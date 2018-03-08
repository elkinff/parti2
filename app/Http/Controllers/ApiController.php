<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller{
    
    public function confirmacionPasarelaPublicacion(Request $request){
		//Validar firma
		$signature = hash('sha256', $request->x_cust_id_cliente.'^86c18a3ad068b30d14c99a47940ad176bb0c7721^'.$request->x_ref_payco.'^'.$request->x_transaction_id.'^'.$request->x_amount.'^'.$request->x_currency_code);
		
		if ($signature == $request->x_signature) {
			$publicacion = Publicacion::findOrFail($request->x_id_invoice);
			if ($publicacion->estado == 3) {
				switch ($request->x_cod_response) {
					//Transacción Aceptada
					case 1:
						$tipoPublicacion = $request->x_extra1;
						if ($tipoPublicacion == "publicacion") {
							$publicacion->estado = 0;
							$publicacion->save();

							//Actualizamos el saldo del usuario a $0
							$usuario = $publicacion->usuarioRetador;
							$usuario->saldo = 0;
							$usuario->save();
						}else{
							//Se ha creado el match
							$this->usuarioReceptor = User::findOrFail($request->x_extra2);
							$this->usuarioRetador = $publicacion->usuarioRetador;

							//Actualizamos el estado de la publicacion
							$publicacion->id_usu_receptor = $this->usuarioReceptor->id;
							$publicacion->estado = 1;
							$publicacion->save();

							//Actualizamos el estado del saldo
							$this->usuarioReceptor->saldo = 0;
							$this->usuarioReceptor->save();
					
							// Notificar a los usuarios del match
					        $imagen = "match";
					        $titulo = "Felicitaciones, encontraste tu Match!";
					        $descripcion = "Tu publicación encontró el contrincante. Si tu equipo gana recibirás $".number_format($publicacion->valor_ganado); 
					        $labelButton = "Continua publicando!";
					        $url = url("publicar");
							$subject = 'Felicitaciones, Encontraste tu match en Parti2';

						    $this->usuarioRetador->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));
						    $this->usuarioReceptor->notify(new EmailNotification($imagen, $titulo, $descripcion, $labelButton, $url, $subject));
						}
						break;

					//Transaccion Rechazada
					case 2:
					case 4:
						$publicacion->delete();
						break;
				}
			}
		}
	}

	public function confirmacionPasarelaCredito(Request $request){
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

        //Falta registrar movimiento banacario
    }
}
