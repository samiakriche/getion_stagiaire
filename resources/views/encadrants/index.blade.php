
@extends('layouts.app')
@section('title', __('encadrant.list'))
@section('content')

      <!-- partial -->
    
      <div class="row">
            
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
           
                <div class="card-body">
                <div class="mb-3">
    <div class="float-right">
  
        @can('create', new App\Models\Encadrant)
            <a href="{{ route('encadrants.create') }}" class="btn btn-success">Créer un encadrant</a>
        @endcan
    </div>
    <h4 class="card-title">Liste des encadrants</h4>
</div>

                
                  <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">Rechercher un encadrant </label>
                        <input placeholder="Rechercher" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="Rechercher" class="btn btn-priamary">
                    <a href="{{ route('encadrants.index') }}" class="btn btn-light">Annuler</a>
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
            <p><small>{{ __('app.total') }} : {{ $encadrants->total() }} {{ __('encadrant.encadrant') }}</small>
            </p>  </div>
              </div>
            </div>
           
           
          </div>
        </div>
@endsection
