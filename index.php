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
    <!-- Header -->
    <header class="bg-light py-3 px-4 shadow-sm">
      <div class="container-fluid">
        <div class="header-title">
            <span class="grupo text-warning">Grupo</span> <span class="impulsora text-success">Impulsora</span>
        </span>
      </div>
    </header>

    <!-- Inicio -->
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

      <!-- Formulario Empleado -->
      <div id="formEmpleado" class="card p-4 mb-4 d-none">
        <h5>Nuevo Empleado</h5>
        <form id="formAltaEmpleado">
          <input name="nombreEmpleado" class="form-control mb-2" placeholder="Nombre" required>
          <input name="apellidoPaterno" class="form-control mb-2" placeholder="Apellido Paterno">
          <input name="apellidoMaterno" class="form-control mb-2" placeholder="Apellido Materno">
          <input name="correo" class="form-control mb-2" type="email" placeholder="Correo" required>
          <select name="idDepartamento" class="form-control mb-2" required></select>
          <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>

      <!-- Formulario Equipo -->
      <div id="formEquipo" class="card p-4 mb-4 d-none">
        <h5>Nuevo Equipo</h5>
        <form id="formAltaEquipo">
          <input name="nombreEquipo" class="form-control mb-2" placeholder="Nombre del equipo" required>
          <input name="serie" class="form-control mb-2" placeholder="Serie" required>
          <select name="idTipo" class="form-control mb-2" required></select>
          <select name="responsableId" class="form-control mb-2" required></select>
          <button type="submit" class="btn btn-warning">Guardar</button>
        </form>
      </div>

      <!-- Tabla -->
      <div id="tablaContenido" class="mt-5 d-none">
        <div class="d-flex justify-content-between mb-3">
          <h2 id="tituloTabla" class="fw-bold text-success"></h2>
          <div>
            <button class="btn btn-warning" id="botonAlta" ></button>
            <button class="btn btn-success" onclick="inicio()">Volver</button>
          </div>
        </div>
        <div class="table-responsive">
          <table class=" table table-bordered table-hover">
            <thead id="tablaHead" class="table-success"></thead>
            <tbody id="tablaBody"></tbody>
          </table>
          <div id="paginacion" class="d-flex justify-content-center mt-3"></div>
        </div>
      </div>

    </div>

    <script>
      let tipoActual = null;
      let filasPorPagina = 5
      let paginaActual = 1;
      let modoEdicionEmpleado = false;
      let modoEdicionEquipo = false;
      let idEquipoActual = null;
      let idEmpleadoActual = null;

      function inicio() {
        document.getElementById('tablaContenido').classList.add('d-none');
        document.getElementById('formEquipo').classList.add('d-none');
        document.getElementById('formEmpleado').classList.add('d-none');
        document.getElementById('opciones').classList.remove('d-none');
      }

      function mostrarTabla(tipo) {
        tipoActual = tipo;
        document.getElementById('opciones').classList.add('d-none');
        document.getElementById('tablaContenido').classList.remove('d-none');

        const titulo = document.getElementById('tituloTabla');
        const tablaHead = document.getElementById('tablaHead');
        const botonAlta = document.getElementById('botonAlta');

        if (tipo === 'empleados') {
          botonAlta.innerHTML = "+ Empleado";
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
          botonAlta.innerHTML = "+ Equipo";
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
        document.getElementById('formEmpleado').classList.add('d-none');
        document.getElementById('formEquipo').classList.add('d-none');
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
                  <td class="td-nombreEmpleado">${e.nombreEmpleado}</td>
                  <td class="td-correo">${e.correo}</td>
                  <td class="td-departamento">${e.nombreDepartamento}</td>
                  <td>
                    <button class="btn btn-sm btn-warning editar-empleado" data-id="${e.idEmpleado}">Editar</button>
                    <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion('empleado', ${e.idEmpleado})">Eliminar</button>
                  </td>
                </tr>`;
              empleados.innerHTML += fila;
            });
            mostrarPaginacion();
          })
        .catch(err => {
          Swal.fire('Error', 'Error al consultar el listado de empleados', 'error');
        });
      }

      function cargarEquipos() {
        fetch('equipos/listar.php')
          .then(response => response.json())
          .then(data => {
            const empleados = document.getElementById('tablaBody');
            empleados.innerHTML = '';

            data.forEach(e => {
              const fila = `
                <tr>
                  <td>${e.idEquipo}</td>
                  <td class="td-nombre">${e.nombreEquipo}</td>
                  <td class="td-tipo">${e.nombreTipo}</td>
                  <td class="td-serie">${e.serie}</td>
                  <td class="td-responsable">${e.responsable}</td>
                  <td>
                    <button class="btn btn-sm btn-warning editar-equipo" data-id="${e.idEquipo}">Editar</button>
                    <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion('equipo', ${e.idEquipo})">Eliminar</button>
                  </td>
                </tr>`;
              empleados.innerHTML += fila;
            });
            mostrarPaginacion();
          })
        .catch(err => {
          Swal.fire('Error', 'Error al consultar el listado de equipos', 'error');
        });
      }

      function eliminarEmpleado(id){
        fetch('empleados/eliminar.php?id=' + id, {
          method: 'DELETE'
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Confirmación', data.mensaje, 'success');
            cargarEmpleados();
          } else {
            Swal.fire('Error', data.mensaje, 'error');
          }
        })
        .catch(err => {
          Swal.fire('Error', 'No se pudo procesar la operación', 'error');
        });
      } 

      function eliminarEquipo(id){
        fetch('equipos/eliminar.php?id=' + id, {
          method: 'DELETE'
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Confirmación', data.mensaje, 'success');
            cargarEquipos();
          } else {
            Swal.fire('Error', data.mensaje, 'error');
          }
        })
        .catch(err => {
          Swal.fire('Error', 'No se pudo procesar la operación', 'error');
        });
      } 

      function filtrarTabla(columna, cadena) {
        cadena = cadena.toLowerCase();
        const filas = document.querySelectorAll("table tbody tr");

        filas.forEach(fila => {
            const celda = fila.cells[columna];
            const texto = celda.textContent.toLowerCase();
            fila.style.display = texto.includes(cadena) ? "" : "none";
        });
        paginaActual = 1;
        mostrarPaginacion();
      }

      function confirmarEliminacion(tipo,id) {
        Swal.fire({
          title: `¿Desea eliminar el ${tipo} con id ${id}?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, eliminar',
          confirmButtonColor: "#00A44D",
          cancelButtonColor: "#d33",
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            if(tipo == 'empleado'){
              eliminarEmpleado(id);
            }else{
              eliminarEquipo(id);
            }
          }
        });
      }

      function mostrarFormulario(tipo) {
        if (tipo === 'empleados') {
          document.getElementById('formEmpleado').classList.remove('d-none');
          cargarDepartamentos();
        } else {
          document.getElementById('formEquipo').classList.remove('d-none');
          cargarTipos();
          cargarEmpleadosSelect();
        }
      }

      function cargarDepartamentos() {
        fetch('departamentos/listar.php')
          .then(res => res.json())
          .then(data => {
            const select = document.querySelector('[name="idDepartamento"]');
            select.innerHTML = '<option value="">Seleccione</option>';
            data.forEach(d => {
              select.innerHTML += `<option value="${d.idDepartamento}">${d.nombreDepartamento}</option>`;
            });
          });
      }

      function cargarTipos() {
        fetch('tipoEquipo/listar.php')
          .then(res => res.json())
          .then(data => {
            const select = document.querySelector('[name="idTipo"]');
            select.innerHTML = '<option value="">Seleccione</option>';
            data.forEach(t => {
              select.innerHTML += `<option value="${t.idTipo}">${t.nombreTipo}</option>`;
            });
          });
      }

      function cargarEmpleadosSelect() {
        fetch('empleados/listar.php')
          .then(res => res.json())
          .then(data => {
            const select = document.querySelector('[name="responsableId"]');
            select.innerHTML = '<option value="">Seleccione</option>';
            data.forEach(e => {
              select.innerHTML += `<option value="${e.idEmpleado}">${e.nombreEmpleado}</option>`;
            });
          });
      }

      document.getElementById('formAltaEmpleado').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        let url = "empleados/crear.php";
        if (modoEdicionEmpleado && idEmpleadoActual) {
          url = "empleados/editar.php";
          formData.append("idEmpleado", idEmpleadoActual);
        }

        fetch(url, {
          method: "POST",
          body: formData
        })
          .then(res => res.json())
          .then(data => {
            if(!data.success){
              Swal.fire("Advertencia", data.mensaje, "warning");
            } else {
              Swal.fire("Éxito", data.mensaje, "success");
              this.reset();
              document.getElementById("formEmpleado").classList.add("d-none");
              modoEdicionEmpleado = false;
              idEmpleadoActual = null;
              document.querySelector("#formEmpleado .btn").textContent = "Guardar";
              cargarEmpleados();
            }
            
          })
          .catch(error => {
            console.error("Error:", error);
            Swal.fire("Error", "No se pudo procesar", "error");
          });
      });

      document.addEventListener("click", function (e) {
        if (e.target.classList.contains("editar-empleado")) {
          const btn = e.target;
          const fila = btn.closest("tr");

          const nombreEmpleado = fila.querySelector(".td-nombreEmpleado").textContent;
          const correo = fila.querySelector(".td-correo").textContent;
          const departamento = fila.querySelector(".td-departamento").textContent;
          const id = btn.getAttribute("data-id");

          mostrarFormulario('empleados');

          setTimeout(() => {
            document.getElementById("formAltaEmpleado").nombreEmpleado.value = nombreEmpleado;
            document.getElementById("formAltaEmpleado").nombreEmpleado.disabled = true;
            document.getElementById("formAltaEmpleado").apellidoPaterno.hidden = true;
            document.getElementById("formAltaEmpleado").apellidoMaterno.hidden = true;
            document.getElementById("formAltaEmpleado").correo.value = correo;
            document.querySelector('[name="idDepartamento"]').value = obtenerIdPorTexto('[name="idDepartamento"]', departamento);

            modoEdicionEmpleado = true;
            idEmpleadoActual = id;
            document.querySelector("#formEmpleado .btn").textContent = "Actualizar";
          }, 100);
        }
      });

      document.getElementById("formAltaEquipo").addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        let url = "equipos/crear.php";
        if (modoEdicionEquipo && idEquipoActual) {
          url = "equipos/editar.php";
          formData.append("idEquipo", idEquipoActual);
        }

        fetch(url, {
          method: "POST",
          body: formData
        })
          .then(res => res.json())
          .then(data => {
            Swal.fire("Éxito", data.mensaje, "success");
            this.reset();
            document.getElementById("formEquipo").classList.add("d-none");

            modoEdicionEquipo = false;
            idEquipoActual = null;
            document.querySelector("#formEquipo .btn").textContent = "Guardar";

            cargarEquipos();
          })
          .catch(error => {
            console.error("Error:", error);
            Swal.fire("Error", "No se pudo procesar", "error");
          });
      });

      document.addEventListener("click", function (e) {
        if (e.target.classList.contains("editar-equipo")) {
          const btn = e.target;
          const fila = btn.closest("tr");

          const nombreEquipo = fila.querySelector(".td-nombre").textContent;
          const serie = fila.querySelector(".td-serie").textContent;
          const tipoNombre = fila.querySelector(".td-tipo").textContent;
          const responsableNombre = fila.querySelector(".td-responsable").textContent;
          const id = btn.getAttribute("data-id");

          mostrarFormulario('equipos');

          setTimeout(() => {
            document.getElementById("formAltaEquipo").nombreEquipo.value = nombreEquipo;
            document.getElementById("formAltaEquipo").serie.value = serie;
            document.querySelector('[name="idTipo"]').value = obtenerIdPorTexto('[name="idTipo"]', tipoNombre);
            document.querySelector('[name="responsableId"]').value = obtenerIdPorTexto('[name="responsableId"]', responsableNombre);

            modoEdicionEquipo = true;
            idEquipoActual = id;
            document.querySelector("#formEquipo .btn").textContent = "Actualizar";
          }, 300);
        }
      });

      function obtenerIdPorTexto(selector, texto) {
        const opciones = document.querySelectorAll(selector + " option");
        for (let opt of opciones) {
          if (opt.textContent === texto) return opt.value;
        }
        return "";
      }

      document.getElementById('botonAlta').addEventListener('click', () => {
        if (tipoActual === 'empleados') {
          mostrarFormulario('empleados');
          document.getElementById("formAltaEmpleado").nombreEmpleado.value = "";
          document.getElementById("formAltaEmpleado").nombreEmpleado.disabled = false;
          document.getElementById("formAltaEmpleado").apellidoPaterno.hidden = false;
          document.getElementById("formAltaEmpleado").apellidoMaterno.hidden = false;
          document.getElementById("formAltaEmpleado").correo.value = "";
          document.querySelector("#formEmpleado .btn").textContent = "Guardar";
        } else if (tipoActual === 'equipos') {
          mostrarFormulario('equipos');
          document.getElementById("formAltaEquipo").nombreEquipo.value = "";
          document.getElementById("formAltaEquipo").serie.value = "";
          document.querySelector('[name="idTipo"]').value = 0;
          document.querySelector('[name="responsableId"]').value = 0;
          document.querySelector("#formEquipo .btn").textContent = "Guardar";
        }
      });

      function mostrarPaginacion() {
        const filas = document.querySelectorAll('#tablaBody tr');
        const totalPaginas = Math.ceil(filas.length / filasPorPagina);
        const paginacion = document.getElementById('paginacion');
        paginacion.innerHTML = '';

        filas.forEach((fila, index) => {
          fila.style.display = (index >= (paginaActual - 1) * filasPorPagina && index < paginaActual * filasPorPagina) ? '' : 'none';
        });

        const crearBoton = (texto, pagina) => {
          const btn = document.createElement('button');
          btn.textContent = texto;
          btn.className = 'btn btn-sm mx-1 btn-outline-success';
          btn.onclick = () => {
            paginaActual = pagina;
            mostrarPaginacion();
          };
          return btn;
        };

        if (paginaActual > 1) {
          paginacion.appendChild(crearBoton('Anterior', paginaActual - 1));
        }

        for (let i = 1; i <= totalPaginas; i++) {
          const btn = crearBoton(i, i);
          if (i === paginaActual) {
            btn.classList.add('active', 'btn-success');
          }
          paginacion.appendChild(btn);
        }

        if (paginaActual < totalPaginas) {
          paginacion.appendChild(crearBoton('Siguiente', paginaActual + 1));
        }
      }
    </script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
  </body>
</html>