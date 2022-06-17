@extends('layouts.app')

@section('title', __('document.list'))

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
        @can('create', new App\Models\Document)
            <a href="{{ route('documents.create') }}"> <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">Create nouveau document<i class="mdi mdi-account-plus"></i>
            </button></a>  @endcan
    </div>

</div>
<div class="row">
    <div class="col-md-12">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">Rechercher des documents</label>
                        <input placeholder="{{ __('document.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="Rechercher" class="btn btn-primary">
                    <a href="{{ route('documents.index') }}" class="btn btn-light">Annuler</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('Nom') }}</th>
                        <th>{{ __('Description') }}</th>
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
                                <a href="{{ route('documents.show', $document) }}" class="btn btn-light" id="show-document-{{ $document->id }}">Voir</a>
                            @endcan
                            
                            <a href="{{ route('documents.download', $document->id) }}" class="btn btn-info" id="id">Télécharger</a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-10">{{ $documents->appends(Request::except('page'))->render() }}</div>
        </div>
       <p><small>{{ __('app.total') }} : {{ $documents->total() }} {{ __('document.document') }}</small></p> 
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
