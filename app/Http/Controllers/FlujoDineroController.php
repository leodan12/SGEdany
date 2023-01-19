<?php

namespace App\Http\Controllers;
use View;
use Datetime;

use Illuminate\Http\Request;
use App\Model\Flujo_Dinero;
use App\Model\Persona;
use App\Model\Colaborador;
use App\Model\Tipo_flujo;
use Carbon\Carbon;

class FlujoDineroController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $movimientos = Flujo_Dinero::join('colaborador','colaborador.idCol','flujo_dinero.idCol')->join('persona','persona.idPersona','colaborador.idPersona')
        ->join('tipo_flujo','tipo_flujo.idTipoFlujo','flujo_dinero.idTipoFlujo')->get();
        $colaboradores = Persona::join('colaborador','colaborador.idPersona','persona.idPersona')->where('per_estado',1)->get();
        $hoy = Carbon::now();
        $tipos = Tipo_Flujo::get();
        // dd($hoy->format('d-m-Y'));
        return View::make('flujoDinero.registro')
        ->with(['movimientos'=>$movimientos,'colaboradores'=>$colaboradores,'hoy'=>$hoy->format('Y-m-d'),'tipos'=>$tipos]);

    }

    public function guardar(Request $request)
    {
        try {
            $hoy = Carbon::now();
            $mov = new Flujo_Dinero;
            $mov->idTipoFlujo= $request->tipo;
            $mov->Flu_monto= $request->monto;
            $mov->Flu_fecha= $request->fecha;
            $mov->Flu_registro= $hoy->format('Y-m-d');
            $mov->idCol= $request->dni;
            $mov->Flu_motivo= strtoupper($request->motivo);
            $mov->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function editar($id)
    {
        $mov = Flujo_Dinero::findOrFail($id);
        return View::make('flujoDinero.edit')->with(['mov'=>$mov]);
    }

    public function actualizar(Request $request,$id)
    {
        try {
            $mov = Flujo_Dinero::findOrFail($id);
            $mov->idTipoFlujo= $request->tipo;
            $mov->Flu_monto= $request->monto;
            $mov->Flu_fecha= $request->fecha;
            $mov->idCol= $request->dni;
            $mov->Flu_motivo= strtoupper($request->motivo);
            $mov->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $mov = Flujo_Dinero::findOrFail($id);
            if($mov->Flu_estado=='activo'){
                $mov->Flu_estado='inactivo';
            }else{
                $mov->Flu_estado='activo';
            }
            $mov->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
