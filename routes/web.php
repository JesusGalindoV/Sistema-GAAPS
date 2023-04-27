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

			//te lleva  a a la vista para enviar la peticion de restaurar pass
			Route::get('/restore-pass',[
		        'uses' => 'AuthController@requestRestorePass', 
		        'as' => 'RequestRestorePass'
			]);		

			//envia la peticion de restaurar pass
			Route::post('/restore-pass',[
		        'uses' => 'AuthController@sendRequest', 
		        'as' => 'sendRequest'
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
				
				Route::get('/user/tesis', [
					'uses' => 'MemoriasController@index',
					'as' => 'tesis'
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

	    Route::get('/restore-pass/{token?}', [
	        'uses' => 'WebsiteController@viewRestore', 
	        'as' => 'restore'
	    ]);	

	    Route::post('/restore/{instance?}', [
	        'uses' => 'WebsiteController@restorePassword', 
	        'as' => 'restore.password'
	    ]);	

		Route::get('/maintenance',[
			'uses' => 'WebsiteController@inMaintenance', 
			'as' => 'maintenance'
		]);
	
	
	});

	Route::group(['prefix'=> 'admin', 'namespace'=>'AdminPanel'], function()
	{
	  	Route::name('admin.')->group(function()
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

	  		Route::group(['middleware' => ['admin.user']
			], function()
			{
				Route::get('/', [
			        'uses' => 'HomeController@index', 
			        'as' => 'home'
				]);
			});
	  	});
	});

	Route::group(['prefix' => 'departaments', 'namespace' => 'DepartamentPanel'], function()
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

				Route::get('/debit', [
			        'uses' => 'DebitController@index', 
			        'as' => 'debit'
				]);

				Route::post('/debit/save', [
			        'uses' => 'DebitController@save', 
			        'as' => 'debit.save'
				]);

				Route::post('/debit/update', [
			        'uses' => 'DebitController@update', 
			        'as' => 'debit.update'
				]);
				
				Route::post('/debit/show', [
			        'uses' => 'DebitController@showDebit', 
			        'as' => 'debit.show'
				]);

				Route::post('/debit/see', [
			        'uses' => 'DebitController@seeDebit', 
			        'as' => 'debit.see'
				]);

				Route::get('/debit/delete/{id}', [
			        'uses' => 'DebitController@delete', 
			        'as' => 'debit.see'
				]);

				Route::group(["prefix" => "biblioteca"], function() {

					Route::name('logs.')->group(function() {

						Route::group(["prefix" => "bibliografia"], function() {

							Route::get('/', [
						        'uses' => 'ClassRoomController@index', 
						        'as' => 'classrooms.index'
							]);

							Route::get('/create', [
						        'uses' => 'ClassRoomController@create', 
						        'as' => 'classrooms.create'
							]);

							Route::get('/edit/{id?}', [
						        'uses' => 'ClassRoomController@edit', 
						        'as' => 'classrooms.edit'
							]);

							Route::get('/delete/{id?}', [
						        'uses' => 'ClassRoomController@delete', 
						        'as' => 'classrooms.delete'
							]);

							Route::post('/save/{instance?}', [
						        'uses' => 'ClassRoomController@save', 
						        'as' => 'classrooms.save'
							]);

						});

						Route::group(["prefix" => "tesis"], function() {
							Route::get('/', [
						        'uses' => 'ReportController@index', 
						        'as' => 'tesis.index'
							]);

							Route::post('/datatable', [
						        'uses' => 'ReportController@datatable', 
						        'as' => 'tesis.datatable'
							]);

							Route::post('/tesis/save', [
								'uses' => 'ReportController@saveDocument', 
								'as' => 'tesis.save'
							]);

							Route::get('/delete/{id}', [
								'uses' => 'ReportController@delete', 
								'as' => 'tesis.delete'
							]);	

						});

						Route::group(["prefix" => "equipments"], function() {

							Route::get('/', [
						        'uses' => 'EquipmentController@index', 
						        'as' => 'equipment.index'
							]);

							Route::get('/delete/{id?}', [
						        'uses' => 'EquipmentController@delete', 
						        'as' => 'equipment.delete'
							]);

							Route::post('/save', [
						        'uses' => 'EquipmentController@save', 
						        'as' => 'equipment.save'
							]);

							Route::post('/fill', [
						        'uses' => 'EquipmentController@fillOrQuit', 
						        'as' => 'equipment.fill'
							]);

							Route::get('/getEquipment', [
						        'uses' => 'EquipmentController@equipment', 
						        'as' => 'equipment.getEquipment'
							]);

							Route::get('/getAlumnInfo', [
						        'uses' => 'EquipmentController@alumnData', 
						        'as' => 'equipment.alumnData'
							]);

						});

					});

				});

			});
	  	});
	});

});
