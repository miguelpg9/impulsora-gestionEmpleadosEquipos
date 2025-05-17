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
    <header class="bg-light py-3 px-4 shadow-sm">
      <div class="container-fluid">
        <div class="header-title">
            <span class="grupo text-warning">Grupo</span> <span class="impulsora text-success">Impulsora</span>
        </span>
      </div>
    </header>

    <div class="container mt-5">
      <div id="opciones" class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 mb-4" onclick="mostrarTabla('empleados')">
          <div class="card card-option text-center p-4 bg-success">
            <div class="icon-box mx-auto mb-3">👥</div>
            <h4 class="card-title">Gestión de Empleados</h4>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4" onclick="mostrarTabla('equipos')">
          <div class="card card-option text-center p-4 bg-warning">
            <div class="icon-box mx-auto mb-3">💻</div>
            <h4 class="card-title">Gestión de Equipos</h4>
          </div>
        </div>
      </div>

      <div id="tablaContenido" class="mt-5 motrarTabla">
        <div class="d-flex justify-content-between mb-3">
          <h2 id="tituloTabla" class="fw-bold text-success"></h2>
          <button class="btn btn-success" onclick="inicio()">Volver</button>
        </div>
        <table class="table table-bordered table-hover">
          <thead id="tablaHead" class="table-success"></thead>
          <tbody id="tablaBody"></tbody>
        </table>
        <div id="paginador" class="text-center mt-3"></div>
      </div>
    </div>

    <script>
      function inicio() {
        document.getElementById('tablaContenido').classList.add('motrarTabla');
        document.getElementById('opciones').classList.remove('motrarTabla');
      }

      function mostrarTabla(tipo) {
        document.getElementById('opciones').classList.add('motrarTabla');
        document.getElementById('tablaContenido').classList.remove('motrarTabla');

        const titulo = document.getElementById('tituloTabla');
        const tablaHead = document.getElementById('tablaHead');

        if (tipo === 'empleados') {
          titulo.textContent = 'Lista de Empleados';
          tablaHead.innerHTML = `
            <tr>
              <th>
                ID
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar ID" onkeyup="filtrarTabla(0, this.value)">
              </th>
              <th>
                Nombre
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar nombre" onkeyup="filtrarTabla(1, this.value)">
              </th>
              <th>
                Correo
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar correo" onkeyup="filtrarTabla(2, this.value)">
              </th>
              <th>
                Departamento
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar depto." onkeyup="filtrarTabla(3, this.value)">
              </th>
              <th>Acciones</th>
            </tr>
          `;
          cargarEmpleados();
        } else if (tipo === 'equipos') {
          titulo.textContent = 'Lista de Equipos';
          tablaHead.innerHTML = `
            <tr>
              <th>
                ID
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar ID" onkeyup="filtrarTabla(0, this.value)">
              </th>
              <th>
                Nombre Equipo
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar Nombre Equipo" onkeyup="filtrarTabla(1, this.value)">
              </th>
              <th>
                Tipo
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar Tipo" onkeyup="filtrarTabla(2, this.value)">
              </th>
              <th>
                Serie
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar Serie" onkeyup="filtrarTabla(3, this.value)">
              </th>
              <th>
                Empleado Asignado
                <input type="text" class="form-control form-control-sm mt-1" placeholder="Buscar Empleado" onkeyup="filtrarTabla(4, this.value)">
              </th>
              <th>Acciones</th>
            </tr>
          `;
          cargarEquipos();
        }
      }

      function cargarEmpleados() {
        fetch('empleados/listar.php')
          .then(response => response.json())
          .then(data => {
            const empleados = document.getElementById('tablaBody');
            empleados.innerHTML = '';

            data.forEach(e => {
              const fila = `
                <tr>
                  <td>${e.idEmpleado}</td>
                  <td>${e.nombreEmpleado}</td>
                  <td>${e.correo}</td>
                  <td>${e.nombreDepartamento}</td>
                  <td>
                    <a href="editar.php?id=2" class="btn btn-sm btn-warning">Editar</a>
                    <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion(2)">Eliminar</button>
                  </td>
                </tr>`;
              empleados.innerHTML += fila;
            });
          })
        .catch(error => console.error('Error al cargar empleados:', error));
      }

      function cargarEquipos() {
        fetch('equipos/listar.php')
          .then(response => response.json())
          .then(data => {
            const empleados = document.getElementById('tablaBody');
            console.log(data)
            empleados.innerHTML = '';

            data.forEach(e => {
              const fila = `
                <tr>
                  <td>${e.idEquipo}</td>
                  <td>${e.nombreEquipo}</td>
                  <td>${e.nombreTipo}</td>
                  <td>${e.serie}</td>
                  <td>${e.responsable}</td>
                  <td>
                    <a href="editar.php?id=2" class="btn btn-sm btn-warning">Editar</a>
                    <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion(2)">Eliminar</button>
                  </td>
                </tr>`;
              empleados.innerHTML += fila;
            });
          })
        .catch(error => console.error('Error al cargar equipos:', error));
      }

      function filtrarTabla(columna, cadena) {
        cadena = cadena.toLowerCase();
        const filas = document.querySelectorAll("table tbody tr");

        filas.forEach(fila => {
            const celda = fila.cells[columna];
            const texto = celda.textContent.toLowerCase();
            fila.style.display = texto.includes(cadena) ? "" : "none";
        });
      }
    </script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>