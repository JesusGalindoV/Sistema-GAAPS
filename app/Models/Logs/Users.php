<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{

    protected $table = "users";

    protected $fillable = [
    	'id',
        'name',
        'lastname',
        'email',
    ];

}