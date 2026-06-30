@extends('layouts.master')

@section('pageTitle', 'Inicio')

@section('content')

    <div class="text-center mt-5">
        <h1 class="display-4">Pequeño CRUD Laravel</h1>
        
        <p class="lead mt-3">Podrás aprender el flujo básico al trabajar con un framework como <span class="font-weight-bold text-primary">Laravel</span> y tocarás temas importantes que podrás profundizar más adelante</p>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Conceptos que aprenderemos:</h2>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Migraciones</li>
                <li class="list-group-item">Routing</li>
                <li class="list-group-item">Models</li>
                <li class="list-group-item">Controllers</li>
                <li class="list-group-item">Views</li>
            </ul>
        </div>
    </div>

@endsection