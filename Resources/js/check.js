// Validación
function check(){
	var values = getValues();

	var checks = [
		turn(values['turn']),
		day(values['day'], values['turn']),
		night(values['night'], values['day']),
		dimensions(values['x'], values['y']),
		changeWeather(values['changeWeather'], values['turn']),
		amountElements(values['carrot'], values['tree'], values['lair'], values['rabbit'], values['wolf'], values['x'], values['y']),
		moreCarrot(values['eachCarrot'], values['amountCarrot'], values['turn']),
		moreWolf(values['eachWolf'], values['amountWolf'], values['turn']),
		maxEat(values['eatRabbit'], values['eatWolf']),
		maxSleep(values['sleepRabbit'], values['sleepWolf']),
		turnEat(values['turnEatRabbit'], values['turnEatWolf'], values['day']),
		turnSleep(values['turnSleepRabbit'], values['turnSleepWolf'], values['night']),
		maxUse(values['maxUseRabbit'], values['maxUseWolf']),
		useAct(values['smellRabbitUse'], values['hearRabbitUse'], values['seeRabbitUse'], values['moveRabbitUse'], 
			values['sleepRabbitUse'], values['breedRabbitUse'], values['smellWolfUse'], values['hearWolfUse'], 
			values['seeWolfUse'], values['moveWolfUse'], values['sleepWolfUse'], values['breedWolfUse']),
		rangeAct(values['seeRabbit'], values['seeWolf'], values['smellRabbit'], values['smellWolf'], values['hearRabbit'], values['hearWolf'])
	];

	for(i = 0; i < checks.length; i++){
		if(checks[i] == false){
			return false;
		}
	}

	return true;
}

// Campos de la configuración
function getValues(){
	var turn = document.getElementById('turn').value;
	var day = document.getElementById('day').value;
	var night = document.getElementById('night').value;
	var x = document.getElementById('x').value;
	var y = document.getElementById('y').value;
	var changeWeather = document.getElementById('changeWeather').value;
	var carrot = document.getElementById('carrot').value;
	var tree = document.getElementById('tree').value;
	var lair = document.getElementById('lair').value;
	var rabbit = document.getElementById('rabbit').value;
	var wolf = document.getElementById('wolf').value;
	var eachCarrot = document.getElementById('timeMoreCarrot').value;
	var amountCarrot = document.getElementById('amountMoreCarrot').value;
	var eachWolf = document.getElementById('timeMoreWolf').value;
	var amountWolf = document.getElementById('amountMoreWolf').value;
	var eatRabbit = document.getElementById('maxEatRabbit').value;
	var eatWolf = document.getElementById('maxEatWolf').value;
	var sleepRabbit = document.getElementById('maxSleepRabbit').value;
	var sleepWolf = document.getElementById('maxSleepWolf').value;
	var turnEatRabbit = document.getElementById('eatRabbit').value;
	var turnEatWolf = document.getElementById('eatWolf').value;
	var turnSleepRabbit = document.getElementById('sleepRabbit').value;
	var turnSleepWolf = document.getElementById('sleepWolf').value;
	var maxUseRabbit = document.getElementById('maxUseRabbit').value;
	var maxUseWolf = document.getElementById('maxUseWolf').value;
	var smellRabbitUse = document.getElementById('smellRabbitUse').value;
	var hearRabbitUse = document.getElementById('hearRabbitUse').value;
	var seeRabbitUse = document.getElementById('seeRabbitUse').value;
	var moveRabbitUse = document.getElementById('moveRabbitUse').value;
	var sleepRabbitUse = document.getElementById('sleepRabbitUse').value;
	var breedRabbitUse = document.getElementById('breedRabbitUse').value;
	var smellWolfUse = document.getElementById('smellWolfUse').value;
	var hearWolfUse = document.getElementById('hearWolfUse').value;
	var seeWolfUse = document.getElementById('seeWolfUse').value;
	var moveWolfUse = document.getElementById('moveWolfUse').value;
	var sleepWolfUse = document.getElementById('sleepWolfUse').value;
	var breedWolfUse = document.getElementById('breedWolfUse').value;
	var seeRabbit = document.getElementById('seeRabbit').value;
	var seeWolf = document.getElementById('seeWolf').value;
	var smellRabbit = document.getElementById('smellRabbit').value;
	var smellWolf = document.getElementById('smellWolf').value;
	var hearRabbit = document.getElementById('hearRabbit').value;
	var hearWolf = document.getElementById('hearWolf').value;

	return {
		'turn' : turn,
		'day' : day,
		'night' : night,
		'x' : x,
		'y' : y,
		'changeWeather' : changeWeather,
		'carrot' : carrot,
		'tree' : tree,
		'lair' : lair,
		'rabbit' : rabbit,
		'wolf' : wolf,
		'eachCarrot' : eachCarrot,
		'amountCarrot' : amountCarrot,
		'eachWolf' : eachWolf,
		'amountWolf' : amountWolf,
		'eatRabbit' : eatRabbit,
		'eatWolf' : eatWolf,
		'sleepRabbit' : sleepRabbit,
		'sleepWolf' : sleepWolf,
		'turnEatRabbit' : turnEatRabbit,
		'turnEatWolf' : turnEatWolf,
		'turnSleepRabbit' : turnSleepRabbit,
		'turnSleepWolf' : turnSleepWolf,
		'maxUseRabbit' : maxUseRabbit,
		'maxUseWolf' : maxUseWolf,
		'smellRabbitUse' : smellRabbitUse,
		'hearRabbitUse' : hearRabbitUse,
		'seeRabbitUse' : seeRabbitUse,
		'moveRabbitUse' : moveRabbitUse,
		'sleepRabbitUse' : sleepRabbitUse,
		'breedRabbitUse' : breedRabbitUse,
		'smellWolfUse' : smellWolfUse,
		'hearWolfUse' : hearWolfUse,
		'seeWolfUse' : seeWolfUse,
		'moveWolfUse' : moveWolfUse,
		'sleepWolfUse' : sleepWolfUse,
		'breedWolfUse' : breedWolfUse,
		'seeRabbit' : seeRabbit,
		'seeWolf' : seeWolf,
		'smellRabbit' : smellRabbit,
		'smellWolf' : smellWolf,
		'hearRabbit' : hearRabbit,
		'hearWolf' : hearWolf
	};
}

// Número de turnos
function turn(turn){
	if(!(/^([0-9])*$/.test(turn))){
		alert('Número de turnos - Formato incorrecto');
		return false;
	}else{
		var turn = parseInt(turn);

		if(turn < 2){
			alert('El número de turnos tiene que ser mayor o igual que 2');
			return false;
		}else{
			return true;
		}
	}
}

// Duración de un día
function day(day, turn){
	if(!(/^([0-9])*$/.test(day))){
		alert('Duración del día - Formato incorrecto');
		return false;
	}else{
		var turn = parseInt(turn);
		var day = parseInt(day);

		if(day > turn){
			alert('La duración del día tiene que ser menor a la duración total de la ejecución');
			return false;
		}else if(day <= 1){
			alert('La duración del día tiene que ser mayor que 1');
			return false;
		}else{
			return true;
		}
	}
}

// Duración de una noche
function night(night, day){
	if(!(/^([0-9])*$/.test(night))){
		alert('Duración de la noche - Formato incorrecto');
		return false;
	}else{
		var day = parseInt(day);
		var night = parseInt(night);

		if(night == 0){
			alert('La duración de la noche tiene que ser mayor que 0');
			return false;
		}else if(night >= day){
			alert('La duración de la noche tiene que ser menor que la duración del día');
			return false;
		}else{
			return true;
		}
	}
}

// Dimensiones del mundo
function dimensions(x, y){
	if(!(/^([0-9])*$/.test(x)) || !(/^([0-9])*$/.test(y))){
		if(!(/^([0-9])*$/.test(x))){
			alert('Largo - Formato incorrecto');
		}else{
			x = parseInt(x);

			if(x < 1){
				alert('El largo tiene que ser mayor que 1');
			}
		}
		if(!(/^([0-9])*$/.test(y))){
			alert('Ancho - Formato incorrecto');
		}else{
			y = parseInt(y);

			if(y < 1){
				alert('El ancho tiene que ser mayor que 1');
			}
		}
		return false;
	}else{
		x = parseInt(x);
		y = parseInt(y);

		if(x < 1 || y < 1){
			if(x < 1){
				alert('El largo tiene que ser mayor que 1');
			}
			if(y < 1){
				alert('El ancho tiene que ser mayor que 1');
			}
			return false;
		}else{
			return true;
		}
	}
}

// Cambiar tiempo cada
// 0 para tiempo constante
function changeWeather(change, turn){
	if(!(/^([0-9])*$/.test(change))){
		alert('Cambiar tiempo cada - Formato incorrecto');
		return false;
	}else{
		turn = parseInt(turn);
		change = parseInt(change);

		if(change >= turn){
			alert('Cambiar tiempo cada - Tiene que ser menor que el número de turnos de ejecución');
			return false;
		}else{
			return true;
		}
	}
}

// Comprueba si la cantidad de elementos a crear no es mayor que las dimensiones del mundo
function checkAmountElements(carrot, tree, lair, rabbit, wolf, x, y){
	carrot = parseInt(carrot);
	tree = parseInt(tree);
	lair = parseInt(lair);
	rabbit = parseInt(rabbit);
	wolf = parseInt(wolf);
	x = parseInt(x);
	y = parseInt(y);

	if(carrot + tree + lair + rabbit + wolf > x * y){
		return false;
	}else{
		return true;
	}
}

function amountElements(carrot, tree, lair, rabbit, wolf, x, y){
	if(!(/^([0-9])*$/.test(carrot)) || !(/^([0-9])*$/.test(tree)) || !(/^([0-9])*$/.test(lair)) || !(/^([0-9])*$/.test(rabbit)) || !(/^([0-9])*$/.test(wolf))){
		if(!(/^([0-9])*$/.test(carrot))){
			alert('Número de zanahorias - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(tree))){
			alert('Número de árboles - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(lair))){
			alert('Número de madrigueras - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(rabbit))){
			alert('Número de conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(wolf))){
			alert('Número de lobos - Formato incorrecto');
		}
		return false;
	}else if(!checkAmountElements(carrot, tree, lair, rabbit, wolf, x, y)){
		alert('La cantidad de elementos es mayor que la dimensión del mundo');
		return false;
	}else{
		return true;
	}
}

// Generación de zanahorias
function moreCarrot(each, amount, turn){
	if(!(/^([0-9])*$/.test(each)) || !(/^([0-9])*$/.test(amount))){
		if(!(/^([0-9])*$/.test(each)) && !(/^([0-9])*$/.test(amount))){
			alert('Generación de zanahorias - Turnos - Formato incorrecto');
			alert('Generación de zanahorias - Cantidad - Formato incorrecto');
		}else if(!(/^([0-9])*$/.test(each))){
			alert('Generación de zanahorias - Turnos - Formato incorrecto');
		}else{
			alert('Generación de zanahorias - Cantidad - Formato incorrecto');
		}
		return false;
	}else{
		each = parseInt(each);
		amount = parseInt(amount);
		turn = parseInt(turn);

		if(each > turn){
			alert('Generación de zanahorias - Turnos - El número de turnos no puede ser mayor que el total de la ejecución');
			return false;
		}else{
			return true;
		}
	}
}

// Generación de lobos
function moreWolf(each, amount, turn){
	if(!(/^([0-9])*$/.test(each)) || !(/^([0-9])*$/.test(amount))){
		if(!(/^([0-9])*$/.test(each)) && !(/^([0-9])*$/.test(amount))){
			alert('Generación de lobos - Turnos - Formato incorrecto');
			alert('Generación de lobos - Cantidad - Formato incorrecto');
		}else if(!(/^([0-9])*$/.test(each))){
			alert('Generación de lobos - Turnos - Formato incorrecto');
		}else{
			alert('Generación de lobos - Cantidad - Formato incorrecto');
		}
		return false;
	}else{
		each = parseInt(each);
		amount = parseInt(amount);
		turn = parseInt(turn);

		if(each > turn){
			alert('Generación de lobos - Turnos - El número de turnos no puede ser mayor que el total de la ejecución');
			return false;
		}else{
			return true;
		}
	}
}

// Días sin comer
// 0 para muerte por día en caso negativo
function maxEat(eatRabbit, eatWolf){
	if(!(/^([0-9])*$/.test(eatRabbit)) || !(/^([0-9])*$/.test(eatWolf))){
		if(!(/^([0-9])*$/.test(eatRabbit))){
			alert('Días sin comer - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(eatWolf))){
			alert('Días sin comer - Lobos - Formato incorrecto');
		}
		return false;
	}else{
		return true;
	}
}

// Días sin dormir
// 0 para muerte por día en caso negativo
function maxSleep(sleepRabbit, sleepWolf){
	if(!(/^([0-9])*$/.test(sleepRabbit)) || !(/^([0-9])*$/.test(sleepWolf))){
		if(!(/^([0-9])*$/.test(sleepRabbit))){
			alert('Días sin dormir - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(sleepWolf))){
			alert('Días sin dormir - Lobos - Formato incorrecto');
		}
		return false;
	}else{
		return true;
	}
}

// Turnos para comer
function turnEat(turnEatRabbit, turnEatWolf, day){
	if(!(/^([0-9])*$/.test(turnEatRabbit)) || !(/^([0-9])*$/.test(turnEatWolf))){
		if(!(/^([0-9])*$/.test(turnEatRabbit)) && !(/^([0-9])*$/.test(turnEatWolf))){
			alert('Turnos para comer - Conejos - Formato incorrecto');
			alert('Turnos para comer - Lobos - Formato incorrecto');
		}else if(!(/^([0-9])*$/.test(turnEatRabbit))){
			alert('Turnos para comer - Conejos - Formato incorrecto');
		}else{
			alert('Turnos para comer - Lobos - Formato incorrecto');
		}
	}else{
		turnEatRabbit = parseInt(turnEatRabbit);
		turnEatWolf = parseInt(turnEatWolf);
		day = parseInt(day);

		if(turnEatRabbit > day && turnEatWolf > day){
			alert('Los conejos no pueden tardar más de la duración de un día para comer');
			alert('Los lobos no pueden tardar más de la duración de un día para comer');
			return false;
		}else if(turnEatRabbit > day){
			alert('Los conejos no pueden tardar más de la duración de un día para comer');
			return false;
		}else if(turnEatWolf > day){
			alert('Los lobos no pueden tardar más de la duración de un día para comer');
			return false;
		}else{
			return true;
		}
	}
}

// Turnos para dormir
function turnSleep(turnSleepRabbit, turnSleepWolf, night){
	if(!(/^([0-9])*$/.test(turnSleepRabbit)) || !(/^([0-9])*$/.test(turnSleepWolf))){
		if(!(/^([0-9])*$/.test(turnSleepRabbit)) && !(/^([0-9])*$/.test(turnSleepWolf))){
			alert('Turnos para dormir - Conejos - Formato incorrecto');
			alert('Turnos para dormir - Lobos - Formato incorrecto');
		}else if(!(/^([0-9])*$/.test(turnSleepRabbit))){
			alert('Turnos para dormir - Conejos - Formato incorrecto');
		}else{
			alert('Turnos para dormir - Lobos - Formato incorrecto');
		}
		return false;
	}else{
		turnSleepRabbit = parseInt(turnSleepRabbit);
		turnSleepWolf = parseInt(turnSleepWolf);
		night = parseInt(night);

		if(turnSleepRabbit > parseInt(night * 1.5) && turnSleepWolf > parseInt(night * 1.5)){
			alert('Los conejos no pueden tardar más del 150% de la duración de una noche para dormir');
			alert('Los lobos no pueden tardar más del 150% de la duración de una noche para dormir');
			return false;
		}else if(turnSleepRabbit > parseInt(night * 1.5)){
			alert('Los conejos no pueden tardar más del 150% de la duración de una noche para dormir');
			return false;
		}else if(turnSleepWolf > parseInt(night * 1.5)){
			alert('Los lobos no pueden tardar más del 150% de la duración de una noche para dormir');
			return false;
		}else{
			return true;
		}
	}
}

// Puntos por turno
function maxUse(maxUseRabbit, maxUseWolf){
	if(!(/^([0-9])*$/.test(maxUseRabbit)) || !(/^([0-9])*$/.test(maxUseWolf))){
		if(!(/^([0-9])*$/.test(maxUseRabbit)) && !(/^([0-9])*$/.test(maxUseWolf))){
			alert('Puntos por acciones - Conejos - Formato incorrecto');
			alert('Puntos por acciones - Lobos - Formato incorrecto');
		}else if(!(/^([0-9])*$/.test(maxUseRabbit))){
			alert('Puntos por acciones - Conejos - Formato incorrecto');
		}else{
			alert('Puntos por acciones - Lobos - Formato incorrecto');
		}
		return false;
	}else{
		return true;
	}
}

// Consumo de puntos por acción
function useAct(smellRabbitUse, hearRabbitUse, seeRabbitUse, moveRabbitUse, sleepRabbitUse, breedRabbitUse, 
	smellWolfUse, hearWolfUse, seeWolfUse, moveWolfUse, sleepWolfUse, breedWolfUse){
	if(!(/^([0-9])*$/.test(smellRabbitUse)) || !(/^([0-9])*$/.test(hearRabbitUse)) || !(/^([0-9])*$/.test(seeRabbitUse)) ||
		!(/^([0-9])*$/.test(moveRabbitUse)) || !(/^([0-9])*$/.test(sleepRabbitUse)) || !(/^([0-9])*$/.test(breedRabbitUse)) ||
		!(/^([0-9])*$/.test(smellWolfUse)) || !(/^([0-9])*$/.test(hearWolfUse)) || !(/^([0-9])*$/.test(seeWolfUse)) ||
		!(/^([0-9])*$/.test(moveWolfUse)) || !(/^([0-9])*$/.test(sleepWolfUse)) || !(/^([0-9])*$/.test(breedWolfUse))){
		if(!(/^([0-9])*$/.test(smellRabbitUse))){
			alert('Consumo por acción - Olfatear - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(hearRabbitUse))){
			alert('Consumo por acción - Oir - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(seeRabbitUse))){
			alert('Consumo por acción - Ver - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(moveRabbitUse))){
			alert('Consumo por acción - Mover - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(sleepRabbitUse))){
			alert('Consumo por acción - Dormir - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(breedRabbitUse))){
			alert('Consumo por acción - Reproducirse - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(smellWolfUse))){
			alert('Consumo por acción - Olfatear - Lobos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(hearWolfUse))){
			alert('Consumo por acción - Oir - Lobos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(seeWolfUse))){
			alert('Consumo por acción - Ver - Lobos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(moveWolfUse))){
			alert('Consumo por acción - Mover - Lobos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(sleepWolfUse))){
			alert('Consumo por acción - Dormir - Lobos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(breedWolfUse))){
			alert('Consumo por acción - Reproducirse - Lobos - Formato incorrecto');
		}
		return false;
	}else{
		return true;
	}
}

// Rango por acción
function rangeAct(seeRabbit, seeWolf, smellRabbit, smellWolf, hearRabbit, hearWolf){
	if(!(/^([0-9])*$/.test(seeRabbit)) || !(/^([0-9])*$/.test(seeWolf)) || !(/^([0-9])*$/.test(smellRabbit)) || 
		!(/^([0-9])*$/.test(smellWolf)) || !(/^([0-9])*$/.test(hearRabbit)) || !(/^([0-9])*$/.test(hearWolf))){
		if(!(/^([0-9])*$/.test(seeRabbit))){
			alert('Rango por acción - Ver - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(seeWolf))){
			alert('Rango por acción - Ver - Lobos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(smellRabbit))){
			alert('Rango por acción - Olfatear- Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(smellWolf))){
			alert('Rango por acción - Olfatear - Lobos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(hearRabbit))){
			alert('Rango por acción - Oir - Conejos - Formato incorrecto');
		}
		if(!(/^([0-9])*$/.test(hearWolf))){
			alert('Rango por acción - Oir - Lobos - Formato incorrecto');
		}
		return false;
	}else{
		return true;
	}
}