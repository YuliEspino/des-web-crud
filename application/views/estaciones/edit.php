<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estación de Juego</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control {
            border-radius: 0.25rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="title">Editar Estación de Juego</h2>
        <?php echo form_open('estaciones/update/' . $estacion['ID']); ?>
            <div class="form-group">
                <label for="descripcion_estacion">Descripción de la Estación</label>
                <input type="text" name="descripcion_estacion" class="form-control" placeholder="Descripción de la Estación" value="<?php echo set_value('descripcion_estacion', $estacion['DESCRIPCION_ESTACION']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tarifa">Tarifa</label>
                <input type="number" step="0.01" name="tarifa" id="tarifa" class="form-control" placeholder="Tarifa" value="<?php echo set_value('tarifa', $estacion['TARIFA']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="nombre_cliente">Nombre del Cliente</label>
                <input type="text" name="nombre_cliente" class="form-control" placeholder="Nombre del Cliente" value="<?php echo set_value('nombre_cliente', $estacion['NOMBRE_CLIENTE']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tiempo_solicitado">Tiempo Solicitado (minutos)</label>
                <input type="number" name="tiempo_solicitado" id="tiempo_solicitado" class="form-control" placeholder="Tiempo Solicitado" value="<?php echo set_value('tiempo_solicitado', $estacion['TIEMPO_SOLICITADO']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gamertag">GamerTag</label>
                <input type="text" name="gamertag" class="form-control" placeholder="GamerTag" value="<?php echo set_value('gamertag', $estacion['GAMERTAG']); ?>" required>
            </div>
            <div class="form-group">
                <label for="estatus_pago">Estatus de Pago</label>
                <input type="text" name="estatus_pago" class="form-control" placeholder="Estatus de Pago" value="<?php echo set_value('estatus_pago', $estacion['ESTATUS_PAGO']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_utilizacion">Fecha de Utilización</label>
                <input type="date" name="fecha_utilizacion" class="form-control" value="<?php echo set_value('fecha_utilizacion', $estacion['FECHA_UTILIZACION']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <script>
        function actualizarTarifa() {
            const tiempoSolicitado = document.getElementById('tiempo_solicitado').value;
            const tarifaPor30Minutos = 10;
            const minutosPor30 = 30;
            const tarifa = (Math.ceil(tiempoSolicitado / minutosPor30) * tarifaPor30Minutos).toFixed(2);
            document.getElementById('tarifa').value = tarifa;
        }
        document.getElementById('tiempo_solicitado').addEventListener('input', actualizarTarifa);
        window.onload = actualizarTarifa;
    </script>
</body>
</html>
