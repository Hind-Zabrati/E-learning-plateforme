@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Tableau de bord Admin
        </div>
        <div class="card-body">
            <h5 class="card-title">Bienvenue, {{ auth()->user()->name }} !</h5>
            <p class="card-text">
                Vous êtes connecté·e en tant qu’<strong>Admin</strong>.  
                Ici, vous pouvez gérer les utilisateurs, les contenus et tout l’espace de la plateforme.
            </p>
            <!-- Ajoutez vos liens/actions admin ci-dessous -->
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Gérer les utilisateurs</a>
        </div>
    </div>
</div>
@endsection
