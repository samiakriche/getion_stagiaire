@extends('layouts.app')

@section('title', __('demande_stage.detail'))

@section('content')       
<div class="content-wrapper">
          <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Demande de stage </h4>
                    <p class="card-description"> </p>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('demande_stage.name') }}</td><td>{{ $demandeStage->name }}</td></tr>
                        <tr><td>{{ __('demande_stage.description') }}</td><td>{{ $demandeStage->desciption }}</td></tr>
                      
                         <tr><td>{{ __('Date de debut') }}</td><td>{{ $demandeStage->date_debut }}</td></tr>
                        <tr><td>{{ __('Date de fin') }}</td><td>{{ $demandeStage->date_fin }}</td></tr>
                        
                        <tr><td>{{ __('Societe') }}</td><td>{{ $demandeStage->societe }}</td></tr>
                        <tr><td>{{ __('Status') }}</td><td>{{ $demandeStage->status }}</td></tr>
                        <tr><td>{{ __('Encadrant ID ') }}</td><td>{{ $demandeStage->encadrant_id }}</td></tr>
                        <tr><td>{{ __('Lettre de motivation ') }}</td><td></td></tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-12 offset-1">
                @can('update', $demandeStage)
                    <a href="{{ route('demande_stages.edit', $demandeStage) }}" id="edit-demande_stage-{{ $demandeStage->id }}" class="btn btn-info">Modifier </a>
                @endcan
                <a href="{{ route('demande_stages.index') }}" class="btn btn-light">Cancel</a>
                </div>
        </div>
    </div>
</div>

@endsection
