@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            Tableau de bord Formateur
        </div>
        <div class="card-body">
            <h5 class="card-title">Bienvenue, {{ auth()->user()->name }} !</h5>
            <p class="card-text">
                Vous êtes connecté·e en tant que <strong>Formateur</strong>.  
                Ici, vous pouvez créer et gérer vos cours, quiz et certificats.
            </p>
            <!-- Ajoutez vos liens/actions formateur ci-dessous -->
            <a href="{{ route('formateur.courses.index') }}" class="btn btn-success">Mes cours</a>
        </div>
    </div>
</div>
@endsection
