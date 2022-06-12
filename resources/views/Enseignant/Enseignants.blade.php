@extends('layouts.app')
@section('title', 'Demandes')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
            <h4>Liste des Enseignants</h4>
            <a href="{{ url('enseignant/add-enseignant')}}" class="btn btn-primary float-right"> Nouveau Enseignant</a>
        </div>
        <div class="card-body">
        
            <form action="" method="POST">
                <div class="mb-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enseignants as $enseignant)
                            <tr>
                                <td>{{ $enseignant->name}}</td>
                               <td>{{ $enseignant->Email}}</td>
                                <td>
                                    <a href="" class="btn btn-xs btn-info">Edit</a>
                                    
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
   