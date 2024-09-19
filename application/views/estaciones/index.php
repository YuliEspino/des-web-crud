<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estaciones de Juego</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos existentes */
        .container {
            margin-top: 50px;
        }
        .btn-add {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            position: fixed;
            bottom: 20px;
            right: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: none;
        }
        .btn-add:hover {
            background-color: #0056b3;
        }
        .title {
            text-align: center;
            font-size: 3rem;
            font-weight: 700;
            color: #007bff;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
            margin-bottom: 40px;
            position: relative;
        }
        .title::before {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 150px;
            height: 5px;
            background: linear-gradient(to right, #007bff, #00d4ff);
            border-radius: 5px;
        }
        .card {
            background-color: #2b2e31;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .card-title {
            color: #00d4ff;
        }
        .card-text {
            color: #bfbfbf;
        }
        .badge-success {
            background-color: #28a745;
            font-size: 1.1rem;
        }
        .badge-danger {
            background-color: #dc3545;
            font-size: 1.1rem;
        }
        .btn-warning, .btn-danger, .btn-primary {
            margin-top: 10px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 10px 20px;
        }
        .btn-warning {
            background-color: #ffb236;
            border-color: #ffb236;
        }
        .btn-danger {
            background-color: #ff5b5b;
            border-color: #ff5b5b;
        }
        .btn-primary {
            background-color: #0099ff;
            border-color: #0099ff;
        }
        .timer {
            font-size: 2.5rem;
            font-weight: bold;
            color: #00d4ff;
            margin-top: 1px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .btn-controls {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        .btn-controls button {
            background-color: #333;
            border: none;
            color: white;
            font-size: 1.5rem;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-controls button:hover {
            background-color: #444;
        }
        .btn-controls .fa-pause { color: #ffeb3b; }
        .btn-controls .fa-stop { color: #f44336; }
        .btn-controls .fa-redo { color: #4caf50; }
        /* Estilos para los botones de añadir tiempo */
        .btn-time-adjust {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        .btn-time-adjust button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 5px 15px;
            margin: 0 5px;
            border-radius: 20px;
            cursor: pointer;
        }
        .btn-time-adjust button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="title">Geek Universe</h1>
    <a href="<?= site_url('estaciones/create'); ?>" class="btn-add">
        <i class="fas fa-plus"></i>
    </a>

    <div class="row">
        <?php foreach ($estaciones as $estacion): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://img.freepik.com/premium-photo/video-game-controller-with-number-3-it_83925-6056.jpg" class="card-img-top" alt="Video Game Controller" style="border-radius: 10px 10px 0 0;">
                    <div class="card-body">
                        <h5 class="card-title">Estación <?= $estacion['ID']; ?></h5>
                        <p class="card-text">Cliente: <?= $estacion['NOMBRE_CLIENTE']; ?></p>
                        <p class="card-text">GamerTag: <?= $estacion['GAMERTAG']; ?></p>
                        <p class="card-text">Tiempo Solicitado: <span id="tiempo-solicitado-<?= $estacion['ID']; ?>"><?= $estacion['TIEMPO_SOLICITADO']; ?></span> minutos</p>
                        <p class="card-text">Fecha de Utilización: <?= $estacion['FECHA_UTILIZACION']; ?></p>
                        <p class="card-text">Tarifa: Q<?= $estacion['TARIFA']; ?></p>
                        
                        <p class="card-text">
                            Estatus de Pago: 
                            <span class="badge <?= $estacion['ESTATUS_PAGO'] == 'Pagado' ? 'badge-success' : 'badge-danger'; ?>">
                                <?= $estacion['ESTATUS_PAGO']; ?>
                            </span>
                        </p>W
                    
                        <p class="timer" id="timer-<?= $estacion['ID']; ?>">00:00:00</p>

                        <!-- Botones para ajustar tiempo -->
                        <div class="btn-time-adjust">
                            <button onclick="adjustTime(<?= $estacion['ID']; ?>, 10)">10+</button>
                            <button onclick="adjustTime(<?= $estacion['ID']; ?>, 30)">30+</button>
                            <button onclick="adjustTime(<?= $estacion['ID']; ?>, 60)">60+</button>
                        </div>

                        <!-- Botones de control del temporizador -->
                        <div class="btn-controls">
                            <button id="pause-<?= $estacion['ID']; ?>" class="btn-control">
                                <i class="fas fa-pause"></i>
                            </button>
                            <button id="stop-<?= $estacion['ID']; ?>" class="btn-control">
                                <i class="fas fa-stop"></i>
                            </button>
                            <button id="reset-<?= $estacion['ID']; ?>" class="btn-control">
                                <i class="fas fa-redo"></i>
                            </button>
                        </div>
                        
                        <a href="<?= site_url('estaciones/edit/'.$estacion['ID']); ?>" class="btn btn-warning">Editar</a>
                        <a href="<?= site_url('estaciones/delete/'.$estacion['ID']); ?>" class="btn btn-danger delete-btn" data-id="<?= $estacion['ID']; ?>">Eliminar</a>
                        <?php if($estacion['ESTATUS_PAGO'] != 'Pagado'): ?>
                            <a href="<?= site_url('estaciones/cobrar/'.$estacion['ID']); ?>" class="btn btn-primary">Cobrar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal para alerta -->
<div id="modalAlerta" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tiempo finalizado en la estación <span id="modalNumeroEstacion"></span>!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para alerta -->
<div id="modalEliminar" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalMensaje"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a id="modalConfirmar" class="btn btn-danger" href="#">Confirmar</a>
            </div>
        </div>
    </div>
</div>

<audio id="alert-sound" src="<?= base_url('public/alert.mp3'); ?>" preload="auto"></audio>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
        $(document).ready(function() {
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#modalMensaje').text('¿Estás seguro de que quieres eliminar esta estación?');
            $('#modalConfirmar').attr('href', url);
            $('#modalEliminar').modal('show');
        });
    });
    function playAlertSound() {
        var alertSound = document.getElementById("alert-sound");
        alertSound.play();
    }

    let timers = {};
    function adjustTime(estacionId, minutes) {
    const timeElement = document.querySelector('#tiempo-solicitado-' + estacionId);
    let currentTime = parseInt(timeElement.textContent);
    currentTime += minutes;
    timeElement.textContent = currentTime;

    const timerDisplay = document.querySelector('#timer-' + estacionId);

    const timerInterval = timers[estacionId].interval;
    let newDuration = currentTime * 60;

    clearInterval(timerInterval);
    startTimer(newDuration, timerDisplay, estacionId);
}

function resetTimer(estacionId) {
    if (timers[estacionId]) {
        clearInterval(timers[estacionId].interval);
        document.querySelector('#timer-' + estacionId).textContent = "00:00:00";
        timers[estacionId].interval = null;

        let initialDuration = parseInt(document.querySelector('#tiempo-solicitado-' + estacionId).textContent) * 60;
        startTimer(initialDuration, document.querySelector('#timer-' + estacionId), estacionId);
    }
}

function startTimer(duration, display, estacionId) {
            let timer = duration, hours, minutes, seconds;

            const interval = setInterval(function () {
                hours = Math.floor(timer / 3600);
                minutes = Math.floor((timer % 3600) / 60);
                seconds = timer % 60;

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ":" + minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    display.textContent = "00:00:00";
                    localStorage.removeItem('timer-' + estacionId); // Eliminar el timer cuando se acaba

                    // Mostrar el modal cuando el tiempo termine y reproducir el sonido
                    document.getElementById('modalNumeroEstacion').textContent = estacionId;
                    $('#modalAlerta').modal('show');
                    playAlertSound();
                } else {
                    // Guardar el tiempo restante en localStorage
                    localStorage.setItem('timer-' + estacionId, timer);
                }
            }, 1000);

            display.dataset.timerInterval = interval;
            timers[estacionId] = { interval: interval, remainingTime: duration };
}

    document.addEventListener('DOMContentLoaded', (event) => {
        
        function pauseTimer(estacionId) {
            if (timers[estacionId]) {
                clearInterval(timers[estacionId].interval);
                timers[estacionId].remainingTime -= Math.floor((new Date().getTime() - timers[estacionId].startTime) / 1000);
                timers[estacionId].interval = null;

                // Guardar el tiempo restante en localStorage
                localStorage.setItem('timer-' + estacionId, timers[estacionId].remainingTime);
            }
        }

        function stopTimer(estacionId) {
            if (timers[estacionId]) {
                clearInterval(timers[estacionId].interval);
                timers[estacionId].remainingTime = 0;
                document.querySelector('#timer-' + estacionId).textContent = "00:00:00";
                timers[estacionId].interval = null;

                // Eliminar el tiempo de localStorage
                localStorage.removeItem('timer-' + estacionId);
            }
        }
        function cobrar(estacionId){
            stopTimer(estacionId);
        }

        <?php foreach ($estaciones as $estacion): ?>
            (function() {
                let display = document.querySelector('#timer-<?= $estacion['ID']; ?>');
                if (display) {
                    // Verificar si hay un tiempo guardado en localStorage
                    let savedTime = localStorage.getItem('timer-<?= $estacion['ID']; ?>');
                    let tiempoSolicitado = <?= $estacion['TIEMPO_SOLICITADO']; ?> * 60;

                    if (savedTime) {
                        // Si hay un tiempo guardado, restaurarlo
                        startTimer(parseInt(savedTime), display, <?= $estacion['ID']; ?>);
                    } else if ('<?= $estacion['ESTATUS_PAGO']; ?>' != 'Pagado') {
                        // Si no hay tiempo guardado y no está pagado, iniciar con el tiempo solicitado
                        startTimer(tiempoSolicitado, display, <?= $estacion['ID']; ?>);
                    } else {
                        display.textContent = "00:00:00";
                    }
                }

                document.querySelector('#pause-<?= $estacion['ID']; ?>').addEventListener('click', function() {
                    pauseTimer(<?= $estacion['ID']; ?>);
                });
                document.querySelector('#stop-<?= $estacion['ID']; ?>').addEventListener('click', function() {
                    stopTimer(<?= $estacion['ID']; ?>);
                });
                document.querySelector('#reset-<?= $estacion['ID']; ?>').addEventListener('click', function() {
                    resetTimer(<?= $estacion['ID']; ?>);
                });
                <?php if($estacion['ESTATUS_PAGO'] != 'Pagado'): ?>
                    // Asignar el evento al botón de "Cobrar"
                    document.querySelector('a[href="<?= site_url('estaciones/cobrar/'.$estacion['ID']); ?>"]').addEventListener('click', function() {
                        cobrar(<?= $estacion['ID']; ?>); // Detener el cronómetro al cobrar
                    });
                <?php endif; ?>
            })();
        <?php endforeach; ?>
    });

</script>
</body>
</html>
