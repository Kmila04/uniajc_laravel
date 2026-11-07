@extends('layouts.adminlte')

@section('title', 'Editar orden de servicio')
@section('page_title', 'Editar orden ' . $orden->codigo_orden)

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">

        <div class="card shadow-sm">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>
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

                <form method="POST" action="{{ route('ordenes.update', $orden) }}">
                    @csrf
                    @method('PUT')

                    {{-- ============ CAMPOS SOLO LECTURA (no editables) ============ --}}
                    {{-- Van "disabled" y SIN name, así no se envían en el formulario --}}
                    <p class="text-muted small mb-2">
                        <i class="fas fa-lock me-1"></i> Estos datos no se pueden modificar
                    </p>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="text" class="form-control" id="cliente" disabled
                                       value="{{ $orden->cliente->id_cliente }} - {{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}">
                                <label for="cliente">Cliente</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="usuario" disabled
                                       value="{{ $orden->usuario->id_usuario }} - {{ $orden->usuario->username }}">
                                <label for="usuario">Usuario</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="codigo_orden" disabled
                               value="{{ $orden->codigo_orden }}">
                        <label for="codigo_orden">Código de la orden</label>
                    </div>

                    <div class="form-floating mb-4">
                        <textarea class="form-control" id="descripcion" disabled
                                  style="height: 100px">{{ $orden->descripcion }}</textarea>
                        <label for="descripcion">Descripción</label>
                    </div>

                    <hr>

                    {{-- ============ CAMPOS EDITABLES ============ --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <select class="form-select @error('tipo_servicio') is-invalid @enderror"
                                        id="tipo_servicio" name="tipo_servicio" required>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo }}"
                                            {{ old('tipo_servicio', $orden->tipo_servicio) == $tipo ? 'selected' : '' }}>
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
                                            {{ old('prioridad', $orden->prioridad) == $prioridad ? 'selected' : '' }}>
                                            {{ $prioridad }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="prioridad">Prioridad</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <select class="form-select @error('estado') is-invalid @enderror"
                                        id="estado" name="estado" required>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado }}"
                                            {{ old('estado', $orden->estado) == $estado ? 'selected' : '' }}>
                                            {{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="estado">Estado</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date"
                                       class="form-control @error('fecha_cierre_estimada') is-invalid @enderror"
                                       id="fecha_cierre_estimada" name="fecha_cierre_estimada"
                                       value="{{ old('fecha_cierre_estimada', $orden->fecha_cierre_estimada?->format('Y-m-d')) }}">
                                <label for="fecha_cierre_estimada">Fecha de cierre estimada</label>
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
                            Actualizar orden
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
