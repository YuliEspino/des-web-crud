<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Estación de Juego</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Agregar Estación de Juego</h2>
        <form action="<?= site_url('estaciones/store'); ?>" method="post">
            <div class="form-group">
                <label for="descripcion_estacion">Descripción de la Estación</label>
                <input type="text" name="descripcion_estacion" class="form-control" placeholder="Descripción de la Estación" required>
            </div>
            <div class="form-group">
                <label for="tarifa">Tarifa</label>
                <input type="text" name="tarifa" id="tarifa" class="form-control" placeholder="Tarifa" readonly>
            </div>

            <div class="form-group">
                <label for="nombre_cliente">Nombre del Cliente</label>
                <input type="text" name="nombre_cliente" class="form-control" placeholder="Nombre del Cliente" required>
            </div>
            <div class="form-group">
                <label for="tiempo_solicitado">Tiempo Solicitado (minutos)</label>
                <input type="number" name="tiempo_solicitado" id="tiempo_solicitado" class="form-control" placeholder="Tiempo Solicitado" required>
            </div>
            <div class="form-group">
                <label for="gamertag">GamerTag</label>
                <input type="text" name="gamertag" class="form-control" placeholder="GamerTag" required>
            </div>
            <div class="form-group">
                <label for="estatus_pago">Estatus de Pago</label>
                <input type="text" name="estatus_pago" class="form-control" placeholder="Estatus de Pago" required>
            </div>
            <div class="form-group">
                <label for="fecha_utilizacion">Fecha de Utilización</label>
                <input type="date" name="fecha_utilizacion" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script>
        function calcularTarifa() {
            var tiempo = document.getElementById('tiempo_solicitado').value;
            var tarifa = document.getElementById('tarifa');
            if (tiempo) {
                var minutos = parseInt(tiempo, 10);
                var costo = Math.ceil(minutos / 30) * 10;
                tarifa.value = costo;
            } else {
                tarifa.value = '';
            }
        }
        document.getElementById('tiempo_solicitado').addEventListener('input', calcularTarifa);
    </script>
</body>
</html>
