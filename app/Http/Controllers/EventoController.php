<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\EventosLocalidades;
use App\Localidad;
use App\Lugar;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventos = Evento::all();
        return $eventos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $evento = new Evento();
        $evento->id_lugar = $request->id_lugar;
        $evento->nombre = $request->nombre;
        $evento->save();
        for($i=0; $i<count($request->localidades); $i++){
            $eventoslocalidades = new EventosLocalidades();
            $eventoslocalidades->id_evento = $evento->id;
            $eventoslocalidades->id_localidad = $request->localidades[$i];
            $eventoslocalidades->save();
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $evento = Evento::where('id', $id)->first();
        $eventoslocalidades = EventosLocalidades::where('id_evento', $id)->get();
        $localidades = array();
        $lugar = Lugar::where('id', $evento->id_lugar)->first();
        for($i=0; $i<count($eventoslocalidades); $i++){
            $localidad = Localidad::where('id', $eventoslocalidades[$i]->id_localidad)->first();
            $localidades[$i] = $localidad;
        }
        return [$evento, $localidades, $lugar];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
