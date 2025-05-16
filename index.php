<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Sistema de Gestión</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <header class="bg-light py-3 px-4 shadow-sm fixed-top">
      <div class="container-fluid">
        <div class="header-title">
          <span class="grupo">Grupo</span> <span class="impulsora">Impulsora</span>
        </div>
      </div>
    </header>
    <main  class="d-flex justify-content-center align-items-center vh-100">
      <div class="container text-center">
        <h1 class="title fw-bold">Bienvenido al Sistema de Gestión de Empleados y Equipos</h1>
        <div class="row justify-content-center mt-5">
          <div class="col-12 col-md-6 col-lg-4 mb-4">
            <a href="empleados/listar.php" class="text-decoration-none text-dark">
              <div class="card card-option text-center p-4 bg-success">
                <div class="icon-box mx-auto mb-3">👥</div>
                <h4 class="card-title">Gestión de Empleados</h4>
              </div>
            </a>
          </div>
          <div class="col-12 col-md-6 col-lg-4 mb-4">
            <a href="equipos/listar.php" class="text-decoration-none text-dark">
              <div class="card card-option text-center p-4 bg-warning">
                <div class="icon-box mx-auto mb-3">💻</div>
                <h4 class="card-title">Gestión de Equipos</h4>
              </div>
            </a>
          </div>
        </div>
      </div>
    </main >
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
  </body>
</html>