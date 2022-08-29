@extends('AdminPanel.main')

@section('content-admin')

<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>{{$instance->id ? 'Editar' : 'Crear'}} carrera</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="#">Home</a></li>

            <li class="breadcrumb-item active"><a href="#">Usuarios</a></li>

            <li class="breadcrumb-item"><a href="#">Crear carrera</a></li>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card">

      <div class="card-body">

        <form action="{{route('admin.carreras.save', $instance)}}" method="post">
          
          {{ csrf_field() }}

          <div class="row">

            <div class="col-md-6">

              <label class="label-style" for="nombre">Clave de la carrera</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-user"></i></span>

                  </div>

                  <input type="text" id="Clave" name="Clave" placeholder="Ingrese la clave de la carrera" class="form-control form-control-lg" maxlength="2" required value="{{$instance->Clave}}">

              </div>

            </div>

            <div class="col-md-6">

              <label class="label-style" for="nombre">Nombre de la carrera</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-user"></i></span>

                  </div>

                  <input type="text" id="Nombre" name="Nombre" placeholder="Ingrese el nombre" class="form-control form-control-lg" required value="{{$instance->Nombre}}">

              </div>

            </div>

            <div class="col-md-6">

              <label class="label-style" for="nombre">Ebreviatura</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-user"></i></span>

                  </div>

                  <input type="text" id="Abreviatura" name="Abreviatura" placeholder="Ingrese la abreviatura" class="form-control form-control-lg" required value="{{$instance->Abreviatura}}">

              </div>

            </div>

            <div class="col-md-6">

              <label class="label-style" for="nombre">¿Es una carrera activa?</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-key"></i></span>

                  </div>

                  <select name="is_activa" class="form-control form-control-lg" required>
                    <option value="">Seleccione</option>}
                    <option value="1" @if($instance->is_activa == 1) selected @endif>Activa</option>
                    <option value="0" @if($instance->is_activa == 0) selected @endif>Inactiva</option>
                  </select>

              </div>

            </div>

             <div class="col-md-6">

              <label class="label-style" for="nombre">Divicion</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-key"></i></span>

                  </div>

                  <select name="DivisionId" class="form-control form-control-lg">
                    @foreach(getDiviciones() as $item)
                    <option value="{{$item->DivisionId}}" @if($instance->DivisionId == $item->DivisionId) selected @endif>{{$item->NombreDivision}}</option>}
                    option
                    @endforeach
                  </select>

              </div>

            </div>

            <div class="col-md-6">

              <label class="label-style" for="nombre">Precio</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-building"></i></span>

                  </div>

                  <input type="number" step="any" id="precio" name="precio" placeholder="Ingrese el precio" class="form-control form-control-lg" required value="{{$instance->precio}}">

              </div>

            </div>

          </div>

          <div class="row">
            <div class="col-md-6">
              <a href="{{route('admin.carreras')}}" class="btn btn-danger" style="width: 100%"><i class="fa fa-times"></i> Cancelar</a>
            </div>
            <div class="col-md-6">
              <button class="btn btn-success" style="width: 100%"><i class="fa fa-check"></i> Guardar</button>
            </div>
          </div>

        </form>

      </div>

    </div>

  </section>

</div>

@stop
