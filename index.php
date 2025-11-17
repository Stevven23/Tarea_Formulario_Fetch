
<?php
require_once './db/conection.php';

// Obtener pacientes
$sqlPacientes = "SELECT * FROM pacientes";
$pacientes = $pdo->query($sqlPacientes)->fetchAll(PDO::FETCH_ASSOC);

// Obtener médicos
$sqlMedicos = "SELECT * FROM medicos";
$medicos = $pdo->query($sqlMedicos)->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/lib/bootstrap-5.3.5-dist/css/bootstrap.min.css">
</head>
<body>

    <div class="card">
            <div class="icon"><i class="bi bi-person-badge"></i></div>
            <h2>Song</h2>

            <!-- Botón modal con <a> -->
            <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addSongModal">
                Add Song
            </a>   
        </div>



    <div class="modal fade" id="addSongModal" tabindex="-1" aria-labelledby="addSongModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="addSongModalLabel">Add Song</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="create-song">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type:</label>
                            <input type="text" id="type" name="type" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="artist" class="form-label">Artist:</label>
                            <input type="text" id="artist" name="artist" class="form-control" required>
                        </div>

                        <button type="submit" class="btn-warining">Add Song</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    

    <script src="./public/lib/bootstrap-5.3.5-dist/js/bootstrap.min.js"></script>

    <script>
        const addSong = document.getElementById('create-song');
        addSong.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(addSong);
            fetch('./app/addSong.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                Swal.fire('Nice', data, 'success');
                addSong.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('addSongModal'));
                modal.hide();
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'to ', 'error');
            });
        });
    </script>

<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>