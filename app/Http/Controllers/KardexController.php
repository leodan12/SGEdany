<?php

namespace App\Http\Controllers;
use View;
use Datetime;

use Illuminate\Http\Request;
use App\Model\Kardex;
use App\Model\Ubicacion;
use App\Model\Producto;
use App\Http\Controllers\KardexController;

class KardexController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $kardex = Kardex::join('ubicacion','ubicacion.idUbicacion','kardex.idUbicacion')->join('producto','producto.idProducto','kardex.idProducto')->where('krdx_estado','activo')->get();
        $ubic = Ubicacion::get();
        return View::make('kardex.registro')->with(['kardex'=>$kardex,'ubicAct'=>$ubic]);

    }

    public function guardar(Request $request)
    {
       try {
            $hoy = new Datetime;

            $krdx = new Kardex;
            $krdx->idProducto = $request->prod;
            $krdx->idUbicacion = $request->ubicacion;
            $krdx->Kdx_creacion = $hoy->format('Y-m-d');
            $krdx->Cant_actual = $request->cantidad;
            $krdx->save();

            $ubic = Ubicacion::findOrFail($request->ubicacion);
            $ubic->Ubic_estado='ocupado';
            $ubic->save();

            $prod = Producto::findOrFail($request->prod);
            $prod->Prod_estado='almacenado';
            $prod->save();
            return json_encode('success');
       } catch (\Throwable $th) {
            return json_encode('error');
       }
    }

    public function buscarProducto(Request $request)
    {
        $datos = Producto::find($request->prod);
     
        return json_encode($datos);
    }


    public function actualizar(Request $request,$id)
    {
       
        try {
            $krdx = Kardex::findOrFail($id);

            if ($krdx->idUbicacion != $request->ubicacion){


                KardexController::estado('Ubicacion',$krdx->idUbicacion,'disponible');

                $krdx->idUbicacion = $request->ubicacion;

                KardexController::estado('Ubicacion',$krdx->idUbicacion,'ocupado');

            }
            $krdx->save();
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->route('kardex.register');
    }

    public function estado($model,$valor,$estado)
    {
        if ($model == 'Ubicacion'){
            $dato = Ubicacion::findOrFail($valor);
            $dato->Ubic_estado=$estado;
        }
        else{
            $dato = Producto::findOrFail($valor);
            $dato->Prod_estado=$estado;
        }
        
        
        $dato->save();
    }

    public function eliminar($id)
    {
        try {
            $krdx = Kardex::findOrFail($id);

            if ($krdx->krdx_estado=='activo'){
                $krdx->krdx_estado='inactivo';
                $krdx->save();
                KardexController::estado('Ubicacion',$krdx->idUbicacion,'disponible');
                KardexController::estado('Producto',$krdx->idProducto,'activo');
            }

            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
