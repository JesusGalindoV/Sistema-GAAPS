@extends('layout')

@section('content')

<div class="content-custom">

    @include('Website.header')

    <div class="back2">

        <div class="row" style="width: 100%">

                <div class="col-md-12 osos-title2">
					<h1 class="feel-title">#GAAPS</h1>
				</div>


            <div class="col-lg-12 col-md-12">


                <div class="login-form">

                    <form action="" method="post">

                        {{ csrf_field() }}

                        <div class="col-md-12">

					        <!-- <img src="{{asset('img/temple/unisierra.png')}}" alt='Logo Unisierra' class="osos_alfa_login"> -->

				        </div>

                        <h2 class="text-center">Iniciar sesión</h2>  

                        <div class="input-group mb-3">

                            <label class="field a-field a-field_a2">

                                <input class="field__input a-field__input" placeholder="example@example.com" id="email" name="email" value="{{old('email')}}" required>

                                <span class="a-field__label-wrap">

                                    <span class="a-field__label">Correo</span>

                                </span>

                            </label> 

                        </div>

                        <div class="input-group mb-3">

                            <label class="field a-field a-field_a2">

                                <input type="password" class="field__input a-field__input" placeholder="Ingresa tu contraseña" name="password" required>

                                <span class="a-field__label-wrap">

                                    <span class="a-field__label">Contraseña</span>

                                </span>

                            </label> 

                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-primary btn-block boton" style="border-radius: 19px;">Ingresar</button>

                        </div>

                        <!-- REGISTRO DE NUEVO INGRESO --> 
                        <div class="row">
                            <div class="col-md-12">
                                <center><a href="{{route('alumn.register')}}" class="btn boton-success">Registrarse</a></center>
                            </div>
                        </div>

                    </form> 

                </div> 

            </div>        

        </div>   

    </div>

</div>

<script src="{{asset('js/website/home.js')}}"></script>

@stop
