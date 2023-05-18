<?php namespace App\Http\Controllers\DepartamentPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logs\Equipment;
use App\Models\Logs\users;
use App\Models\Logs\Document;
use App\Models\Logs\TempUse;
use App\Models\Logs\ClassRoom;
use App\Models\Logs\ReportEquipment;
use App\Models\Alumns\User;
use Carbon\Carbon;
use DB;

class ReportUsersController extends Controller {

	public function index() {

		return view("DepartamentPanel.logs.users.index");

	}

	public function datatable(Request $request) 
    {
        $filter = $request->get('search') && isset($request->get('search')['value'])?$request->get('search')['value']:false;
        $start = $request->get('start');
        $length = $request->get('length');

        $query = users::where("id","<>",null);

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

    public function delete($id)
	{
		$tesis = users::find($id);
		users::where("id","=",$tesis->id)->delete();
		$tesis->delete();
		session()->flash("messages","success|Todos los registros fueron borrados");
		return redirect()->back();
    }

}