@extends('AdminPanel.main')

@section('content-admin')

<style>
  .page-item.active .page-link {
    background-color: #fd7e14;
    border-color: #fd7e14;
  }

  .textAndButton{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
  }  
 
  .custom{
    background-color: #fd7e14;
    border-color: #fd7e14;
    color: white;
  }

  .custom:hover{
    background-color: #e96c06;
    border-color: #e96c06;
    color: white;
  }
  .modal-header{
    background-color: #28a745;
    color: white;
  }
 
 
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Problemas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Problemas</a></li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">

    <div class="card">
      
      <div class="card-body">

        Estos son los problemas encontrados por los alumnos.

      </div>

    </div>

    <div class="card">

      <div class="card-body">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

        <table class="table table-bordered table-hover tableProblem">

          <thead>

            <tr>
              <th style="width: 10px">#</th>
              <th>Alumno</th>
              <th>Estado</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<div class="modal fade" id="modalProblems">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h3>Problemas encontrados en el sistema</h3>

      </div>
        
        <div class="modal-body">
              
            <div class="row">

              <div class="col-md-12">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="tokenModal">
                
                <p id="parraf-problem" style="text-align: justify;">
                  
                </p>

              </div>

            </div>

            <div class="row">

              <div class="col-md-12">

                <div class="form-group" id="pay-now" style="margin-top: 10vh;">

                    <button class="btn btn-success" data-dismiss="modal">Aceptar</button>
                  
                </div>

              </div>

            </div>
              
        </div>

    </div>

  </div>

</div>
<script src="{{ asset('js/admin/problem.js')}}"></script>

@stop
