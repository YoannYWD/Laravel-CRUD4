<?php

namespace App\Http\Controllers;
use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecetteController extends Controller
{
    //AFFICHAGE PAGE INDEX
    public function index() {
        $recettes = DB::table('recettes')
        ->join('users', 'recettes.user_id', '=', 'users.id')
        ->select('recettes.id', 'recettes.nom', 'recettes.image', 'users.name as user')
        ->get();
        return view('recettes.index', compact('recettes'));
    }

    //AFFICHAGE PAGE CREATE
    public function create() {
        return view('recettes.create');
    }

    //ENREGISTREMENT NOUVELLE RECETTE
    public function store(Request $request) {
        $imageName = "";
        if ($request->image) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        $newRecette = new Recette;
        $newRecette->nom = $request->nom;
        $newRecette->image = '/images/' . $imageName;
        $newRecette->user_id = $request->user_id;
        $newRecette->save();

        return redirect()->route('index')
                         ->with('success', 'Recette enregistrée !')
                         ->with('image', $imageName);

    }

    //EDITER UNE RECETTE
    public function edit($id) {
        $recette = Recette::findOrFail($id);
        return view('recettes.edit', compact('recette'));
    }

    public function update(Request $request, $id) {
        $updateRecette = $request->validate([
            'nom' => 'required'
        ]);
        $updateRecette = $request->except(['_token', '_method']);

        if ($request->image) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $updateRecette['image'] = '/images/' . $imageName;

        }
        
        Recette::whereId($id)->update($updateRecette);
        return redirect()->route('index')
                         ->with('success', 'Recette modifié !');
    }

    //SUPPRESSION RECETTE
    public function destroy($id) {
        $recette = Recette::findOrFail($id);
        $recette->delete();
        return redirect()->route('index')
                         ->with('success', 'Recette supprimé !');
    }
}
