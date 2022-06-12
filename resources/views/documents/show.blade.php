@extends('layouts.app')

@section('title', __('document.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('document.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('document.name') }}</td><td>{{ $document->name }}</td></tr>
                        <tr><td>{{ __('document.description') }}</td><td>{{ $document->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $document)
                    <a href="{{ route('documents.edit', $document) }}" id="edit-document-{{ $document->id }}" class="btn btn-warning">{{ __('document.edit') }}</a>
                @endcan
                <a href="{{ route('documents.index') }}" class="btn btn-link">{{ __('document.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
