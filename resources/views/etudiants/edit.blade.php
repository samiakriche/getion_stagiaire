@extends('layouts.app')

@section('title', __('etudiant.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $etudiant)
        @can('delete', $etudiant)
            <div class="card">
                <div class="card-header">{{ __('etudiant.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('etudiant.name') }}</label>
                    <p>{{ $etudiant->name }}</p>
                    <label class="form-label text-primary">{{ __('etudiant.description') }}</label>
                    <p>{{ $etudiant->description }}</p>
                    {!! $errors->first('etudiant_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('etudiant.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('etudiants.destroy', $etudiant) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="etudiant_id" type="hidden" value="{{ $etudiant->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('etudiants.edit', $etudiant) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('etudiant.edit') }}</div>
            <form method="POST" action="{{ route('etudiants.update', $etudiant) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('etudiant.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $etudiant->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('etudiant.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $etudiant->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('etudiant.update') }}" class="btn btn-success">
                    <a href="{{ route('etudiants.show', $etudiant) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $etudiant)
                        <a href="{{ route('etudiants.edit', [$etudiant, 'action' => 'delete']) }}" id="del-etudiant-{{ $etudiant->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
