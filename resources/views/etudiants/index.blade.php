@extends('layouts.app')
@section('title', __('etudiant.list'))
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
                        <p class="card-subtitle card-subtitle-dash">Rechercher etudiant</p>
                     </div>
                     <div>
                        @can('create', new App\Models\Etudiant)
                        @endcan
                        <a href="{{ route('etudiants.create') }}"><button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>créer etudiant</button>
                        </a> 
                     </div>
                  </div>
                 
                     <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                        <div class="form-group">
                           <label for="q" class="form-label"></label>
                           <input placeholder="Rechercher" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                        </div>
                        <input type="submit" value="{{ __('etudiant.search') }}" class="btn btn-primary">
                        <a href="{{ route('etudiants.index') }}" class="btn btn-light">Annuler</a>
                     </form>
                   
                  <div class="table-responsive ">
                    
                     <table class="table select-table">
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
                                 <a href="{{ route('etudiants.show', $etudiant) }}" id="show-etudiant-{{ $etudiant->id }}" class="btn btn-info">Voir details</a>
                                 @endcan
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     <div class="col-md-10">  <small>{{ __('app.total') }} : {{ $etudiants->total() }} {{ __('etudiant.etudiant') }}</small></div>
                     <div class="card-body">{{ $etudiants->appends(Request::except('page'))->render() }}</div>
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