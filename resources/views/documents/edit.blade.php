@extends('layouts.app')

@section('title', __('document.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $document)
        @can('delete', $document)
            <div class="card">
                <div class="card-header">{{ __('document.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('document.name') }}</label>
                    <p>{{ $document->name }}</p>
                    <label class="form-label text-primary">{{ __('document.description') }}</label>
                    <p>{{ $document->description }}</p>
                    {!! $errors->first('document_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('document.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('documents.destroy', $document) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="document_id" type="hidden" value="{{ $document->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('documents.edit', $document) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('document.edit') }}</div>
            <form method="POST" action="{{ route('documents.update', $document) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('document.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $document->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('document.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $document->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('document.update') }}" class="btn btn-success">
                    <a href="{{ route('documents.show', $document) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $document)
                        <a href="{{ route('documents.edit', [$document, 'action' => 'delete']) }}" id="del-document-{{ $document->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
