@extends('layouts.adminlte')

@section('title', 'Crear cliente')
@section('page_title', 'Registro de nuevo cliente')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">

        <div class="card shadow-sm">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    Datos del cliente
                </h3>
            </div>

            <div class="card-body">

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('clientes.store') }}">

                    @csrf

                    {{-- Nombre y apellido --}}
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input
                                    type="text"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre"
                                    name="nombre"
                                    placeholder="Nombre"
                                    value="{{ old('nombre') }}"
                                    required
                                >
                                <label for="nombre">Nombre</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('apellido') is-invalid @enderror"
                                    id="apellido"
                                    name="apellido"
                                    placeholder="Apellido"
                                    value="{{ old('apellido') }}"
                                    required
                                >
                                <label for="apellido">Apellido</label>
                            </div>
                        </div>

                    </div>

                    {{-- Documento y fecha de nacimiento --}}
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input
                                    type="text"
                                    class="form-control @error('documento') is-invalid @enderror"
                                    id="documento"
                                    name="documento"
                                    placeholder="Documento"
                                    value="{{ old('documento') }}"
                                    required
                                >
                                <label for="documento">Documento</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input
                                    type="date"
                                    class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                    id="fecha_nacimiento"
                                    name="fecha_nacimiento"
                                    value="{{ old('fecha_nacimiento') }}"
                                >
                                <label for="fecha_nacimiento">
                                    Fecha de nacimiento
                                </label>
                            </div>
                        </div>

                    </div>

                    {{-- Correo electrónico --}}
                    <div class="form-floating mb-3">
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            placeholder="nombre@ejemplo.com"
                            value="{{ old('email') }}"
                            required
                        >
                        <label for="email">Correo electrónico</label>
                    </div>

                    {{-- Dirección y ciudad --}}
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input
                                    type="text"
                                    class="form-control @error('direccion') is-invalid @enderror"
                                    id="direccion"
                                    name="direccion"
                                    placeholder="Dirección"
                                    value="{{ old('direccion') }}"
                                >
                                <label for="direccion">Dirección</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control @error('ciudad') is-invalid @enderror"
                                    id="ciudad"
                                    name="ciudad"
                                    placeholder="Ciudad"
                                    value="{{ old('ciudad') }}"
                                >
                                <label for="ciudad">Ciudad</label>
                            </div>
                        </div>

                    </div>

                    {{-- Teléfono y empresa --}}
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input
                                    type="text"
                                    class="form-control @error('telefono') is-invalid @enderror"
                                    id="telefono"
                                    name="telefono"
                                    placeholder="Teléfono"
                                    value="{{ old('telefono') }}"
                                >
                                <label for="telefono">Teléfono</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select
                                    class="form-select @error('id_empresa') is-invalid @enderror"
                                    id="id_empresa"
                                    name="id_empresa"
                                    required
                                >
                                    <option value="">
                                        Seleccione una empresa
                                    </option>

                                    @foreach ($empresas as $empresa)
                                        <option
                                            value="{{ $empresa->id_empresa }}"
                                            {{ old('id_empresa') == $empresa->id_empresa ? 'selected' : '' }}
                                        >
                                            {{ $empresa->nombre }}
                                        </option>
                                    @endforeach

                                </select>

                                <label for="id_empresa">Empresa</label>
                            </div>
                        </div>

                    </div>

                    {{-- Botones --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a href="{{ route('clientes.index') }}"
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Guardar cliente
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection