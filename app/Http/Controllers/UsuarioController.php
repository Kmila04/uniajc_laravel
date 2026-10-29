<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas = Empresa::all(['id_empresa', 'nombre']);
        return view('usuarios.create', compact('empresas'));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:50|unique:usuario',
            'password' => 'required|max:255',
            'rol' => 'required|in:admin,vendedor,supervisor',
            'activo' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'id_empresa' => 'required|exists:empresa,id_empresa',
        ]);

        // Crea el usuario en la base de datos
        Usuario::create($request->all());

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        $empresas = Empresa::all(['id_empresa', 'nombre']);
        return view('usuarios.edit', compact('usuario', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'username' => 'required|max:50|unique:usuario,username,' . $usuario->id_usuario . ',id_usuario',
            'password' => 'required|max:255',
            'rol' => 'required|in:admin,vendedor,supervisor',
            'activo' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'id_empresa' => 'required|exists:empresa,id_empresa',
        ]);

        // Actualiza el usuario en la base de datos
        $usuario->update($request->all());

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}