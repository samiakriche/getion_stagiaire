@extends('layouts.app')

@section('title', __('message.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Message)
            <a href="{{ route('messages.create') }}" class="btn btn-success">{{ __('message.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('message.list') }} <small>{{ __('app.total') }} : {{ $messages->total() }} {{ __('message.message') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('message.search') }}</label>
                        <input placeholder="{{ __('message.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('message.search') }}" class="btn btn-secondary">
                    <a href="{{ route('messages.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('From') }}</th>
                        <th>Message</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $key => $message)
                    <tr>
                        <td class="text-center">{{ $messages->firstItem() + $key }}</td>
                        <td>{{ $message->from }}</td>
                        <td>{{ $message->message }}</td>
                        <td class="text-center">
                            @can('view', $message)
                                <a href="{{ route('messages.show', $message) }}" id="show-message-{{ $message->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $messages->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
