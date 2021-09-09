@extends('dashboard')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-6 offset-3">
            <form method="POST" action="{{route('update', $recette->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
                <div class="mb-3">
                  <label>Nom</label>
                  <input type="text" name="nom" class="form-control" placeholder="Nom de la recette" value="{{$recette->nom}}">
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image">
                </div>

                <input type="hidden" value="{{auth()->id()}}" name="user_id">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

@endsection