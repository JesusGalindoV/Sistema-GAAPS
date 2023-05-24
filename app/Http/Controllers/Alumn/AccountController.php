<?php

namespace App\Http\Controllers\Alumn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alumns\User;
use App\Models\AdminUsers\AdminUser;
use App\Models\Website\Pending;
use App\Models\Sicoes\Alumno;
use App\Library\Log;
use Auth;

class AccountController extends Controller
{
    private $logger;

    public function callAction($method, $parameters)
    {
        $this->logger = new Log(AccountController::class);
        return parent::callAction($method, $parameters);
    }

	public function index() 
	{
        $this->logger->info("###Iniciando proceso de alta de alumno re-inscripcion paso 1");
        $step = 1;
        return view('Alumn.account.steps')->with(["step"=>$step]);
    }

    public function save(Request $request, $step)
    {
                //validamos que no haya ninguna sesion abierta, si la hay la cerramos
                closeAllSessions("alumn");

                try {
                    $user = new User();
                    $user->name = normalizeChars($data->Nombre);
                    $user->lastname = normalizeChars($data->ApellidoPrimero." ".$data->ApellidoSegundo);
                    $user->email = $request->input('email');
                    $user->password = bcrypt($request->input("password"));
                    $user->id_alumno = 5;
                    $user->save();

                    $credentials = $request->only('email', 'password');
                    if (Auth::guard('alumn')->attempt($credentials)) {
                        session()->flash("messages", "success|Bienvenido".$user->name.".");
                    } else {
                        session()->flash("messages","info|No pudimos iniciar sesion, intenta hacerlo con tus credenciales");                       
                    }
                   
                    return redirect()->route("alumn.home");
                } catch(\Exception $e) {
                    $this->logger->info("Ocurrió un error del tipo: " . $e->getMessage());
                    session()->flash("messages","error|Ocurrio un problema al intentar guardar");
                    return redirect()->route('alumn.users.first_step'); 
                }              
    }

    public function registerAlumn(Request $request) 
    {

        $request->validate([
            'name'=>'required',
            'lastname'=>'required',
            'email' => 'required',
            'password' => 'required'
            
        ]);

        //validar que un correo no exista.
        $validate = User::where("email","=", $request->input("email"))->first();
        $adminUser = AdminUser::where('email', "=" ,$request->input("email"))->first();

        if($validate || $adminUser) {
            session()->flash("messages","error|El correo ".$request->input("email")." ya esta registrado");
            return redirect()->back()->withInput();
        }

        //intentar registrar al alumno, cualquier error que surja se envia de nuevo al registro
        try {
            $user = new User();
            $user->name = normalizeChars($request->input("name"));
            $user->lastname = normalizeChars($request->input("lastname"));
            $user->email = $request->input("email");
            // $user->curp = $request->input("curp");
            $user->password = bcrypt($request->input("password"));
            $user->save(); 
            session()->flash("messages", 'success|Su registro se realizó con éxito|De click en el botón Acceso para iniciar sesión');
            return redirect()->back(); 
        } catch(\Exception $e) {
           session()->flash("messages","error|Opps, ocurrió un problema que no esperabamos.");
           return redirect()->back(); 
        }
        
    }
}