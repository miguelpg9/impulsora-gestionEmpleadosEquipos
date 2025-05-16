<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Lista de Empleados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
    </head>
    <body>
        <header class="bg-light py-3 px-4 shadow-sm fixed-top">
            <div class="container-fluid">
            <div class="header-title">
                <span class="grupo">Grupo</span> <span class="impulsora">Impulsora</span>
            </div>
            </div>
        </header>
        <main class="container mt-5 pt-5 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-success">Lista de Empleados</h2>
                <a href="crear.php" class="btn btn-success">+ Agregar Empleado</a>
            </div>

            <div class="mb-3">
                <input type="text" id="buscarEmpleado" class="form-control" placeholder="Buscar por nombre..." onkeyup="filtrarTabla()">
            </div>

            <table class="table table-bordered table-hover shadow-sm" id="tablaEmpleados">
                <thead class="table-success">
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
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Miguel Pacheco</td>
                        <td>miguel@gmail.com</td>
                        <td>Sistemas</td>
                        <td>
                            <a href="editar.php?id=1" class="btn btn-sm btn-warning">Editar</a>
                            <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion(1)">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Melissa Willis</td>
                        <td>melissa@gmail.com</td>
                        <td>Linux</td>
                        <td>
                            <a href="editar.php?id=2" class="btn btn-sm btn-warning">Editar</a>
                            <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion(2)">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-4">
                <a href="../index.php" class="btn btn-success">Regresar inicio</a>
            </div>
        </main>

        <script>
            function confirmarEliminacion(id) {
                Swal.fire({
                    title: '¿Eliminar empleado?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    confirmButtonColor: "#00A44D",
                    cancelButtonColor: "#d33",
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'eliminar.php?id=' + id;
                    }
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
            }
        </script>
    </body>
</html>