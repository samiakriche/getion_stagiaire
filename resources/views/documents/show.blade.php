@extends('layouts.app')

@section('title', __('document.detail'))

@section('content')
<div class="content-wrapper">
          <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{ __('demande_stage.detail') }}</h4>
                    <p class="card-description">
                    
                    </p>
    
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>Nom</td><td>{{ $document->name }}</td></tr>
                        <tr><td>Description</td><td>{{ $document->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                @can('update', $document)
                    <a href="{{ route('documents.edit', $document) }}" id="edit-document-{{ $document->id }}" class="btn btn-primary">Modifier</a>
                @endcan
                <a href="{{ route('documents.index') }}" class="btn btn-light">Voir la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection
