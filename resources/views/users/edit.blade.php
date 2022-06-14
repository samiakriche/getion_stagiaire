@extends('layouts.app')

@section('title', __('encadrant.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $encadrant)
        @can('delete', $encadrant)
            <div class="card">
                <div class="card-header">{{ __('encadrant.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('Nom') }}</label>
                    <p>{{ $encadrant->nom }}</p>
                    <label class="form-label text-primary">{{ __('Prenom') }}</label>
                    <p>{{ $encadrant->prenom }}</p>
                    <label class="form-label text-primary">{{ __('Tel') }}</label>
                    <p>{{ $encadrant->tel }}</p>
                    <label class="form-label text-primary">{{ __('Email') }}</label>
                    <p>{{ $encadrant->email }}</p>
                    <label class="form-label text-primary">{{ __('Status') }}</label>
                    <p>{{ $encadrant->status }}</p>


                    {!! $errors->first('encadrant_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('encadrant.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('encadrants.destroy', $encadrant) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="encadrant_id" type="hidden" value="{{ $encadrant->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('encadrants.edit', $encadrant) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('encadrant.edit') }}</div>
            <form method="POST" action="{{ route('encadrants.update', $encadrant) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="form-group">
                        <label for="name" class="form-label">{{ __('Nom') }} <span class="form-required">*</span></label>
                        <input id="name" type="text"  class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{ old('name', $encadrant->nom) }}" required>
                        {!! $errors->first('nom', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Prenom') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="prenom" value="{{ old('name', $encadrant->prenom) }}" required>
                        {!! $errors->first('prenom', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Tel') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="tel" value="{{ old('name', $encadrant->tel) }}" required>
                        {!! $errors->first('tel', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Email') }}</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="email" value="{{ old('name', $encadrant->email) }}" required>
                        {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}

                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Status') }}</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="status" value="{{ old('name', $encadrant->status) }}" required>
                        {!! $errors->first('status', '<span class="invalid-feedback" role="alert">:message</span>') !!}

                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('encadrant.update') }}" class="btn btn-success">
                    <a href="{{ route('encadrants.show', $encadrant) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $encadrant)
                        <a href="{{ route('encadrants.edit', [$encadrant, 'action' => 'delete']) }}" id="del-encadrant-{{ $encadrant->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
