@extends('DepartamentPanel.main')

@section('content-departament')

<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Registro de bibliografias en biblioteca</h1>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-md-12">
            <button data-toggle="modal" data-target="#modalDebit" class="btn btn-warning button-custom"><i class="fa fa-fw fa-plus"></i>Nueva bibliografia</button>
          </div>
        </div>
      </div>
      
      <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
        
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Titulo</th>
              <th>Autor</th>
              <th>ISBN</th>           
            </tr>  
          </thead>

          <tbody>
            
            @foreach($instances as $key => $item)
            <tr>
              <td>{{ ($key+1)}} </td> 
              <td>{{ $item->area->name }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->code }}</td>
            </tr>
            @endforeach
          </tbody>

        </table>

        </div>

      </div>

    </div>

  </section>

</div>


<!-- Modal crear nuevo adeudo -->

<div class="modal fade" id="modalDebit">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

        <form method="post" action="{{route('departament.debit.save')}}">
            
            {{ csrf_field() }}

            <div class="modal-header">

                <h4 class="modal-title">GENERAR NUEVA BIBLIOGRAFIA</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        
            <div class="modal-body">

                <div class="row">

                    {{-- Ingresar el titulo del libro --}}
                    <div class="col-md-12">           

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Titulo</span>
                            </div>
                            <textarea type="text" name="titulo" placeholder="Ingrese el titulo del libro" class="form-control" required></textarea>

                        </div>

                    </div>

                    {{-- Ingresar el Autor del libro --}}
                    <div class="col-md-12">           

                      <div class="input-group mb-3">

                          <div class="input-group-prepend">
                              <span class="input-group-text">Autor:</span>
                          </div>
                          <textarea type="text" name="autor" placeholder="Ingrese el/los Autor/Autores del libro" class="form-control" required></textarea>

                      </div>

                    </div>

                    {{-- Ingresar el ISBN del libro --}}
                    <div class="col-md-12">           

                      <div class="input-group mb-3">

                          <div class="input-group-prepend">
                              <span class="input-group-text">ISBN:</span>
                          </div>
                          <textarea type="text" name="isbn" placeholder="Ingrese el ISBN del libro" class="form-control" required></textarea>

                      </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer justify-content">

                <div class="col-sm container-fluid">

                    <div class="row">

                        <div class=" col-sm-6 btn-group">

                        <button id="cancel" type="button" class="btn btn-danger .px-2 " data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>

                        </div>

                        <div class=" col-sm-6 btn-group">

                        <button type="submit" id="sale" class="btn btn-success .px-2"><i class="fa fa-check"></i> Guardar</button>
                        
                        </div>

                    </div>

                </div>

            </div>

       </form>

    </div>

  </div>

</div>



<script>
  $(".table").DataTable({
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

  $(".btnDelete").click(function() {
    var id = $(this).attr("idClassroom");
    swal.fire({
        title: '¿Seguro que deseas borrar este salon?',
        text: "¡Si lo haces todos los equipos ligados con este salon serán borrados!",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Borrar'
    }).then((result)=>
    {
        if (result.value)
        {
          window.location = "/departaments/logs/classrooms/delete/"+id;
        }
    });
  });
</script>

@stop
