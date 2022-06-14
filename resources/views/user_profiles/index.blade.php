@extends('layouts.app')

@section('title', __('user_profile.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\UserProfile)
            <a href="{{ route('user_profiles.create') }}" class="btn btn-success">{{ __('user_profile.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('user_profile.list') }} <small>{{ __('app.total') }} : {{ $userProfiles->total() }} {{ __('user_profile.user_profile') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('user_profile.search') }}</label>
                        <input placeholder="{{ __('user_profile.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('user_profile.search') }}" class="btn btn-secondary">
                    <a href="{{ route('user_profiles.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('user_profile.name') }}</th>
                        <th>{{ __('user_profile.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userProfiles as $key => $userProfile)
                    <tr>
                        <td class="text-center">{{ $userProfiles->firstItem() + $key }}</td>
                        <td>{!! $userProfile->name_link !!}</td>
                        <td>{{ $userProfile->description }}</td>
                        <td class="text-center">
                            @can('view', $userProfile)
                                <a href="{{ route('user_profiles.show', $userProfile) }}" id="show-user_profile-{{ $userProfile->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $userProfiles->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
