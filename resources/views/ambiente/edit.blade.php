<div class="modal fade" id="editar{{ $ambiente->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 color" id="staticBackdropLabel">Editar Información del Ambiente <i
                        class="bi bi-pencil-square"></i></h2>
            </div>
            <form method="POST" action="{{ route('ambientes.update', $ambiente->id) }}" role="form"
                enctype="multipart/form-data" id="update{{ $ambiente->id }}">
                {{ method_field('PATCH') }}
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="ambiente{{ $ambiente->id }}" class="form-label fw-semibold">Nombre del Ambiente de
                            Formación:</label>
                        <input type="text" name="ambiente" id="ambiente{{ $ambiente->id }}"
                            class="form-control border border-2 shadow-sm" placeholder="Ingrese el nombre del ambiente"
                            value="{{ $ambiente->ambiente }}" required>
                        <small class="text-danger fw-semibold d-none" id="msambiente{{ $ambiente->id }}">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            El campo nombre del ambiente es requerido
                        </small>
                        @if ($errors->has('ambiente'))
                            <small class="text-danger fw-semibold">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('ambiente') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="ubicacion{{ $ambiente->id }}" class="form-label fw-semibold">Ubicación del Ambiente
                            en la Sede:</label>
                        <input type="text" name="ubicacion" id="ubicacion{{ $ambiente->id }}"
                            class="form-control border border-2 shadow-sm"
                            placeholder="Ingrese la ubicación del ambiente" required
                            value="{{ $ambiente->ubicacion }}">
                        <small class="text-danger fw-semibold d-none" id="msubicacion{{ $ambiente->id }}">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            El campo ubicación del ambiente es requerido
                        </small>
                        @if ($errors->has('ubicacion'))
                            <small class="text-danger fw-semibold">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('ubicacion') }}
                            </small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-semibold"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-send fw-semibold"
                        onclick="validateForm('update{{ $ambiente->id }}');">Enviar <i
                            class="bi bi-send-fill"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
