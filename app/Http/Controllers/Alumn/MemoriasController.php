<?php

namespace App\Http\Controllers\Alumn;

use Auth;
use App\Models\Alumns\Debit;
use Illuminate\Http\Request;
use App\Models\Alumns\Ticket;
use App\Models\Logs\Document;
use App\Models\AdminUsers\Problem;
use App\Http\Controllers\Controller;
use App\Library\Log;
use DB;

class MemoriasController extends Controller
{

    public function index()
    {

        return view('Alumn.memorias.index');
        
    }

    public function datatable(Request $request) 
    {
        $filter = $request->get('search') && isset($request->get('search')['value'])?$request->get('search')['value']:false;
        $start = $request->get('start');
        $length = $request->get('length');

        $query = Document::where("id","<>",null);

        if ($filter) {
            $query = $query->where(function($query) use ($filter){
                $query->orWhere('document_type.Autor', 'like', '%'. $filter .'%')
                    ->orWhere('document.Titulo', 'like', '%'. $filter . '%')
                    ->orWhere('document.Carrera', 'like', '%'. $filter . '%');
            });
        }

        $filtered = $query->count();

        $query->skip($start)->take($length)->get();

        return response()->json([
            "recordsTotal" => $query->count(),
            "recordsFiltered" => $filtered,
            "data" => $query->get()
        ]);
	}

}