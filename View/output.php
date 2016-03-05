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
	<script type="text/javascript" src="../Resources/js/world.js"></script>
</head>
<body>
<?php
	$file = file_get_contents("../Resources/log/world.txt");

	$data = explode(".", $file);

	session_start();

	$row = $_SESSION['row'];
	$col = $_SESSION['col'];
	$memory = $_SESSION['memory'];
	$time = $_SESSION['time'];

	session_write_close();

	echo "Memoria: " . $memory . " mb";
    echo "<br>Tiempo de ejecución: " . $time . " s";
?>

<script type="text/javascript">
	var data = <?php echo json_encode($data); ?>;
	var row = <?php echo json_encode($row); ?>;
	var col = <?php echo json_encode($col); ?>;
</script>

<div class="container">
	<h1>Mundo</h1>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div style="overflow: scroll; max-height: 600px;">
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
</div>
</body>
</html>