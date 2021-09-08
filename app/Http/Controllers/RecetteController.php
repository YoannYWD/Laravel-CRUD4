<?php

namespace App\Http\Controllers;
use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecetteController extends Controller
{
    public function index() {
        $recettes = DB::table('recettes')
        ->join('users', 'recettes.user_id', '=', 'users.id')
        ->select('recettes.id', 'recettes.nom', 'recettes.image', 'users.name as user')
        ->get();
        return view('recettes.index', compact('recettes'));
    }


    public function create() {
        return view('recettes.create');
    }

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
                         ->with('success', 'Recette enregistré !')
                         ->with('image', $imageName);

    }
}
