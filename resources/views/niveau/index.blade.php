@extends('niveaux$niveaux.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Exemple d'une application CRUD Laravel 8 - apcpedagogie.com</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-outline-success" href="{{ route('niveau.create') }}"> Créer un nouveau niveau</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Numéro</th>
            
            <th>formation</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($niveaux as $niveau)
        <tr>
           
            <td>{{ $niveau->id }}</td>
        
            <td>{{ $niveau->formation }}</td>
            <td>
                <form action="{{ route('niveaux$niveaux.destroy',$niveau->npro) }}" method="POST">
   
                    <a class="btn btn-outline-primary" href="{{ route('niveaux$niveaux.show',$niveau->npro) }}">Montrer</a>
    
                    <a class="btn btn-outline-success" href="{{ route('niveaux$niveaux.edit',$niveau->npro) }}">Éditer</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center pagination-lg">
    {!! $niveaux->links('pagination::bootstrap-4') !!}
      </div>
@endsection