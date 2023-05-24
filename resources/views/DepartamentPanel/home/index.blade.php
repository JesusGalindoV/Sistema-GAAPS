@extends('DepartamentPanel.main')

@section('content-departament')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Bienvenido {{Auth::guard("departament")->user()->name}}</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content" >

    <div class="card">
      
      <div class="card-body">

        <div class="row">

          <!-- boton de estadias -->
          <div class="col-md-4 col-sm-12">

            <div class="small-box bg-success">

              <div class="inner">

              <h3>Memorias</h3>

                <p>Ver memorias de estadía</p>

              </div>
              <div class="icon">

                <i class="fas fa-book"></i>

              </div>

              <!-- i -->

              <a href="{{route('departament.modulos.tesis.index')}}" class="small-box-footer" >Ver <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>

          <!-- boton de usuaruis -->
          <div class="col-md-4 col-sm-12">

            <div class="small-box bg-success">

              <div class="inner">

                <h3>Usuarios</h3>

                <p>Ver usuarios</p>

              </div>
              <div class="icon">

                <i class="fas fa-users"></i>

              </div>

              <!-- i -->

              <a href="{{route('departament.modulos.usuarios.index')}}" class="small-box-footer" >Ver <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

</div>

@stop
