<?php namespace App\Http\Controllers\DepartamentPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logs\Equipment;
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

    public function saveDocument(Request $request)
    {

        $file = $request->file('file-document');
        $path = "memorias";

        $document_type = "tesis";

        if ($file->getClientOriginalExtension() != "pdf") {
            session()->flash("messages","warning|El documento no tiene el formato requerido");
            return redirect()->back();
        }

        $documentName = $document_type."_".$request->input("autor").".".$file->getClientOriginalExtension();

        if (file_exists("/".$path."/".$documentName)) {
            unlink("/".$path."/".$documentName);
        }

        $file->move($path, $documentName);
        $document = Document::where("route", $path."/".$documentName)->first();
        
        if(!$document) {
            $document = new Document();
        }


        $documentValidate = Document::where("route", "/".$path."/".$documentName)->first();


        if(!$documentValidate){

            $document->Autor = $request->input("autor");
            $document->Titulo = $request->input("titulo");
            $document->Carrera = $request->input("carrera");
            $document->Año = $request->input("year");
            $document->route = "/".$path."/".$documentName;   

            $document->save();

            session()->flash("messages","success|El documento se guardo con exito");
            return redirect()->back();

        }else{

            session()->flash("messages","success|El documento ha sido reemplazado con exito!.");
            return redirect()->back();
            
        }
        
    }

    public function delete($id)
	{
		$tesis = Document::find($id);
		Document::where("id","=",$tesis->id)->delete();
		$tesis->delete();
		session()->flash("messages","success|Todos los registros fueron borrados");
		return redirect()->back();
    }

}