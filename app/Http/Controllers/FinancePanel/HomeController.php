<?php

namespace App\Http\Controllers\FinancePanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Input;
use DB;

class HomeController extends Controller
{
	public function index()
	{

        /*

        $debits = DB::table('debit')
        ->join('users', 'users.id_alumno' , '=', 'debit.id_alumno')
        ->select('debit.id','debit.id_order', 'debit.concept' ,'debit.amount','debit.admin_id','debit.status','debit.payment_method','users.name','users.lastname')
        ->get();

        */


		return view('FinancePanel.home.index');
    }
    
    public function changePaymentStatus(Request $request , $id){
        
        $status = $request->input('status');
        DB::table('debit')
        ->where('id', $id) ->update(['status' => $status]);


        return redirect()->route('finance.home');
    }

    public function showPayementTicket($id_order){

        require_once("conekta/Conekta.php");
        \Conekta\Conekta::setApiKey("key_b6GSXASrcJATTGjgSNxWFg");
        \Conekta\Conekta::setApiVersion("2.0.0");
        $order = \Conekta\Order::find($id_order);
       

        return view('FinancePanel.home.temp');

    }

	

}