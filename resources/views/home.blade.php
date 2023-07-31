@extends('layouts.app')
@section('content')
    @if (session('rol') !== 'instructor')
        <section id="hero" class="hero">
            <div class="container position-relative">
                <div class="row gy-5">
                    <div
                        class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                        <h2>Bienvenidos a <span>PCLA</span></h2>
                        <p>Funcionario te damos la bienvenida al Sistema de Préstamo y Control de Llaves de los Ambientes de
                            la Sede TIC SENA.</p>
                        <div class="d-flex justify-content-center justify-content-lg-start">
                            <button type="button" class="btn-get-started" data-bs-toggle="modal"
                                data-bs-target="#createPrestamo">Prestar Llaves de un Ambiente</button>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg- text-center">
                        <img src="{{ asset('img/logo_blanco.svg') }}" height="300">
                    </div>
                </div>
            </div>

            <div class="icon-boxes position-relative">
                <div class="container position-relative">
                    <div class="row gy-4 mt-5 justify-content-around">

                        <div class="col-md-4 col-xl-3 col-md-6" data-aos="fade-up">
                            <div class="icon-box shadow-sm">
                                <div class="icon">{{ session('totalAmbientes') }}</div>
                                <h4 class="title">Total de Ambientes</h4>
                            </div>
                        </div>
                        <!--End Icon Box -->

                        <div class="col-md-4 col-xl-3 col-md-6" data-aos="fade-up">
                            <div class="icon-box shadow-sm">
                                <div class="icon">{{ session('ambientesOcupados') }}</div>
                                <h4 class="title">Ambientes Ocupados</h4>
                            </div>
                        </div>
                        <!--End Icon Box -->

                        <div class="col-md-4 col-xl-3 col-md-6" data-aos="fade-up">
                            <div class="icon-box shadow-sm">
                                <div class="icon">{{ session('ambientesDisponibles') }}</div>
                                <h4 class="title">Ambientes Disponibles</h4>
                            </div>
                        </div>
                        <!--End Icon Box -->

                    </div>
                </div>
            </div>

            </div>
        </section>

        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <article class="section-header">
                    <h2>Prestamos de LLaves de la Sede TIC</h2>
                    <p class="fw-semibold">Listado y control de prestamos de las llaves de los ambientes de formación de la
                        Sede TIC.</p>
                </article>

                <article class="row justify-content-center mb-5">
                    <div class="col-md-11">
                        <div class="service-item  position-relative shadow-sm bg-body-tertiary">
                            <div class="table-responsive">
                                <table id="informationTable" class="table table-striped table-bordered nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="color">Instructor</th>
                                            <th class="color">Ambiente</th>
                                            <th class="color">Ubicación del Ambiente</th>
                                            <th class="color">Estado</th>
                                            <th class="color">Funciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prestamos as $prestamo)
                                            <tr>
                                                <td>{{ $prestamo->instructor }}</td>
                                                <td>{{ $prestamo->ambiente }}</td>
                                                <td>{{ $prestamo->ubicacion }}</td>
                                                @if ($prestamo->estado == 'PENDIENTE')
                                                    <td><button type="button"
                                                            class="btn btn-sm btn-light shadow-sm fw-semibold"
                                                            onclick="cambiarEstado({{ $prestamo->id }});">{{ $prestamo->estado }}
                                                            <i class="bi bi-key-fill"></i></button></td>
                                                @else
                                                    <td><button type="button"
                                                            class="btn btn-sm btn-danger shadow-sm fw-semibold"
                                                            onclick="cambiarEstado({{ $prestamo->id }});">{{ $prestamo->estado }}
                                                            <i class="bi bi-slash-circle"></i></button></td>
                                                @endif
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning text-white fw-semibold shadow-sm"
                                                        data-bs-toggle="modal" data-bs-target="#editar{{ $prestamo->id }}">
                                                        Editar <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('layouts.editPrestamos')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </article>

            </div>
        </section>

        @include('layouts.prestamo')

        @if ($message = Session::get('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Proceso finalizado exitosamente!'
                })
            </script>
        @elseif ($message = Session::get('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'El ambiente se encuentra ocupado',
                });
            </script>
        @elseif ($message = Session::get('error2'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'El instructor tiene un ambiente pendiente u ocupado',
                });
            </script>
        @endif
    @else
        <section id="hero" class="hero pb-5">
            <div class="container position-relative">
                <div class="row gy-5">
                    <div
                        class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                        <h2>Bienvenidos a <span>PCLA</span></h2>
                        <p>Funcionario te damos la bienvenida al Sistema de Préstamo y Control de Llaves de los Ambientes de
                            la Sede TIC SENA.</p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg- text-center">
                        <img src="{{ asset('img/logo_blanco.svg') }}" height="300">
                    </div>
                </div>
            </div>

        </section>

        <main id="main">
            <section id="services" class="services sections-bg">
                <article class="row justify-content-center mb-4">
                    <div class="col-md-9 col-lg-7 px-4 px-md-0">
                        <div class="service-item  position-relative shadow">
                            <div class="icon">
                                <h3><i class="bi bi-key-fill"></i> Llaves Pendientes por Entregar:</h3>
                                @if ($estado)
                                    <p class="fw-semibold fs-5 px-md-3 text-secondary">No tiene llaves pendientes por
                                        entregar, la solicitud de entrega ya fue aceptada.</p>
                                @endif
                                @foreach ($prestamos as $prestamo)
                                    <p class="fw-semibold fs-5 px-md-3 text-secondary">Instruct@r <span
                                            class="color">{{ $prestamo->instructor }}</span> tines en tus manos
                                        las llaves del ambiente <span class="color">{{ $prestamo->ambiente }}</span> si ya
                                        terminaste tu horario de formación o la actividad
                                        que te encontrabas realizando en el ambiente has click en el botón de Solicitar
                                        Entrega de Llaves.</p>
                                    @if ($prestamo->estado == 'OCUPADO')
                                        <button class="btn btn-send fw-semibold shadow-sm m-2"
                                            onclick="solicitarEntrega({{ $prestamo->id }});">Solicitar Entrega de Llaves <i
                                                class="bi bi-key-fill"></i></button>
                                    @else
                                        <button class="btn btn-secondary fw-semibold shadow-sm m-2" disabled">Solicitar
                                            Entrega de Llaves <i class="bi bi-key-fill"></i></button>
                                    @endif
                                @endforeach

                            </div>

                        </div>
                    </div>
                </article>
            </section>
        </main>
        @if ($message = Session::get('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Proceso finalizado exitosamente!'
                })
            </script>
        @endif
    @endif
@endsection
