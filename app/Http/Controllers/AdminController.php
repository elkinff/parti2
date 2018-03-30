<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovimientoBancario;

class AdminController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function getSolicitudesPagos(){
    	$retiros = MovimientoBancario::whereTipo('Retiro')->orderBy("fecha", "desc")->get();
    	return view('pages.admin.pagos', compact("retiros"));
    }

    public function pagarRetiro($idRetiro){
    	$retiro = MovimientoBancario::findOrFail($idRetiro);
    	$retiro->estado_pago_admin = 1;
    	$retiro->save();

    	return redirect()->back();
    }
}
