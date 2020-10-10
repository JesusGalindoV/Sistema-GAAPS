@extends('layout')

@section('content')

<div class="content-custom">

    @include('Website.header')

    <div class="back2">

        <div class="row" style="margin: 1%; width: 100%">

<!--             <div class="col-lg-8 col-md-12">

                <div class="row">

                    <div class="col-md-12 osos-title">
                        <h1>Se un Oso Unisierra</h1>
                    </div>

                    <div class="col-md-12">

                        <div class="feed">

                            <div class="feed_content">

                                <div class="feed-header">
                                    <h1>encabezado2</h1>
                                </div>

                                <div class="feed-body">
                                    <p>Parrafo</p>
                                </div>

                            </div>
                            
                        </div>

                        <div class="feed">

                            <div class="feed_content">

                                <div class="feed-header">
                                    <h1>encabezado2</h1>
                                </div>

                                <div class="feed-body">
                                    <p>Parrafo</p>
                                </div>

                            </div>
                            
                        </div>

                        <div class="feed">

                            <div class="feed_content">

                                <div class="feed-header">
                                    <h1>encabezado3</h1>
                                </div>

                                <div class="feed-body">
                                    <p>Parrafo</p>
                                </div>

                            </div>
                            
                        </div>

                    </div>

                </div>

            </div> -->

            <div class="col-lg-12 col-md-12">

                <div class="login-form">

                    <form action="" method="post">

                        {{ csrf_field() }}

                        <h2 class="text-center">Iniciar sesión</h2>  

                        <div class="input-group mb-3">

                            <label class="field a-field a-field_a2">

                                <input class="field__input a-field__input" placeholder="example@example.com" id="email" name="email" required>

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

                            <button type="submit" class="btn btn-primary btn-block boton">Entrar</button>

                        </div>
                    </form> 
                </div> 

            </div>        

        </div>   

    </div>

</div>

<script src="{{asset('js/website/home.js')}}"></script>

@stop