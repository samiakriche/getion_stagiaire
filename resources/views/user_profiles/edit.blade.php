@extends('layouts.app')

@section('title', __('user_profile.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $userProfile)
        @can('delete', $userProfile)
            <div class="card">
                <div class="card-header">{{ __('user_profile.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('user_profile.name') }}</label>
                    <p>{{ $userProfile->name }}</p>
                    <label class="form-label text-primary">{{ __('user_profile.description') }}</label>
                    <p>{{ $userProfile->description }}</p>
                    {!! $errors->first('user_profile_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('user_profile.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('user_profiles.destroy', $userProfile) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="user_profile_id" type="hidden" value="{{ $userProfile->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('user_profiles.edit', $userProfile) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('user_profile.edit') }}</div>
            <form method="POST" action="{{ route('user_profiles.update', $userProfile) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Nom') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nom" value="{{ old('name', $userProfile->nom) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Prenom') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="Prenom" value="{{ old('name', $userProfile->prenom) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Email') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="email" value="{{ old('name', $userProfile->email) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('user_profile.update') }}" class="btn btn-success">
                    <a href="{{ route('user_profiles.show', $userProfile) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $userProfile)
                        <a href="{{ route('user_profiles.edit', [$userProfile, 'action' => 'delete']) }}" id="del-user_profile-{{ $userProfile->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
