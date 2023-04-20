<?php namespace App\Http\Controllers\DepartamentPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logs\Equipment;
use App\Models\Alumns\Document;
use App\Models\Logs\TempUse;
use App\Models\Logs\ClassRoom;
use App\Models\Logs\ReportEquipment;
use App\Models\Sicoes\Alumno;
use App\Models\Alumns\User;
use Carbon\Carbon;
use DB;

class ReportController extends Controller {

	public function index() {
		return view("DepartamentPanel.logs.tesis.index");
	}

    public function save(Request $request) 
    {
        try {
            $request->validate([
                'debit_type_id' => 'required',
                'amount' => 'required',
                'id_alumno'=>'required',
            ]);

            $alumn = Alumno::find($request->get("id_alumno"));

            $debit = new Debit();
            $debit->debit_type_id = $request->get("debit_type_id");
            $debit->amount = $request->get("amount");
            $debit->description = $request->get("description");
            $debit->id_alumno = $request->get("id_alumno");
            $debit->admin_id = current_user('departament')->id;
            $debit->period_id = selectCurrentPeriod()->id;
            $debit->enrollment = $alumn->Matricula;
            $debit->alumn_name = $alumn->Nombre;
            $debit->alumn_last_name = $alumn->ApellidoPrimero;
            $debit->alumn_second_last_name = (isset($alumn->ApellidoSegundo) ? $alumn->ApellidoSegundo : '');
            $debit->career = $alumn->PlanEstudio->Carrera->Nombre;
            $debit->location = $alumn->Localidad;
            $debit->state = $alumn->Estado->Nombre;

            $debit->save();
            session()->flash("messages","success|El alumno tiene un nuevo adeudo");
            return redirect()->back();
        } catch (\Exception $th) {
            session()->flash("messages","error|No pudimos guardar los datos");
            return redirect()->back();
        }
    }

	public function datatable(Request $request) {
        $filter = isset($request->get('search')['value']) && $request->get('search')  ?$request->get('search')['value']:false;

        $start = $request->get('start');
        $length = $request->get('length');
        $filtered = 0;

        $query = ReportEquipment::select([
        	"report_equipment.*",
        	DB::raw("CONCAT_WS(' ', u.name, u.lastname) AS full_name"),
            "u.enrollment",
        	"e.code as equipment",
        	"c.name as classroom",
        	"a.name as area"
        ])->leftJoin("users as u", "report_equipment.alumn_id", "u.id")
        ->leftJoin("equipment as e", "report_equipment.equipment_id", "e.id")
        ->leftJoin("classroom as c", "e.classroom_id", "c.id")
        ->leftJoin("area as a", "c.area_id", "a.id")
        ->where("a.id", current_user('departament')->area_id);

        if ($request->has('initDate') && $request->get('initDate') != "" && $request->get('initDate')) {
            $init = $request->get('initDate');
            $end = $request->get('endDate');

            if ($init == $end) {
                $query = $query->where("report_equipment.created_at", "like", $init."%");
            } else {
                $end = new Carbon($end);
                $end = $end->addDays(1)->format('Y-m-d');
                $query = $query->whereBetween("report_equipment.created_at", [$init, $end]);
            }
        }
        
        if ($filter) {
           $query = $query->where(function($query) use ($filter){
                $query->orWhere('report_equipment.entry', 'like', '%'. $filter .'%')
                ->orWhere('u.name', 'like', '%'. $filter .'%')
                ->orWhere('u.lastname', 'like', '%'. $filter .'%')
                ->orWhere('e.code', 'like', '%'. $filter .'%')
                ->orWhere('c.name', 'like', '%'. $filter .'%')
                ->orWhere('a.name', 'like', '%'. $filter .'%');
            });
        } 

        $filtered = $query->count();

        $query->skip($start)->take($length)->get();

        if(isset($order) && isset($order[0]) && $order[0]['column'] > -1) {
           $query->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'] );  
        }

        return response()->json([
            "recordsTotal" => ReportEquipment::count(),
            "recordsFiltered" => $filtered,
            "data" => $query->get()
        ]);
	}

    public function saveDocument(Request $request)
    {
        $file = $request->file('file-document');
        $rDocument = $request->input('document-type');
        $path = "memorias/" . "hola";

        $document_type = "memoria";

        if ($file->getClientOriginalExtension() != "pdf") {
            session()->flash("messages","warning|El documento no tiene el formato requerido");
            return redirect()->back();
        }
        
        $documentName = $document_type."_".time().".".$file->getClientOriginalExtension();
        // $documentName = $document_type.".".$file->getClientOriginalExtension();


        // if (file_exists("/".$path."/".$documentName)) {
        //     unlink("/".$path."/".$documentName);
        // }

        $file->move($path, $documentName);
        $document = Document::where("route", $path."/".$documentName)->first();
        
        if(!$document) {
            $document = new Document();
        }


        $documentValidate = Document::where("route", "/".$path."/".$documentName)->first();

        if(!$documentValidate){

            $document->description = "Documento de inscripción";
            $document->route = "/".$path."/".$documentName;
            $document->status = 1;
            $document->PeriodoId = getConfig()->period_id;
            $document->alumn_id = 1;
            $document->type = 1;
            $document->document_type_id = 3;    

            $document->save();

            session()->flash("messages","success|El documento se guardo con exito");
            return redirect()->back();

        }else{

            session()->flash("messages","success|El documento ha sido reemplazado con exito!.");
            return redirect()->back();
            
        }

        
    }
}