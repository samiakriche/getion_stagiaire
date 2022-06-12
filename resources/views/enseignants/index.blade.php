@extends('layouts.admin-app')

@section('title', __('enseignant.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Enseignant)
            <a href="{{ route('enseignants.create') }}" class="btn btn-success">{{ __('enseignant.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('enseignant.list') }} <small>{{ __('app.total') }} : {{ $enseignants->total() }} {{ __('enseignant.enseignant') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('enseignant.search') }}</label>
                        <input placeholder="{{ __('enseignant.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('enseignant.search') }}" class="btn btn-secondary">
                    <a href="{{ route('enseignants.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('enseignant.name') }}</th>
                        <th>{{ __('enseignant.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enseignants as $key => $enseignant)
                    <tr>
                        <td class="text-center">{{ $enseignants->firstItem() + $key }}</td>
                        <td>{!! $enseignant->name_link !!}</td>
                        <td>{{ $enseignant->description }}</td>
                        <td class="text-center">
                            @can('view', $enseignant)
                                <a href="{{ route('enseignants.show', $enseignant) }}" id="show-enseignant-{{ $enseignant->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $enseignants->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
