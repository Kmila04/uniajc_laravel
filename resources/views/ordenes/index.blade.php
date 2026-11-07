@extends('layouts.adminlte')

@section('title', 'Órdenes de servicio')
@section('page_title', 'Listado de órdenes de servicio')

@section('content')

<a href="{{ route('ordenes.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus me-1"></i>
    Crear nueva orden
</a>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

@php
    $colorPrioridad = ['Baja' => 'secondary', 'Media' => 'info', 'Alta' => 'warning', 'Urgente' => 'danger'];
    $colorEstado = ['Pendiente' => 'warning', 'En Proceso' => 'primary', 'Cerrada' => 'success', 'Cancelada' => 'danger'];
@endphp

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Usuario</th>
                        <th>Código orden</th>
                        <th>Descripción</th>
                        <th>Tipo servicio</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Cierre estimado</th>
                        <th>Fecha creación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ordenes as $orden)
                        <tr>
                            {{-- código - nombre y apellido del cliente --}}
                            <td>
                                {{ $orden->cliente->id_cliente }} -
                                {{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}
                            </td>
                            {{-- código - username del usuario --}}
                            <td>{{ $orden->usuario->id_usuario }} - {{ $orden->usuario->username }}</td>
                            <td><strong>{{ $orden->codigo_orden }}</strong></td>
                            <td>{{ \Illuminate\Support\Str::limit($orden->descripcion, 50) }}</td>
                            <td>{{ $orden->tipo_servicio }}</td>
                            <td>
                                <span class="badge text-bg-{{ $colorPrioridad[$orden->prioridad] ?? 'secondary' }}">
                                    {{ $orden->prioridad }}
                                </span>
                            </td>
                            <td>
                                <span class="badge text-bg-{{ $colorEstado[$orden->estado] ?? 'secondary' }}">
                                    {{ $orden->estado }}
                                </span>
                            </td>
                            <td>{{ $orden->fecha_cierre_estimada?->format('d/m/Y') ?? '—' }}</td>
                            <td>{{ $orden->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('ordenes.edit', $orden) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit me-1"></i>
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                No hay órdenes de servicio registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection