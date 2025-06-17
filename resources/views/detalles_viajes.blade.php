@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ is_array($viaje->imagenes) ? $viaje->imagenes[0] : $viaje->imagenes }}" class="img-fluid rounded mb-3" alt="{{ $viaje->nombre }}">
            <h2>{{ $viaje->nombre }}</h2>
            <p><strong>Origen:</strong> {{ $viaje->origen }}</p>
            <p><strong>Destino:</strong> {{ $viaje->destino }}</p>
            <p><strong>Salida:</strong> {{ $viaje->fecha_salida }}</p>
            <p><strong>Llegada:</strong> {{ $viaje->fecha_llegada }}</p>
            <p><strong>Empresa:</strong> {{ $viaje->empresa }}</p>
            <p><strong>Precio base:</strong> ${{ number_format($viaje->precio_base, 2) }}</p>
            <p>{{ $viaje->descripcion }}</p>
        </div>
        <div class="col-md-6">
            @auth
                @if($reserva)
                    <div class="alert alert-success">Ya tienes una reserva para este viaje.</div>
                @else
                    <form id="formReservarViaje" action="{{ route('reservas.viaje', $viaje->id) }}" method="POST" class="card p-3 shadow-sm">
    @csrf
    <h4 class="mb-3">Reservar este viaje</h4>
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha de salida</label>
        <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ $viaje->fecha_salida }}" readonly>
    </div>
    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad de pasajeros</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" value="1" required onchange="actualizarPasajeros()">
    </div>
    <div id="pasajerosFields"></div>
    <div class="mb-3">
        <label class="form-label">Total a pagar</label>
        <input type="text" class="form-control" id="totalPagar" value="${{ number_format($viaje->precio_base, 2) }}" readonly>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPago">Reservar y Pagar</button>
</form>

<!-- Modal de Reserva y Pago con pestañas -->
<div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPagoLabel">Reserva y Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs nav-justified border-bottom bg-light" id="reservaTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active fw-bold text-black" id="pasajeros-tab" data-bs-toggle="tab" data-bs-target="#pasajerosTab" type="button" role="tab" aria-controls="pasajerosTab" aria-selected="true" style="font-size:1.1rem;">Datos de Pasajeros</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link fw-bold text-black" id="pago-tab" data-bs-toggle="tab" data-bs-target="#pagoTab" type="button" role="tab" aria-controls="pagoTab" aria-selected="false" style="font-size:1.1rem;">Pago</button>
  </li>
</ul>
        <div class="tab-content mt-3" id="reservaTabsContent">
          <div class="tab-pane fade show active" id="pasajerosTab" role="tabpanel" aria-labelledby="pasajeros-tab">
            <div id="modalPasajerosFields"></div>
            <div class="mb-3">
              <label class="form-label">Total a pagar</label>
              <input type="text" class="form-control" id="modalTotalPagarTab" value="${{ number_format($viaje->precio_base, 2) }}" readonly>
            </div>
            <button class="btn btn-primary w-100 mt-3" type="button" id="btnContinuarPago" onclick="nextPagoTab()">Siguiente: Pago</button>
          </div>
          <div class="tab-pane fade" id="pagoTab" role="tabpanel" aria-labelledby="pago-tab">
            <form id="formPagoViaje" action="{{ route('reservas.viaje', $viaje->id) }}" method="POST">
              @csrf
              <input type="hidden" name="cantidad" id="pago_cantidad">
              <input type="hidden" name="pasajeros" id="pago_pasajeros">
              <div class="mb-3">
                <label for="cardholder_name" class="form-label">Nombre en la tarjeta</label>
                <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" required>
              </div>
              <div class="mb-3">
                <label for="card_number" class="form-label">Número de tarjeta</label>
                <input type="text" class="form-control" id="card_number" name="card_number" maxlength="19" required>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label for="expiration_month" class="form-label">Mes</label>
                  <input type="text" class="form-control" id="expiration_month" name="expiration_month" maxlength="2" required>
                </div>
                <div class="col">
                  <label for="expiration_year" class="form-label">Año</label>
                  <input type="text" class="form-control" id="expiration_year" name="expiration_year" maxlength="4" required>
                </div>
                <div class="col">
                  <label for="cvv" class="form-label">CVV</label>
                  <input type="text" class="form-control" id="cvv" name="cvv" maxlength="4" required>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Total a pagar</label>
                <input type="text" class="form-control" id="modalTotalPagar" value="${{ number_format($viaje->precio_base, 2) }}" readonly>
              </div>
              <button type="submit" class="btn btn-success w-100">Confirmar pago y reservar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
// Actualiza los campos de pasajeros en el modal de pestañas
function actualizarPasajerosModal() {
    var cantidad = parseInt(document.getElementById('cantidad').value) || 1;
    var pasajerosDiv = document.getElementById('modalPasajerosFields');
    pasajerosDiv.innerHTML = '';
    for (let i = 1; i <= cantidad; i++) {
        pasajerosDiv.innerHTML += `
            <div class='mb-2'>
                <label class='form-label'>Pasajero ${i} - Nombre</label>
                <input type='text' class='form-control mb-1' name='modal_pasajeros[${i}][nombre]' required>
                <label class='form-label'>Pasajero ${i} - DNI</label>
                <input type='text' class='form-control' name='modal_pasajeros[${i}][dni]' required>
            </div>
        `;
    }
    // Actualizar total
    var precio = {{ $viaje->precio_base }};
    document.getElementById('modalTotalPagarTab').value = `$${(precio * cantidad).toFixed(2)}`;
    document.getElementById('modalTotalPagar').value = `$${(precio * cantidad).toFixed(2)}`;
}

// Al abrir el modal, sincroniza campos
var modalPago = document.getElementById('modalPago');
modalPago.addEventListener('show.bs.modal', function (event) {
    actualizarPasajerosModal();
});

// Botón para pasar a la pestaña de pago
function nextPagoTab() {
    // Validar que todos los campos de pasajeros estén completos
    var cantidad = parseInt(document.getElementById('cantidad').value) || 1;
    var valid = true;
    for (let i = 1; i <= cantidad; i++) {
        var nombre = document.querySelector(`#modalPasajerosFields input[name='modal_pasajeros[${i}][nombre]']`).value;
        var dni = document.querySelector(`#modalPasajerosFields input[name='modal_pasajeros[${i}][dni]']`).value;
        if (!nombre || !dni) { valid = false; break; }
    }
    if (!valid) {
        alert('Completa todos los datos de los pasajeros.');
        return;
    }
    // Copiar datos a los campos ocultos para el form de pago
    var pasajeros = [];
    for (let i = 1; i <= cantidad; i++) {
        pasajeros.push({
            nombre: document.querySelector(`#modalPasajerosFields input[name='modal_pasajeros[${i}][nombre]']`).value,
            dni: document.querySelector(`#modalPasajerosFields input[name='modal_pasajeros[${i}][dni]']`).value
        });
    }
    document.getElementById('pago_cantidad').value = cantidad;
    document.getElementById('pago_pasajeros').value = JSON.stringify(pasajeros);
    // Cambiar a la pestaña de pago de forma robusta
    var pagoTabBtn = document.getElementById('pago-tab');
    if (pagoTabBtn) {
        var tab = new bootstrap.Tab(pagoTabBtn);
        tab.show();
        // Visual feedback: scroll al tab de pago
        setTimeout(function(){
            document.getElementById('pagoTab').scrollIntoView({behavior:'smooth'});
        }, 200);
    }
}
</script>


<script>
function actualizarPasajeros() {
    var cantidad = parseInt(document.getElementById('cantidad').value) || 1;
    var pasajerosDiv = document.getElementById('pasajerosFields');
    pasajerosDiv.innerHTML = '';
    for (let i = 1; i <= cantidad; i++) {
        pasajerosDiv.innerHTML += `
            <div class="mb-2">
                <label class="form-label">Pasajero ${i} - Nombre</label>
                <input type="text" class="form-control mb-1" name="pasajeros[${i}][nombre]" required>
                <label class="form-label">Pasajero ${i} - DNI</label>
                <input type="text" class="form-control" name="pasajeros[${i}][dni]" required>
            </div>
        `;
    }
    // Actualizar total
    var precio = {{ $viaje->precio }};
    document.getElementById('totalPagar').value = `$${(precio * cantidad).toFixed(2)}`;
    document.getElementById('modalTotalPagar').value = `$${(precio * cantidad).toFixed(2)}`;
}

// Sincronizar datos al abrir modal
var modalPago = document.getElementById('modalPago');
modalPago.addEventListener('show.bs.modal', function (event) {
    var cantidad = document.getElementById('cantidad').value;
    var pasajeros = [];
    document.querySelectorAll('#pasajerosFields [name^="pasajeros"]').forEach(function(input) {
        var match = input.name.match(/pasajeros\[(\d+)\]\[(nombre|dni)\]/);
        if (match) {
            var idx = parseInt(match[1]) - 1;
            if (!pasajeros[idx]) pasajeros[idx] = {};
            pasajeros[idx][match[2]] = input.value;
        }
    });
    document.getElementById('pago_cantidad').value = cantidad;
    document.getElementById('pago_pasajeros').value = JSON.stringify(pasajeros);
});

// Inicializar campos
actualizarPasajeros();
</script>

                @endif
            @else
                <div class="alert alert-info">Inicia sesión para reservar este viaje.</div>
            @endauth
        </div>
    </div>
</div>
@endsection
