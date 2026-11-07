<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\OrdenServicio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrdenServicioController extends Controller
{
    
    public function index()
    {
        
        $ordenes = OrdenServicio::with(['cliente', 'usuario'])
            ->orderByDesc('created_at')
            ->get();

        return view('ordenes.index', compact('ordenes'));
    }

    
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $usuarios = Usuario::where('activo', 1)->orderBy('username')->get();

        return view('ordenes.create', [
            'clientes'     => $clientes,
            'usuarios'     => $usuarios,
            'tipos'        => OrdenServicio::TIPOS_SERVICIO,
            'prioridades'  => OrdenServicio::PRIORIDADES,
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'cliente_id'    => ['required', 'integer', 'exists:cliente,id_cliente'],
            'usuario_id'    => ['required', 'integer', 'exists:usuario,id_usuario'],
            'codigo_orden'  => ['required', 'string', 'max:50', 'unique:orden_de_servicio,codigo_orden'],
            'descripcion'   => ['required', 'string'],
            'tipo_servicio' => ['required', 'string', 'max:50', Rule::in(OrdenServicio::TIPOS_SERVICIO)],
            'prioridad'     => ['required', Rule::in(OrdenServicio::PRIORIDADES)],
        ], [], [
            'cliente_id'    => 'cliente',
            'usuario_id'    => 'usuario',
            'codigo_orden'  => 'código de la orden',
            'descripcion'   => 'descripción',
            'tipo_servicio' => 'tipo de servicio',
        ]);

        
        $datos['estado'] = 'Pendiente';

        OrdenServicio::create($datos);

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden de servicio creada correctamente.');
    }

    
    public function edit(OrdenServicio $orden)
    {
        $orden->load(['cliente', 'usuario']);

        return view('ordenes.edit', [
            'orden'        => $orden,
            'tipos'        => OrdenServicio::TIPOS_SERVICIO,
            'prioridades'  => OrdenServicio::PRIORIDADES,
            'estados'      => OrdenServicio::ESTADOS,
        ]);
    }

    public function update(Request $request, OrdenServicio $orden)
    {
        
        $datos = $request->validate([
            'tipo_servicio'         => ['required', 'string', 'max:50', Rule::in(OrdenServicio::TIPOS_SERVICIO)],
            'prioridad'             => ['required', Rule::in(OrdenServicio::PRIORIDADES)],
            'estado'                => ['required', Rule::in(OrdenServicio::ESTADOS)],
            'fecha_cierre_estimada' => ['nullable', 'date'],
        ], [], [
            'tipo_servicio'         => 'tipo de servicio',
            'fecha_cierre_estimada' => 'fecha de cierre estimada',
        ]);

        $orden->update($datos);

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden ' . $orden->codigo_orden . ' actualizada correctamente.');
    }
}
