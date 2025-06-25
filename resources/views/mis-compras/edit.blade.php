@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Editar Reserva: {{ $reserva->codigo_reserva }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('mis-compras.update', $reserva) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <h4>{{ $reservable->nombre }}</h4>
                            <p class="text-muted">Modifica los detalles de tu reserva a continuación.</p>
                        </div>

                        <!-- Campos del formulario -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $reserva->fecha_inicio->format('Y-m-d')) }}" required>
                            </div>
                            @if(in_array($reserva->reservable_type, ['App\\Models\\Viaje', 'App\\Models\\Hospedaje']))
                            <div class="col-md-6 mb-3">
                                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $reserva->fecha_fin ? $reserva->fecha_fin->format('Y-m-d') : '') }}" required>
                            </div>
                            @endif
                            <div class="col-md-6 mb-3">
                                <label for="cantidad_personas" class="form-label">Cantidad de Personas</label>
                                <input type="number" class="form-control" id="cantidad_personas" name="cantidad_personas" value="{{ old('cantidad_personas', $reserva->cantidad_personas) }}" min="1" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('mis-compras') }}" class="btn btn-secondary me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar Reserva</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
