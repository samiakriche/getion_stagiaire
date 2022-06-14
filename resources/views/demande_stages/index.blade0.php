@extends('layouts.app')

@section('title', __('demande_stage.list'))

@section('content')
<div class="mb-3">
  
     @if (Auth::user()->role === 'user')
                                    
                                  
                                  
    <div class="float-right">
        @can('create', new App\Models\DemandeStage)
            <a href="{{ route('demande_stages.create') }}" class="btn btn-success">{{ __('demande_stage.create') }}</a>
        @endcan
    </div>
    @endif
    <h1 class="page-title">{{ __('demande_stage.list') }} <small>{{ __('app.total') }} : {{ $demandeStages->total() }} {{ __('demande_stage.demande_stage') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('demande_stage.search') }}</label>
                        <input placeholder="{{ __('demande_stage.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="Titre">
                    </div>
                    <input type="submit" value="{{ __('demande_stage.search') }}" class="btn btn-secondary">
                    <a href="{{ route('demande_stages.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('Titre0') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Encadrant ID ') }}</th>

                        
                        @if (Auth::user()->role === 'admin')
                        <th class="text-center">{{ __('Action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandeStages as $key => $demandeStage)
                    <tr>
                        <td class="text-center">{{ $demandeStages->firstItem() + $key }}</td>
                        <td>{!! $demandeStage->name_link !!}</td>
                        <td>{{ $demandeStage->description }}</td>
                        <td>{{ $demandeStage->status }}</td>
                        
                       
                        <td>{{ $demandeStage->encadrant_id }}</td>
                        
                        
                      <!--  <td class="text-center">
                            @can('view', $demandeStage)
                                <a href="{{ route('demande_stages.show', $demandeStage) }}" id="show-demande_stage-{{ $demandeStage->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td> -->
                       
                        @if (Auth::user()->role === 'admin' )   
                <td id="{{ $demandeStage->id }}" class="text-center" >
                @if( $demandeStage->status === 'Pending'  )  
                    <form style="display: flex;gap: 12px; justify-content: center;" method="POST" action="{{ route('demande_stages.status',$demandeStage->id) }}" accept-charset="UTF-8">
                    {{ csrf_field() }} {{ method_field('post') }}
                    
                   
                    <div class="form-group">
                    <input type="submit" name="status" label="accepter" value="accepter" >
                        
                    </div>   
                    <div class="form-group">
                    <input type="submit" name="status"  value="refuser" >
                    </div>  
                    </form>
                  
                    @elseif( $demandeStage->status === 'Accepted'  )
                    <form  id="{{ $demandeStage->id }}" style="display: flex;gap: 12px; justify-content: center;" method="POST" action="{{ route('demande_stages.encadrant',$demandeStage->id) }}" accept-charset="UTF-8">
                    {{ csrf_field() }} {{ method_field('post') }}
                    <div class="form-group">
                    <input id="{{ $demandeStage->id }}" type="text"  name="encadrant_id" value=""   > 
                    <input id="{{ $demandeStage->id }}" type="submit"   value="Affecter" >
                    </div> 
                    </form>
                    @endif 
                        
                       
                    
               
                    
                    
                   
                </td>
                @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $demandeStages->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
