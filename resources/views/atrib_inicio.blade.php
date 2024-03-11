<?php
//date_default_timezone_set('europe/london');
date_default_timezone_set('America/Lima');

$hora_actual = date("H"); // Obtener la hora actual en formato H (solo hora)
//echo "La hora actual es: " . $hora_actual;
$controlDia = 0;
if($hora_actual > 5  && $hora_actual <= 16) $controlDia = 0;
if($hora_actual > 16 && $hora_actual <= 18) $controlDia = 1;
if($hora_actual > 18 || $hora_actual <= 4 ) $controlDia = 2;
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inicio</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- ====== img archivos locales ====== -->
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- ======== css archivos web ======== -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- ====== css archivos locales ====== -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Desarrollado por: Erick Andre Zamalloa Pomalaza
  * Bootstrap: Bootstrap v5.3.1
  ============================================================ -->
</head>
<body class="bg-body-normal">
  @php $panel = 0; @endphp
  <!-- ================================================= inicio del Header ======================================================== -->
  @include('const_header', ['usuario' => $usuario])

  <!-- ================================================= Inicio del Sidebar ======================================================= -->
  @include('const_sidebar', ['usuario' => $usuario, 'p' => $panel])

  <!-- ========================================= Inicio de la interfaz principal ================================================== -->
  <main id="main" class="main">
    <section class="section profile">
    <!-- Contenido adicional aquí -->
        <div class="contenedorCanvas">
            <canvas data="{{ json_encode($usuario) }}" tabindex="1"></canvas>
        </div> <br>
        <div class="container">
          <div class="row">
            <div class="col-6">
                <div class="card text-center bg-dark text-white">
                  <h4 class="card-header bg-dark text-white">
                      <span class="badge badge-pill badge-danger card-header bg-dark" id="mensajeMax" style="color:red"></span>
                  </h4>
                  <h5 class="card-header bg-dark text-white">Mutantes disponibles</h5>
                  <div class="card-body">
                    <table class="table table-striped table-dark">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Especia</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($mutantes as $mutante)
                          <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $mutante->nombre }}</td>
                              <td>{{ $mutante->especie }}</td>
                              <td>
                                  <div class="d-flex justify-content-center">
                                  <a type="button" data-bs-toggle="modal" data-bs-target="#MutanteModal" class="btn btn-outline-info mr-2"
                                    data-id-muntante="{{ $mutante->idM }}"
                                    data-nombre-mutante="{{ $mutante->nombre }}"
                                    data-mi-img="{{ asset('img/mutante/mut'.$mutante->apariencia.'/carta-v1.png') }}"
                                  ><i class="bi bi-gear"></i></a>
                                  @if ($mutante->seleccion == 0)
                                      @if (!isset($mutantesSel[3]))
                                          <form action="{{ route('selecMut', $mutante->idM) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                            <button type="submit" class="btn btn-outline-info ml-2"><i class="bi bi-box-arrow-up-right"></i></button>
                                          </form>
                                      @else
                                         <button type="button" class="btn btn-outline-info ml-2" id="mensajeError"><i class="bi bi-box-arrow-up-right"></i></button>
                                      @endif
                                  @endif
                                  </div>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>

            <div class="col-6">
                <div class="row">

                    <div class="col-6">
                        <div class="card bg-perfil">
                            <div class="card-body profile-card d-flex flex-column align-items-center">
                                @if (isset($mutantesSel[0]))
                                <br>
                                <form action="{{ route('selecMut', $mutantesSel[0]->idM) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <button type="submit" class="btn btn-outline-info"><i class="bi bi-box-arrow-down-left"></i></button>
                                </form>
                                <img src="{{ asset('img/mutante/mut'.$mutantesSel[0]->apariencia.'/mutante1-v1-p1.png') }}" alt="" style="width: 70px; height: auto;">
                                <h2>{{ $mutantesSel[0]->nombre}}</h2>
                                @else
                                <br><br><br><h2 class="text-white"><i class="bi bi-bookmark-dash"></i></h2><br><br><br>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-perfil">
                            <div class="card-body profile-card d-flex flex-column align-items-center">
                                @if (isset($mutantesSel[1]))
                                <br>
                                <form action="{{ route('selecMut', $mutantesSel[1]->idM) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <button type="submit" class="btn btn-outline-info"><i class="bi bi-box-arrow-down-left"></i></button>
                                </form>
                                <img src="{{ asset('img/mutante/mut'.$mutantesSel[1]->apariencia.'/mutante1-v1-p1.png') }}" alt="" style="width: 70px; height: auto;">
                                <h2>{{ $mutantesSel[1]->nombre}}</h2>
                                @else
                                <br><br><br><h2 class="text-white"><i class="bi bi-bookmark-dash"></i></h2><br><br><br>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-perfil">
                            <div class="card-body profile-card d-flex flex-column align-items-center">
                                @if (isset($mutantesSel[2]))
                                <br>
                                <form action="{{ route('selecMut', $mutantesSel[2]->idM) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <button type="submit" class="btn btn-outline-info"><i class="bi bi-box-arrow-down-left"></i></button>
                                </form>
                                <img src="{{ asset('img/mutante/mut'.$mutantesSel[2]->apariencia.'/mutante1-v1-p1.png') }}" alt="" style="width: 70px; height: auto;">
                                <h2>{{ $mutantesSel[2]->nombre}}</h2>
                                @else
                                <br><br><br><h2 class="text-white"><i class="bi bi-bookmark-dash"></i></h2><br><br><br>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-perfil">
                            <div class="card-body profile-card d-flex flex-column align-items-center">
                                @if (isset($mutantesSel[3]))
                                <br>
                                <form action="{{ route('selecMut', $mutantesSel[3]->idM) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <button type="submit" class="btn btn-outline-info"><i class="bi bi-box-arrow-down-left"></i></button>
                                </form>
                                <img src="{{ asset('img/mutante/mut'.$mutantesSel[3]->apariencia.'/mutante1-v1-p1.png') }}" alt="" style="width: 70px; height: auto;">
                                <h2>{{ $mutantesSel[3]->nombre}}</h2>
                                @else
                                <br><br><br><h2 class="text-white"><i class="bi bi-bookmark-dash"></i></h2><br><br><br>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <!--  Inicio del modal  -->
        <div class="modal fade" id="MutanteModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
              <div class="modal-header">
                <h1 class="modal-title fs-5">Modificar Mutante</h1>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
              </div>
              <div class="modal-body">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Cuando se hace clic en el botón, obtenemos el valor del atributo data y lo mostramos en el modal
                        $('a[data-bs-target="#MutanteModal"]').click(function() {
                            var idMutante = $(this).data('id-muntante');
                            var nombreMut = $(this).data('nombre-mutante');
                            var valorImg = $(this).data('mi-img');
                            $('#idMuntante').text(idMutante);
                            $('#idMuntanteF').val(idMutante);
                            $('#nombreM').val(nombreMut);
                            $('#valorImg').attr('src', valorImg);
                            // Actualiza la acción del formulario con el valor de idMuntante
                            var formAction = "{{ route('modificarMut', ':idMutante') }}";
                            formAction = formAction.replace(':idMutante', idMutante);
                            $('#mutanteForm').attr('action', formAction);
                        });
                    });
                    // eventos de boton para cuando la lista de mutantes seleccionados ya esta llena
                    document.getElementById('mensajeError').addEventListener('click', function() {
                        document.getElementById('mensajeMax').textContent = 'Ya tienes el maximo de mutantes seleccionados...';
                    });
                </script>
                <form id="mutanteForm" action="{{ route('modificarMut', 0) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="container">
                      <div class="row">
                          <div class="col">
                              <img id="valorImg" src="" alt="Profile" class="">
                          </div>
                          <div class="col">
                              <div class="mb-3">
                                  <span>Puedes cambiar de nombre a tu mutante</span>
                              </div>
                              <div class="mb-3">
                                  <label for="nombreM" class="col-form-label">Nombre:</label>
                                  <input type="text" class="form-control" id="nombreM" name="nombreM" value="" required>
                                  <input type="hidden" name="id" value="{{ session('usuario') }}">
                              </div>
                              <div class="mb-3">
                                  <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="modal"><i class="bi bi-pencil-square"></i> Cambiar nombre</button>
                              </div>
                          </div>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    </section>
  </main><!-- End #main -->
  <!-- ====== js archivos locales ====== -->

  <script src="{{ asset('js/parcela.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- ======== js archivos web ======== -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>
