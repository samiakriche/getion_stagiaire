@extends('layouts.app')

@section('title', __('encadrant.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Encadrant)
            <a href="{{ route('encadrants.create') }}" class="btn btn-success">{{ __('encadrant.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('encadrant.list') }} <small>{{ __('app.total') }} : {{ $encadrants->total() }} {{ __('encadrant.encadrant') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('encadrant.search') }}</label>
                        <input placeholder="{{ __('encadrant.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('encadrant.search') }}" class="btn btn-secondary">
                    <a href="{{ route('encadrants.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('Nom') }}</th>
                        <th>{{ __('Prenom') }}</th>
                        <th>{{ __('Tel') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($encadrants as $key => $encadrant)
                    <tr>
                        <td class="text-center">{{ $encadrants->firstItem() + $key }}</td>
                        <td>{!! $encadrant->name_link !!}</td>
                        <td>{{ $encadrant->prenom }}</td>
                        <td>{{ $encadrant->tel }}</td>
                        <td>{{ $encadrant->email }}</td>
                        <td>{{ $encadrant->status }}</td>
                        <td class="text-center">
                            @can('view', $encadrant)
                                <a href="{{ route('encadrants.show', $encadrant) }}" id="show-encadrant-{{ $encadrant->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $encadrants->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
