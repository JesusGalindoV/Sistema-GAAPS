@extends('Website.main')

@section('main-content')


<style>
	.btns-row{
		display: flex;
		flex-direction: row;
		justify-content: space-around;
		margin-top: 2rem;
		align-items: center;
	}

	.capitalize{
		text-transform: uppercase !important;
	}

	@media (min-height: 768px) { 

		.btns-row{
			margin-top: 10rem;
		}
		
	}

	button[disabled]{
  		background-color: #cccccc !important;
  		color: #8a8a8a;
	}

	#resultado {
		width: 95%;
    	color: white;
    	font-weight: bold;
	}
	
	#resultado.ok {
    	background-color: green;
	}

	#btnGuardar.disabled {
		background-color: #8a8a8a;
	}

</style>

<div class="back2">

	<div class="row" style="margin-right: 15%; margin-left: 15%;">

		<div class="col-md-12">

			<div class="card card-custom">

				<form method="post" action="{{route('alumn.users.registerAlumn')}}" style="width: 90%; margin-right: auto; margin-left: auto">

					{{ csrf_field() }}

					<div class="card-body">

						<div class="row">

							<h3>Registro Usuario</h3>

						</div>

						<div class="row" style="padding-top: 1rem">

							<div class="col-md-6">
								
								<div class="input-group mb-3">

								  	<label class="field a-field a-field_a2">

									    <input class="field__input a-field__input" placeholder="Ingrese su nombre" id="name" name="name" required value="{{ old('name') }}">

									    <span class="a-field__label-wrap">

									        <span class="a-field__label">Nombre (s)</span>

									    </span>

									</label> 

								</div>

							</div>

							<div class="col-md-6">
								
								<div class="input-group mb-3">

								  	<label class="field a-field a-field_a2">

									    <input class="field__input a-field__input" placeholder="Ingrese su apellido" id="lastname" name="lastname" value="{{ old('lastname') }}" required>

									    <span class="a-field__label-wrap">

									        <span class="a-field__label">Apellido (s)</span>

									    </span>

									</label> 

								</div>

							</div>


							<!-- INGRESO DE CURP -->

							<div class="col-md-6">
								
								<div class="input-group mb-3">

								  	<label class="field a-field a-field_a2">

									    <input type="text" class="field__input a-field__input capitalize" placeholder="e.g ROCE000131HNLDNDA9" id="curp" name="curp" oninput="validarInput(this)" onblur="aMayusculas(this.value,this.id)" required  minlength="18" maxlength="18" pattern=".{18,}" title="e.g ROCE000131HNLDNDA9 (18 caracteres)." >
										
									    <span class="a-field__label-wrap">

									        <span class="a-field__label">Curp</span>

									    </span>

									</label> 

									<pre id="resultado"></pre>

								</div>

							</div>

							<!-- INGRESO DE CORREO -->

							<div class="col-md-6">
								
								<div class="input-group mb-3">

								  	<label class="field a-field a-field_a2">

									    <input type="email" class="field__input a-field__input" placeholder="e.g Example@example.com" id="email" name="email" required>

									    <span class="a-field__label-wrap">

									        <span class="a-field__label">Correo</span>

									    </span>

									</label> 

								</div>

							</div>

							<div class="col-md-6">
								
								<div class="input-group mb-3">

								  	<label class="field a-field a-field_a2">

									    <input type="password" class="field__input a-field__input" placeholder="Ingrese una contraseña" id="first" required>

									    <span class="a-field__label-wrap">

									        <span class="a-field__label">Contraseña</span>

									    </span>

									</label> 

								</div>

							</div>

							<div class="col-md-6">
								
								<div class="input-group mb-3">

								  	<label class="field a-field a-field_a2">

									    <input type="password" class="field__input a-field__input" placeholder="Ingrese una contraseña" id="password" name="password" required>

									    <span class="a-field__label-wrap">

									        <span class="a-field__label">Confirmar contraseña</span>

									    </span>

									</label> 

								</div>

							</div>

						</div>

					</div>
						
					<div class="row footer-custom">

						<div class="col-md-12">

							<button type="button" class="btn btn-primary btn-block boton sent" id='btnGuardar' disabled>Guardar</button>
							
						</div>

					</div>

				</form>


			</div>


			<div class="btns-row">
				<a href="{{route('alumn.home')}}" 
						class="btn btn-success btn-lg btn-block " 
						style="color: white; border-radius: 20px; margin:0rem 2rem; font-weight: 900;font-size: 20px;">
				 Acceso
				</a>
				<!-- <a href="{{route('alumn.home')}}" 
						class="btn btn-warning btn-lg btn-block button-custom my-2 my-sm-0" 
						style="color: white; border-radius: 20px;  margin:0rem 2rem; font-weight: 900;font-size: 20px;">
				Acesso Nuevo
				Ingreso
				</a> -->
			</div>

		</div>

	</div>

</div>

<script>
    $(document).ready(function()
    {
        @if(isset($error))
            toastr.warning("{{$error}}");
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{$error}}');
            @endforeach
        @endif
    });

	function aMayusculas(obj,id){
    	obj = obj.toUpperCase();
    	document.getElementById(id).value = obj;
	}


	function curpValida(curp) {
    	var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        	validado = curp.match(re);
	
    	if (!validado)  //Coincide con el formato general?
    		return false;
    
    	//Validar que coincida el dígito verificador
    	function digitoVerificador(curp17) {
        	//Fuente https://consultas.curp.gob.mx/CurpSP/
        	var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            	lngSuma      = 0.0,
            	lngDigito    = 0.0;
        	for(var i=0; i<17; i++)
            	lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        		lngDigito = 10 - lngSuma % 10;
        	if (lngDigito == 10) return 0;
        		return lngDigito;
    	}
  
    	if (validado[2] != digitoVerificador(validado[1])) 
    		return false;
        
    	return true; //Validado
	}

	//Handler para el evento cuando cambia el input
	//Lleva la CURP a mayúsculas para validarlo
	function validarInput(input) {
    	var curp = input.value.toUpperCase(),
        	resultado = document.getElementById("resultado"),
        	valido = "No válido";

			let btnGardar = document.getElementById('btnGuardar');
			btnGardar.classList.add("disabled");
			btnGardar.disabled = true;
        
    	if (curpValida(curp)) { // ⬅️ Acá se comprueba
    		valido = "Validado";
        	resultado.classList.add("ok");
			btnGardar.classList.remove("disabled");

			btnGardar.disabled = false;
    	} else {
    		resultado.classList.remove("ok");
    	}
        
		resultado.innerText = "Formato: " + valido;
    	//resultado.innerText = "CURP: " + curp + "\nFormato: " + valido;
	}


</script>

<script src="{{asset('js/website/home.js')}}"></script>

@stop