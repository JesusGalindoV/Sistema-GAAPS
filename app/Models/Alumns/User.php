<?php

namespace App\Models\Alumns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sicoes\Inscripcion;
use App\Library\Inscription;

class User extends Authenticatable
{
    protected $table = "users";

    protected $appends = ["FullName"];

    public $steps = [
        "form" => 0,
        "payment" => 1,
        "waiting" => 2,
        "charge" => 3,
        "complete" => 4
    ];

    public function requestPassword() {
        return $this->hasMany('\App\Models\Alumns\PasswordRequest', "id", "alumn_id");
    }

    public function getFullNameAttribute() {
        return join(" ", [$this->name, $this->lastname]);
    }
}
