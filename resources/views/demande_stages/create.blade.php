@extends('layouts.app')
@section('title', __('demande_stage.create'))

@section('content')


        <div class="content-wrapper">
          <div class="row">
            
       
    
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{ __('demande_stage.create') }}</h4>
                    <p class="card-description">
                    
                    </p>
                    <form method="POST" action="{{ route('demande_stages.store') }}" accept-charset="UTF-8" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Titre de stage') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Societe') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="societe" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Date debut') }} <span class="form-required">*</span></label>
                        <input id="name" type="date" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="date_debut" value="" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Date fin') }} <span class="form-required">*</span></label>
                        <input id="name" type="date" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="date_fin" value="" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Lettre de motivation') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                      <input type="file" name="file" placeholder="Choose file" id="file">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                  </div>
                </div>
                <div class="col-md-12 offset-1">
                    <input type="submit" value="{{ __('demande_stage.create') }}" class="btn btn-primary ">
                    <a href="{{ route('user_index') }}" class="btn btn-danger">{{ __('app.cancel') }}</a>
                </div>
            </form>
                  </div>
                </div>
              </div>
              
           
           
           
          </div>
    
       


@endsection
