<?php

namespace App\Http\Controllers;

use App\Models\Cajon;
use Illuminate\Http\Request;

class CajonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cajones = Cajon::all();
        return view('cajon.index', compact('cajones'));
    }

    public function buscarCajaAjax(Request $request)
{
    $caja = Cajon::where('numero', $request->numero)->first();

    if (!$caja) {
        return response()->json(['success' => false, 'message' => 'La caja no existe.']);
    }

    return response()->json([
        'success' => true,
        'data' => [
            'numero' => $caja->numero,
            'fecha'  => $caja->created_at->format('d/m/Y H:i'),
            'usuario' => $caja->usuario // Asumiendo que guardas el nombre del usuario
        ]
    ]);
}

// 2. Para el guardado masivo (Actualizar Rack, Nivel, Góndola)

public function confirmarUbicacionCajas(Request $request)
{
    // Validamos que lleguen los datos necesarios
    $request->validate([
        'cajas' => 'required|array',
        'rack' => 'required|string',
        'nivel' => 'required|string',
        'gondola' => 'required|string',
    ]);

    $numerosCajas = $request->input('cajas');

    try {
        // Actualizamos masivamente el modelo Cajon
        // Esto buscará todas las cajas cuyos números estén en la lista
        \App\Models\Cajon::whereIn('numero', $numerosCajas)->update([
            'rack'    => $request->rack,
            'nivel'   => $request->nivel,
            'ubicacion' => $request->gondola,
            // Opcional: puedes cambiar un estado si tienes esa columna
            // 'status' => 'Ubicado' 
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Ubicación asignada correctamente a ' . count($numerosCajas) . ' cajas.'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false, 
            'message' => 'Error al actualizar las cajas: ' . $e->getMessage()
        ], 500);
    }
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
        $request->validate([
            'numero' => 'required|integer',
        ]);

        Cajon::create([
            'numero' => $request->numero,
        ]);

        return redirect()->route('cajones.inicio')->with('success', 'Caja creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cajon  $cajon
     * @return \Illuminate\Http\Response
     */
    public function show(Cajon $cajon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cajon  $cajon
     * @return \Illuminate\Http\Response
     */
    public function edit(Cajon $cajon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cajon  $cajon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cajon $cajon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cajon  $cajon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cajon $cajon)
    {
        //
    }
}
