<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;
use App\Model\Area;

class AreaController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $areas = Area::all();
        return View::make('area.registro')->with(['areas'=>$areas]);

    }

    public function guardar(Request $request)
    {
        try {
            $area = new Area;
            $area->are_nombre = mb_strtoupper($request->nameA, 'UTF-8');
            $area->are_descripcion =mb_strtoupper($request->descA, 'UTF-8');
            $area->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function verificar($id)
    {
        $area = Area::where('are_nombre',$id)->first();
        if(is_null($area)){
            return json_encode('success');
        }
        else{
            return json_encode('error');
        }
        return View::make('area.edit')->with(['area'=>$area]);
    }

    public function actualizar(Request $request,$id)
    {
        try {
            $area = Area::findOrFail($id);
            $area->Are_nombre = mb_strtoupper($request->nameA, 'UTF-8');
            $area->Are_descripcion = mb_strtoupper($request->descA, 'UTF-8');
            $area->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $area = Area::findOrFail($id);
            if($area->are_estado == 'activo'){
                $area->are_estado='inactivo';
            }else{
                $area->are_estado='activo';
            }
            $area->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
