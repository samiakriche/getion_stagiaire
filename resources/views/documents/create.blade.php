@extends('layouts.app')

@section('title', __('document.create'))

@section('content')
<div class="content-wrapper">
          <div class="row">
            
       
    
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">Créer un nouveau document</div>
            <form method="POST" action="{{ route('documents.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                      <input type="file" name="file" placeholder="Choose file" id="file">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                  </div>
                
                <div class="col-md-12 offset-1">
              
                    <input type="submit" value="Créer" class="btn btn-success">
                    <a href="{{ route('documents.index') }}" class="btn btn-light">Annuler</a>
                
                </div>        </form>
        </div>
        </div>
    </div>
</div>

<div class="row"></div>
    
@endsection
