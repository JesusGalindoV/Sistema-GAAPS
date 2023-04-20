@extends('DepartamentPanel.main')

@section('content-departament')

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

        {{-- <div class="row" style="margin-bottom: 1rem">

          <div class="col-md-4">

            <label for="">Rango de fechas</label>

            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-calendar"></i></span>

              </div>

              <input type="text" class="form-control" id="datepicker-report" placeholder="Rango de fechas">

            </div>

          </div>

        </div> --}}

        <div class="row" style="margin-bottom: 1rem">

          <div class="col-md-4">

            <div class="input-group mb-3">

              <button data-toggle="modal" data-target="#modalTesis" class="btn btn-warning button-custom"><i class="fa fa-fw fa-plus"></i>Nueva memoria de estadía</button>

            </div>

          </div>

        </div>


        <div class="table-responsive">
          <table class="table table-bordered table-hover dt-responsive">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Carrera</th>
                <th>Año</th>
              </tr>  
            </thead>
          </table>
        </div>

      </div>

    </div>

  </section>

</div>

<!-- Modal crear nuevo adeudo -->

<div class="modal fade" id="modalTesis">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

        <form method="post" action="{{route('departament.debit.save')}}">
            
            {{ csrf_field() }}

            <div class="modal-header">

                <h4 class="modal-title">REGISTRAR NUEVA MEMORIA DE ESTADÍA</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        
            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6">           

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fas fa-credit-card"></i></span>
                            </div>

                            <select name="debit_type_id" id="debit_type_id" class="form-control select2" style="width: 88%">
                              <option value="" disabled selected>Seleccione un concepto</option>
                              @foreach(getUnAdminDebitType()  as $key => $value)
                              <option value="{{$value->id}}">{{$value->concept}}</option>
                              @endforeach
                            </select>

                        </div>

                    </div>

                    <div class="col-md-6">           

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i></span>
                            </div>

                            <input type="number" step="any" min="0" name="amount" placeholder="¿Cual es el monto?" class="form-control" required>

                        </div>

                    </div>

                    <div class="col-md-12">           

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fas fa-user"></i></span>
                            </div>

                            <select class="form-control select2" style="width: 88%" name="id_alumno" require>
                                <option value="">Seleccione un alumno</option>
                                @php
                                    $alumnos = selectUsersWithSicoes();
                                @endphp

                                @foreach($alumnos as $key => $value)
                                <option value="{{$value->id_alumno}}">{{$value->email." ".$value->name." ".$value->lastname}}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="col-md-12">           

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fas fa-ad"></i></span>
                            </div>

                            <textarea type="text" name="description" placeholder="Ingrese una descripción" class="form-control" required></textarea>

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
{{-- fin del modal nueva memoria de estadia --}}

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>

  // var filters = {
  //   initDate: null,
  //   endDate: null,
  //   init: () => {
  //     $('#datepicker-report').daterangepicker({
  //       autoUpdateInput: false,
  //       locale: {
  //          cancelLabel: 'Clear'
  //       },
  //       ranges: {
  //        'Hoy': [moment(), moment()],
  //        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  //        'Ultimos 7 días': [moment().subtract(6, 'days'), moment()],
  //        'Ultimos 30 días': [moment().subtract(29, 'days'), moment()],
  //        'Este mes': [moment().startOf('month'), moment().endOf('month')],
  //        'Ultimo mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  //       },
  //     }, function(start, end, label) {
  //       $("#datepicker-report").val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
  //       filters.initDate = start.format('YYYY-MM-DD');
  //       filters.endDate = end.format('YYYY-MM-DD');
  //       Datatable.dataTable.draw();
  //     });
  //   }
  // };

  var Datatable = {
    table: $(".table"),
    init: () => {
      Datatable.dataTable = Datatable.table.DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "{{ route('departament.logs.report.datatable') }}",
          "type": "POST",
          "headers":{'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
          // "data": {
          //   "initDate": () => {
          //     return filters.initDate;
          //   }, 
          //   "endDate": () => {
          //     return filters.endDate;
          //   }
          // }
        },
        "columns": [
          {"data": "enrollment", "render": (data) => {
            return "lol";
          }},
          {"data": "number"},
          {"data": "full_name"},
          {"data": "equipment"},
          {"data": "classroom"},
          // {"data": "entry_time"},
          // {"data": "departure_time"},
          // {"data": "Date"}
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
  
  // filters.init();
  Datatable.init();

</script>

@stop
