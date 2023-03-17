@extends('DepartamentPanel.main')

@section('content-departament')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Bienvenido {{Auth::guard("departament")->user()->name}}</h1>
        </div>
        <!-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="#">Home</a></li>
          </ol>
        </div> -->
      </div>
    </div>
  </section>

  <section class="content">

    <div class="card">
      
      <div class="card-body">

        <div class="row">


          <!-- atajo de adeudos -->
          
          <div class="col-md-4 col-sm-12">

            <div class="small-box bg-success">

              <div class="inner">

                <h3>Adeudos</h3>

              
              </div>
              <div class="icon">

                <i class="fa fa-file-invoice-dollar"></i>

              </div>

              <!-- i -->
              

              <a href="{{route('departament.debit')}}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>

            </div>
            
          </div>

          <!-- boton de estadias -->
          <div class="col-md-4 col-sm-12">

            <div class="small-box bg-success">

              <div class="inner">

                <h3>Tesis</h3>

                <!-- <p>{{ $equipments }}</p> -->

              </div>
              <div class="icon">

                <i class="fas fa-book"></i>

              </div>

              <!-- i -->

              <a href="{{route('departament.logs.report.index')}}" class="small-box-footer" >Ver <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>

          <!-- atajo de bibliografias -->
          <div class="col-md-4 col-sm-12">

            <div class="small-box bg-success">

              <div class="inner">

                <h3>Bibliografias</h3>

                <!-- <p>{{ $equipments }}</p> -->

              </div>
              <div class="icon">

                <i class="fas fa-atlas"></i>

              </div>

              <!-- i -->

              <a href="{{route('departament.logs.classrooms.index')}}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

</div>

@stop
