@extends('dashboard')

@section('content')

<div class="container mt-5">
    <div class="row">

            <h1 class="text-center">Liste des recettes</h1>
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div><br />
            @endif

            @foreach($recettes as $recette)
            <div class="col-3 mt-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{$recette->image}}" class="card-img-top" alt="Image de {{$recette->nom}}" style="height: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$recette->nom}}</h5>
                        <p>#{{$recette->id}}</p>
                        <p>Posté par {{$recette->user}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        
    </div>
</div>

@endsection