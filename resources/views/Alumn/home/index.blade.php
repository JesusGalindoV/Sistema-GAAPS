@extends('Alumn.main')

@section('content-alumn')

@php
 
  $boxCorreo = strpos(Auth::guard('alumn')->user()->email, "@unisierra.edu.mx")?"bg-info":"bg-danger";
 
@endphp

<div class="content-wrapper">
  
  <section class="content-header">
    
    <div class="container-fluid">
      
      <div class="row mb-2">
        
        <div class="col-sm-6">
          
          <h1>¡Bienvenido!</h1>
          
        </div>
        
      </div>
      
    </div>
    
  </section>

  <section class="content">

    <div class="card">

      <div class="card-body">

        <div class="row">

          <!-- <div class="col-md-12"> 

                <h4>Mi tablero</h4> 

          </div> -->

          <div class="col-md-3 col-sm-12">

            <div class="small-box {{$boxCorreo}}">

              <div class="inner">

                <h3>Mi perfil</h3>

                <p>{{Auth::guard("alumn")->user()->email}}</p>

              </div>

              <div class="icon">

                <i class="fa fa-envelope"></i>

              </div>

              @if(strpos(Auth::guard('alumn')->user()->email, "@unisierra.edu.mx"))
              <a href="{{route('alumn.user')}}" class="small-box-footer">Ver mi perfil<i class="fas fa-arrow-circle-right"></i></a>
              @else
              <a href="#" class="small-box-footer">Ir a perfil<i class="fas fa-arrow-circle-right"></i></a>
              @endif

            </div>
            
          </div>

          <div class="col-md-3 col-sm-12">

            <div class="small-box {{$boxCorreo}}">

              <div class="inner">

                <h3>Memorias</h3>

                <p>Ver memorias de estadía</p>

              </div>

              <div class="icon">

                <i class="fa fa-book"></i>

              </div>

              @if(strpos(Auth::guard('alumn')->user()->email, "@unisierra.edu.mx"))
              <a href="{{route('alumn.user')}}" class="small-box-footer">Ver memorias<i class="fas fa-arrow-circle-right"></i></a>
              @else
              <a href="#" class="small-box-footer">Ir a perfil<i class="fas fa-arrow-circle-right"></i></a>
              @endif

            </div>
            
          </div>

        </div>

      </div>

    </div>

  </section>

</div>



<script src="{{asset('js/alumn/home.js')}}"></script>

@stop
