<!DOCTYPE html>
<html lang="en">

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
@php $panel = 3; @endphp

  <!-- ================================================= inicio del Header ======================================================== -->
  @include('const_header', ['usuario' => $usuario])

  <!-- ================================================= Inicio del Sidebar ======================================================= -->
  @include('const_sidebar', ['usuario' => $usuario, 'p' => $panel])

  <!-- ========================================= Inicio de la interfaz principal ================================================== -->
  <main id="main" class="main">
    <section class="section profile">
    <!-- Contenido adicional aquí -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card bg-perfil text-white">
                <div class="card-body profile-card pt-3 d-flex flex-column align-items-end">
                    <div class="social-links mt-2">
                        <a type="button" class="twitter" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-gear"></i></a>

                        <!--  Inicio del modal  -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar usuario</h1>
                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                              </div>
                              <div class="modal-body">
                                <form action="{{ route('modificar', session('usuario')) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-xl-4">
                                            @if (!$usuario->foto) <img id="imagenPrevisualizacion" src="{{ asset('img/usuario_perfil.jpg') }}" alt="Profile" class="rounded-circle img-perfil" width="120px" height="120px">
                                            @else <img id="imagenPrevisualizacion" src="{{ asset('img/usuarios/'.$usuario->foto) }}" alt="Profile" class="rounded-circle img-perfil">
                                            @endif
                                            <label for="foto" class="col-form-label">Imagen <br>(120 x 120 px):</label>
                                            <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="mb-3">
                                                <label for="nombre" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="modal">Modificar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                    </div>
                </div>
                <div class="card-body profile-card d-flex flex-column align-items-center">
                    @if (!$usuario->foto) <img src="{{ asset('img/usuario_perfil.jpg') }}" alt="Profile" class="rounded-circle" width="120px" height="120px">
                    @else <img src="{{ asset('img/usuarios/'.$usuario->foto) }}" alt="Profile" class="rounded-circle img-perfil">
                    @endif
                    <h2>{{ $usuario->nombre }}</h2>
                    <h3>nivel {{ $usuario->nivel }}</h3>
                    <img src="{{ asset('img/nivel/0.png') }}" alt="Profile" class="">
                    <div class="social-links mt-2">
                        <a href="#" class="twitter"><i class="bi bi-house-door-fill"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-person-plus-fill"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-gift-fill"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-chat-left-dots-fill"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!--  modal para modificar -->
  </main><!-- End #main -->
  <!-- ====== js archivos locales ====== -->
  <script >
  const $seleccionArchivos = document.querySelector("#foto"),
    $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

  // Escuchar cuando cambie
  $seleccionArchivos.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = $seleccionArchivos.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
      $imagenPrevisualizacion.src = "";
      return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imagenPrevisualizacion.src = objectURL;
  });
  </script>
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- ======== js archivos web ======== -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>
