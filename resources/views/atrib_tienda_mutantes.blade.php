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
@php $panel = 2; @endphp

  <!-- ================================================= inicio del Header ======================================================== -->
  @include('const_header', ['usuario' => $usuario])

  <!-- ================================================= Inicio del Sidebar ======================================================= -->
  @include('const_sidebar', ['usuario' => $usuario, 'p' => $panel])

  <!-- ========================================= Inicio de la interfaz principal ================================================== -->
  <main id="main" class="main">
    <section class="section profile">
    <!-- Contenido adicional aquí -->
    <div class="row">
        <div class="col-xl-3">

            <div class="card bg-perfil text-white">
                <a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#MutanteModal"
                    data-mi-img="{{ asset('img/mutante/mut1/carta-v1.png') }}"
                    data-mi-especie="March-T"

                    data-mi-salud       = "6"
                    data-mi-energia     = "10"
                    data-mi-carga       = "5"
                    data-mi-apariencia  = "1"

                    data-mi-at1         = "2"
                    data-mi-at2         = "3"
                    data-mi-at3         = "1"
                    data-mi-at4         = "1"
                >
                    <img src="{{ asset('img/mutante/mut1/carta-v1.png') }}" alt="Profile" class=""><br><br>
                    <img src="{{ asset('img/smopin.png') }}" alt="Profile" class="">
                    <i class="bi bi-cart3"></i> 100
                </a>

                <div class="card-body profile-card d-flex flex-column align-items-center">
                    <h2>March-T V1</h2>
                    <spam>Elemental mutante de ataque cuerpo a cuerpo, parece adorable pero puede envestir a sus victimas con su poderoso cuerno</spam>
                </div>
            </div>

        </div>
        <div class="col-xl-3">

            <div class="card bg-perfil text-white">
                <a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#MutanteModal"
                    data-mi-img="{{ asset('img/mutante/mut2/carta-v1.png') }}"
                    data-mi-especie="Vampir"

                    data-mi-salud       = "7"
                    data-mi-energia     = "9"
                    data-mi-carga       = "5"
                    data-mi-apariencia  = "2"

                    data-mi-at1="3"
                    data-mi-at2="3"
                    data-mi-at3="1"
                    data-mi-at4="1"
                >
                    <img src="{{ asset('img/mutante/mut2/carta-v1.png') }}" alt="Profile" class=""><br><br>
                    <img src="{{ asset('img/smopin.png') }}" alt="Profile" class="">
                    <i class="bi bi-cart3"></i> 100
                </a>
                <div class="card-body profile-card d-flex flex-column align-items-center">
                    <h2>Vampir V1</h2>
                    <spam>Elemental mutante de ataque cuerpo a cuerpo, infije vastante daño gracias a sus poderosos colmillos y puede envenenar a sus victimas</spam>
                </div>
            </div>

        </div>
        <div class="col-xl-3">

            <div class="card bg-perfil text-white">
                <a href="#" class="btn btn-outline-info">
                    <img src="{{ asset('img\mutante\mut1/carta-v1.png') }}" alt="Profile" class=""><br><br>
                    <img src="{{ asset('img/smopin.png') }}" alt="Profile" class="">
                    <i class="bi bi-cart3"></i> 100
                </a>
                <div class="card-body profile-card d-flex flex-column align-items-center">
                    <h2>March-T </h2>
                    <spam>Elemental mutante de ataque cuerpo a cuerpo, parece adorable pero puede envestir a sus victimas con su poderoso cuerno</spam>
                </div>
            </div>

        </div>
        <div class="col-xl-3">

            <div class="card bg-perfil text-white">
                <a href="#" class="btn btn-outline-info">
                    <img src="{{ asset('img\mutante\mut1/carta-v1.png') }}" alt="Profile" class=""><br><br>
                    <img src="{{ asset('img/smopin.png') }}" alt="Profile" class="">
                    <i class="bi bi-cart3"></i> 100
                </a>
                <div class="card-body profile-card d-flex flex-column align-items-center">
                    <h2>March-T </h2>
                    <spam>Elemental mutante de ataque cuerpo a cuerpo, parece adorable pero puede envestir a sus victimas con su poderoso cuerno</spam>
                </div>
            </div>

        </div>
    </div>
    <!--  Inicio del modal  -->
    <div class="modal fade" id="MutanteModal" tabindex="-1" aria-labelledby="MutanteModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Comprar Mutante</h1>
            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
          </div>
          <div class="modal-body">
            @if ($usuario->esmopins >= 100)
            <form action="{{ route('compMutante') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="container">
                  <div class="row">
                      <div class="col">
                          <img id="valorImg" src="" alt="Profile" class="">
                      </div>
                      <div class="col">
                          <div class="mb-3">
                              <span>¡Ponle un nombre a tu mutante!</span>
                          </div>
                          <div class="mb-3">
                              <label for="nombreM" class="col-form-label">Nombre:</label>
                              <input type="text" class="form-control" id="nombreM" name="nombreM" required>
                              <input type="hidden" name="id" value="{{ session('usuario')  }}">
                              <input type="hidden" name="especie" id="especieF" value="">
                              <input type="hidden" name="saludMax" id="saludF" value="">
                              <input type="hidden" name="energiaMax" id="energiaF" value="">
                              <input type="hidden" name="cargaTurno" id="cargaF" value="">
                              <input type="hidden" name="apariencia" id="aparienciaF" value="">

                              <input type="hidden" name="at1" id="at1F" value="">
                              <input type="hidden" name="at2" id="at2F" value="">
                              <input type="hidden" name="at3" id="at3F" value="">
                              <input type="hidden" name="at4" id="at4F" value="">
                          </div>
                          <div class="mb-3">
                              <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="modal"><i class="bi bi-cart3"></i> Comprar</button>
                          </div>
                      </div>
                  </div>
              </div>
            </form>
            @else
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img id="valorImg" src="" alt="Profile" class="">
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <span>Al parecer no tienes suficientes smopins para comprar este mutante</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <span>cantidad actual:</span>
                        </div>
                        <div class="mb-3">
                            <img src="{{ asset('img/smopin.png') }}" alt="Profile" class=""> <span>{{ $usuario->esmopins }}</span>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </section>
    <!--  modal para modificar -->
  </main><!-- End #main -->
  <!-- ====== js archivos locales ====== -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
        // Cuando se hace clic en el botón, obtenemos el valor del atributo data y lo mostramos en el modal
        $('a[data-bs-target="#MutanteModal"]').click(function() {
            var valorImg = $(this).data('mi-img');

            $('#valorImg').attr('src', valorImg);
            $('#especieF'       ).val($(this).data('mi-especie'));
            $('#saludF'         ).val($(this).data('mi-salud'));
            $('#energiaF'       ).val($(this).data('mi-energia'));
            $('#cargaF'         ).val($(this).data('mi-carga'));
            $('#aparienciaF'    ).val($(this).data('mi-apariencia'));

            $('#at1F'    ).val($(this).data('mi-at1'));
            $('#at2F'    ).val($(this).data('mi-at2'));
            $('#at3F'    ).val($(this).data('mi-at3'));
            $('#at4F'    ).val($(this).data('mi-at4'));
        });
    });
  </script>
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- ======== js archivos web ======== -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>
