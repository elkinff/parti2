<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CreditoController extends Controller{
    
    public function __construct(){
        $this->middleware('auth', ["only" => ["index"]]);
    }

    public function index(){
    	return view('pages.dashboard.credito');
    }

    public function respuestaPasarela(Request $request){
    	if ($request->x_franchise == "AM" || $request->x_franchise == "CR" || $request->x_franchise == "DC" || $request->x_franchise == "CR" || $request->x_franchise == "MC" $request->x_franchise == "SP") {
    		alert()->info("Tu Pago se ha realizado satisfactoriamente, en unos segundos se reflejará en tu saldo");
    		return view('pages.dashboard.credito');
    	}else{
    		alert()->info("Tu Pago se ha realizado satisfactoriamente, en unos segundos se reflejará en tu saldo");
    		return view('pages.dashboard.credito');
    	}	
	}

    public function confirmacionPasarela(Request $request){
    	//Validar firma
		$signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);
		
		if ($signature == $request->x_signature) {
			$codigoRespuesta = $request->x_cod_response;
			if ($codigoRespuesta == 1) {
				$saldoRecarga = $request->x_amount;
				$usuario = User::findOrFail($request->x_extra1);
				$usuario->saldo = $usuario->saldo + $saldoRecarga;
				$usuario->save();

				$mensaje ="Saldo cargado";
			}else{
				$mensaje ="No Realizada, estado = ".$codigoRespuesta;
			}
		}else{
			$mensaje = "No coincide la firma";
		}

		return $mensaje;
    }
}
