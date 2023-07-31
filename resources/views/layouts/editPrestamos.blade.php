<div class="modal fade" id="editar{{ $prestamo->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 color" id="staticBackdropLabel">Editar Prestamo de Llave <i
                    class="bi bi-pencil-square"></i></h2>
            </div>
            <form method="POST" action="{{ route('prestamos.update') }}" role="form" enctype="multipart/form-data" id="update{{ $prestamo->id }}" class="prestamoForm{{$prestamo->id}}">
                @csrf
                <input type="hidden" value="{{$prestamo->id}}" name="estado_id">
                <input type="hidden" value="{{$prestamo->llaves_id}}" name="llaves_id">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="instructor{{$prestamo->id}}" class="form-label fw-semibold">Instructor que Solicita el Prestamo:</label>
                        <input type="text" class="form-control border-2 shadow-sm instructor" name="instructor" id="instructor{{$prestamo->id}}" placeholder="Ingresar el nombre del instructor"  value="{{ $prestamo->instructor }}" required>
                        <select name="instructorName" id="id_instructor{{$prestamo->id}}" class="d-none form-select mt-1 select" size="3"
                                aria-label="size 3 select example">
                        </select>
                        <small class="text-danger fw-semibold d-none" id="msinstructor{{ $prestamo->id }}">
                            <i class="bi bi-exclamation-circle-fill"></i> El campo instructor es requerido
                        </small>
                        @if ($errors->has('instructor'))
                            <small class="text-danger fw-semibold">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="ambiente{{$prestamo->id}}" class="form-label fw-semibold">Ambiente ha Prestar:</label>
                        <input type="text" class="form-control border-2 shadow-sm ambiente" name="ambiente" id="ambiente{{$prestamo->id}}" placeholder="Ingresar el nombre del ambiente" value="{{ $prestamo->ambiente }}" required>
                        <select name="ambiente_id" id="id_ambiente{{$prestamo->id}}" class="form-select mt-1 selectAmbiente" size="3"
                                aria-label="size 3 select example">
                                <option value="{{$prestamo->llaves_id}}">{{ $prestamo->ambiente }}</option>
                        </select>
                        <small class="text-danger fw-semibold d-none" id="msambiente{{ $prestamo->id }}">
                            <i class="bi bi-exclamation-circle-fill"></i> El campo ambiente es requerido
                        </small>
                        @if ($errors->has('ambiente'))
                            <small class="text-danger fw-semibold">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-semibold"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-send fw-semibold"
                        onclick="validateForm('update{{ $prestamo->id }}');">Enviar <i
                            class="bi bi-send-fill"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
