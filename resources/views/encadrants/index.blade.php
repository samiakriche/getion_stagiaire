@extends('layouts.app')
@section('title', __('encadrant.list'))
@section('content')

<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">

<div class="float-right">
 
      <div class="row flex-grow">
         <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
               <div class="card-body">
                  <div class="d-sm-flex justify-content-between align-items-start">
                     <div>
                        <h4 class="card-title card-title-dash">Liste des etudiants</h4>
                     
                     </div>
                     <div>
                     @can('create', new App\Models\Encadrant)
                        <a href="{{ route('encadrants.create') }}" ><button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>créer encadrant</button>
                       </a>
                        @endcan
                     </div>
                  </div>
                 
                  <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">Rechercher un encadrant </label>
                        <input placeholder="Rechercher" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}" >
                    </div>
                    <input type="submit" value="Rechercher" class="btn btn-primary">
                    <a href="{{ route('encadrants.index') }}" class="btn btn-light">Annuler</a>
                </form>
                   
                  <div class="table-responsive ">
                    
                     <table class="table select-table">
                        <thead>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('Nom') }}</th>
                        <th>{{ __('Prenom') }}</th>
                        <th>{{ __('Tel') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                        </thead>
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
                                <a href="{{ route('encadrants.show', $encadrant) }}" id="show-encadrant-{{ $encadrant->id }}" class="btn btn-info">Voir details</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                       
                     </table>
                     <div class="col-md-10"><p><small>{{ __('app.total') }} : {{ $encadrants->total() }} {{ __('encadrant.encadrant') }}</small>
            </p></div>
                     <div class="card-body">{{ $encadrants->appends(Request::except('page'))->render() }}</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>
@endsection