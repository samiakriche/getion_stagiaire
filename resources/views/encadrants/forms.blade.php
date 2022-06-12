@if (Request::get('action') == 'create')
@can('create', new App\Models\Encadrant)
    <form method="POST" action="{{ route('encadrants.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="form-label">{{ __('encadrant.name') }} <span class="form-required">*</span></label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('encadrant.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('encadrant.create') }}" class="btn btn-success">
        <a href="{{ route('encadrants.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableEncadrant)
@can('update', $editableEncadrant)
    <form method="POST" action="{{ route('encadrants.update', $editableEncadrant) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="name" class="form-label">{{ __('encadrant.name') }} <span class="form-required">*</span></label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $editableEncadrant->name) }}" required>
            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('encadrant.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableEncadrant->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('encadrant.update') }}" class="btn btn-success">
        <a href="{{ route('encadrants.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableEncadrant)
            <a href="{{ route('encadrants.index', ['action' => 'delete', 'id' => $editableEncadrant->id] + Request::only('page', 'q')) }}" id="del-encadrant-{{ $editableEncadrant->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableEncadrant)
@can('delete', $editableEncadrant)
    <div class="card">
        <div class="card-header">{{ __('encadrant.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('encadrant.name') }}</label>
            <p>{{ $editableEncadrant->name }}</p>
            <label class="form-label text-primary">{{ __('encadrant.description') }}</label>
            <p>{{ $editableEncadrant->description }}</p>
            {!! $errors->first('encadrant_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('encadrant.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('encadrants.destroy', $editableEncadrant) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="encadrant_id" type="hidden" value="{{ $editableEncadrant->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('encadrants.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
