@extends('administracion.partials.layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Detalle del Viaje</h3>
        </div>
        <div class="card-body">
            <h4>{{ $viaje->nombre }}</h4>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Tipo:</strong> {{ $viaje->tipo }}</li>
                <li class="list-group-item"><strong>Origen:</strong> {{ $viaje->origen }}</li>
                <li class="list-group-item"><strong>Destino:</strong> {{ $viaje->destino }}</li>
                <li class="list-group-item"><strong>Salida:</strong> {{ $viaje->fecha_salida ? $viaje->fecha_salida->format('d/m/Y H:i') : '-' }}</li>
                <li class="list-group-item"><strong>Llegada:</strong> {{ $viaje->fecha_llegada ? $viaje->fecha_llegada->format('d/m/Y H:i') : '-' }}</li>
                <li class="list-group-item"><strong>Empresa:</strong> {{ $viaje->empresa }}</li>
                <li class="list-group-item"><strong>Número de viaje:</strong> {{ $viaje->numero_viaje }}</li>
                <li class="list-group-item"><strong>Capacidad total:</strong> {{ $viaje->capacidad_total }}</li>
                <li class="list-group-item"><strong>Asientos disponibles:</strong> {{ $viaje->asientos_disponibles }}</li>
                <li class="list-group-item"><strong>Precio base:</strong> ${{ number_format($viaje->precio_base, 2, ',', '.') }}</li>
                <li class="list-group-item"><strong>Clases:</strong> {{ is_array($viaje->clases) ? implode(', ', $viaje->clases) : $viaje->clases }}</li>
                <li class="list-group-item"><strong>Descripción:</strong> {{ $viaje->descripcion }}</li>
                <li class="list-group-item"><strong>Activo:</strong> {!! $viaje->activo ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-danger">No</span>' !!}</li>
            </ul>
            <a href="{{ route('viajes.show', ['viaje' => $viaje->id]) }}" class="btn btn-secondary">Volver al detalle del viaje</a>
        </div>
    </div>
</div>
@endsection
