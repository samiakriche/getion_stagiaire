@extends('layouts.app')

@section('title', __('user_profile.detail'))

@section('content')
<div class="content-wrapper">
          <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Encadrant Details</h4>
                    <p class="card-description"> </p>
    
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('Nom') }}</td><td>{{ $userProfile->nom }}</td></tr>
                        <tr><td>{{ __('Prenom') }}</td><td>{{ $userProfile->prenom }}</td></tr>
                        <tr><td>{{ __('Email') }}</td><td>{{ $userProfile->email }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 offset-1">
               
               <a href="{{ route('user_profile.edit', $userProfile->id) }}" id="edit-user_profile-{{ $userProfile->id }}" class="btn btn-info">Modifier mes informations</a>
              
               
            </div>
        </div>
    </div>
</div>
@endsection
