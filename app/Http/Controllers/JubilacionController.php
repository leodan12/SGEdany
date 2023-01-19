<?php

namespace App\Http\Controllers;
use View;
use Datetime;

use Illuminate\Http\Request;
use App\Model\Persona;
use App\Model\Colaborador;
use App\Model\Jubilacion;
use Carbon\Carbon;

class JubilacionController extends Controller
{
    public function registro()
    {
        $jubilaciones = Jubilacion::join('colaborador','colaborador.idCol','jubilacion.idCol')
        ->join('persona','persona.idPersona','colaborador.idPersona')
        ->select('persona.per_nombres','persona.per_apellidos','jubilacion.*')->get();
    
        $colaboradores = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')
        ->where('persona.per_estado','activo')->get();

        $AllCol =Colaborador::join('persona','persona.idPersona','colaborador.idPersona')->get();
       
        return View::make('jubilacion.registro')->with(['colaboradores'=>$colaboradores, 'jubilaciones'=>$jubilaciones,'AllCol'=>$AllCol]);
        
    }

    public function guardar(Request $request)
    {
        try {

            $hoy = Carbon::now();
            
            $jubilacion = new Jubilacion;
            $jubilacion->idCol = $request->colJub;
            $jubilacion->jub_fecha = $hoy->format('Y-m-d');;
            $jubilacion->jub_estado= 'activo';
            $jubilacion->save();

            $colaborador = Colaborador::findOrFail($request->colJub);
            $idpersona = $colaborador->idPersona;
            $persona = Persona::findOrFail($idpersona);
            $persona->per_estado='inactivo';
            $persona->save();
            
            return json_encode('success');
        } catch (\Throwable $th) {
            dd($th);
            return json_encode('error');
        }
        return redirect()->route('jubilacion.register');
    }

    public function actualizar(Request $request,$id)
    {
        try {
            $jubilacion = Jubilacion::findOrFail($id);

            $oldCol=$jubilacion->idCol;
            $colaborador = Colaborador::findOrFail($oldCol);
            $idpersona = $colaborador->idPersona;
            $persona = Persona::findOrFail($idpersona);
            $persona->per_estado='activo';
            $persona->save();

            $jubilacion->idCol = $request->colJub;
            $jubilacion->save();

            $colaborador = Colaborador::findOrFail($request->colJub);
            $idpersona = $colaborador->idPersona;
            $persona = Persona::findOrFail($idpersona);
            $persona->per_estado='inactivo';
            $persona->save();

            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $jubilacion = Jubilacion::findOrFail($id);
            if($jubilacion->jub_estado == 'activo'){

                $jubilacion->jub_estado='inactivo';
                
                $oldCol=$jubilacion->idCol;
                $colaborador = Colaborador::findOrFail($oldCol);
                $idpersona = $colaborador->idPersona;
                $persona = Persona::findOrFail($idpersona);
                $persona->per_estado='activo';
                $persona->save();

            }else{
                $jubilacion->jub_estado='activo';

                $oldCol=$jubilacion->idCol;
                $colaborador = Colaborador::findOrFail($oldCol);
                $idpersona = $colaborador->idPersona;
                $persona = Persona::findOrFail($idpersona);
                $persona->per_estado='inactivo';
                $persona->save();
            }
            $jubilacion->save();
            return json_encode($jubilacion->jub_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
