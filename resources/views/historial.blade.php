@extends('layouts.app')
@section('content')
<main id="main">
    <section id="services" class="services sections-bg">
        <div class="container" data-aos="fade-up">
  
          <article class="section-header">
            <h2>Historial de Prestamos Sede TIC</h2>
            <p class="fw-semibold">Información de los prestamos de llaves hechos por funcionarios administrativos y vigilante a los instructores de la Sede TIC</p>
          </article>
  
          <article class="row justify-content-center mb-5">
            <div class="col-md-11">
              <div class="service-item  position-relative shadow">
                <div class="icon">
                    <h3><i class="bi bi-folder2-open"></i> Historial de Prestamos de Llaves Sede TIC</h3> 
                </div>
                
                <div class="table-responsive">
                    <table id="historialTable" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th class="color">Ambiente de Formación</th>
                                <th class="color">Instructor</th>
                                <th class="color">Ubicacion de Llaves</th>
                                <th class="color">Prestado por</th>
                                <th class="color">Fecha y Hora Prestamo</th>
                                <th class="color">Recibido Por</th>
                                <th class="color">Fecha y Hora Devolución</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $historial as $historico)
                               <tr>
                                    <td>{{$historico->ambiente}}</td>
                                    <td>{{$historico->instructor}}</td>
                                    <td>{{$historico->ubicacion}}</td>
                                    <td>{{$historico->funcionario_prestamo}}</td>
                                    <td>{{$historico->fecha_prestamo}}</td>
                                    <td>{{$historico->name}}</td>
                                    <td>{{$historico->created_at}}</td>
                               </tr>
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
@endsection