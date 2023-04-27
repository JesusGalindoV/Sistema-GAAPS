@extends('Alumn.main')

@section('content-alumn')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Memorias de estadía</h1>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card">
      
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-bordered table-hover dt-responsive">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Autor</th>
                <th>Titulo</th>
                <th>Carrera</th>
                <th style="width: 10px">Año</th>
                <th>Documento</th>
              </tr>  
            </thead>
          </table>
        </div>

      </div>

    </div>

  </section>

</div>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>

  var Datatable = {
    table: $(".table"),
    init: () => {
      Datatable.dataTable = Datatable.table.DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "{{ route('alumn.tesis.datatable') }}",
          "type": "POST",
          "headers":{'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
        },
        "columns": [
          {"data": "id", "render": (data) => {
            return `${data}`;
          }},
          {"data": "Autor"},
          {"data": "Titulo"},
          {"data": "Carrera"},
          {"data": "Año"},
          {
            "data": "route",
            "render": (data) => {
              return `<a href="${data}" target="_blank" class="btn btn-primary"><i class="fas fa-book"></i></a>`;
            }
          }
        ],
        "language": {

            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
      });
    }
  }
  
  Datatable.init();

</script>

@stop
