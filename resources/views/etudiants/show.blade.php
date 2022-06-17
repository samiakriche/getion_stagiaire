@extends('layouts.app')

@section('title', __('etudiant.detail'))

@section('content')
<div class="content-wrapper">
          <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Etudiant Details</h4>
                    <p class="card-description"> </p>
    
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>Name</td><td>{{ $etudiant->nom }}</td></tr>
                        <tr><td>Prenom</td><td>{{ $etudiant->prenom }}</td></tr>
                        <tr><td>Email</td><td>{{ $etudiant->email }}</td></tr>
                    
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 offset-1">
                @can('update', $etudiant)
                    <a href="{{ route('etudiants.edit', $etudiant) }}" id="edit-etudiant-{{ $etudiant->id }}" class="btn btn-info">Modifier</a>
                @endcan
                <a href="{{ route('etudiants.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection
