@extends('layouts.app')
@section('title', 'Demandes')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
            <h4>Liste des Demandes de Stages</h4>
            <a href="{{ url('/add-demande')}}" class="btn btn-primary float-right"> Nouveau demande de stage</a>
        </div>
        <div class="card-body">
<form action="" method="POST">
                <div class="mb-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>titre</th>
                                <th>decription</th>
                                <th>Nom Encadrant</th>
                                <th>date_debut</th>
                                <th>date_fin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stages as $stage)
                            <tr>
                                <td>{{ $stage->titre}}</td>
                                <td>{{ $stage->decription}}</td>
                                <td>{{ $stage->encadrant}}</td>
                                 <td>{{ $stage->date_debut}}</td>
                                <td>{{ $stage->date_fin}}</td>
                               
                                <td>
                                    <a href="" class="btn btn-xs btn-info">affecter_stage</a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection
   