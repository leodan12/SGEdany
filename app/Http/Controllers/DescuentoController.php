<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;
use App\Model\Descuento;
use App\Model\Colaborador;
use DateTime;

class DescuentoController extends Controller
{
    public function adelanto()
    {
        $colaboradores = Colaborador::where('col_estado',1)->get();

        return View::make('descuentos.adelanto.inicio')->with(['colaboradores'=>$colaboradores]);
    }

    public function adelantoG(Request $request)
    {
        $hoy = new DateTime();

        $descuento = new Descuento;
        $descuento->idTipoDesc = 8;
        $descuento->idColaborador = $request->colA;
        $descuento->desc_monto= $request->montA;
        $descuento->desc_fechareg = $hoy;
        $descuento->desc_fecha = $request->fechA;
        $descuento->desc_motivo = $request->motA;
        $descuento->save();
        return redirect()->route('adelanto.register');
    }
}
