<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Reservas - Frategar Admin</title>
    <style>
        .page-header {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .page-title {
            color: var(--despegar-blue);
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }

        .page-subtitle {
            color: #6c757d;
            margin: 5px 0 0 0;
        }

        .btn-admin {
            background-color: var(--despegar-blue);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-admin.orange {
            background-color: var(--despegar-orange);
        }

        .btn-admin.orange:hover {
            background-color: #e55a00;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-layouts.administracion.sidebar reservas="active" />

    <!-- Header -->
    <x-layouts.administracion.main nameHeader="Gestión de Reservas">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestión de Reservas</h1>
                    <p class="page-subtitle">Administra todas las reservas del sistema</p>
                </div>

            </div>
        </div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs mb-4" id="reservasTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="viajes-tab" data-bs-toggle="tab" data-bs-target="#viajes" type="button" role="tab" aria-controls="viajes" aria-selected="true">Viajes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="vehiculos-tab" data-bs-toggle="tab" data-bs-target="#vehiculos" type="button" role="tab" aria-controls="vehiculos" aria-selected="false">Vehículos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="hospedaje-tab" data-bs-toggle="tab" data-bs-target="#hospedaje" type="button" role="tab" aria-controls="hospedaje" aria-selected="false">Hospedaje</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="paquetes-tab" data-bs-toggle="tab" data-bs-target="#paquetes" type="button" role="tab" aria-controls="paquetes" aria-selected="false">Paquetes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="historica-tab" data-bs-toggle="tab" data-bs-target="#historica" type="button" role="tab" aria-controls="historica" aria-selected="false">Histórica</button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" id="reservasTabsContent">
            <div class="tab-pane fade show active" id="viajes" role="tabpanel" aria-labelledby="viajes-tab">
                <div class="alert alert-info mt-3">Aquí irán las reservas de <strong>Viajes</strong>.</div>
            </div>
            <div class="tab-pane fade" id="vehiculos" role="tabpanel" aria-labelledby="vehiculos-tab">
                @if($reservasVehiculosPendientes->isEmpty())
                    <div class="alert alert-warning mt-3">No hay reservas de vehículos pendientes.</div>
                @else
                <div class="row justify-content-center g-4 mt-3">
                    @foreach($reservasVehiculosPendientes as $reserva)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm border-0 h-100 text-center p-3" style="border-radius: 18px;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
    <div class="mb-2">
        <span class="badge bg-warning text-dark px-3 py-2 mb-2" style="font-size: 1rem;">Pendiente</span>
    </div>
    <h5 class="card-title mb-1">Reserva #{{ $reserva->id }}</h5>
    <p class="mb-2 text-secondary">Cliente</p>
    <div class="fw-bold mb-1">{{ $reserva->usuario ? $reserva->usuario->name : '-' }}</div>
    <div class="mb-2 text-muted">{{ $reserva->usuario ? $reserva->usuario->email : '-' }}</div>
    <hr class="my-2 w-50 mx-auto">
    <div class="mb-1"><i class="fas fa-calendar-alt me-1"></i> <strong>Desde:</strong> {{ $reserva->fecha_inicio ? $reserva->fecha_inicio->format('d/m/Y') : '-' }}</div>
    <div class="mb-3"><i class="fas fa-calendar-check me-1"></i> <strong>Hasta:</strong> {{ $reserva->fecha_fin ? $reserva->fecha_fin->format('d/m/Y') : '-' }}</div>
    <div class="mb-2">
        <span class="fs-5 fw-bold text-success">${{ number_format($reserva->precio_total, 2, ',', '.') }}</span>
    </div>
    <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalReservaVehiculo{{ $reserva->id }}">
        <i class="fas fa-eye me-1"></i> Ver detalles
    </button>
</div>

<!-- Modal Detalles Reserva Vehículo -->
<div class="modal fade" id="modalReservaVehiculo{{ $reserva->id }}" tabindex="-1" aria-labelledby="modalReservaVehiculoLabel{{ $reserva->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalReservaVehiculoLabel{{ $reserva->id }}">Detalles de la Reserva #{{ $reserva->id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <h6 class="fw-bold mb-2">Datos de la reserva</h6>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Cliente:</strong> {{ $reserva->usuario ? $reserva->usuario->name : '-' }}</li>
              <li class="list-group-item"><strong>Email:</strong> {{ $reserva->usuario ? $reserva->usuario->email : '-' }}</li>
              <li class="list-group-item"><strong>Fecha inicio:</strong> {{ $reserva->fecha_inicio ? $reserva->fecha_inicio->format('d/m/Y') : '-' }}</li>
              <li class="list-group-item"><strong>Fecha fin:</strong> {{ $reserva->fecha_fin ? $reserva->fecha_fin->format('d/m/Y') : '-' }}</li>
              <li class="list-group-item"><strong>Ubicación:</strong> {{ $reserva->ubicacion }}</li>
              <li class="list-group-item"><strong>Monto:</strong> ${{ number_format($reserva->precio_total, 2, ',', '.') }}</li>
              <li class="list-group-item"><strong>Estado:</strong> <span class="badge bg-warning text-dark">Pendiente</span></li>
              <li class="list-group-item"><strong>Método de pago:</strong> {{ ucfirst($reserva->metodo_pago) }}</li>
              <li class="list-group-item"><strong>Código reserva:</strong> {{ $reserva->codigo_reserva }}</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h6 class="fw-bold mb-2">Datos de pago</h6>
            @php $pago = $pagosVehiculos[$reserva->id] ?? null; @endphp
            @if($pago)
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Nombre en tarjeta:</strong> {{ $pago->cardholder_name }}</li>
              <li class="list-group-item"><strong>Número de tarjeta:</strong> **** **** **** {{ substr($pago->card_number, -4) }}</li>
              <li class="list-group-item"><strong>Expiración:</strong> {{ $pago->expiration_month }}/{{ $pago->expiration_year }}</li>
              <li class="list-group-item"><strong>CVV:</strong> ***</li>
              <li class="list-group-item"><strong>Monto:</strong> ${{ number_format($pago->amount, 2, ',', '.') }}</li>
              <li class="list-group-item"><strong>Estado pago:</strong> <span class="badge bg-warning text-dark">Pendiente</span></li>
            </ul>
            @else
            <div class="alert alert-danger">No se encontraron datos de pago asociados.</div>
            @endif
          </div>
        </div>
      </div>
      <div class="modal-footer flex-column flex-md-row justify-content-between">
        <div class="w-100 mb-2 mb-md-0">
          <!-- Campo motivo (solo visible si se va a rechazar, mostrar con JS) -->
          <div class="d-none" id="motivoRechazoContainer{{ $reserva->id }}">
            <label for="motivoRechazo{{ $reserva->id }}" class="form-label">Motivo de rechazo</label>
            <textarea class="form-control" id="motivoRechazo{{ $reserva->id }}" rows="2" placeholder="Escribe el motivo del rechazo..."></textarea>
          </div>
        </div>
        <div class="d-flex gap-2 w-100 justify-content-end">
          <!-- Botón Rechazar -->
          <button type="button" class="btn btn-danger" onclick="mostrarMotivoRechazo({{ $reserva->id }})">Rechazar</button>
          <!-- Botón Confirmar Rechazo (solo visible si se muestra el textarea) -->
          <form method="POST" action="{{ route('administracion.reservas.vehiculos.rechazar', $reserva->id) }}" class="d-inline-block" id="formRechazo{{ $reserva->id }}" style="display:none;">
            @csrf
            <input type="hidden" name="motivo" id="inputMotivoRechazo{{ $reserva->id }}">
            <button type="submit" class="btn btn-outline-danger ms-2">Confirmar rechazo</button>
          </form>
          <!-- Botón Aceptar -->
          <button type="button" class="btn btn-success" onclick="mostrarConfirmacionAceptar({{ $reserva->id }})">Aceptar</button>
          <!-- Modal confirmación aceptar -->
          <div class="modal fade" id="modalConfirmarAceptar{{ $reserva->id }}" tabindex="-1" aria-labelledby="modalConfirmarAceptarLabel{{ $reserva->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalConfirmarAceptarLabel{{ $reserva->id }}">Confirmar aceptación</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                  ¿Está seguro que desea aceptar esta reserva? Se notificará al cliente y se actualizará el estado.
                </div>
                <div class="modal-footer">
                  <form method="POST" action="{{ route('administracion.reservas.vehiculos.aceptar', $reserva->id) }}" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirmar aceptación</button>
                  </form>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="tab-pane fade" id="hospedaje" role="tabpanel" aria-labelledby="hospedaje-tab">
                @if($reservasHospedajePendientes->isEmpty())
                    <div class="alert alert-warning mt-3">No hay reservas de hospedaje pendientes.</div>
                @else
                <div class="row justify-content-center g-4 mt-3">
                    @foreach($reservasHospedajePendientes as $reserva)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm border-0 h-100 text-center p-3" style="border-radius: 18px;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="mb-2">
                                        <span class="badge bg-warning text-dark px-3 py-2 mb-2" style="font-size: 1rem;">Pendiente</span>
                                    </div>
                                    <h5 class="card-title mb-1">Reserva #{{ $reserva->id }}</h5>
                                    <p class="mb-2 text-secondary">Cliente</p>
                                    <div class="fw-bold mb-1">{{ $reserva->usuario ? $reserva->usuario->name : '-' }}</div>
                                    <div class="mb-2 text-muted">{{ $reserva->usuario ? $reserva->usuario->email : '-' }}</div>
                                    <div class="mb-2">
                                        <span class="fs-6">Habitaciones: 
                                            @foreach($reserva->habitaciones as $hab)
                                                <span class="badge bg-info text-dark">{{ $hab->numero ?? $hab->id }}</span>
                                            @endforeach
                                        </span>
                                    </div>
                                    <hr class="my-2 w-50 mx-auto">
                                    <div class="mb-1"><i class="fas fa-calendar-alt me-1"></i> <strong>Desde:</strong> {{ $reserva->fecha_inicio ? $reserva->fecha_inicio->format('d/m/Y') : '-' }}</div>
                                    <div class="mb-3"><i class="fas fa-calendar-check me-1"></i> <strong>Hasta:</strong> {{ $reserva->fecha_fin ? $reserva->fecha_fin->format('d/m/Y') : '-' }}</div>
                                    <div class="mb-2">
                                        <span class="fs-5 fw-bold text-success">${{ number_format($reserva->precio_total, 2, ',', '.') }}</span>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalReservaHospedaje{{ $reserva->id }}">
                                        <i class="fas fa-eye me-1"></i> Ver detalles
                                    </button>
                                </div>
                                <!-- Modal Detalles Reserva Hospedaje -->
                                <div class="modal fade" id="modalReservaHospedaje{{ $reserva->id }}" tabindex="-1" aria-labelledby="modalReservaHospedajeLabel{{ $reserva->id }}" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="modalReservaHospedajeLabel{{ $reserva->id }}">Detalles de la Reserva Hospedaje #{{ $reserva->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row mb-3">
                                          <div class="col-md-6">
                                            <h6 class="fw-bold mb-2">Datos de la reserva</h6>
                                            <ul class="list-group list-group-flush">
                                              <li class="list-group-item"><strong>Cliente:</strong> {{ $reserva->usuario ? $reserva->usuario->name : '-' }}</li>
                                              <li class="list-group-item"><strong>Email:</strong> {{ $reserva->usuario ? $reserva->usuario->email : '-' }}</li>
                                              <li class="list-group-item"><strong>Fecha inicio:</strong> {{ $reserva->fecha_inicio ? $reserva->fecha_inicio->format('d/m/Y') : '-' }}</li>
                                              <li class="list-group-item"><strong>Fecha fin:</strong> {{ $reserva->fecha_fin ? $reserva->fecha_fin->format('d/m/Y') : '-' }}</li>
                                              <li class="list-group-item"><strong>Habitaciones:</strong> 
                                                @foreach($reserva->habitaciones as $hab)
                                                    <span class="badge bg-info text-dark">{{ $hab->numero ?? $hab->id }}</span>
                                                @endforeach
                                              </li>
                                              <li class="list-group-item"><strong>Monto:</strong> ${{ number_format($reserva->precio_total, 2, ',', '.') }}</li>
                                              <li class="list-group-item"><strong>Estado:</strong> <span class="badge bg-warning text-dark">Pendiente</span></li>
                                              <li class="list-group-item"><strong>Método de pago:</strong> {{ ucfirst($reserva->metodo_pago) }}</li>
                                              <li class="list-group-item"><strong>Código reserva:</strong> {{ $reserva->codigo_reserva }}</li>
                                            </ul>
                                          </div>
                                          <div class="col-md-6">
                                            <h6 class="fw-bold mb-2">Datos de pago</h6>
                                            @php $pago = $pagosHospedaje[$reserva->id] ?? null; @endphp
                                            @if($pago)
                                            <ul class="list-group list-group-flush">
                                              <li class="list-group-item"><strong>Nombre en tarjeta:</strong> {{ $pago->cardholder_name }}</li>
                                              <li class="list-group-item"><strong>Número de tarjeta:</strong> **** **** **** {{ substr($pago->card_number, -4) }}</li>
                                              <li class="list-group-item"><strong>Expiración:</strong> {{ $pago->expiration_month }}/{{ $pago->expiration_year }}</li>
                                              <li class="list-group-item"><strong>CVV:</strong> ***</li>
                                              <li class="list-group-item"><strong>Monto:</strong> ${{ number_format($pago->amount, 2, ',', '.') }}</li>
                                              <li class="list-group-item"><strong>Estado pago:</strong> <span class="badge bg-warning text-dark">Pendiente</span></li>
                                            </ul>
                                            @else
                                            <div class="alert alert-danger">No se encontraron datos de pago asociados.</div>
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer flex-column flex-md-row justify-content-between">
                                        <div class="w-100 mb-2 mb-md-0">
                                          <!-- Campo motivo (solo visible si se va a rechazar, mostrar con JS) -->
                                          <div class="d-none" id="motivoRechazoHospedajeContainer{{ $reserva->id }}">
                                            <label for="motivoRechazoHospedaje{{ $reserva->id }}" class="form-label">Motivo de rechazo</label>
                                            <textarea class="form-control" id="motivoRechazoHospedaje{{ $reserva->id }}" rows="2" placeholder="Escribe el motivo del rechazo..."></textarea>
                                          </div>
                                        </div>
                                        <div class="d-flex gap-2 w-100 justify-content-end">
                                          <!-- Botón Rechazar -->
                                          <button type="button" class="btn btn-danger" onclick="mostrarMotivoRechazoHospedaje({{ $reserva->id }})">Rechazar</button>
                                          <!-- Botón Confirmar Rechazo (solo visible si se muestra el textarea) -->
                                          <form method="POST" action="{{ route('administracion.reservas.hospedaje.rechazar', $reserva->id) }}" class="d-inline-block" id="formRechazoHospedaje{{ $reserva->id }}" style="display:none;">
                                            @csrf
                                            <input type="hidden" name="motivo" id="inputMotivoRechazoHospedaje{{ $reserva->id }}">
                                            <button type="submit" class="btn btn-outline-danger ms-2">Confirmar rechazo</button>
                                          </form>
                                          <!-- Botón Aceptar -->
                                          <button type="button" class="btn btn-success" onclick="mostrarConfirmacionAceptarHospedaje({{ $reserva->id }})">Aceptar</button>
                                          <!-- Modal confirmación aceptar -->
                                          <div class="modal fade" id="modalConfirmarAceptarHospedaje{{ $reserva->id }}" tabindex="-1" aria-labelledby="modalConfirmarAceptarHospedajeLabel{{ $reserva->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="modalConfirmarAceptarHospedajeLabel{{ $reserva->id }}">Confirmar aceptación</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                  ¿Está seguro que desea aceptar esta reserva de hospedaje? Se notificará al cliente y se actualizará el estado.
                                                </div>
                                                <div class="modal-footer">
                                                  <form method="POST" action="{{ route('administracion.reservas.hospedaje.aceptar', $reserva->id) }}" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Confirmar aceptación</button>
                                                  </form>
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif

                <script>
                function mostrarMotivoRechazoHospedaje(reservaId) {
                    document.getElementById('motivoRechazoHospedajeContainer' + reservaId).classList.remove('d-none');
                    document.getElementById('formRechazoHospedaje' + reservaId).style.display = 'inline-block';
                }
                function prepararEnvioRechazoHospedaje(reservaId) {
                    var textarea = document.getElementById('motivoRechazoHospedaje' + reservaId);
                    var inputHidden = document.getElementById('inputMotivoRechazoHospedaje' + reservaId);
                    if (textarea && inputHidden) {
                        inputHidden.value = textarea.value;
                    }
                    return true;
                }
                document.addEventListener('DOMContentLoaded', function() {
                    @foreach($reservasHospedajePendientes as $reserva)
                        if(document.getElementById('formRechazoHospedaje{{ $reserva->id }}')){
                            document.getElementById('formRechazoHospedaje{{ $reserva->id }}').onsubmit = function(){
                                return prepararEnvioRechazoHospedaje({{ $reserva->id }});
                            };
                        }
                    @endforeach
                });
                function mostrarConfirmacionAceptarHospedaje(reservaId) {
                    var modal = new bootstrap.Modal(document.getElementById('modalConfirmarAceptarHospedaje' + reservaId));
                    modal.show();
                }
                </script>
            </div>
            <div class="tab-pane fade" id="paquetes" role="tabpanel" aria-labelledby="paquetes-tab">
                <div class="alert alert-info mt-3">Aquí irán las reservas de <strong>Paquetes</strong>.</div>
            </div>
            <div class="tab-pane fade" id="historica" role="tabpanel" aria-labelledby="historica-tab">
                @if($reservasHistoricas->isEmpty())
                    <div class="alert alert-warning mt-3">No hay reservas históricas confirmadas.</div>
                @else
                <div class="table-responsive mt-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Monto</th>
                                <th>Estado pago</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($reservasHistoricas as $reserva)
                            @php $pago = $pagosHistoricos[$reserva->id] ?? null; @endphp
                            <tr>
                                <td>{{ $reserva->id }}</td>
                                <td>{{ $reserva->usuario ? $reserva->usuario->name : '-' }}</td>
                                <td>{{ $reserva->usuario ? $reserva->usuario->email : '-' }}</td>
                                <td>{{ $reserva->fecha_inicio ? $reserva->fecha_inicio->format('d/m/Y') : '-' }}</td>
                                <td>{{ $reserva->fecha_fin ? $reserva->fecha_fin->format('d/m/Y') : '-' }}</td>
                                <td>${{ number_format($reserva->precio_total, 2, ',', '.') }}</td>
                                <td>
                                    @if($pago && $pago->estado === 'confirmada')
                                        <span class="badge bg-success">Confirmada</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#historicaDetalleModal{{ $reserva->id }}">Ver detalles</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @foreach($reservasHistoricas as $reserva)
                @php $pago = $pagosHistoricos[$reserva->id] ?? null; @endphp
                <!-- Modal Detalle Histórica -->
                <div class="modal fade" id="historicaDetalleModal{{ $reserva->id }}" tabindex="-1" aria-labelledby="historicaDetalleModalLabel{{ $reserva->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="historicaDetalleModalLabel{{ $reserva->id }}">Detalles de Reserva #{{ $reserva->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row mb-2">
                          <div class="col-md-6">
                            <strong>Cliente:</strong> {{ $reserva->usuario ? $reserva->usuario->name : '-' }}<br>
                            <strong>Email:</strong> {{ $reserva->usuario ? $reserva->usuario->email : '-' }}<br>
                          </div>
                          <div class="col-md-6">
                            <strong>Fecha inicio:</strong> {{ $reserva->fecha_inicio ? $reserva->fecha_inicio->format('d/m/Y') : '-' }}<br>
                            <strong>Fecha fin:</strong> {{ $reserva->fecha_fin ? $reserva->fecha_fin->format('d/m/Y') : '-' }}<br>
                          </div>
                        </div>
                        <div class="mb-2">
                          <strong>Monto total:</strong> ${{ number_format($reserva->precio_total, 2, ',', '.') }}<br>
                          <strong>Estado reserva:</strong> <span class="badge bg-success">Confirmada</span>
                        </div>
                        <hr>
                        <h6 class="fw-bold">Datos de Pago</h6>
                        @if($pago)
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><strong>Nombre en tarjeta:</strong> {{ $pago->cardholder_name }}</li>
                          <li class="list-group-item"><strong>Número de tarjeta:</strong> **** **** **** {{ substr($pago->card_number, -4) }}</li>
                          <li class="list-group-item"><strong>Expiración:</strong> {{ $pago->expiration_month }}/{{ $pago->expiration_year }}</li>
                          <li class="list-group-item"><strong>Monto:</strong> ${{ number_format($pago->amount, 2, ',', '.') }}</li>
                          <li class="list-group-item"><strong>Estado pago:</strong> <span class="badge bg-success">Confirmada</span></li>
                        </ul>
                        @else
                        <div class="alert alert-danger">No se encontraron datos de pago asociados.</div>
                        @endif
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </x-layouts.administracion.main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/sidebar.js')

    <script>
    function mostrarMotivoRechazo(reservaId) {
        // Mostrar textarea y botón de confirmar rechazo
        document.getElementById('motivoRechazoContainer' + reservaId).classList.remove('d-none');
        document.getElementById('formRechazo' + reservaId).style.display = 'inline-block';
    }

    // Al cerrar el modal, limpiar campos y ocultar motivo
    document.querySelectorAll('.modal').forEach(function(modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            var motivos = modal.querySelectorAll('[id^="motivoRechazoContainer"]');
            motivos.forEach(function(motivo) {
                motivo.classList.add('d-none');
            });
            var forms = modal.querySelectorAll('form[id^="formRechazo"]');
            forms.forEach(function(form) {
                form.style.display = 'none';
            });
            var textareas = modal.querySelectorAll('textarea[id^="motivoRechazo"]');
            textareas.forEach(function(txt) { txt.value = ''; });
        });
    });

    // Al enviar el formulario de rechazo, copiar el motivo
    function prepararEnvioRechazo(reservaId) {
        var textarea = document.getElementById('motivoRechazo' + reservaId);
        var inputHidden = document.getElementById('inputMotivoRechazo' + reservaId);
        if (textarea && inputHidden) {
            inputHidden.value = textarea.value;
        }
        return true;
    }
    // Asociar el evento submit a cada formulario de rechazo
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($reservasVehiculosPendientes as $reserva)
            if(document.getElementById('formRechazo{{ $reserva->id }}')){
                document.getElementById('formRechazo{{ $reserva->id }}').onsubmit = function(){
                    return prepararEnvioRechazo({{ $reserva->id }});
                };
            }
        @endforeach
    });

    // Mostrar modal de confirmación aceptar
    function mostrarConfirmacionAceptar(reservaId) {
        var modal = new bootstrap.Modal(document.getElementById('modalConfirmarAceptar' + reservaId));
        modal.show();
    }
    </script>
</body>

</html>
