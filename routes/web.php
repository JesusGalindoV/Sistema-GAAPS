<?php

use Illuminate\Support\Facades\Route;

$alumnDomain  =  env('ALUMN_DOMAIN');

Route::group(['domain' => $alumnDomain], function() {

	Route::group(['prefix'=> 'portal', 'namespace'=>'Alumn'], function()
	{
	  	Route::name('alumn.')->group(function()
	  	{
			Route::group(["middleware"=>["maintenance"]],function(){

				Route::get('/sign-in',[
					'uses' => 'AuthController@login', 
					'as' => 'login'
				]); 
			});	  				

		    Route::post('/sign-in',[
		        'uses' => 'AuthController@postLogin', 
			]); 

			//REGRESA FORMULARIO PARA NUEVO INGRESO
			Route::get('/registerAlumn',[
				'uses' => 'WebsiteController@register', 
				'as' => 'register'
			]);
		 
		    Route::get('/sign-out', [
		        'uses' => 'AuthController@logout', 
		        'as' => 'logout'
		    ]);

		    Route::post('/users/registerAlumn',[
		        'uses' => 'AccountController@registerAlumn', 
		        'as' => 'users.registerAlumn'
		    ]);

		    Route::get('/account/first_step',[
		        'uses' => 'AccountController@index', 
		        'as' => 'users.first_step'
		    ]);

		    Route::post('/account/postStep/{step}',[
		        'uses' => 'AccountController@save', 
		        'as' => 'users.postStep'
		    ]);

	  		Route::group(['middleware' => ['alumn.user']
			], function() {

				Route::get('/notify/show',[
						'uses'=>'UserController@notify', 
						'as' => 'notify.show'
				]);

				Route::get('/notify/{route?}/{id?}',[
						'uses'=>'UserController@seeNotify', 
						'as' => 'notify'
				]);

				Route::group(['middleware' => ['candidate']
				], function() {

					Route::get('/user', [
				        'uses' => 'UserController@index', 
				        'as' => 'user'
				    ]);

				    Route::post('/user/save/{user?}', [
				        'uses' => 'UserController@save', 
				        'as' => 'user.save'
				    ]);

				});

				Route::get('/', [
			        'uses' => 'HomeController@index', 
			        'as' => 'home'
			    ]);	 
				
				Route::get('/memorias', [
					'uses' => 'MemoriasController@index',
					'as' => 'memorias'
				]);

				Route::post('user/datatable', [
					'uses' => 'MemoriasController@datatable', 
					'as' => 'tesis.datatable'
				]);
				
			});
	  	});
	});

	Route::group(['namespace' => 'Website'], function()
	{
		Route::group(["middleware"=>["maintenance"]],function(){

			Route::get('/', [
				'uses' => 'WebsiteController@index', 
				'as' => 'home'
			]);	

		});

		Route::get('/maintenance',[
			'uses' => 'WebsiteController@inMaintenance', 
			'as' => 'maintenance'
		]);
	
	
	});

	Route::group(['prefix' => 'archivero', 'namespace' => 'DepartamentPanel'], function()
	{
	  	Route::name('departament.')->group(function()
	  	{
	  		Route::get('/sign-in',[
		        'uses' => 'AuthController@login', 
		        'as' => 'login'
		    ]);

		    Route::post('/sign-in',[
		        'uses' => 'AuthController@postLogin', 
		    ]);

		    Route::get('/sign-out', [
		        'uses' => 'AuthController@logout', 
		        'as' => 'logout'
		    ]);

	  		Route::group(['middleware' => ['departament.user']
			], function()
			{
				Route::get('/', [
			        'uses' => 'HomeController@index', 
			        'as' => 'home'
				]);

				Route::post('/user/save/{user?}', [
			        'uses' => 'UserController@save', 
			        'as' => 'user.save'
				]);
				
				Route::get('/user', [
			        'uses' => 'UserController@index', 
			        'as' => 'user'
				]);

				Route::group(["prefix" => "modulo"], function() {

					Route::name('modulos.')->group(function() {

						Route::group(["prefix" => "usuarios"], function() {
							Route::get('/', [
								'uses' => 'ReportUsersController@index',
								'as' => 'usuarios.index'
							]);

							Route::post('/datatable', [
								'uses' => 'ReportUsersController@datatable',
								'as' => 'usuarios.datatable'
							]);

							Route::get('/delete/{id}', [
								'uses' => 'ReportUsersController@delete', 
								'as' => 'usuarios.delete'
							]);	
						});

						Route::group(["prefix" => "memorias"], function() {
							Route::get('/', [
						        'uses' => 'ReportMemoriasController@index', 
						        'as' => 'tesis.index'
							]);

							Route::post('/datatable', [
						        'uses' => 'ReportMemoriasController@datatable', 
						        'as' => 'tesis.datatable'
							]);

							Route::post('/tesis/save', [
								'uses' => 'ReportMemoriasController@saveDocument', 
								'as' => 'tesis.save'
							]);

							Route::get('/delete/{id}', [
								'uses' => 'ReportMemoriasController@delete', 
								'as' => 'tesis.delete'
							]);	

						});

					});

				});

			});
	  	});
	});

});
