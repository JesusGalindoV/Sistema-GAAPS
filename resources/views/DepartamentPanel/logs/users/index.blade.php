@extends('DepartamentPanel.main')

@section('content-departament')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Usuarios registrados en el sistema</h1>

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
                <th>Nombre(s)</th>
                <th>Apellido(s)</th>
                <th>Correo</th>
                <th>Acciones</th>
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
          "url": "{{ route('departament.logs.usuarios.datatable') }}",
          "type": "POST",
          "headers":{'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
        },
        "columns": [
          {"data": "id", "render": (data) => {
            return `${data}`;
          }},
          {"data": "name"},
          {"data": "lastname"},
          {"data": "email"},
          {
            "data": "id",
            "render": (data) => {
              return `<button class='btn btn-danger btnDeleteTesis' id='${data}' title='Eliminar memoría' title='eliminar'><i class='fas fa-trash'></i></button></div>`;
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


  $(".table").on("click","button.btnDeleteTesis",function(){
							var id = $(this).attr("id");
							swal.fire({
								title: '¿Esta seguro de eliminar este usuario?',
								text: "¡todo registro de el sera borrado!",
								type: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								cancelButtonText: 'Cancelar',
								confirmButtonText: 'Si, estoy seguro'
							}).then((result)=>{
							  if (result.value)
							  {
								window.location = "usuarios/delete/"+id;    
							  }
							});
						});

</script>

@stop
