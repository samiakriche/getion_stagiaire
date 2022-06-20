@extends('layouts.app')

@section('title', __('message.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('message.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('message.name') }}</td><td>{{ $message->name }}</td></tr>
                        <tr><td>{{ __('message.description') }}</td><td>{{ $message->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $message)
                    <a href="{{ route('messages.edit', $message) }}" id="edit-message-{{ $message->id }}" class="btn btn-warning">{{ __('message.edit') }}</a>
                @endcan
                <a href="{{ route('messages.index') }}" class="btn btn-link">{{ __('message.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
