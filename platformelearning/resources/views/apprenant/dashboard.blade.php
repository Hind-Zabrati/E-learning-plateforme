@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            Tableau de bord Apprenant
        </div>
        <div class="card-body">
            <h5 class="card-title">Bienvenue, {{ auth()->user()->name }} !</h5>
            <p class="card-text">
                Vous êtes connecté·e en tant qu’<strong>Apprenant</strong>.  
                Ici, vous pouvez accéder à vos cours, suivre votre progression et télécharger vos certificats.
            </p>
            <!-- Ajoutez vos liens/actions apprenant ci-dessous -->
            <a href="{{ route('apprenant.courses.index') }}" class="btn btn-info">Mes cours</a>
        </div>
    </div>
</div>
@endsection
