<button class="btn btn-primary py-1 px-2" id="mostrarButton" data-id-button={{$id}}>Ver</button>
<div class="modal" id="mostrarRegistroModal" data-id-modal={{$id}} tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @foreach ( $detalles as $detalle)
                    <h5>{{ $detalle->titulo}}</h3>
                    <p>{{$detalle->contenido ?? ''}}</p>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>