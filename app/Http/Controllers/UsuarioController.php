<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use App\Models\Repartidor;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Cargamos los roles de antemano para que la consulta sea rápida
    $usuarios = User::with('roles')->get(); 
    $repartidores = Repartidor::all();
    
    return view('usuarios.index', compact('usuarios', 'repartidores'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $repartidores = Repartidor::all();
        return view('usuarios.crear')->with(['roles'=>$roles, 'repartidores'=>$repartidores]);;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'rol'      => 'required'
    ]);

    // 1. Crear el usuario
    $user = User::create([
        'name'      => $request->name,
        'last_name' => $request->last_name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password),
        'dui'       => $request->dui,
        'phone'     => $request->phone,
        'whatsapp'  => $request->whatsapp,
        'address'   => $request->address,
        'joined_at' => $request->joined_at,
        'nombre' => $request->nombre,
    ]);

    // 2. Asignar Rol de Spatie
    $user->assignRole($request->rol);

    return redirect()->route('usuarios.inicio')->with('success', 'Usuario creado correctamente.');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    // Buscamos al usuario por ID cargando sus roles (Spatie)
    // findOrFail lanzará un error 404 si el usuario no existe
    $usuario = User::with('roles')->findOrFail($id);

    // Retornamos la vista (que crearemos en el siguiente paso)
    return view('usuarios.show', compact('usuario'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id) {
    $usuario = User::findOrFail($id);
    $roles = \Spatie\Permission\Models\Role::pluck('name', 'name'); // Si usas Spatie
    return view('usuarios.edit', compact('usuario', 'roles'));
}

public function update(Request $request, $id) {
    $usuario = User::findOrFail($id);
    
    // Validar y actualizar
    $usuario->update($request->all());
    
    // Actualizar Rol (Spatie)
    $usuario->syncRoles($request->rol);

    return redirect()->route('usuarios.show', $id)->with('success', 'Usuario actualizado');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }
}
