<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <title>Simulador</title>

    <link rel='shortcut icon' href='../resources/img/icon2.ico'>
    
    <!-- Bootstrap core CSS -->
    <link href='../resources/css/bootstrap.css' rel='stylesheet'>

    <!-- Add custom CSS here -->
    <link href='../resources/css/custom.css' rel='stylesheet'>

    <!-- JavaScript -->
    <script src='../resources/js/bootstrap.js'></script>
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>

    <!-- Add custom JS here -->
    <script type='text/javascript' src='../Resources/js/output.js'></script>
</head>
<body style='background-color: #E8E8E8; overflow-x: hidden;'>
	<?php
		// File which generates the world
		$file = file_get_contents('../Resources/log/world.txt');
		//$file = file_get_contents('../resources/log/world.csv');

		$data = explode('.', $file);
		//$data = explode('\n\n', $file);

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
	?>

	<script type='text/javascript'>
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

	<script type='text/javascript' src='../resources/js/chart.js'></script>

	<!-- Header -->
	<div class='row text-center' style='background-color: #424242; height: 75px'>
		<h1 style='color: #F0F0F0; letter-spacing: 10px'><strong>Simulación</strong></h1>
	</div>

	<!-- Content -->
	<div class='row' style='padding-top: 35px; padding-bottom: 35px; padding-left: 35px; padding-right: 35px; margin-left: 0px; margin-right: 0px;'>
		<div class='row well'>
			<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
				<div class='containerWorld'>
				<?php for($i = 0; $i < $row; $i++){ ?>
					<div class='contentWorld'>
					<?php for($j = 0; $j < $col; $j++){ ?>
						<div class='colWorld' id='row<?php echo $i; ?>col<?php echo $j; ?>'></div>
					<?php } ?>
					</div>
				<?php } ?>
				</div>
			</div>

			<div class='col-sm-2 col-md-2 col-lg-2'>
				<div class="row">
					<div class="col-xs-4 col-sm-12 col-md-12 col-lg-12">
						<input type="button" class="btn btn-default btn-success" style="width: 100%" onclick="transition = setInterval(function(){play()}, 750)" value="Play" />
						<div class="dividingBtn"></div>
					</div>

					<div class="col-xs-4 col-sm-12 col-md-12 col-lg-12">
						<input type="button" class="btn btn-default btn-warning" style="width: 100%" onclick="pause()" value="Pause" />
						<div class="dividingBtn"></div>
					</div>

					<div class="col-xs-4 col-sm-12 col-md-12 col-lg-12">
						<input type="button" class="btn btn-default btn-danger" style="width: 100%" onclick="stop()" value="Stop" />
					</div>
				</div>

				<div class="dividing"></div>

				<div class="row">
					<div class="col-xs-3 col-sm-12 col-md-12 col-lg-12">
						<input type="button" class="btn btn-default btn-primary" style="width: 100%" onclick="update('begin')" value="Inicio" />
						<div class="dividingBtn"></div>
					</div>

					<div class="col-xs-3 col-sm-12 col-md-12 col-lg-12">
						<input type="button" class="btn btn-default btn-primary" style="width: 100%" onclick="update('previous')" value="Anterior" />
						<div class="dividingBtn"></div>
					</div>

					<div class="col-xs-3 col-sm-12 col-md-12 col-lg-12">
						<input type="button" class="btn btn-default btn-primary" style="width: 100%" onclick="update('next')" value="Siguiente" />
						<div class="dividingBtn"></div>
					</div>

					<div class="col-xs-3 col-sm-12 col-md-12 col-lg-12">
						<input type="button" class="btn btn-default btn-primary" style="width: 100%" onclick="update('end')" value="Fin" />
					</div>
				</div>

				<div class="dividing"></div>

				<div class="row">
					<div class="col-xs-6 col-sm-12 col-md-12 col-lg-12">
						<div class="input-group">
							<input type="text" class="form-control" id="goTo" />
							<span class="input-group-btn">
								<input type="button" class="btn btn-default btn-primary" value="Ir a" onclick="update('goTo')" />
							</span>
						</div>
					</div>
				</div>

				<div class="dividing"></div>

				<div id="time"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<div class="row">
					<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
						<h5><img src='' width='20px' height='20px' style='background-color:blue'/> Conejo</h5>
					</div>

					<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
						<h5><img src='' width='20px' height='20px' style='background-color:red'/> Lobo</h5>
					</div>

					<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
						<h5><img src='' width='20px' height='20px' style='background-color:orange'/> Zanahoria</h5>
					</div>

					<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
						<h5><img src='' width='20px' height='20px' style='background-color:grey'/> Madriguera</h5>
					</div>

					<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
						<h5><img src='' width='20px' height='20px' style='background-color:purple'/> Árbol</h5>
					</div>

					<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
						<h5><img src='' width='20px' height='20px' style='background-color:green'/> Hierba</h5>
					</div>
				</div>
			</div>
		</div>

		<div class="dividing"></div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Población total</h4>
				<div id="chartPopulation"></div>
			</div>

			<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
				<br><br>
				<input type="button" class="btn btn-default btn-info" id="prevPopulation" style="width: 100%" value="Anterior" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="nextPopulation" style="width: 100%" value="Siguiente" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="zoomPopulation" style="width: 100%" value="Zoom" />
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Población de conejos</h4>
				<div id="chartPopulationRabbit"></div>
			</div>

			<div class="col-sm-2 col-md-2 col-lg-2"></div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Población de lobos</h4>
				<div id="chartPopulationWolf"></div>
			</div>

			<div class="col-sm-2 col-md-2 col-lg-2"></div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Población de zanahorias</h4>
				<div id="chartPopulationCarrot"></div>
			</div>

			<div class="col-sm-2 col-md-2 col-lg-2"></div>
		</div>

		<div class="dividing"></div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Conejos cazados</h4>
				<div id="chartHuntedRabbit"></div>
			</div>

			<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
				<br><br>
				<input type="button" class="btn btn-default btn-info" id="prevHuntedRabbit" style="width: 100%" value="Anterior" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="nextHuntedRabbit" style="width: 100%" value="Siguiente" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="zoomHuntedRabbit" style="width: 100%" value="Zoom" />
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Zanahorias comidas</h4>
				<div id="chartCarrotEaten"></div>
			</div>

			<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
				<br><br>
				<input type="button" class="btn btn-default btn-info" id="prevEatenCarrot" style="width: 100%" value="Anterior" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="nextEatenCarrot" style="width: 100%" value="Siguiente" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="zoomEatenCarrot" style="width: 100%" value="Zoom" />
			</div>
		</div>

		<div class="dividing"></div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Conejos y lobos muertos por no comer</h4>
				<div id="chartDeadEat"></div>
			</div>

			<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
				<br><br>
				<input type="button" class="btn btn-default btn-info" id="prevDeadEat" style="width: 100%" value="Anterior" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="nextDeadEat" style="width: 100%" value="Siguiente" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="zoomDeadEat" style="width: 100%" value="Zoom" />
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Conejos y lobos muertos por no dormir</h4>
				<div id="chartDeadSleep"></div>
			</div>

			<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
				<br><br>
				<input type="button" class="btn btn-default btn-info" id="prevDeadSleep" style="width: 100%" value="Anterior" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="nextDeadSleep" style="width: 100%" value="Siguiente" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="zoomDeadSleep" style="width: 100%" value="Zoom" />
			</div>
		</div>

		<div class="dividing"></div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Reproducción de conejos</h4>
				<div id="chartBornRabbit"></div>
			</div>

			<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
				<br><br>
				<input type="button" class="btn btn-default btn-info" id="prevBornRabbit" style="width: 100%" value="Anterior" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="nextBornRabbit" style="width: 100%" value="Siguiente" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="zoomBornRabbit" style="width: 100%" value="Zoom" />
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h4>Reproducción de lobos</h4>
				<div id="chartBornWolf"></div>
			</div>

			<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
				<br><br>
				<input type="button" class="btn btn-default btn-info" id="prevBornWolf" style="width: 100%" value="Anterior" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="nextBornWolf" style="width: 100%" value="Siguiente" />
				<div class="dividingBtn"></div>
				<input type="button" class="btn btn-default btn-info" id="zoomBornWolf" style="width: 100%" value="Zoom" />
			</div>
		</div>

		<div class="dividing"></div>

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<h4>Tiempo atmosférico</h4>
				<div id="chartWeather"></div>
			</div>

			<div class="col-sm-6 col-md-6 col-lg-6"></div>
		</div>

		<div class="dividing"></div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3><u>Descargas</u></h3>
				<h4><a href="../resources/log/conf.txt">Configuración inicial</a></h4>
				<h4><a href="../resources/log/log.csv">Registro de acciones</a></h4>
				<h4><a href="../resources/log/world.txt">Mundo</a></h4>
			</div>
		</div>

		<div class="dividing"></div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4>Memoria consumida: <?php echo $memory; ?> mb</h4>
				<h4>Tiempo de ejecución: <?php echo $time; ?> segundos</h4>
			</div>
		</div>
	</div>
</body>
</html>