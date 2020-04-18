<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden;
use App\OrdenesLocalidades;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ordenes = Orden::all();
        return $ordenes;
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
        $orden = new Orden();
        $orden->id_cliente = $request->id_cliente;
        $orden->total = $request->total;
        $orden->id_evento = $request->id_evento;
        $orden->asientos = $request->asientos;
        $orden->save();
        for($i=0; $i<count($request->localidades); $i++){
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($request->localidades[$i]['id']);
            $ordeneslocalidades = new OrdenesLocalidades();
            $ordeneslocalidades->id_orden = $orden->id;
            $ordeneslocalidades->id_localidad = $request->localidades[$i]['id'];
            $ordeneslocalidades->cantidad = $request->localidades[$i]['cupos'];
            $ordeneslocalidades->precio = $request->localidades[$i]['precio'];
            $ordeneslocalidades->save();
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
        $orden = Orden::where('id', $id)->first();
        return $orden;
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
