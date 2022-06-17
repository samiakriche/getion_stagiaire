@extends('layouts.app')

@section('title', __('encadrant.detail'))

@section('content')
<div class="content-wrapper">
          <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Encadrant Details</h4>
                    <p class="card-description"> </p>
    
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('Nom') }}</td><td>{{ $encadrant->nom }}</td></tr>
                        <tr><td>{{ __('Prenom') }}</td><td>{{ $encadrant->prenom }}</td></tr>
                        <tr><td>{{ __('Tel') }}</td><td>{{ $encadrant->tel }}</td></tr>
                        <tr><td>{{ __('Email') }}</td><td>{{ $encadrant->email }}</td></tr>
                        <tr><td>{{ __('Status') }}</td><td>{{ $encadrant->status }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 offset-1">
                @can('update', $encadrant)
                    <a href="{{ route('encadrants.edit', $encadrant) }}" id="edit-encadrant-{{ $encadrant->id }}" class="btn btn-info">Modifier</a>
                @endcan
                <a href="{{ route('encadrants.index') }}" class="btn btn-light">Voir la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection
