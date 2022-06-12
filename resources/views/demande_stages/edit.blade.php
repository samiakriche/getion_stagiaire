@extends('layouts.app')

@section('title', __('demande_stage.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $demandeStage)
        @can('delete', $demandeStage)
            <div class="card">
                <div class="card-header">{{ __('demande_stage.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('demande_stage.name') }}</label>
                    <p>{{ $demandeStage->name }}</p>
                    <label class="form-label text-primary">{{ __('demande_stage.description') }}</label>
                    <p>{{ $demandeStage->description }}</p>
                    {!! $errors->first('demande_stage_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('demande_stage.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('demande_stages.destroy', $demandeStage) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="demande_stage_id" type="hidden" value="{{ $demandeStage->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('demande_stages.edit', $demandeStage) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('demande_stage.edit') }}</div>
            <form method="POST" action="{{ route('demande_stages.update', $demandeStage) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('demande_stage.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $demandeStage->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('demande_stage.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $demandeStage->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('demande_stage.update') }}" class="btn btn-success">
                    <a href="{{ route('demande_stages.show', $demandeStage) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $demandeStage)
                        <a href="{{ route('demande_stages.edit', [$demandeStage, 'action' => 'delete']) }}" id="del-demande_stage-{{ $demandeStage->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
