<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registrarse</title>
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
<body class="bg-dark">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Byte Mutants</span>
                </a>
              </div><!-- End Logo -->

              <div class=" card mb-3">

                <div class="card-body bg-trc-oscuro text-light">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Registrate y empieza a contruir tu parcela!!!</h5>
                    <p class="text-center small">Ingresa un apodo y una contraseña para iniciar</p>
                  </div>

                  <form class="row g-3 needs-validation" action="{{ route('registrar') }}" method="post">
                  @csrf
                    <div class="col-12">
                      <label for="nombre" class="form-label">Nombre</label>
                      <input type="text" name="nombre" class="form-control bg-dark text-light" id="nombre" required>
                      <div class="form-text text-light">El anonimato es una virtud de internet!</div>
                    </div>

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="correo" class="form-control bg-dark text-light" id="correo" required>
                      <div class="form-text text-light">Por si olvidas tu contraseña</div>
                    </div>

                    <div class="col-12">
                      <label for="pass" class="form-label">Constraseña</label>
                      <input type="password" name="pass" class="form-control bg-dark text-light" id="pass" required>
                      <div class="form-text text-light">Ingresa una contraseña!</div>
                    </div>

                    <div class="col-12">
                      <label for="passConf" class="form-label">Confirmar constraseña</label>
                      <input type="password" name="passConf" class="form-control bg-dark text-light" id="passConf" required>
                      <div class="form-text text-light">Ingresa la misma contraseña!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">¡Crear usuario!</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">¿Ya tienes una cuenta? <a href="{{ route('loguear') }}"> Inicia sesión aqui</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Creado con <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
<!-- ====== js archivos locales ====== -->
<script src="{{ asset('js/main.js') }}"></script>

<!-- ======== js archivos web ======== -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>
