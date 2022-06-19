@extends('layouts.app')

@section('title', __('suivie.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Suivie)
            <a href="{{ route('suivies.create') }}" class="btn btn-success">{{ __('suivie.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('suivie.list') }} <small>{{ __('app.total') }} : {{ $suivies->total() }} {{ __('suivie.suivie') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('suivie.search') }}</label>
                        <input placeholder="{{ __('suivie.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('suivie.search') }}" class="btn btn-secondary">
                    <a href="{{ route('suivies.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('Titre stage') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Commentaires') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suivies as $key => $suivie)
                    <tr>
                        <td class="text-center">{{ $suivies->firstItem() + $key }}</td>
                        <td>{{ $suivie->titre_stage }}</td>
                        <td>{{ $suivie->date }}</td>
                        <td>{{ $suivie->commentaires }}</td>
                        <td class="text-center">
                            @can('view', $suivie)
                                <a href="{{ route('suivies.show', $suivie) }}" id="show-suivie-{{ $suivie->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $suivies->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
