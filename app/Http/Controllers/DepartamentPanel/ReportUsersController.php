<?php namespace App\Http\Controllers\DepartamentPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logs\Equipment;
use App\Models\Logs\Users;
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

        

        $query = Users::where("id","<>",null);

        if ($filter) {
            $query = $query->where(function($query) use ($filter){
                $query->orWhere('users.name', 'like', '%'. $filter . '%')
                    ->orWhere('users.lastname', 'like', '%'. $filter . '%')
                    ->orWhere('users.email', 'like', '%'. $filter . '%')
                    ->orWhere('users.curp', 'like', '%'. $filter . '%');
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

    // public function delete($id)
	// {
	// 	$tesis = Document::find($id);
	// 	Document::where("id","=",$tesis->id)->delete();
	// 	$tesis->delete();
	// 	session()->flash("messages","success|Todos los registros fueron borrados");
	// 	return redirect()->back();
    // }

}