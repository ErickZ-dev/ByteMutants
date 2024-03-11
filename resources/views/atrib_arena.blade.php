<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-2">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Arena</title>
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
  @php $panel = 1; @endphp
  <!-- ================================================= inicio del Header ======================================================== -->
  @include('const_header', ['usuario' => $usuario])

  <!-- ================================================= Inicio del Sidebar ======================================================= -->
  @include('const_sidebar', ['usuario' => $usuario, 'p' => $panel])

  <!-- ========================================= Inicio de la interfaz principal ================================================== -->
  <main id="main" class="main">
    <section class="section dashboard">
    <!-- Contenido adicional aquí -->
        <div class="contenedorCanvas">
            <canvas data="{{ json_encode($mutantesSel) }}" tabindex="1"></canvas>
        </div>
        <div style="height: 200px;" class="d-flex justify-content-center">
            <div class="h-75 d-inline-block" style="width: 900px; background-color: rgba(0,0,255,.1)">
                <div class="card w-100 p-3" style="background-color: #134441;">
                    <div class="container">
<!-- ======================================================================================================================================================= -->
                        <div class="row">
                            <div class="col-md-2">
                                <div class="btn-group mr-2 d-flex pe-3" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-outline-info" id="btnIzquierda"><i class="bi bi-arrow-left-square"></i></button>
                                    <div class="btn-group-vertical">
                                        <button type="button" class="btn btn-outline-info" id="btnArriba"><i class="bi bi-arrow-up-square"></i></button>
                                        <button type="button" class="btn btn-outline-info" id="btnAbajo"><i class="bi bi-arrow-down-square"></i></button>
                                    </div>
                                    <button type="button" class="btn btn-outline-info" id="btnDerecha"><i class="bi bi-arrow-right-square"></i></button>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-info d-flex pe-0" id="id1">
                                    @if (isset($mutantesSel[0])) <img src="{{ asset('img/mutante/mut'.$mutantesSel[0]->apariencia.'/carta-v1-1.png') }}" alt="Profile" class="">
                                    @else                        <img src="{{ asset('img/mutante/x/carta-v1-1.png') }}" alt="Profile" class="">
                                    @endif
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-info d-flex pe-0" id="id2">
                                    @if (isset($mutantesSel[1])) <img src="{{ asset('img/mutante/mut'.$mutantesSel[1]->apariencia.'/carta-v1-1.png') }}" alt="Profile" class="">
                                    @else                        <img src="{{ asset('img/mutante/x/carta-v1-1.png') }}" alt="Profile" class="">
                                    @endif
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-info d-flex pe-0" id="id3">
                                    @if (isset($mutantesSel[2])) <img src="{{ asset('img/mutante/mut'.$mutantesSel[2]->apariencia.'/carta-v1-1.png') }}" alt="Profile" class="">
                                    @else                        <img src="{{ asset('img/mutante/x/carta-v1-1.png') }}" alt="Profile" class="">
                                    @endif
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-info d-flex pe-0" id="id4">
                                    @if (isset($mutantesSel[3])) <img src="{{ asset('img/mutante/mut'.$mutantesSel[3]->apariencia.'/carta-v1-1.png') }}" alt="Profile" class="">
                                    @else                        <img src="{{ asset('img/mutante/x/carta-v1-1.png') }}" alt="Profile" class="">
                                    @endif
                                </button>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-1 d-flex pe-3"></div>
                                    <div class="col-md-3">
                                        <img src="{{ asset('img/energia.png') }}" alt="Profile" class="">
                                        <span id="energia" class="badge badge-info"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{ asset('img/vida.png') }}" alt="Profile" class="">
                                        <span id="vida" class="badge badge-info"></span>

                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-info" id="btnRcargar"><i class="bi bi-escape"></i></button>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-1 d-flex pe-3"></div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-info" id="btnAtaque1"><img src="{{ asset('img/mutante/mut1/atque-v1-1.png') }}" alt="Profile"></button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-info" id="btnAtaque2"><img src="{{ asset('img/mutante/mut1/atque-v1-2.png') }}" alt="Profile"></button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-info active"><div style="width: 40px; height: 40px;"></button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-info active"><div style="width: 40px; height: 40px;"></div></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <p id="datoEnInterfaz">sdf</p>
            </div>
        </div>

    </section>
  </main><!-- End #main -->
  <!-- ====== js archivos locales ====== -->
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/juego.js') }}"></script>

  <!-- ======== js archivos web ======== -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>
  <!-- <div class="position-relative vh-100">
      <div class="d-flex justify-content-center h-70 bg-dark">
          <div class="position-absolute vh-100 d-flex align-items-center">
              <p>contenod relativo</p>
          </div>
      </div>
   </div>


   <div class="w-25 p-3" style="background-color: #eee;">Width 25%</div>
<div class="w-50 p-3" style="background-color: #eee;">Width 50%</div>
<div class="w-75 p-3" style="background-color: #eee;">Width 75%</div>
<div class="w-100 p-3" style="background-color: #eee;">Width 100%</div>
<div class="w-auto p-3" style="background-color: #eee;">Width auto</div>



<div style="height: 300px;" class="d-flex justify-content-center">
    <div class="h-100 d-inline-block" style="width: 120px; background-color: rgba(0,0,255,.1)">Height 25%</div>
    <div class="h-75 d-inline-block" style="width: 120px; background-color: rgba(0,0,255,.1)">Height 75%</div>
    <div class="h-100 d-inline-block" style="width: 120px; background-color: rgba(0,0,255,.1)">Height 100%</div>
</div>
<div class="d-flex justify-content-center">
    <img src="{{ asset('img/parcela/parcela-gc1.png') }}" alt="Profile" class="img-fluid full-screen-div">
</div>
<div style="height: 300px;" class="d-flex justify-content-center">
    <div class="d-flex justify-content-center">
        <img src="{{ asset('img/parcela/parcela-gc2.png') }}" alt="Profile" class="img-fluid full-screen-div">
    </div>
</div>


<div class="">
    <div class="d-flex justify-content-center">
        <img src="{{ asset('img/parcela/parcela-gc1.png') }}" alt="Profile" class="img-fluid full-screen-div">
    </div>
    <div style="height: 300px;" class="d-flex justify-content-center">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('img/parcela/parcela-gc2.png') }}" alt="Profile" class="img-fluid full-screen-div">
        </div>
    </div>
</div>

?php
    $divCont = 0;
    $acomodador = 223;
    for ($i=1; $i <= $usuario->parcelas; $i++) {
        if($i==1) echo '<img src="'.asset('img/parcela/parcela-gc1.png').'" alt="Profile" style="margin-left: '. 0 .'px; margin-top: 250px">';
        if($i%2==0) echo '<div class="position-absolute d-flex">
                            <img src="'.asset('img/parcela/parcela-gc2.png').'" alt="Profile" style="margin-left: '. -402 .'px; margin-top: 250px">';
        if($i==3) echo '<div class="position-absolute d-flex">
                            <img src="'.asset('img/parcela/parcela-gc3.png').'" alt="Profile" style="margin-left: '. 118 .'px; margin-top: 250px">';
    }
    for ($i=0; $i < ($usuario->parcelas-1); $i++) echo'</div>';
?



<div class="position-relative">
    <div class="d-flex justify-content-center">

        <img src="{{ asset('img/parcela/parcela-gc1.png') }}" alt="Profile" style="margin-left: 0px; margin-top: 250px">
        <div class="position-absolute d-flex">
            <img src="{{ asset('img/parcela/parcela-gc2.png') }}" alt="Profile" style="margin-left: -402px; margin-top: 250px">
            <div class="position-absolute d-flex">
                <img src="{{ asset('img/parcela/parcela-gc3.png') }}" alt="Profile" style="margin-left: 118px; margin-top: 250px">
            </div>
        </div>

    </div>
 </div>
 -->
