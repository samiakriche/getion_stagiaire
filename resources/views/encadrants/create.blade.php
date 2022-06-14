@extends('layouts.app')

@section('title', __('encadrant.create'))

@section('content')
<div class="content-wrapper">
          <div class="row">
            
       
    
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{ __('encadrant.create') }}</h4>
                    <p class="card-description">
                    
                    </p>
    
            <form method="POST" action="{{ route('encadrants.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Nom') }} <span class="form-required">*</span></label>
                        <input id="name" type="text"  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nom" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Prenom') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="prenom" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Tel') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="tel" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Email') }}</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="email" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}

                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Status') }}</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="status" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}

                    </div>
                </div>
                <div class="col-md-12 offset-md-1">
                    <input type="submit" value="{{ __('encadrant.create') }}" class="btn btn-success">
                    <a href="{{ route('encadrants.index') }}" class="btn btn-danger">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
