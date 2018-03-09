<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MovimientoBancario;
use App\Http\Requests\CreditoRetiroRequest;
use Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AvisoRetiroNotification;
use App\Publicacion;

class CreditoController extends Controller{
    
    public function __construct(){
        $this->middleware('auth', ["only" => ["index"]]);
    }

    public function index(){
        $historial = Auth::user()->historialCrediticio()->whereEstado(1)->get();
    	return view('pages.dashboard.credito', compact("historial"));
    }

    public function retirarDinero(CreditoRetiroRequest $request){
        $this->validate($request, ['valor' => 'required|menor_saldo']);
        try {
            $usuario = Auth::user();
            $matchsUser = User::matchsUsuarios($usuario->id);
        
            if (!$matchsUser->isEmpty()) {            
                $valorRetiro = $request->valor;
                
                $usuario->saldo = $usuario->saldo - str_replace(array("$",","), "", $valorRetiro);
                $usuario->save();

                //Enviar Correo a admin-parti2
                $usuarioAdmin = new User();
                $usuarioAdmin->email = "hola@parti2.com";
                $usuarioAdmin->notify(new AvisoRetiroNotification($usuario, $valorRetiro));

                //Registrar el movimiento de credito del usuario
                $request["valor"] = str_replace(array("$", ","), "", $valorRetiro);
                $request["id_usu"] = $usuario->id;
                $request["tipo"] = "Retiro";
                $request["fecha"] = date("Y-m-d H:i:s");
                $request["estado"] = 1;

                MovimientoBancario::create($request->all());

                alert()->success('Tu transacción se ha realizado satisfactoriamente, en un momento recibirás tu dinero');
            }else{
                alert()->info('Tienes que realizar tu primer match para hacer retiros');
            }
        }catch (Exception $e) {
            alert()->info($e);
        }
         
        return redirect()->to("credito");
    }

    public function adicionarCredito(Request $request){
        //Solicitar el valor y el usuario id
        $request["valor"] = str_replace(array("$",","), "", $request["valor"]);
        $request["tipo"] = "Adición de credito";
        $request["fecha"] = date("Y-m-d H:i:s");
        $request["estado"] = 0;

        $movimientoBancario = MovimientoBancario::create($request->all());

        return response()->json(["id" => $movimientoBancario->id]);
    }

    public function respuestaPasarela(Request $request){
    	//Validar firma
        $signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);
        
        if ($signature == $request->x_signature) {
            $saldoRecarga = $request->x_amount_base;
            $usuario = User::findOrFail($request->x_extra1);
            $movimientoBancario = MovimientoBancario::findOrFail($request->x_extra2);

            switch ($request->x_cod_response) {
                case 1:
                    $usuario->saldo = $usuario->saldo + $saldoRecarga;
                    $usuario->save();

                    $movimientoBancario->estado = 1;
                    $movimientoBancario->save();

                    alert()->success("Tu credito se ha agregado satisfactoriamente");
                    break;
                
                //Transaccion en espera
                case 3:    
                    alert()->success("Tu transacción esta en espera");
                    break;
            }
            return redirect()->to("credito");
        }
    }

    public function confirmacionPasarelaCredito(Request $request){
        //Validar firma
        $signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);
        
        if ($signature == $request->x_signature) {
            $movimientoBancario = MovimientoBancario::findOrFail($request->x_extra2);
            if ($movimientoBancario->estado == 0) {
                $saldoRecarga = $request->x_amount_base;
                $usuario = User::findOrFail($request->x_extra1);    
                $movimientoBancario = MovimientoBancario::findOrFail($request->x_extra2);

                switch ($request->x_cod_response) {
                    case 1:
                        $usuario->saldo = $usuario->saldo + $saldoRecarga;
                        $usuario->save();

                        $movimientoBancario->estado = 1;
                        $movimientoBancario->save();
                        break;
                }     
            }  
        }
    }
}






