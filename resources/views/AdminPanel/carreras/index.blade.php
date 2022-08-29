@extends('AdminPanel.main')

@section('content-admin')

<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Carreras</h1>

        </div>

        <div class="col-sm-6">

          <div class="pull-right" style="float: right;">
            <a href="{{route('admin.carreras.create')}}" class="btn btn-success"><i class="fa fa-user" aria-hidden="true"></i> Crear carrera</a>
          </div>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card" id="card">

      <div class="card-body">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

        <table class="table table-bordered table-hover" id="tablaCarreras">

          <thead>

            <tr>
              <th>Clave</th>
              <th>Nombre</th>
              <th>Abreviatura</th>
              <th>Es activa</th>
              <th>Precio</th>
              <th>Acciones</th>
            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<script>
  $("#tablaCarreras").DataTable({
      "destroy": true,
      "processing": true,
      "responsive": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
          "url": "{{ route('admin.carreras.datatable') }}",
          "headers":{'X-CSRF-TOKEN' : "{{ csrf_token() }}"},
          "type": "POST",
      },
      "columns":[
          {"data": "Clave", "orderable": false},
          {"data": "Nombre"},
          {"data": "Abreviatura"},
          {"data": "is_activa", "render": (data) => {
            return data == 1 ? "Activa":"Inactiva";
          }},
          {"data": "precio"},
          {"data": null, "orderable": null, "render": (data) => {
              return "<div class='btn-group'><a href='{{route('admin.carreras.edit')}}/"+data.CarreraId+"' title='Editar carrera' class='btn btn-warning'><i class='fa fa-edit'></i></a><button title='Eliminar' carrera_id='"+data.CarreraId+"' class='btn btn-danger btnEliminar'><i class='fa fa-times'></i></button></div>";
          }}
      ],
      "language": datatableSpanish
  });

  $("#tablaCarreras tbody").on("click","button.btnEliminar",function()
{
    var id = $(this).attr("carrera_id");
    swal.fire({
        title: '¿Esta seguro de eliminar esta carrera?',
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
         window.location = "/admin/carreras/delete/"+id;        
      }
    });
});
</script>

@stop
