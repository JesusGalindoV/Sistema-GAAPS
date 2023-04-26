<?php

namespace App\Http\Controllers\Alumn;

use Auth;
use App\Models\Alumns\Debit;
use Illuminate\Http\Request;
use App\Models\Alumns\Ticket;
use App\Models\Alumns\Document;
use App\Models\AdminUsers\Problem;
use App\Http\Controllers\Controller;
use App\Library\Log;
use DB;

class HomeController extends Controller
{

    public function index()
    {

        return view('Alumn.home.index');
        
    }

}