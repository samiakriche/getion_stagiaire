@extends('layouts.app')

@section('title', __('message.create'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('message.create') }}</div>
            <form method="POST" action="{{ route('messages.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('To') }} <span class="form-required">*</span></label>
                        {{ Form::select('to', $users, null); }}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Message</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="message" rows="4">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('message.create') }}" class="btn btn-success">
                    <a href="{{ route('messages.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
