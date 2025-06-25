<div class="col-lg-12">
    <div class="purchase-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    @php
                        $iconClass = 'fa-question-circle';
                        if ($reserva->reservable_type === 'App\\Models\\Hospedaje') $iconClass = 'fa-bed';
                        if ($reserva->reservable_type === 'App\\Models\\Viaje') $iconClass = 'fa-plane';
                        if ($reserva->reservable_type === 'App\\Models\\Vehiculo') $iconClass = 'fa-car';
                        if ($reserva->tipo_reserva === 'paquete' || $reserva->paquete_id) $iconClass = 'fa-box';
                    @endphp
                    <i class="fas {{ $iconClass }} fa-3x purchase-icon"></i>
                </div>
                <div class="col-md-7">
                    <h5 class="card-title mb-1">
                        @if($reserva->paquete)
                            {{ $reserva->paquete->nombre }}
                        @else
                            {{ $reserva->reservable->nombre ?? 'Reserva ' . $reserva->codigo_reserva }}
                        @endif
                    </h5>
                    <p class="card-text text-muted mb-2">
                        Código de reserva: <strong>{{ $reserva->codigo_reserva }}</strong>
                    </p>
                    <p class="card-text text-muted">
                        Fecha de compra: {{ $reserva->created_at->format('d/m/Y') }}
                    </p>
                </div>
                <div class="col-md-3 text-md-end">
                    <p class="price-highlight mb-2">
                        ARS {{ number_format($reserva->total_pagar, 2, ',', '.') }}
                    </p>
                    <div>
                        @php
                            $estado = $reserva->estado;
                            $badgeClass = '';
                            if ($estado === 'pendiente') $badgeClass = 'bg-warning text-dark';
                            if ($estado === 'aceptada') $badgeClass = 'bg-success';
                            if ($estado === 'cancelada') $badgeClass = 'bg-danger';
                        @endphp
                        <span class="badge status-badge {{ $badgeClass }}">{{ ucfirst($estado) }}</span>
                        </div>
                    {{-- Acciones para reservas pendientes --}}
                    @if(strtolower(trim($reserva->estado)) == 'pendiente')
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <form action="{{ route('mis-compras.edit', $reserva) }}" method="GET" class="mb-0">
                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </button>
                            </form>
                            <form action="{{ route('mis-compras.cancelar', $reserva) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta reserva?');" class="mb-0">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-times me-1"></i>Cancelar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
