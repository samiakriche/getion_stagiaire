@extends('layouts.app')

@section('title', __('etudiant.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('etudiant.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('etudiant.name') }}</td><td>{{ $etudiant->name }}</td></tr>
                        <tr><td>{{ __('etudiant.description') }}</td><td>{{ $etudiant->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $etudiant)
                    <a href="{{ route('etudiants.edit', $etudiant) }}" id="edit-etudiant-{{ $etudiant->id }}" class="btn btn-warning">{{ __('etudiant.edit') }}</a>
                @endcan
                <a href="{{ route('etudiants.index') }}" class="btn btn-link">{{ __('etudiant.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
