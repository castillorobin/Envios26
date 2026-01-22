<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;


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
        
        'status' => 'required|in:Alta,Baja',
    ]);

    // 2. Crear el registro
    Comercio::create([
        'nombre'      => $request->name,
        'direccion' => $request->direccion,
        'telefono'  => $request->telefono,
        'whatsapp'  => $request->whatsapp,
        'email'     => $request->email,
        //'password'  => Hash::make($request->password), // ¡Importante encriptar!
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
    public function edit($id)
    {
        $comercio = Comercio::findOrFail($id);
        return view('comercio.edit', compact('comercio'));
    }

    public function editaruser($id)
    {
        $usuario = User::findOrFail($id);
        return view('comercio.edituser', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comercio = Comercio::findOrFail($id);

    // 1. Validar datos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'nullable|email|unique:comercios,email,' . $id,
        'password' => 'nullable|confirmed', // nullable permite que vaya vacío
        'status' => 'nullable|in:Alta,Baja',
    ]);

    // 2. Obtener todos los datos del formulario
    $data = $request->all();

    // 3. Lógica de la contraseña
    if ($request->filled('password')) {
        // Si el campo password tiene contenido, lo encriptamos
        $data['password'] = Hash::make($request->password);
    } else {
        // Si está vacío, quitamos el campo del arreglo para no afectar la DB
        unset($data['password']);
    }

    // 4. Actualizar el registro
    $comercio->update($data);

    // 5. Sincronizar roles (Spatie)
   

    return redirect()->route('comercios.show', $id)
                     ->with('success', 'Comercio actualizado correctamente.');
    }

     public function updateuser(Request $request, $id)
    {
         $usuario = User::findOrFail($id);

    // 1. Validar datos
    $request->validate([
        //'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|confirmed', // nullable permite que vaya vacío
        //'status' => 'required|in:Alta,Baja',
    ]);

    // 2. Obtener todos los datos del formulario
    $data = $request->all();

    // 3. Lógica de la contraseña
    if ($request->filled('password')) {
        // Si el campo password tiene contenido, lo encriptamos
        $data['password'] = Hash::make($request->password);
    } else {
        // Si está vacío, quitamos el campo del arreglo para no afectar la DB
        unset($data['password']);
    }

    // 4. Actualizar el registro
    $usuario->update($data);

    // 5. Sincronizar roles (Spatie)
    //$usuario->syncRoles($request->rol);
   

    return redirect()->route('comercios.show', $id)
                     ->with('success', 'Comercio actualizado correctamente.');
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

    public function storeusuario(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'status' => 'Alta',
    ]);

    $user->assignRole('Comercio'); // Rol por defecto

    return redirect()->back()->with('success', '¡Usuario de comercio creado con éxito!');
}
}
