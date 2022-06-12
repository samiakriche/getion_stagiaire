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
           <form action="/add-demande" method="POST">
           @csrf
           
               <div class="mb-3">
                   <label for="titre">titre</label>
                   <input type="text" name="titre" class="form-control"/>
               </div>
               
               <div class="mb-3">
                   <label for="decription">decription</label>
                   <textarea name="decription" class="form-control"rows="3"></textarea>
               </div>
                <div class="mb-3">
                   <label for="encadrant">Encadrant</label>
                   <select type="text" name="encadrant_id" disabled="disabled" class="form-control">
                   @foreach ($enseignant as $item)
                   
                   <!--option value="{{ $item->id }}">{{ $item->name }}</option-->
                   @endforeach
                   </select>
               </div>
               <div class="mb-3">
                   <label for="date_debut">date_debut</label>
                   <input type="text" name="date_debut" class="form-control"/>
               </div>
               
                <div class="mb-3">
                   <label for="date_fin">date_fin</label>
                   <input type="text" name="date_fin" class="form-control"/>
               </div>
               
               <div class="col-md-12">
                <div class="mb-3">
                   <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
                </div>
               </div>
        </form>
        </div>
    </div>
</div>
@endsection