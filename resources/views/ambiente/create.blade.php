<div class="modal fade" id="crearAmbiente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 color" id="staticBackdropLabel">Crear un Ambiente de Formación <i
                        class="bi bi-buildings"></i></h2>
            </div>
            <form method="POST" action="{{ route('ambientes.store') }}" role="form" enctype="multipart/form-data"
                id="crearForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="ambiente" class="form-label fw-semibold">Nombre del Ambiente de Formación:</label>
                        <input type="text" name="ambiente" id="ambiente"
                            class="form-control border border-2 shadow-sm" placeholder="Ingrese el nombre del ambiente"
                            value="{{ old('ambiente') }}" required>
                        <small class="text-danger fw-semibold d-none" id="msambiente">
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
                        <label for="ubicacion" class="form-label fw-semibold">Ubicación del Ambiente en la Sede:</label>
                        <input type="text" name="ubicacion" id="ubicacion"
                            class="form-control border border-2 shadow-sm"
                            placeholder="Ingrese la ubicación del ambiente" required value="{{ old('ubicacion') }}">
                        <div class="text-danger fw-semibold d-none" id="msubicacion">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            El campo ubicación del ambiente es requerido
                        </div>
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
                    <button type="button" class="btn btn-send fw-semibold" onclick="validateForm('crearForm');">Enviar
                        <i class="bi bi-send-fill"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
