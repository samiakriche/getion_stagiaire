@extends('layouts.app')

@section('title', __('user_profile.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('user_profile.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('Nom') }}</td><td>{{ $userProfile->nom }}</td></tr>
                        <tr><td>{{ __('Prenom') }}</td><td>{{ $userProfile->prenom }}</td></tr>
                        <tr><td>{{ __('Email') }}</td><td>{{ $userProfile->email }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
               
               <a href="{{ route('user_profile.edit', $userProfile->id) }}" id="edit-user_profile-{{ $userProfile->id }}" class="btn btn-warning">{{ __('user_profile.edit') }}</a>
              
               
            </div>
        </div>
    </div>
</div>
@endsection
