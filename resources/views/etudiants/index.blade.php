@extends('layouts.app')

@section('title', __('etudiant.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Etudiant)
            <a href="{{ route('etudiants.create') }}" class="btn btn-success">{{ __('etudiant.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('etudiant.list') }} <small>{{ __('app.total') }} : {{ $etudiants->total() }} {{ __('etudiant.etudiant') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('etudiant.search') }}</label>
                        <input placeholder="{{ __('etudiant.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('etudiant.search') }}" class="btn btn-secondary">
                    <a href="{{ route('etudiants.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('Nom') }}</th>
                        <th>{{ __('Prenom') }}</th>
                        <th>{{ __('Email') }}</th>

                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etudiants as $key => $etudiant)
                    <tr>
                        <td class="text-center">{{ $etudiants->firstItem() + $key }}</td>
                        <td>{!! $etudiant->name_link !!}</td>
                        <td>{{ $etudiant->Prenom }}</td>
                        <td>{{ $etudiant->Email }}</td>

                        <td class="text-center">
                            @can('view', $etudiant)
                                <a href="{{ route('etudiants.show', $etudiant) }}" id="show-etudiant-{{ $etudiant->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $etudiants->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
