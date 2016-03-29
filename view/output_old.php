<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Simulación</title>

	<link rel="shortcut icon" href="../resources/img/icon2.ico">

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="../resources/css/bootstrap.min.css">

	<!-- Add custom CSS here -->
    <link href="../resources/css/custom.css" rel="stylesheet">

	<!-- JavaScript -->
	<script type="text/javascript" src="../resources/js/bootstrap.min.js"></script>

	<!-- Add custom JS here -->
	<script type="text/javascript" src="../resources/js/output.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
<?php
	// File which generates the world
	$file = file_get_contents("../Resources/log/world.txt");
	//$file = file_get_contents('../resources/log/world.csv');

	$data = explode(".", $file);
	//$data = explode("\n\n", $file);

	session_start();

	// Size
	$row = $_SESSION['row'];
	$col = $_SESSION['col'];

	// Memory and execution time
	$memory = $_SESSION['memory'];
	$time = $_SESSION['time'];

	// Statistics
	// Weather
	$weather = $_SESSION['weather'];

	// Population of elements
	$amountRabbit = $_SESSION['amountRabbit'];
	$amountWolf = $_SESSION['amountWolf'];
	$amountCarrot = $_SESSION['amountCarrot'];

	// Hunted rabbits
	$huntedRabbit = $_SESSION['huntedRabbit'];

	// Eaten carrots
	$eatenCarrot = $_SESSION['eatenCarrot'];

	// Dead rabbits and wolves for not eating
	$deadEatRabbit = $_SESSION['deadEatRabbit'];
	$deadEatWolf = $_SESSION['deadEatWolf'];

	// Dead rabbits and wolves for not sleeping
	$deadSleepRabbit = $_SESSION['deadSleepRabbit'];
	$deadSleepWolf = $_SESSION['deadSleepWolf'];

	// Breed of rabbits
	$bornRabbit = $_SESSION['bornRabbit'];

	// Breed of wolves
	$bornWolf = $_SESSION['bornWolf'];

	session_write_close();

	echo "Memoria: " . $memory . " mb";
    echo "<br>Tiempo de ejecución: " . $time . " s";
?>

<script type="text/javascript">
	// World
	var data = <?php echo json_encode($data); ?>;

	// Size
	var row = <?php echo json_encode($row); ?>;
	var col = <?php echo json_encode($col); ?>;

	// TWeather
	var weather = <?php echo json_encode($weather); ?>;

	// Population of elements
	var amountRabbit = <?php echo json_encode($amountRabbit); ?>;
	var amountWolf = <?php echo json_encode($amountWolf); ?>;
	var amountCarrot = <?php echo json_encode($amountCarrot); ?>;

	// Hunted rabbits
	var huntedRabbit = <?php echo json_encode($huntedRabbit); ?>;

	// Eaten carrots
	var eatenCarrot = <?php echo json_encode($eatenCarrot); ?>;

	// Dead rabbits and wolves for not eating
	var deadEatRabbit = <?php echo json_encode($deadEatRabbit); ?>;
	var deadEatWolf = <?php echo json_encode($deadEatWolf); ?>;

	// Dead rabbits and wolves for not sleeping
	var deadSleepRabbit = <?php echo json_encode($deadSleepRabbit); ?>;
	var deadSleepWolf = <?php echo json_encode($deadSleepWolf); ?>;

	// Breed of rabbits
	var bornRabbit = <?php echo json_encode($bornRabbit); ?>;

	// Breed of wolves
	var bornWolf = <?php echo json_encode($bornWolf); ?>;
</script>

<script type="text/javascript" src="../resources/js/chart.js"></script>

<div class="container">
	<a href="input.php">Volver a inicio</a>
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
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4>Reproducción de lobos</h4>
			<div id="chartBornWolf"></div>
			<button id="prevBornWolf">Anterior</button>
			<button id="nextBornWolf">Siguiente</button>
			<button id="zoomBornWolf">Zoom</button>
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