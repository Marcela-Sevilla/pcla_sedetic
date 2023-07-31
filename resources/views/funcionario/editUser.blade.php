<div class="modal fade" id="editar{{$usuario->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5 color" id="staticBackdropLabel">Editar Información del Funcionario <i
                        class="bi bi-pencil-square"></i></h2>
            </div>
            <form method="POST" action="{{ route('funcionarios.update') }}" role="form"
                enctype="multipart/form-data" id="update{{$usuario->id}}">
                @csrf
                <input type="hidden" name="id" value="{{ $usuario->id }}">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nombre{{$usuario->id}}" class="form-label fw-semibold">Nombre del
                            Funcionario:</label>
                        <input type="text" name="nombre" id="nombre{{$usuario->id}}"
                            class="form-control border border-2 shadow-sm"
                            placeholder="Ingrese el nombre del funcionario" value="{{ $usuario->name }}" required>
                        <small class="text-danger fw-semibold d-none" id="msnombre{{$usuario->id}}">
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
                        <label for="identificacion{{$usuario->id}}" class="form-label fw-semibold">Número de
                            Identificación del Funcionario:</label>
                        <input type="number" name="identificacion" id="identificacion{{$usuario->id}}"
                            class="form-control border border-2 shadow-sm"
                            placeholder="Ingrese el número de identificación del funcionario"
                            value="{{ $usuario->email }}" required>
                        <small class="text-danger fw-semibold d-none" id="msidentificacion{{$usuario->id}}">
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
                        <label for="rol{{$usuario->id}}" class="form-label fw-semibold">Seleccionar el Cargo del
                            Funcionario:</label>
                        <select class="form-select roles" name="rol" id="rol{{$usuario->id}}" required>
                            @if ($usuario->role_id == 2)
                                <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
                            @elseif ($usuario->role_id == 3)
                                <option value="VIGILANTE">VIGILANTE</option>
                            @else
                                <option value="INSTRUCTOR">INSTRUCTOR</option>
                            @endif
                            <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
                            <option value="INSTRUCTOR">INSTRUCTOR</option>
                            <option value="VIGILANTE">VIGILANTE</option>
                        </select>
                        <small class="text-danger fw-semibold d-none" id="msrol{{$usuario->id}}">
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
                    <button type="button" class="btn btn-send fw-semibold"
                        onclick="validateForm('update{{$usuario->id}}');">Enviar
                        <i class="bi bi-send-fill"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
