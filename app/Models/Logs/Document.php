<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $table = "memorias";

    protected $fillable = [
    	'id',
        'Autor',
        'Titulo',
        'Resumen',
        'Carrera',
        'Año',
        'route',
        'created_at',
        'updated_at',
    ];

}