@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestion des Frais Journaliers</h2>
    <!--
    <a href="{{ route('admin.paiements.create') }}" class="btn btn-primary mb-3">
        Ajouter un Frais Journalier
    </a>
-->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Frais par Jour</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paiements as $paiement)
                    <tr>
                        <td>{{ number_format($paiement->frais_jour, 2) }} €</td>
                        <td>
                            <a href="{{ route('admin.paiements.edit', $paiement) }}" 
                               class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.paiements.destroy', $paiement) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                 
                               @method('DELETE')
                               <!-- <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Êtes-vous sûr ?')">
                                    Supprimer
                                </button>
-->
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection