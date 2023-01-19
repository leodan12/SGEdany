<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;
use App\Model\Empresa;

class EmpresaController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $empresas = Empresa::where('idRol',4)->get();
        return View::make('empresa.registro')->with(['empresas'=>$empresas]);

    }

    public function guardar(Request $request)
    {
        try {
            $empresa = new Empresa;
            $empresa->RUC = $request->ruc;
            $empresa->RazonSocial =mb_strtoupper($request->razon, 'UTF-8');
            $empresa->NombreComercial =mb_strtoupper($request->nombre, 'UTF-8');
            $empresa->Direccion =mb_strtoupper($request->direc, 'UTF-8');
            $empresa->Rubro =mb_strtoupper($request->rubro, 'UTF-8');
            $empresa->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        
        }
    }

    public function verificar($id)
    {
        $empresa = Empresa::where('RUC',$id);
        if (is_null($empresa)){
            return json_encode('success');
        } 
        else {
        return json_encode('error');
        }
    }

    public function actualizar(Request $request,$id)
    {
        try {
            $empresa = Empresa::findOrFail($id);
            $empresa->RazonSocial =mb_strtoupper($request->razon, 'UTF-8');
            $empresa->NombreComercial =mb_strtoupper($request->nombre, 'UTF-8');
            $empresa->Direccion =mb_strtoupper($request->direc, 'UTF-8');
            $empresa->Rubro =mb_strtoupper($request->rubro, 'UTF-8');
            $empresa->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $empresa = Empresa::findOrFail($id);
            if($empresa->emp_estado == 'activo'){
                $empresa->emp_estado='inactivo';
            }else{
                $empresa->emp_estado='activo';
            }
            $empresa->save();
            return json_encode($empresa->emp_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
