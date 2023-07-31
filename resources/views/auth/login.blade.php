<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/sena_logo.svg') }}">

    {{-- Style Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="vh-100">
        <div class="h-100 container-fluid">
            <main class="row justify-content-center align-items-center h-100 mx-2">

                <div class="form-login col-md-5 col-lg-4 col-xl-3 shadow p-4 px-xxl-5">
                    <img src="{{ asset('img/avatarSena.jpg') }}" class="avatarSena shadow mb-2" alt="Logo Sena">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-4">
                            <label for="email" class="form-label fs-5"><i class="bi bi-person-circle"></i> Número de
                                Documento:</label>
                            <input type="number" name="email" id="email"
                                class="form-control"
                                placeholder="Ingresar número de documento" value="{{ old('email') }}" required>
                            <div class="invalid-feedback fs-6 fw-medium">
                                <span class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> </span> El
                                número de documento es requerido.
                            </div>
                            @error('email')
                                <p class="text-danger fs-6 fw-medium" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fs-5"><i class="bi bi-person-fill-lock"></i>
                                Contraseña:</label>
                            <input type="password" name="password" id="password"
                                class="form-control"
                                placeholder="Ingresar contraseña" required>
                            <div class="invalid-feedback fs-6 fw-medium">
                                <span class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> </span>La
                                contraseña es requerida.
                            </div>
                            @error('password')
                                <p class="text-danger fs-6 fw-medium" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showPassword">
                            <label class="form-check-label" for="showPassword">
                                Mostrar Contraseña <i class="bi bi-eye-fill"></i>
                            </label>
                        </div>

                        <button type="submit" class="btn w-100 fs-5 fw-semibold shadow mt-4 mb-2">Ingresar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
