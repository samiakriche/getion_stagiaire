@extends('layouts.app')

@section('title', __('demande_stage.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('demande_stage.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('demande_stage.name') }}</td><td>{{ $demandeStage->name }}</td></tr>
                        <tr><td>{{ __('demande_stage.description') }}</td><td>{{ $demandeStage->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $demandeStage)
                    <a href="{{ route('demande_stages.edit', $demandeStage) }}" id="edit-demande_stage-{{ $demandeStage->id }}" class="btn btn-warning">{{ __('demande_stage.edit') }}</a>
                @endcan
                <a href="{{ route('demande_stages.index') }}" class="btn btn-link">{{ __('demande_stage.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
