@extends('layouts.app')

@section('title', __('demande_stage.list'))

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <div class="float-right">

                        @if (Auth::user()->role === 'user')
                        <div class="float-right">
                            @can('create', new App\Models\DemandeStage)
                            <a href="{{ route('demande_stages.create') }}" class="btn btn-success">{{
                                __('demande_stage.create') }}</a>
                            @endcan
                        </div>
                        @endif
                        <div>
                            <h3 class="page-title">Liste des demandes des stages</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                                <div class="form-group">
                                    <label for="q" class="form-label">Rechercher des demandes</label>
                                    <input placeholder="{{ __('demande_stage.search_text') }}" name="q" type="text"
                                        id="q" class="form-control mx-sm-2" value="Titre">
                                </div>
                                <input type="submit" value="Rechercher" class="btn btn-primary ">
                                <a href="{{ route('demande_stages.index') }}" class="btn btn-light">Annuler</a>
                            </form>
                        </div>
                        <table class="table  table-responsive  mt-1">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('app.table_no') }}</th>
                                    <th>{{ __('Titre') }}</th>
                                    <!--th>{{ __('Description') }}</th-->
                                    <!--th>{{ __('Date de debut') }}</th>
                                    <th>{{ __('Date de fin') }}</th>
                                    <th>{{ __('Societe') }}</th-->
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Encadrant  ') }}</th>
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
                                    <!--td>{{ $demandeStage->description }}</td-->
                                    <!--td>{{ $demandeStage->date_debut }}</td>
                                    <td>{{ $demandeStage->date_fin }}</td>
                                    <td>{{ $demandeStage->societe }}</td-->
                                    <td>{{ $demandeStage->status }}</td>
                                    <td>{{ $demandeStage->encadrant_nom }}</td>


                                    <!--  <td class="text-center">
                            @can('view', $demandeStage)
                                <a href="{{ route('demande_stages.show', $demandeStage) }}" id="show-demande_stage-{{ $demandeStage->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td> -->
                                    @if (Auth::user()->role === 'admin' )
                                    <td id="{{ $demandeStage->id }}" class="text-center">
                                        @if( $demandeStage->status === 'Pending' )
                                        <form style="display: flex;gap: 12px; justify-content: center;" method="POST"
                                            action="{{ route('demande_stages.status',$demandeStage->id) }}"
                                            accept-charset="UTF-8">
                                            {{ csrf_field() }} {{ method_field('post') }}


                                            <div class="form-group">
                                                <input type="submit" name="status" label="accepter"
                                                    class="btn btn-success btn-md" value="accepter">

                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="status" class="btn btn-danger btn-md"
                                                    value="refuser">
                                            </div>
                                        </form>

                                        @elseif( $demandeStage->status === 'Accepted' )
                                        <form id="{{ $demandeStage->id }}"
                                            style="display: flex;gap: 12px; justify-content: center;" method="POST"
                                            action="{{ route('demande_stages.encadrant',$demandeStage->id) }}"
                                            accept-charset="UTF-8">
                                            {{ csrf_field() }} {{ method_field('post') }}
                                            <div class="form-group">
                                            {{ Form::select('encadrant_nom',  $nom_encadrants, null); }}
                                                <input id="{{ $demandeStage->id }}" type="submit"
                                                    class="btn btn-info btn-md" value="Affecter">
                                            </div>
                                        </form>
                                        @endif







                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <div>{{ $demandeStages->appends(Request::except('page'))->render() }}</div>
                        <div class="row">
                            <p>{{ __('app.total') }} : {{ $demandeStages->total() }} {{
                                __('demande_stage.demande_stage') }}</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>@endsection