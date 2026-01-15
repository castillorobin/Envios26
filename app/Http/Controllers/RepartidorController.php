<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repartidor;
use Illuminate\Support\Str;
use PDF;

class RepartidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repartidores = Repartidor::all();

        // return view('repartidor.index')->with('repartidores', $repartidores);
           return view('repartidor.index', compact('repartidores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repartidores = Repartidor::all();
        return view('repartidor.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $repartidores = new Repartidor();
        $repartidores->nombre        = $request->nombre;
        $repartidores->direccion     = $request->direccion;
        $repartidores->telefono      = $request->telefono;
        $repartidores->dui           = $request->dui;
        $repartidores->nit           = $request->nit;
        $repartidores->tipo_contrato = $request->tipo_contrato;
        $repartidores->agencia       = $request->agencia;
        $repartidores->num_seguro    = $request->num_seguro;
        $repartidores->num_afp       = $request->num_afp;
        $repartidores->cargo         = $request->cargo;
        $repartidores->fecha_de_alta = $request->fecha_de_alta;
        $repartidores->salario       = $request->salario;
        $repartidores->fecha_de_baja = $request->fecha_de_baja;
        $repartidores->nota          = $request->nota;
        $repartidores->tipo_vehiculo = $request->tipo_vehiculo;
        $repartidores->asigno_unidad = $request->asigno_unidad;
        $repartidores->num_placa     = $request->num_placa;
        $repartidores->num_tarjeta   = $request->num_tarjeta;
        $repartidores->num_licencia  = $request->num_licencia;
        $repartidores->correo  = $request->correo;
       /* 
        if ($request->hasFile('foto')) {
            $repartidores->foto = $request->file('foto')->store('uploads','public');
        }
        */
        if($request->hasFile('foto')){
            
            $imagen = $request->file("foto");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $repartidores->foto = $nombreimagen;
            $ruta = public_path("imgs/fotos/");
            $imagen->move($ruta,$nombreimagen);

        }

        $repartidores->save();

        return redirect('/repartidores');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repartidor = Repartidor::find($id);
        return view('repartidor.edit')->with(['repartidor'=>$repartidor]);
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
          
        $repartidor = Repartidor::find($id);
        $repartidor->nombre        = $request->nombre;
        $repartidor->direccion     = $request->dire;
        $repartidor->telefono      = $request->tele;
        $repartidor->dui           = $request->dui;
        $repartidor->correo        = $request->correo;
        $repartidor->nit           = $request->nit;
        $repartidor->tipo_contrato = $request->tipo_contrato;
        $repartidor->agencia       = $request->agencia;
        $repartidor->num_seguro    = $request->num_seguro;
        $repartidor->num_afp       = $request->num_afp;
        $repartidor->cargo         = $request->cargo;
        $repartidor->fecha_de_alta =  date('Y/m/d', strtotime($request->fecha_de_alta));
        $repartidor->salario       = $request->salario;
        $repartidor->fecha_de_baja =  date('Y/m/d', strtotime($request->fecha_de_baja));
        $repartidor->nota          = $request->nota;
        $repartidor->tipo_vehiculo = $request->tipo_vehiculo;
        $repartidor->asigno_unidad = $request->asigno_unidad;
        $repartidor->num_placa     = $request->num_placa;
        $repartidor->num_tarjeta   = $request->num_tarjeta;
        $repartidor->num_licencia  = $request->num_licencia;
        //$repartidor->foto          = $request->foto;
        if($request->hasFile('foto')){
            
            $imagen = $request->file("foto");
            $nombreimagen = Str::slug(time()).".".$imagen->guessExtension();
            $repartidor->foto = $nombreimagen;
            $ruta = public_path("imgs/fotos/");
            $imagen->move($ruta,$nombreimagen);

        }
        $repartidor->save();
        $repartidores = Repartidor::all();
        //return redirect('/repartidores');
        return view('repartidor.index')->with(['repartidores'=>$repartidores]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repartidor = Repartidor::destroy($id);

        return redirect('/repartidores');   
    }
}
