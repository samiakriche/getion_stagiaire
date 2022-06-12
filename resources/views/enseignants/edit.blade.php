@extends('layouts.admin-app')


@section('title', __('enseignant.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $enseignant)
        @can('delete', $enseignant)
            <div class="card">
                <div class="card-header">{{ __('enseignant.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('enseignant.name') }}</label>
                    <p>{{ $enseignant->name }}</p>
                    <label class="form-label text-primary">{{ __('enseignant.description') }}</label>
                    <p>{{ $enseignant->description }}</p>
                    {!! $errors->first('enseignant_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('enseignant.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('enseignants.destroy', $enseignant) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="enseignant_id" type="hidden" value="{{ $enseignant->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('enseignants.edit', $enseignant) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('enseignant.edit') }}</div>
            <form method="POST" action="{{ route('enseignants.update', $enseignant) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('enseignant.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $enseignant->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('enseignant.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $enseignant->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('enseignant.update') }}" class="btn btn-success">
                    <a href="{{ route('enseignants.show', $enseignant) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $enseignant)
                        <a href="{{ route('enseignants.edit', [$enseignant, 'action' => 'delete']) }}" id="del-enseignant-{{ $enseignant->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
