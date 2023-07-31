<div class="modal fade" id="createPrestamo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 color" id="staticBackdropLabel">Registrar Prestamo de LLaves <i class="bi bi-key-fill"></i></h2>
            </div>
            <form action="{{ route('prestamos.create') }}" method="POST" class="needs-validation prestamoForm" novalidate>
                @csrf
                 <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="instructor" class="form-label fw-semibold">Instructor que Solicita el Prestamo:</label>
                        <input type="text" class="form-control border-2 shadow-sm instructor" name="instructor" id="instructor" placeholder="Ingresar el nombre del instructor" required>
                        <select name="instructorName" id="id_instructor" class="d-none form-select mt-1 select" size="3"
                                aria-label="size 3 select example">
                        </select>
                        <div class="invalid-feedback fw-semibold">
                            <i class="bi bi-exclamation-circle-fill"></i> 
                          El campo instructor es requerido
                        </div>
                        @if ($errors->has('instructor'))
                            <small class="text-danger fw-semibold">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="ambiente" class="form-label fw-semibold">Ambiente ha Prestar:</label>
                        <input type="text" class="form-control border-2 shadow-sm ambiente" name="ambiente" id="ambiente" placeholder="Ingresar el nombre del ambiente" required>
                        <select name="ambiente_id" id="id_ambiente" class="d-none form-select mt-1 selectAmbiente" size="3"
                                aria-label="size 3 select example">
                        </select>
                        <div class="invalid-feedback fw-semibold">
                            <i class="bi bi-exclamation-circle-fill"></i> 
                          El campo ambiente es requerido
                        </div>
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
                     <button type="submit" class="btn btn-send fw-semibold">Registrar
                         <i class="bi bi-send-fill"></i></button>
                 </div>
            </form>
        </div>
    </div>
</div>
