@extends('layouts.adminlte')

@section('title', 'Clientes')
@section('page_title', 'Clientes registrados')

@section('content')

<div class="card">

    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title mb-0">Listado de clientes</h3>
    </div>

    <div class="card-body">

        {{-- Botón crear cliente --}}
        <a href="{{ route('clientes.create') }}"
           class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i>
            Crear nuevo cliente
        </a>

        {{-- Mensaje de confirmación --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Cerrar">
                </button>
            </div>
        @endif

        {{-- Tabla de clientes --}}
        <div class="table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Ciudad</th>
                        <th>Email</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($clientes as $cliente)

                        <tr>
                            <td>{{ $cliente->id_cliente }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->ciudad }}</td>
                            <td>{{ $cliente->email }}</td>

                            <td class="text-center">

                                {{-- Editar --}}
                                <a href="{{ route('clientes.edit', $cliente->id_cliente) }}"
                                   class="btn btn-sm btn-warning me-2">

                                    <i class="fas fa-edit"></i>
                                    Editar

                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Está seguro de que desea eliminar al cliente {{ $cliente->nombre }} {{ $cliente->apellido }}?')">

                                        <i class="fas fa-trash"></i>
                                        Eliminar

                                    </button>

                                </form>

                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No hay clientes registrados.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection