<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Equipos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <script src="../assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
    </head>
    <body>
        <header class="bg-light py-3 px-4 shadow-sm">
            <div class="container-fluid">
                <div class="header-title">
                    <span class="grupo">Grupo</span> <span class="impulsora">Impulsora</span>
                </div>
            </div>
        </header>
        <main class="container mt-5 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-success">Lista de Equipos</h2>
                <a href="crear.php" class="btn btn-success">+ Agregar Equipo</a>
            </div>

            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-success">
                    <tr>
                    <th>ID</th>
                    <th>Nombre Equipo</th>
                    <th>Tipo</th>
                    <th>Serie</th>
                    <th>Empleado Asignado</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Lenovo</td>
                        <td>LapTop</td>
                        <td>12345</td>
                        <td>Miguel Pacheco</td>
                        <td>
                            <a href="editar.php?id=1" class="btn btn-sm btn-warning">Editar</a>
                            <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion(1)">Eliminar</button>
                        </td>
                    </tr>
                        <tr>
                        <td>2</td>
                        <td>MAC</td>
                        <td>PC Escritorio</td>
                        <td>67890</td>
                        <td>Melissa Willis</td>
                        <td>
                            <a href="editar.php?id=2" class="btn btn-sm btn-warning">Editar</a>
                            <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion(2)">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end  mt-4">
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
        </script>
    </body>
</html>