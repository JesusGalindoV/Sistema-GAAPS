<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sicoes\PlanEstudio;

class CarreraModel extends Model
{
    protected $table = "carreras";

    protected $primaryKey = 'CarreraId';
}