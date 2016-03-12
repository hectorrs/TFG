<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Simulación</title>

	<link rel="stylesheet" type="text/css" href="../Resources/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../Resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../Resources/css/custom.css">

	<script type="text/javascript" src="../Resources/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../Resources/js/npm.js"></script>
	<script type="text/javascript" src="../Resources/js/output.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
<?php
	// Archivo que genera el mundo
	$file = file_get_contents("../Resources/log/world.txt");

	$data = explode(".", $file);

	session_start();

	// Dimensiones
	$row = $_SESSION['row'];
	$col = $_SESSION['col'];

	// Memoria y tiempo de ejecución
	$memory = $_SESSION['memory'];
	$time = $_SESSION['time'];

	// Estadísticas
	// Tiempo atmosférico
	$weather = $_SESSION['weather'];

	// Población de elementos
	$amountRabbit = $_SESSION['amountRabbit'];
	$amountWolf = $_SESSION['amountWolf'];
	$amountCarrot = $_SESSION['amountCarrot'];

	// Conejos cazados
	$huntedRabbit = $_SESSION['huntedRabbit'];

	// Zanahorias comidas
	$eatenCarrot = $_SESSION['eatenCarrot'];

	// Conejos y lobos muertos por no comer
	$deadEatRabbit = $_SESSION['deadEatRabbit'];
	$deadEatWolf = $_SESSION['deadEatWolf'];

	// Conejos y lobos muertos por no dormir
	$deadSleepRabbit = $_SESSION['deadSleepRabbit'];
	$deadSleepWolf = $_SESSION['deadSleepWolf'];

	// Reproducción de conejos
	$bornRabbit = $_SESSION['bornRabbit'];

	session_write_close();

	echo "Memoria: " . $memory . " mb";
    echo "<br>Tiempo de ejecución: " . $time . " s";
?>

<script type="text/javascript">
	// Mundo
	var data = <?php echo json_encode($data); ?>;

	// Dimensiones
	var row = <?php echo json_encode($row); ?>;
	var col = <?php echo json_encode($col); ?>;

	// Tiempo atmosférico
	var weather = <?php echo json_encode($weather); ?>;

	// Población de elementos
	var amountRabbit = <?php echo json_encode($amountRabbit); ?>;
	var amountWolf = <?php echo json_encode($amountWolf); ?>;
	var amountCarrot = <?php echo json_encode($amountCarrot); ?>;

	// Conejos cazados
	var huntedRabbit = <?php echo json_encode($huntedRabbit); ?>;

	// Zanahorias comidas
	var eatenCarrot = <?php echo json_encode($eatenCarrot); ?>;

	// Conejos y lobos muertos por no comer
	var deadEatRabbit = <?php echo json_encode($deadEatRabbit); ?>;
	var deadEatWolf = <?php echo json_encode($deadEatWolf); ?>;

	// Conejos y lobos muertos por no dormir
	var deadSleepRabbit = <?php echo json_encode($deadSleepRabbit); ?>;
	var deadSleepWolf = <?php echo json_encode($deadSleepWolf); ?>;

	// Reproducción de conejos
	var bornRabbit = <?php echo json_encode($bornRabbit); ?>;
</script>

<script type="text/javascript" src="../Resources/js/chart.js"></script>

<div class="container">
	<h1>Mundo</h1>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="containerWorld">
			<?php for($i = 0; $i < $row; $i++){ ?>
				<div class="contentWorld">
				<?php for($j = 0; $j < $col; $j++){ ?>
					<div class="colWorld" id="row<?php echo $i; ?>col<?php echo $j; ?>"></div>
				<?php } ?>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div id="time"></div>
			<br>
			<button type="button" onclick="update('begin')">Inicio</button>
			<button type="button" onclick="update('previous')">Anterior</button>
			<button type="button" onclick="update('next')">Siguiente</button>
			<button type="button" onclick="update('end')">Fin</button>
			<br><br>
			<button type="button" onclick="transition = setInterval(function(){play()}, 750)">Play</button>
			<button type="button" onclick="pause()">Pause</button>
			<button type="button" onclick="stop()">Stop</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4><strong>Leyenda</strong></h4>
			<h5><img src='' width='20px' height='20px' style='background-color:blue'/> Conejo</h5>
			<h5><img src='' width='20px' height='20px' style='background-color:red'/> Lobo</h5>
			<h5><img src='' width='20px' height='20px' style='background-color:orange'/> Zanahoria</h5>
			<h5><img src='' width='20px' height='20px' style='background-color:grey'/> Madriguera</h5>
			<h5><img src='' width='20px' height='20px' style='background-color:purple'/> Árbol</h5>
			<h5><img src='' width='20px' height='20px' style='background-color:green'/> Hierba</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4><a href="../Resources/log/log.txt">Descargar log</a></h4>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Población total</h4>
			<div id="chartPopulation"></div>
			<button id="prevPopulation">Anterior</button>
			<button id="nextPopulation">Siguiente</button>
			<button id="zoomPopulation">Zoom</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Población de conejos</h4>
			<div id="chartPopulationRabbit"></div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Población de lobos</h4>
			<div id="chartPopulationWolf"></div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Población de zanahorias</h4>
			<div id="chartPopulationCarrot"></div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Conejos cazados</h4>
			<div id="chartHuntedRabbit"></div>
			<button id="prevHuntedRabbit">Anterior</button>
			<button id="nextHuntedRabbit">Siguiente</button>
			<button id="zoomHuntedRabbit">Zoom</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Zanahorias comidas</h4>
			<div id="chartCarrotEaten"></div>
			<button id="prevEatenCarrot">Anterior</button>
			<button id="nextEatenCarrot">Siguiente</button>
			<button id="zoomEatenCarrot">Zoom</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Conejos y lobos muertos por no comer</h4>
			<div id="chartDeadEat"></div>
			<button id="prevDeadEat">Anterior</button>
			<button id="nextDeadEat">Siguiente</button>
			<button id="zoomDeadEat">Zoom</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Conejos y lobos muertos por no dormir</h4>
			<div id="chartDeadSleep"></div>
			<button id="prevDeadSleep">Anterior</button>
			<button id="nextDeadSleep">Siguiente</button>
			<button id="zoomDeadSleep">Zoom</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Reproducción de conejos</h4>
			<div id="chartBornRabbit"></div>
			<button id="prevBornRabbit">Anterior</button>
			<button id="nextBornRabbit">Siguiente</button>
			<button id="zoomBornRabbit">Zoom</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h4>Tiempo atmosférico</h4>
			<div id="chartWeather"></div>
		</div>
	</div>
</div>
</body>
</html>