<?php

namespace App\Http\Controllers;
use View;


use Illuminate\Http\Request;
use App\Model\Sist_Pension;

class SistPensionController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $pensiones = Sist_Pension::all();
      
        return View::make('sistPension.registro')->with(['pensiones'=>$pensiones]);

    }

    public function guardar(Request $request)
    {
        try {
            $pension = new Sist_Pension;
            $pension->Pen_nombre = mb_strtoupper($request->namePen, 'UTF-8');
            $pension->Porc_obligatorio =$request->oblig;
            $pension->Porc_comFlujo =$request->comFlujo;
            $pension->Porc_comMixta =$request->comMixta;
            $pension->Porc_seguro =$request->seg;
            $pension->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
        
    }

    public function editar($id)
    {
        $pension = Sist_Pension::findOrFail($id);
        return View::make('pension.edit')->with(['pension'=>$pension]);
    }

    public function actualizar(Request $request,$id)
    {
        try {
            $pension = Sist_Pension::findOrFail($id);
            $pension->Pen_nombre = mb_strtoupper($request->namePen, 'UTF-8');
            $pension->Porc_obligatorio =$request->oblig;
            $pension->Porc_comFlujo =$request->comFlujo;
            $pension->Porc_comMixta =$request->comMixta;
            $pension->Porc_seguro =$request->seg;
            $pension->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $pension = Sist_Pension::findOrFail($id);
            if($pension->pen_estado == 'activo'){
                $pension->pen_estado='inactivo';
            }else{
                $pension->pen_estado='activo';
            }
            $pension->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
