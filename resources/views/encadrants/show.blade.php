@extends('layouts.app')

@section('title', __('encadrant.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('encadrant.detail') }}</div>
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
            <div class="card-footer">
                @can('update', $encadrant)
                    <a href="{{ route('encadrants.edit', $encadrant) }}" id="edit-encadrant-{{ $encadrant->id }}" class="btn btn-warning">{{ __('encadrant.edit') }}</a>
                @endcan
                <a href="{{ route('encadrants.index') }}" class="btn btn-link">{{ __('encadrant.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
