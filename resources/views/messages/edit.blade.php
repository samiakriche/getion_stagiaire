@extends('layouts.app')

@section('title', __('message.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $message)
        @can('delete', $message)
            <div class="card">
                <div class="card-header">{{ __('message.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('message.name') }}</label>
                    <p>{{ $message->name }}</p>
                    <label class="form-label text-primary">{{ __('message.description') }}</label>
                    <p>{{ $message->description }}</p>
                    {!! $errors->first('message_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('message.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('messages.destroy', $message) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="message_id" type="hidden" value="{{ $message->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('messages.edit', $message) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('message.edit') }}</div>
            <form method="POST" action="{{ route('messages.update', $message) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('message.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $message->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('message.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $message->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('message.update') }}" class="btn btn-success">
                    <a href="{{ route('messages.show', $message) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $message)
                        <a href="{{ route('messages.edit', [$message, 'action' => 'delete']) }}" id="del-message-{{ $message->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
