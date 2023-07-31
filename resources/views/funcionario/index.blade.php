@extends('layouts.app')
@section('content')
    <main id="main">
        <section id="services" class="services sections-bg">
            <div class="container" data-aos="fade-up">

                <article class="section-header">
                    <h2>Funcionarios de la Sede TIC</h2>
                    <p class="fw-semibold">Información y registro de funcionarios Administrativos, Instructores y Vigilantes
                        de la Sede TIC</p>
                </article>

                <article class="row justify-content-center mb-5">
                    <div class="col-md-11">
                        <div class="service-item  position-relative shadow">
                            <div class="icon">
                                <h3><i class="bi bi-people-fill"></i> Listado de Funcionarios Sede TIC</h3>
                            </div>
                            <form action="{{ route('funcionarios.import') }} " method="post" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="listaFuncionarios" class="form-label color fs-6 fw-semibold">Importar
                                        Listado de Funcionarios en Archivo Excel <i
                                            class="bi bi-file-earmark-excel-fill"></i>:</label>
                                    <input type="file" name="listaFuncionarios" id="listaFuncionarios"
                                        class="form-control border-2 shadow-sm" accept=".xlsx" required>
                                    <div class="invalid-feedback fw-semibold">
                                        <i class="bi bi-exclamation-circle-fill"></i> Debe seleccionar el archivo excel para
                                        hacer la importación.
                                    </div>
                                </div>
                                <div class="text-md-center">
                                    <a href="{{ asset('docs/listado_funcionarios_TIC.xlsx') }}"
                                        class="btn btn-warning fw-semibold text-white shadow-sm me-2 my-2">Descargar
                                        Plantilla <i class="bi bi-download"></i></a>
                                    <button type="submit" class="btn btn-send fw-semibold shadow-sm my-2">Importar
                                        Funcionarios <i class="bi bi-cloud-arrow-up-fill"></i></button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <div class="table-responsive">
                                <button type="button" class="btn btn-send fw-semibold shadow-sm mt-2 mb-3"
                                    data-bs-toggle="modal" data-bs-target="#crearFuncionario">
                                    Registrar Funcionario <i class="bi bi-folder-plus"></i>
                                </button>
                                <table id="informationTable" class="table table-striped table-bordered nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="color">Funcionario</th>
                                            <th class="color">Número de Identificación</th>
                                            <th class="color">Cargo del Funcionario</th>
                                            <th class="color">Funciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            <tr class="fw-semibold">
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                @if ($usuario->role_id == 2)
                                                    <td>ADMINISTRATIVO</td>
                                                @elseif ($usuario->role_id == 3)
                                                    <td>VIGILANTE</td>
                                                @else
                                                    <td>INSTRUCTOR</td>
                                                @endif
                                                <td>
                                                    <form
                                                        action="{{ route('funcionarios.destroy', ['id' => $usuario->id, 'rol' => 'USER']) }}"
                                                        method="POST">
                                                        <button type="button"
                                                            class="btn btn-sm btn-warning text-white fw-semibold shadow-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editar{{$usuario->id}}">
                                                            Editar <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm delete fw-semibold shadow-sm">Eliminar
                                                            <i class="bi bi-trash3"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @include('funcionario.editUser')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </article>

            </div>
        </section>
    </main>

    @include('funcionario.create')

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Proceso finalizado exitosamente!'
            })
        </script>
    @elseif (isset($errors) && $errors->any())
        @if ($errors->has('nombre') == false && $errors->has('identificacion') == false && $errors->has('rol') == false)
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al Importar Excel',
                    text: 'Los nombres de las columnas o datos del excel no son validos!',
                });
            </script>
        @else
            <script>
                $(document).ready(function() {
                    $('#crearFuncionario').modal('toggle')
                });
            </script>
        @endif
    @elseif ($message = Session::get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error al Registrar Funcionario',
                text: 'Este funcionario ya se encuentra registrado!',
            });
        </script>
    @endif
@endsection
