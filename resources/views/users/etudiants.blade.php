@extends('layouts.app')
@section('title', 'Demandes')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
            <h4>Liste des Etudiants</h4>
            <a href="{{ url('users/add-etudiant')}}" class="btn btn-primary float-right"> Nouveau Etudiant</a>
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
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name}}</td>
                               <td>{{ $user->Email}}</td>
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
   