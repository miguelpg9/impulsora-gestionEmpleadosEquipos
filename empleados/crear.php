<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Agregar Empleado</title>
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
                <h2 class="fw-bold text-success">Agregar Nuevo Empleado</h2>
                <button class="btn btn-outline-secondary" onclick="confirmarSalir()">Volver a la lista de Empleados</button>
            </div>

            <form class="mx-auto" >
                <div style="max-width: 50%;">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoPaterno" class="form-label fw-semibold">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoMaterno" class="form-label fw-semibold">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label fw-semibold">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-4">
                        <label for="departamento" class="form-label fw-semibold">Departamento</label>
                        <select class="form-select" id="departamento" name="departamento" required>
                            <option selected disabled>Selecciona una opción</option>
                            <option value="1">Sistemas</option>
                            <option value="2">Recursos Humanos</option>
                            <option value="3">Contabilidad</option>
                            <option value="4">Ventas</option>
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