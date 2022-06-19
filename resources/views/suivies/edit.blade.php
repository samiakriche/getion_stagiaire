@extends('layouts.app')

@section('title', __('suivie.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $suivie)
        @can('delete', $suivie)
            <div class="card">
                <div class="card-header">{{ __('suivie.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('suivie.name') }}</label>
                    <p>{{ $suivie->name }}</p>
                    <label class="form-label text-primary">{{ __('suivie.description') }}</label>
                    <p>{{ $suivie->description }}</p>
                    {!! $errors->first('suivie_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('suivie.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('suivies.destroy', $suivie) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="suivie_id" type="hidden" value="{{ $suivie->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('suivies.edit', $suivie) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('suivie.edit') }}</div>
            <form method="POST" action="{{ route('suivies.update', $suivie) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('suivie.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $suivie->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('suivie.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $suivie->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('suivie.update') }}" class="btn btn-success">
                    <a href="{{ route('suivies.show', $suivie) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $suivie)
                        <a href="{{ route('suivies.edit', [$suivie, 'action' => 'delete']) }}" id="del-suivie-{{ $suivie->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
