@extends('layouts.admin-app')


@section('title', __('enseignant.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('enseignant.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('enseignant.name') }}</td><td>{{ $enseignant->name }}</td></tr>
                        <tr><td>{{ __('enseignant.description') }}</td><td>{{ $enseignant->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $enseignant)
                    <a href="{{ route('enseignants.edit', $enseignant) }}" id="edit-enseignant-{{ $enseignant->id }}" class="btn btn-warning">{{ __('enseignant.edit') }}</a>
                @endcan
                <a href="{{ route('enseignants.index') }}" class="btn btn-link">{{ __('enseignant.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
