@extends('layouts.app')

@section('title', __('suivie.create'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('suivie.create') }}</div>
            <form method="POST" action="{{ route('suivies.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Titre stage') }} <span class="form-required">*</span></label>
                        {{ Form::select('titre_stage',  $titre_stages, null); }}
                       
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Date') }} <span class="form-required">*</span></label>
                        <input id="name" type="date" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="date" value="" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('Commentaires') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="commentaires" rows="4">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('suivie.create') }}" class="btn btn-success">
                    <a href="{{ route('suivies.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
