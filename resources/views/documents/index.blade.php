@extends('layouts.app')

@section('title', __('document.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Document)
            <a href="{{ route('documents.create') }}" class="btn btn-success">{{ __('document.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('document.list') }} <small>{{ __('app.total') }} : {{ $documents->total() }} {{ __('document.document') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('document.search') }}</label>
                        <input placeholder="{{ __('document.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('document.search') }}" class="btn btn-secondary">
                    <a href="{{ route('documents.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('Nom') }}</th>
                        <th>{{ __('document.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $key => $document)
                    <tr>
                        <td class="text-center">{{ $documents->firstItem() + $key }}</td>
                        <td>{!! $document->name_link !!}</td>
                        <td>{{ $document->description }}</td>
                        <td class="text-center"  style="display: flex;gap: 12px; justify-content: center;">
                            @can('view', $document)
                                <a href="{{ route('documents.show', $document) }}" id="show-document-{{ $document->id }}">{{ __('app.show') }}</a>
                            @endcan
                            
                            <a href="{{ route('documents.download', $document->id) }}" id="id">{{ __('Download') }}</a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $documents->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
