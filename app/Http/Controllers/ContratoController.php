<?php

namespace App\Http\Controllers;
use View;
use Datetime;


use Illuminate\Http\Request;
use App\Model\Contrato;
use App\Model\Colaborador;
use Carbon\Carbon;

class ContratoController extends Controller
{
    public function inicio()
    {
        $contratos = Contrato::where('con_estado',1)->get();
        $colaboradores = Colaborador::where('col_estado',1)->get();

        return View::make('contrato.inicio')->with(['contratos'=>$contratos,'colaboradores'=>$colaboradores]);

    }

    public function registro(Request $request)
    {
        $file = $request->file('docC');
        $col = Colaborador::findOrFail($request->contC);
        $nombre = $col->col_apellidos.' '.$request->regC.'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/contratos',$nombre);

        $hoy = new Datetime;
        $contrato = new Contrato;
        $contrato->idColaborador = $request->contC;
        $contrato->con_fechIni = $request->iniC;
        $contrato->con_fechFin = $request->finC;
        $contrato->con_fechFirma = $request->firmC;
        $contrato->con_doc = $nombre;
        $contrato->con_registro = $hoy->format('Y-m-d');
        $contrato->save();
        return redirect()->route('contrato.inicio');
    }

    public function eliminar($id,$idc)
    {

        $contrato = Contrato::where('idContrato',$id)->first();
        $contrato->con_estado=0;
        $contrato->save();

        return redirect()->route('contrato.inicio');
    }


}
