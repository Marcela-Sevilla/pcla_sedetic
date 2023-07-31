<div class="modal fade" id="crearFuncionario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 color" id="staticBackdropLabel">Crear un Funcionario <i
                        class="bi bi-buildings"></i></h2>
            </div>
            <form method="POST" action="{{ route('funcionarios.store') }}" role="form" enctype="multipart/form-data"
                id="crearForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label fw-semibold">Nombre del Funcionario:</label>
                        <input type="text" name="nombre" id="nombre"
                            class="form-control border border-2 shadow-sm"
                            placeholder="Ingrese el nombre del funcionario" value="{{ old('nombre') }}" required>
                        <small class="text-danger fw-semibold d-none" id="msnombre">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            El campo nombre del funcionario es requerido
                        </small>
                        @if ($errors->has('nombre'))
                            <small class="text-danger fw-semibold">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('nombre') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="identificacion" class="form-label fw-semibold">Número de Identificación del
                            Funcionario:</label>
                        <input type="number" name="identificacion" id="identificacion"
                            class="form-control border border-2 shadow-sm"
                            placeholder="Ingrese el número de identificación del funcionario"
                            value="{{ old('identificacion') }}" required>
                        <small class="text-danger fw-semibold d-none" id="msidentificacion">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            El campo número de identificación del funcionario es requerido
                        </small>
                        @if ($errors->has('identificacion'))
                            <small class="text-danger fw-semibold">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('identificacion') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="rol" class="form-label fw-semibold">Seleccionar el Cargo del
                            Funcionario:</label>
                        <select class="form-select" name="rol" id="rol" required>
                            <option selected disabled value="">Seleccionar Opción..</option>
                            <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
                            <option value="INSTRUCTOR">INSTRUCTOR</option>
                            <option value="VIGILANTE">VIGILANTE</option>
                        </select>
                        <small class="text-danger fw-semibold d-none" id="msrol">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            Debe seleccionar una opción
                        </small>
                        @if ($errors->has('rol'))
                            <small class="text-danger fw-semibold">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('rol') }}
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
