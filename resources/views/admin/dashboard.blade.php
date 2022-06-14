@extends('layouts.app')

@section('content')
<div class="content-wrapper">
          <div class="row">
            
       
    
    
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{ __('Dashboard') }}</h4>
                 
            
           
            @if (session('status'))
                     
                            {{ session('status') }}
                        </div>
                    @endif
</div>

                <div class="card-body">
                <div class="alert alert-success" role="alert">

                    {{ __('Hey Admin You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
