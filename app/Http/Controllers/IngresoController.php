<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;

use App\Model\TipoIngreso;
use App\Model\Ingreso;
use App\Model\Colaborador;
use DateTime;

class IngresoController extends Controller
{
    public function inicio()
    {
        $colaboradores = Colaborador::where('col_estado',1)->get();
        $ingresos = TipoIngreso::where('ing_estado',1)->get();

        return View::make('ingreso.inicio')->with(['colaboradores'=>$colaboradores,'ingresos'=>$ingresos]);
    }

    public function guardar(Request $request)
    {
        $hoy = new DateTime();

        $ingreso = new Ingreso;
        $ingreso->idTipoIngreso = $request->tipI;
        $ingreso->idColaborador = $request->colI;
        $ingreso->ing_monto= $request->montI;
        $ingreso->ing_fechareg = $hoy;
        $ingreso->ing_fecha = $request->fechI;
        $ingreso->save();
        return redirect()->route('adelanto.register');
    }
}
