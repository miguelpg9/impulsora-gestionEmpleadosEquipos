<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Agregar Equipo</title>
        <meta charset="UTF-8">
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
                <h2 class="fw-bold text-success">Agregar Nuevo Equipo</h2>
                <button class="btn btn-outline-secondary" onclick="confirmarSalir()">Volver a la lista de Equipos</button>
            </div>

            <form class="mx-auto" >
                <div style="max-width: 50%;">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold">Nombre Equipo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label fw-semibold">Tipo de Equipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="serie" class="form-label fw-semibold">Numero de Serie</label>
                        <input type="text" class="form-control" id="serie" name="serie" required>
                    </div>
                    <div class="mb-4">
                        <label for="empleadoAsignado" class="form-label fw-semibold">Empleado Asignado</label>
                        <select class="form-select" id="empleadoAsignado" name="empleadoAsignado" required>
                            <option selected disabled>Selecciona una opción</option>
                            <option value="1">Miguel</option>
                            <option value="2">Melissa</option>
                            <option value="3">Pedro</option>
                            <option value="4">Ana</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Guardar Empleado</button>
                </div> 
            </form>
        </main>

        <script>
            function confirmarSalir() {
                Swal.fire({
                    title: '¿Estas seguro de salir sin guardar los cambios?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: "#00A44D",
                    cancelButtonColor: "#d33",
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'listar.php';
                    }
                });
            }
        </script>
    </body>
</html>