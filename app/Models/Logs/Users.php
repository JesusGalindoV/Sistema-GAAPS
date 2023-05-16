<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    protected $table = "users";

    protected $fillable = [
    	'id',
        'name',
        'lastname',
        'email',
        'curp',
        'tour',
        'photo'
    ];

}