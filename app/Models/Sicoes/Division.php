<?php 

namespace App\Models\Sicoes;

use Illuminate\Database\Eloquent\Model;

class Division extends Model {

	protected $connection = 'sicoes';

	protected $primaryKey = 'DivisionId';

    protected $table = 'Division';

    public $timestamps = false;

}

