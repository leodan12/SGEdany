<?php

namespace App\Http\Controllers;
use View;


use Illuminate\Http\Request;
use App\Model\Turno;

class TurnoController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function registro()
    {
        $turnos = Turno::where('tur_estado',1)->get();
        return View::make('turno.registro')->with(['turnos'=>$turnos]);
        
    }

    public function guardar(Request $request)
    {
        $turno = new Turno;
        $turno->tur_descripcion = $request->nameT;
        $turno->save();
        return redirect()->route('turno.register');
    }

    public function actualizar(Request $request,$id)
    {
        $turno = Turno::findOrFail($id);
        $turno->tur_descripcion = $request->nameT;
        $turno->save();
        return redirect()->route('turno.register');
    }


}
