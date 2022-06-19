@extends('layouts.app')

@section('title', __('suivie.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('suivie.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('suivie.name') }}</td><td>{{ $suivie->name }}</td></tr>
                        <tr><td>{{ __('suivie.description') }}</td><td>{{ $suivie->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $suivie)
                    <a href="{{ route('suivies.edit', $suivie) }}" id="edit-suivie-{{ $suivie->id }}" class="btn btn-warning">{{ __('suivie.edit') }}</a>
                @endcan
                <a href="{{ route('suivies.index') }}" class="btn btn-link">{{ __('suivie.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
