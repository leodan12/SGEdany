<?php

namespace App\Http\Controllers;
use View;


use Illuminate\Http\Request;
use App\Model\Area;
use App\Model\Cargo;

class CargoController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function registro()
    {
        $cargos = Cargo::join('area','area.idArea','cargo.idArea')->get();
        $areas = Area::where('are_estado','activo')->get();
        return View::make('cargo.registro')->with(['cargos'=>$cargos, 'areas'=>$areas]);
        
    }

    public function guardar(Request $request)
    {
        try {
            $cargo = new Cargo;
            $cargo->Car_nombre = mb_strtoupper($request->nameCa);
            $cargo->Car_descripcion = mb_strtoupper($request->descCa);
            $cargo->idArea=$request->areaCa;
            $cargo->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
        $cargo = new Cargo;
        $cargo->Car_nombre = mb_strtoupper($request->nameCa,'UTF-8');
        $cargo->Car_descripcion = mb_strtoupper($request->descCa,'UTF-8');
        $cargo->idArea=$request->areaCa;
        $cargo->save();
        return redirect()->route('cargo.register');
    }

    public function verificar($id)
    {
        $cargo = Cargo::where('Car_nombre',mb_strtoupper($id,'UTF-8'))->first();
        if(is_null($cargo)){
            return json_encode('success');
        }
        else{
            return json_encode('error');
        }
    }

    public function actualizar(Request $request,$id)
    {
        try {
            $cargo = Cargo::findOrFail($id);
            $cargo->Car_nombre = mb_strtoupper($request->nameCa);
            $cargo->Car_descripcion = mb_strtoupper($request->descCa);
            $cargo->idArea=$request->areaCa;
            $cargo->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $cargo = Cargo::findOrFail($id);
            if($cargo->Car_estado == 'activo'){
                $cargo->Car_estado='inactivo';
            }else{
                $cargo->Car_estado='activo';
            }
            $cargo->save();
            return json_encode($cargo->Car_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
