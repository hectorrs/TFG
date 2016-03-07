<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Mundo</title>

	<link rel="stylesheet" type="text/css" href="../resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../resources/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../resources/css/custom.css">

	<script type="text/javascript" src="../resources/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../resources/js/npm.js"></script>
	<script type="text/javascript" src="../resources/js/input.js"></script>
</head>
<body>
	<form action="../Core/world.php" method="post">
		<div class="container">
			<div class="row well">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h1 class="text-center">Interfaz de configuración del mundo</h1>
				</div>
			</div>
			<div class="row well">
				<div class="col-xs-0 col-sm-0 col-md-1 col-lg-1"></div>
				<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4">
					<input class="btn btn-danger" type="button" style="width: 100%" value="Mundo" onclick="world()">
				</div>
				<div class="col-xs-0 col-sm-2 col-md-2 col-lg-2"></div>
				<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4">
					<input class="btn btn-danger" type="button" style="width: 100%" value="Elementos" onclick="element()">
				</div>
				<div class="col-xs-0 col-sm-0 col-md-1 col-lg-1"></div>
			</div>
			<div class="row well">
				<div id="world" style="display: block">
					<div class="row">
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<input class="btn btn-primary" type="button" style="width: 100%" value="Ejecución/Tamaño" onclick="execution()">
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<input class="btn btn-primary" type="button" style="width: 100%" value="Tiempo" onclick="weatherTime()">
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<input class="btn btn-primary" type="button" style="width: 100%" value="Elementos" onclick="amountElement()">
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<input class="btn btn-primary" type="button" style="width: 100%" value="Restricciones" onclick="restriction()">
						</div>					
					</div>
					<hr class="dividing">
					<div id="execution" style="display: block">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Turnos de ejecución</label>
								<div class="form-group">
									<input class="form-control" name="turn" value="200" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Duración de un día</label>
								<div class="form-group">
									<input class="form-control" name="day" value="100" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Duración de la noche</label>
								<div class="form-group">
									<input class="form-control" name="night" value="20" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Tamaño</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Largo</span>
									<input type="text" class="form-control" name="sizeX" value="2" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Ancho</span>
									<input type="text" class="form-control" name="sizeY" value="2" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
					</div>
					<div id="weather" style="display: none">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Tiempo atmosférico inicial</label>
								<div class="form-group">
									<select class="form-control" name="weather" required>
										<option selected value="sunny">soleado</option>
										<option value="rainy">lluvioso</option>
										<option value="windy">ventoso</option>
										<option value="foggy">neblinoso</option>
									</select>
								</div>
							</div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Cambiar tiempo cada (turnos)</label>
								<div class="form-group">
									<input class="form-control" name="changeWeather" value="10" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
					</div>
					<div id="elements" style="display: none">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Cantidad de zanahorias</label>
								<div class="form-group">
									<input class="form-control" name="carrot" value="2" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Cantidad de árboles</label>
								<div class="form-group">
									<input class="form-control" name="tree" value="2" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Cantidad de madrigueras</label>
								<div class="form-group">
									<input class="form-control" name="lair" value="2" required>
								</div>
							</div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Cantidad de conejos</label>
								<div class="form-group">
									<input class="form-control" name="rabbit" value="2" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Cantidad de lobos</label>
								<div class="form-group">
									<input class="form-control" name="wolf" value="2" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Generación de zanahorias</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Cada x turnos</span>
									<input type="text" class="form-control" name="timeMoreCarrot" value="50" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Cantidad</span>
									<input type="text" class="form-control" name="amountMoreCarrot" value="4" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Generación de lobos</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Cada x turnos</span>
									<input type="text" class="form-control" name="timeMoreWolf" value="100" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Cantidad</span>
									<input type="text" class="form-control" name="amountMoreWolf" value="2" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
					</div>
					<div id="restriction" style="display: none">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Reproducción de conejos</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Límite por día</span>
									<input type="text" class="form-control" name="reproduceRabbit" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Mínimo de comidas por día</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="minimumEatRabbit" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="minimumEatWolf" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Necesidad de dormir</label><br>
								<label>Conejos</label>
								<div class="form-group">
									<select class="form-control" name="needToSleepRabbit" required>
										<option selected value="yes">si</option>
										<option value="no">no</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label><br>
								<label>Lobos</label>
								<div class="form-group">
									<select class="form-control" name="needToSleepWolf" required>
										<option selected value="yes">si</option>
										<option value="no">no</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Lugar para dormir (conejos)</label>
								<div class="form-group">
									<select class="form-control" name="placeToSleepRabbit" required>
										<option selected value="ground">Tierra</option>
										<option value="lair">Madriguera</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
					</div>
				</div>
				<div id="element" style="display: none">
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<input class="btn btn-primary" type="button" style="width: 100%" value="Turnos" onclick="turns()">
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<input class="btn btn-primary" type="button" style="width: 100%" value="Acciones" onclick="actions()">
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<input class="btn btn-primary" type="button" style="width: 100%" value="Rangos" onclick="ranges()">
						</div>	
					</div>
					<hr class="dividing">
					<div id="turn" style="display: block">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Turnos para comer</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="eatRabbit" value="10" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="eatWolf" value="10" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Turnos para dormir</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="sleepRabbit" value="20" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="sleepWolf" value="20" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
					</div>
					<div id="action" style="display: none">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Puntos por turno para acciones</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="maxUseRabbit" value="3" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="maxUseWolf" value="3" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Consumo por acción</label><br>
								<label>--Smell</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="smellRabbitUse" value="1" required>
								</div>
								<label>--Hear</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="hearRabbitUse" value="1" required>
								</div>
								<label>--See</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="seeRabbitUse" value="1" required>
								</div>
								<label>--Move</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="moveRabbitUse" value="1" required>
								</div>
								<label>--Sleep</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="sleepRabbitUse" value="1" required>
								</div>
								<label>--Reproduce</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="reproduceRabbitUse" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label><br>
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="smellWolfUse" value="1" required>
								</div>
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="hearWolfUse" value="1" required>
								</div>
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="seeWolfUse" value="1" required>
								</div>
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="moveWolfUse" value="1" required>
								</div>
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="sleepWolfUse" value="1" required>
								</div>
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="reproduceWolfUse" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
					</div>
					<div id="range" style="display: none">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Rango de visión</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="seeRabbit" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="seeWolf" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Rango de olfato</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="smellRabbit" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="smellWolf" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
						<hr class="dividing2">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>Rango de oído</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Conejos</span>
									<input type="text" class="form-control" name="hearRabbit" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<label>&nbsp;</label>
								<div class="input-group form-group">
									<span class="input-group-addon">Lobos</span>
									<input type="text" class="form-control" name="hearWolf" value="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row well">
				<div class="col-xs-0 col-sm-4 col-md-4 col-lg-4"></div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div class="btn-group btn-group-justified">
					  	<div class="btn-group">
					    	<button type="submit" class="btn btn-default btn-success"><strong>Aceptar</strong></button>
					  	</div>
					</div>
				</div>
				<div class="col-xs-0 col-sm-4 col-md-4 col-lg-4"></div>
			</div>
		</div>
	</form>
</body>
</html>