<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CarreraModel;
use App\Models\Sicoes\Carrera;
use Auth;

class CarrerasController extends Controller
{
	public function index()
    {
        return view('AdminPanel.carreras.index');
    }

    public function create() {
        $instance = new CarreraModel();
        return view('AdminPanel.carreras.form')->with(["instance" => $instance]);
    }

    public function edit($id) {
        $instance = CarreraModel::find($id);
        return view('AdminPanel.carreras.form')->with(["instance" => $instance]);
    }

    public function save(Request $request, CarreraModel $instance) {
        $data = $request->except('_token'); 

        $sicoesCarrera = new Carrera();

        if ($instance->id) {
            $sicoesCarrera = Carrera::find($instance->CarreraId);
        }

        foreach ($data as $key => $value) {
            $instance->$key = $value; 

            if ($key != "precio" && $key != "is_activa") {
                  $sicoesCarrera->$key = strtoupper($value); 
             }         
        }

        $instance->save();
        $sicoesCarrera->save();
        session()->flash("messages","success|Carrera");
        return redirect()->route('admin.carreras');
    }
    
    public function delete($id) {
        try {
            CarreraModel::destroy($id);
            session()->flash("messages","success|La carrera se borró correctamente");
            return redirect()->route('admin.carreras');
        }catch (\Exception $e) {
            session()->flash("messages","error|No se borro la carrera");
            return redirect()->back();
        } 
    }

    public function datatable(Request $request)
    {
        $filter = $request->get('search') && isset($request->get('search')['value'])?$request->get('search')['value']:false;
        
        $start = $request->get('start');
        $length = $request->get('length');

        $query = CarreraModel::select();

        if($filter) {
            $query = $query->where(function($query) use ($filter){
                $query->orWhere('Nombre', 'like', '%'. $filter .'%')
                    ->orWhere('Clave', 'like', '%'. $filter . '%')
                    ->orWhere('Abreviatura', 'like', '%'. $filter . '%');
            });
        }

        $filtered = $query->count();

        $query->skip($start)->take($length)->get();
        
        return response()->json([
            "recordsTotal" => CarreraModel::count(),
            "recordsFiltered" => $filtered,
            "data" => $query->get()
        ]); 
    }
}