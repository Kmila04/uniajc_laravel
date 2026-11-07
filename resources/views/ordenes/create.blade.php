@extends('layouts.adminlte')

@section('title', 'Crear orden de servicio')
@section('page_title', 'Crear orden de servicio')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">

        <div class="card shadow-sm">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Datos de la orden
                </h3>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('ordenes.store') }}">
                    @csrf

                    {{-- Cliente y usuario --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <select class="form-select @error('cliente_id') is-invalid @enderror"
                                        id="cliente_id" name="cliente_id" required>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id_cliente }}"
                                            {{ old('cliente_id') == $cliente->id_cliente ? 'selected' : '' }}>
                                            {{ $cliente->id_cliente }} - {{ $cliente->nombre }} {{ $cliente->apellido }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="cliente_id">Cliente</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('usuario_id') is-invalid @enderror"
                                        id="usuario_id" name="usuario_id" required>
                                    <option value="">Seleccione un usuario</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id_usuario }}"
                                            {{ old('usuario_id') == $usuario->id_usuario ? 'selected' : '' }}>
                                            {{ $usuario->id_usuario }} - {{ $usuario->username }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="usuario_id">Usuario</label>
                            </div>
                        </div>
                    </div>

                    {{-- Código de la orden --}}
                    <div class="form-floating mb-3">
                        <input type="text"
                               class="form-control @error('codigo_orden') is-invalid @enderror"
                               id="codigo_orden" name="codigo_orden" maxlength="50"
                               placeholder="OS-0001"
                               value="{{ old('codigo_orden') }}" required>
                        <label for="codigo_orden">Código de la orden (ej: OS-0001)</label>
                    </div>

                    {{-- Descripción --}}
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('descripcion') is-invalid @enderror"
                                  id="descripcion" name="descripcion"
                                  placeholder="Descripción" style="height: 120px"
                                  required>{{ old('descripcion') }}</textarea>
                        <label for="descripcion">Descripción</label>
                    </div>

                    {{-- Tipo de servicio y prioridad --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <select class="form-select @error('tipo_servicio') is-invalid @enderror"
                                        id="tipo_servicio" name="tipo_servicio" required>
                                    <option value="">Seleccione el tipo</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo }}" {{ old('tipo_servicio') == $tipo ? 'selected' : '' }}>
                                            {{ $tipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="tipo_servicio">Tipo de servicio</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('prioridad') is-invalid @enderror"
                                        id="prioridad" name="prioridad" required>
                                    @foreach ($prioridades as $prioridad)
                                        <option value="{{ $prioridad }}"
                                            {{ old('prioridad', 'Media') == $prioridad ? 'selected' : '' }}>
                                            {{ $prioridad }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="prioridad">Prioridad</label>
                            </div>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Guardar orden
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection