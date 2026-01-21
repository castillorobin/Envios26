<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ComercioController extends Controller
{
    public function index()
    {
        $comercios = Comercio::all();
        return view('comercio.index', compact('comercios'));
    }

 
    public function create()
    {
        dd('crear comercio');
        return view('comercio.crear');
    }

    public function guardar()
    {
       // dd('crear comerciooooo');
        return view('comercio.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validar los datos
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:comercios,email', // Cambia 'comercios' por tu tabla
        'password' => 'nullable',
        'status' => 'required|in:Alta,Baja',
    ]);

    // 2. Crear el registro
    Comercio::create([
        'nombre'      => $request->name,
        'direccion' => $request->direccion,
        'telefono'  => $request->telefono,
        'whatsapp'  => $request->whatsapp,
        'email'     => $request->email,
        'password'  => Hash::make($request->password), // ¡Importante encriptar!
        //'fecha'     => $request->fecha,
        'status'    => $request->status,
    ]);

    // 3. Redireccionar con mensaje de éxito
    return redirect()->route('comercios.inicio')
                     ->with('success', 'El comercio se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $comercio = Comercio::findOrFail($id);
        return view('comercio.show', compact('comercio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function edit(Comercio $comercio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comercio $comercio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comercio $comercio)
    {
        //
    }
}
