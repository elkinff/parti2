<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditoController extends Controller{
    
    public function __construct(){
        $this->middleware('auth', ["only" => ["index"]]);
    }

    public function index(){
    	return view('pages.dashboard.credito');
    }

    public function confirmacionPasarela(){
    	//Validar firma
		$signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);
		
		if ($signature == $request->x_signature) {
			$codigoRespuesta = $request->x_cod_response;
			if ($codigoRespuesta == 1) {
				$usuario = User::findOrFail($request->extra1);
				// $usuario->saldo = $usuario->saldo + 
			}
			}else{
				$mensaje ="No Realizada, estado = ".$codigoRespuesta;
			}
		}else{
			$mensaje = "No coincide la firma";
		}

		return $mensaje;
    }
}
