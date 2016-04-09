/**
 * var Language
 */
var language = location.search.substring(6);

/**
 * It checks if all inputs are correct
 *
 * @return {Boolean}
 */
function check(){
	var values = getValues();
	
	var checks = {
		'world' : [
			totalPeriod(values['totalPeriod']), 
			dayPeriod(values['dayPeriod']), 
			nightPeriod(values['nightPeriod']), 
			dimensions(values['sizeX'], values['sizeY']), 
			changeWeather(values['changeWeather'], values['totalPeriod'])
		],
		'element' : [
			amountElements(values['carrot'], values['tree'], values['lair'], values['rabbit'], values['wolf'], values['sizeX'], values['sizeY']), 
			moreCarrot(values['eachCarrot'], values['amountCarrot'], values['totalPeriod']),
			strickingCarrot(values['lifetimeCarrot'], values['carrot'])
		],
		'restriction' : [
			maxEat(values['eatRabbit'], values['eatWolf'], values['rabbit'], values['wolf']),
			maxSleep(values['sleepRabbit'], values['sleepWolf'], values['rabbit'], values['wolf']),
			placeToSleepRabbit(),
			breed(values['breedRabbitEach'], values['breedRabbitAmount'], values['breedWolfEach'], values['breedWolfAmount'], values['rabbit'], values['wolf'])
		],
		'period' : [
			turnEat(values['turnEatRabbit'], values['turnEatWolf'], values['dayPeriod'], values['rabbit'], values['wolf']),
			noNeedToEat(values['noNeedToEatRabbit'], values['noNeedToEatWolf'], values['eatRabbit'], values['eatWolf'], values['rabbit'], values['wolf']),
			turnSleep(values['turnSleepRabbit'], values['turnSleepWolf'], values['rabbit'], values['wolf']),
			notSleepy(values['notSleepyRabbit'], values['notSleepyWolf'], values['sleepRabbit'], values['sleepWolf'], values['rabbit'], values['wolf'])
		],
		'action' : [
			maxUse(values['maxUseRabbit'], values['maxUseWolf'], values['rabbit'], values['wolf']),
			useAct(values['smellRabbitUse'], values['smellWolfUse'], values['hearRabbitUse'], values['hearWolfUse'], 
				values['seeRabbitUse'], values['seeWolfUse'], values['moveRabbitUse'], values['moveWolfUse'], 
				values['sleepRabbitUse'], values['sleepWolfUse'], values['breedRabbitUse'], values['breedWolfUse'],
				values['rabbit'], values['wolf'])
		],
		'range' : [
			rangeAct(values['seeRabbit'], values['seeWolf'], values['smellRabbit'], values['smellWolf'], values['hearRabbit'], values['hearWolf'], values['rabbit'], values['wolf']),
			comfort(values['eatComfortRabbit'], values['eatComfortWolf'], values['sleepComfortRabbit'], values['sleepComfortWolf'], values['rabbit'], values['wolf'])
		],
		'behaviour' : [
			codeRabbit(values['codeRabbit']),
			codeWolf(values['codeWolf'])
		]
	};

	for(var key in checks){
		for(var i = 0; i < checks[key].length; i++){
			if(checks[key][i] == false){
				switch(key){
					case 'world':
						world();
						break;
					case 'element':
						element();
						break;
					case 'restriction':
						restriction();
						break;
					case 'period':
						period();
						break;
					case 'action':
						action();
						break;
					case 'range':
						range();
						break;
					case 'behaviour':
						behaviour();
						break;
				}

				return false;
			}
		}
	}

	return true;
}

/**
 * It gets the values of the inputs, store them in a hashmap and return it
 *
 * @return {Object}
 */
function getValues(){
	var totalPeriod = document.getElementById('totalPeriod').value;
	var dayPeriod = document.getElementById('dayPeriod').value;
	var nightPeriod = document.getElementById('nightPeriod').value;
	var sizeX = document.getElementById('sizeX').value;
	var sizeY = document.getElementById('sizeY').value;
	var changeWeather = document.getElementById('changeWeather').value;
	var carrot = document.getElementById('carrot').value;
	var tree = document.getElementById('tree').value;
	var lair = document.getElementById('lair').value;
	var rabbit = document.getElementById('rabbit').value;
	var wolf = document.getElementById('wolf').value;
	var eachCarrot = document.getElementById('timeMoreCarrot').value;
	var amountCarrot = document.getElementById('amountMoreCarrot').value;
	var eatRabbit = document.getElementById('maxEatRabbit').value;
	var eatWolf = document.getElementById('maxEatWolf').value;
	var sleepRabbit = document.getElementById('maxSleepRabbit').value;
	var sleepWolf = document.getElementById('maxSleepWolf').value;
	var noNeedToEatRabbit = document.getElementById('noNeedToEatRabbit').value;
	var noNeedToEatWolf = document.getElementById('noNeedToEatWolf').value;
	var breedRabbitEach = document.getElementById('breedRabbitEach').value;
	var breedWolfEach = document.getElementById('breedWolfEach').value;
	var breedRabbitAmount = document.getElementById('breedRabbitAmount').value;
	var breedWolfAmount = document.getElementById('breedWolfAmount').value;
	var turnEatRabbit = document.getElementById('turnEatRabbit').value;
	var turnEatWolf = document.getElementById('turnEatWolf').value;
	var turnSleepRabbit = document.getElementById('turnSleepRabbit').value;
	var turnSleepWolf = document.getElementById('turnSleepWolf').value;
	var maxUseRabbit = document.getElementById('maxUseRabbit').value;
	var maxUseWolf = document.getElementById('maxUseWolf').value;
	var smellRabbitUse = document.getElementById('smellRabbitUse').value;
	var smellWolfUse = document.getElementById('smellWolfUse').value;
	var hearRabbitUse = document.getElementById('hearRabbitUse').value;
	var hearWolfUse = document.getElementById('hearWolfUse').value;
	var seeRabbitUse = document.getElementById('seeRabbitUse').value;
	var seeWolfUse = document.getElementById('seeWolfUse').value;
	var moveRabbitUse = document.getElementById('moveRabbitUse').value;
	var moveWolfUse = document.getElementById('moveWolfUse').value;
	var sleepRabbitUse = document.getElementById('sleepRabbitUse').value;
	var sleepWolfUse = document.getElementById('sleepWolfUse').value;
	var breedRabbitUse = document.getElementById('breedRabbitUse').value;
	var breedWolfUse = document.getElementById('breedWolfUse').value;
	var seeRabbit = document.getElementById('seeRabbit').value;
	var seeWolf = document.getElementById('seeWolf').value;
	var smellRabbit = document.getElementById('smellRabbit').value;
	var smellWolf = document.getElementById('smellWolf').value;
	var hearRabbit = document.getElementById('hearRabbit').value;
	var hearWolf = document.getElementById('hearWolf').value;
	var eatComfortRabbit = document.getElementById('eatComfortRabbit').value;
	var eatComfortWolf = document.getElementById('eatComfortWolf').value;
	var sleepComfortRabbit = document.getElementById('sleepComfortRabbit').value;
	var sleepComfortWolf = document.getElementById('sleepComfortWolf').value;
	var codeRabbit = document.getElementById('codeRabbit').value;
	var codeWolf = document.getElementById('codeWolf').value;
	var notSleepyRabbit = document.getElementById('notSleepyRabbit').value;
	var notSleepyWolf = document.getElementById('notSleepyWolf').value;
	var lifetimeCarrot = document.getElementById('lifetimeCarrot').value;

	return {
		'totalPeriod' : totalPeriod,
		'dayPeriod' : dayPeriod,
		'nightPeriod' : nightPeriod,
		'sizeX' : sizeX,
		'sizeY' : sizeY,
		'changeWeather' : changeWeather,
		'carrot' : carrot,
		'tree' : tree,
		'lair' : lair,
		'rabbit' : rabbit,
		'wolf' : wolf,
		'eachCarrot' : eachCarrot,
		'amountCarrot' : amountCarrot,
		'eatRabbit' : eatRabbit,
		'eatWolf' : eatWolf,
		'sleepRabbit' : sleepRabbit,
		'sleepWolf' : sleepWolf,
		'noNeedToEatRabbit' : noNeedToEatRabbit,
		'noNeedToEatWolf' : noNeedToEatWolf,
		'breedRabbitEach' : breedRabbitEach,
		'breedWolfEach' : breedWolfEach,
		'breedRabbitAmount' : breedRabbitAmount,
		'breedWolfAmount' : breedWolfAmount,
		'turnEatRabbit' : turnEatRabbit,
		'turnEatWolf' : turnEatWolf,
		'turnSleepRabbit' : turnSleepRabbit,
		'turnSleepWolf' : turnSleepWolf,
		'maxUseRabbit' : maxUseRabbit,
		'maxUseWolf' : maxUseWolf,
		'smellRabbitUse' : smellRabbitUse,
		'smellWolfUse' : smellWolfUse,
		'hearRabbitUse' : hearRabbitUse,
		'hearWolfUse' : hearWolfUse,
		'seeRabbitUse' : seeRabbitUse,
		'seeWolfUse' : seeWolfUse,
		'moveRabbitUse' : moveRabbitUse,
		'moveWolfUse' : moveWolfUse,
		'sleepRabbitUse' : sleepRabbitUse,
		'sleepWolfUse' : sleepWolfUse,
		'breedRabbitUse' : breedRabbitUse,
		'breedWolfUse' : breedWolfUse,
		'seeRabbit' : seeRabbit,
		'seeWolf' : seeWolf,
		'smellRabbit' : smellRabbit,
		'smellWolf' : smellWolf,
		'hearRabbit' : hearRabbit,
		'hearWolf' : hearWolf,
		'eatComfortRabbit' : eatComfortRabbit,
		'eatComfortWolf' : eatComfortWolf,
		'sleepComfortRabbit' : sleepComfortRabbit,
		'sleepComfortWolf' : sleepComfortWolf,
		'codeRabbit' : codeRabbit,
		'codeWolf' : codeWolf,
		'notSleepyRabbit' : notSleepyRabbit,
		'notSleepyWolf' : notSleepyWolf,
		'lifetimeCarrot' : lifetimeCarrot
	};
}

/**
 * It checks if the input 'length' has the correct format, changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function totalPeriod(totalPeriod){
	if(totalPeriod == ''){
		document.getElementById('totalPeriod').style.borderColor = '#a94442';
		document.getElementById('totalPeriod').style.borderWidth = '2px';
		document.getElementById('alert1').className = 'alert alert-danger show';
		document.getElementById('error1').innerHTML = translate('Total period - Empty field', language);

		return false;
	}else if(!(/^([0-9])*$/.test(totalPeriod))){
		document.getElementById('totalPeriod').style.borderColor = '#a94442';
		document.getElementById('totalPeriod').style.borderWidth = '2px';
		document.getElementById('alert1').className = 'alert alert-danger show';
		document.getElementById('error1').innerHTML = translate('Total period - Wrong format', language);

		return false;
	}else{
		var totalPeriod = parseInt(totalPeriod);

		if(totalPeriod < 2){
			document.getElementById('totalPeriod').style.borderColor = '#a94442';
			document.getElementById('totalPeriod').style.borderWidth = '2px';
			document.getElementById('alert1').className = 'alert alert-danger show';
			document.getElementById('error1').innerHTML = translate('Total period - It must be equal or more than 2', language);

			return false;
		}else{
			document.getElementById('totalPeriod').style.borderColor = '#3c763d';
			document.getElementById('totalPeriod').style.borderWidth = '2px';
			document.getElementById('alert1').className = 'hide';

			return true;
		}
	}
}

/**
 * It checks if the input 'daylight' has the correct format, changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function dayPeriod(dayPeriod){
	if(dayPeriod == ''){
		document.getElementById('dayPeriod').style.borderColor = '#a94442';
		document.getElementById('dayPeriod').style.borderWidth = '2px';
		document.getElementById('alert2').className = 'alert alert-danger show';
		document.getElementById('error2').innerHTML = translate('Daylight period - Empty field', language);

		return false;
	}else if(!(/^([0-9])*$/.test(dayPeriod))){
		document.getElementById('dayPeriod').style.borderColor = '#a94442';
		document.getElementById('dayPeriod').style.borderWidth = '2px';
		document.getElementById('alert2').className = 'alert alert-danger show';
		document.getElementById('error2').innerHTML = translate('Daylight period - Wrong format', language);

		return false;
	}else{
		var dayPeriod = parseInt(dayPeriod);

		if(dayPeriod < 1){
			document.getElementById('dayPeriod').style.borderColor = '#a94442';
			document.getElementById('dayPeriod').style.borderWidth = '2px';
			document.getElementById('alert2').className = 'alert alert-danger show';
			document.getElementById('error2').innerHTML = translate('Daylight period - It must be equal or more than 1');

			return false;
		}else{
			document.getElementById('dayPeriod').style.borderColor = '#3c763d';
			document.getElementById('dayPeriod').style.borderWidth = '2px';
			document.getElementById('alert2').className = 'hide';

			return true;
		}
	}
}

/**
 * It checks if the input 'night' has the correct format, changes the colour of the input
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function nightPeriod(nightPeriod){
	if(nightPeriod == ''){
		document.getElementById('nightPeriod').style.borderColor = '#a94442';
		document.getElementById('nightPeriod').style.borderWidth = '2px';
		document.getElementById('alert3').className = 'alert alert-danger show';
		document.getElementById('error3').innerHTML = translate('Night period - Empty field', language);

		return false;
	}else if(!(/^([0-9])*$/.test(nightPeriod))){
		document.getElementById('nightPeriod').style.borderColor = '#a94442';
		document.getElementById('nightPeriod').style.borderWidth = '2px';
		document.getElementById('alert3').className = 'alert alert-danger show';
		document.getElementById('error3').innerHTML = translate('Night period - Wrong format', language);

		return false;
	}else{
		var nightPeriod = parseInt(nightPeriod);

		if(nightPeriod < 1){
			document.getElementById('nightPeriod').style.borderColor = '#a94442';
			document.getElementById('nightPeriod').style.borderWidth = '2px';
			document.getElementById('alert3').className = 'alert alert-danger show';
			document.getElementById('error3').innerHTML = translate('Night period - It must be equal or more than 1', language);
			
			return false;
		}else{
			document.getElementById('nightPeriod').style.borderColor = '#3c763d';
			document.getElementById('nightPeriod').style.borderWidth = '2px';
			document.getElementById('alert3').className = 'hide';

			return true;
		}
	}
}

/**
 * It checks if the input 'width' and 'height' have the correct format, changes the colour of the input
 * (green if it is correct or red if not) and throw a new message if they have an error
 *
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function dimensions(sizeX, sizeY){
	if(sizeX == '' || sizeY == ''){
		if(sizeX == ''){
			document.getElementById('sizeX').style.borderColor = '#a94442';
			document.getElementById('sizeX').style.borderWidth = '2px';
			document.getElementById('alert4').className = 'alert alert-danger show';
			document.getElementById('error4').innerHTML = translate('Size (height) of the world - Empty field', language);
		}
		
		if(sizeY == ''){
			document.getElementById('sizeY').style.borderColor = '#a94442';
			document.getElementById('sizeY').style.borderWidth = '2px';
			document.getElementById('alert5').className = 'alert alert-danger show';
			document.getElementById('error5').innerHTML = translate('Size (width) of the world - Empty field', language);
		}

		return false;
	}else if(!(/^([0-9])*$/.test(sizeX)) || !(/^([0-9])*$/.test(sizeY))){
		if(!(/^([0-9])*$/.test(sizeX))){
			document.getElementById('sizeX').style.borderColor = '#a94442';
			document.getElementById('sizeX').style.borderWidth = '2px';
			document.getElementById('alert4').className = 'alert alert-danger show';
			document.getElementById('error4').innerHTML = translate('Size (height) of the world - Wrong format', language);
		}else{
			sizeX = parseInt(sizeX);

			if(sizeX < 1){
				document.getElementById('sizeX').style.borderColor = '#a94442';
				document.getElementById('sizeX').style.borderWidth = '2px';
				document.getElementById('alert4').className = 'alert alert-danger show';
				document.getElementById('error4').innerHTML = translate('Size (height) of the world - It must be equal or more than 1' , language);
			}else{
				document.getElementById('sizeX').style.borderColor = '#3c763d';
				document.getElementById('sizeX').style.borderWidth = '2px';
				document.getElementById('alert4').className = 'hide';
			}
		}

		if(!(/^([0-9])*$/.test(sizeY))){
			document.getElementById('sizeY').style.borderColor = '#a94442';
			document.getElementById('sizeY').style.borderWidth = '2px';
			document.getElementById('alert5').className = 'alert alert-danger show';
			document.getElementById('error5').innerHTML = translate('Size (width) of the world - Wrong format', language);
		}else{
			sizeY = parseInt(sizeY);

			if(sizeY < 1){
				document.getElementById('sizeY').style.borderColor = '#a94442';
				document.getElementById('sizeY').style.borderWidth = '2px';
				document.getElementById('alert5').className = 'alert alert-danger show';
				document.getElementById('error5').innerHTML = translate('Size (width) of the world - It must be equal or more than 1', language);
			}else{
				document.getElementById('sizeY').style.borderColor = '#3c763d';
				document.getElementById('sizeY').style.borderWidth = '2px';
				document.getElementById('alert5').className = 'hide';
			}
		}

		return false;
	}else{
		sizeX = parseInt(sizeX);
		sizeY = parseInt(sizeY);

		if(sizeX < 1 || sizeY < 1){
			if(sizeX < 1){
				document.getElementById('sizeX').style.borderColor = '#a94442';
				document.getElementById('sizeX').style.borderWidth = '2px';
				document.getElementById('alert4').className = 'alert alert-danger show';
				document.getElementById('error4').innerHTML = translate('Size (height) of the world - It must be equal or more than 1' , language);
			}else{
				document.getElementById('sizeX').style.borderColor = '#3c763d';
				document.getElementById('sizeX').style.borderWidth = '2px';
				document.getElementById('alert4').className = 'hide';
			}

			if(sizeY < 1){
				document.getElementById('sizeY').style.borderColor = '#a94442';
				document.getElementById('sizeY').style.borderWidth = '2px';
				document.getElementById('alert5').className = 'alert alert-danger show';
				document.getElementById('error5').innerHTML = translate('Size (width) of the world - It must be equal or more than 1', language);
			}else{
				document.getElementById('sizeY').style.borderColor = '#3c763d';
				document.getElementById('sizeY').style.borderWidth = '2px';
				document.getElementById('alert5').className = 'hide';
			}

			return false;
		}else{
			document.getElementById('sizeX').style.borderColor = '#3c763d';
			document.getElementById('sizeX').style.borderWidth = '2px';
			document.getElementById('sizeY').style.borderColor = '#3c763d';
			document.getElementById('sizeY').style.borderWidth = '2px';
			document.getElementById('alert4').className = 'hide';
			document.getElementById('alert5').className = 'hide';
			
			return true;
		}
	}
}

/**
 * It checks if the input 'change weather' has the correct format, changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function changeWeather(change, totalPeriod){
	document.getElementById('weather').style.borderColor = '#3c763d';
	document.getElementById('weather').style.borderWidth = '2px';

	if(change == ''){
		document.getElementById('changeWeather').style.borderColor = '#a94442';
		document.getElementById('changeWeather').style.borderWidth = '2px';
		document.getElementById('alert6').className = 'alert alert-danger show';
		document.getElementById('error6').innerHTML = translate('Change weather each (cycles) - Empty field', language);

		return false;
	}else if(!(/^([0-9])*$/.test(change))){
		document.getElementById('changeWeather').style.borderColor = '#a94442';
		document.getElementById('changeWeather').style.borderWidth = '2px';
		document.getElementById('alert6').className = 'alert alert-danger show';
		document.getElementById('error6').innerHTML = translate('Change weather each (cycles) - Wrong format', language);

		return false;
	}else{
		totalPeriod = parseInt(totalPeriod);
		change = parseInt(change);

		if(change > totalPeriod){
			document.getElementById('changeWeather').style.borderColor = '#a94442';
			document.getElementById('changeWeather').style.borderWidth = '2px';
			document.getElementById('alert6').className = 'alert alert-danger show';
			document.getElementById('error6').innerHTML = translate('Change weather each (cycles) - It must be equal or less than total period', language);

			return false;
		}else{
			document.getElementById('changeWeather').style.borderColor = '#3c763d';
			document.getElementById('changeWeather').style.borderWidth = '2px';
			document.getElementById('alert6').className = 'hide';

			return true;
		}
	}
}

/**
 * It checks if the amount of elements to create isn't more big than the size of the world
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number}
 * @param {Number}
 *
 * @return {Boolean}
 */
function checkAmountElements(carrot, tree, lair, rabbit, wolf, sizeX, sizeY){
	carrot = parseInt(carrot);
	tree = parseInt(tree);
	lair = parseInt(lair);
	rabbit = parseInt(rabbit);
	wolf = parseInt(wolf);
	sizeX = parseInt(sizeX);
	sizeY = parseInt(sizeY);

	if(carrot + tree + lair + rabbit + wolf > sizeX * sizeY){
		return false;
	}else{
		return true;
	}
}

/**
 * It checks if the inputs 'amount of carrots', 'amount of trees', 'amount of lairs', 'amount of rabbits' and 'amount of wolfs'
 * have the correct format and changes the colour of the input (green if it is correct or red if not)
 * and throw a new message if they have an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number}
 * @param {Number}
 *
 * @return {Boolean}
 */
function amountElements(carrot, tree, lair, rabbit, wolf, sizeX, sizeY){
	if(carrot == '' || tree == '' || lair == '' || rabbit == '' || wolf == ''){
		if(carrot == ''){
			document.getElementById('carrot').style.borderColor = '#a94442';
			document.getElementById('carrot').style.borderWidth = '2px';
			document.getElementById('alert7').className = 'alert alert-danger show';
			document.getElementById('error7').innerHTML = translate('Amount of carrots - Empty field', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}

		if(tree == ''){
			document.getElementById('tree').style.borderColor = '#a94442';
			document.getElementById('tree').style.borderWidth = '2px';
			document.getElementById('alert8').className = 'alert alert-danger show';
			document.getElementById('error8').innerHTML = translate('Amount of trees - Empty field', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}

		if(lair == ''){
			document.getElementById('lair').style.borderColor = '#a94442';
			document.getElementById('lair').style.borderWidth = '2px';
			document.getElementById('alert9').className = 'alert alert-danger show';
			document.getElementById('error9').innerHTML = translate('Amount of lair - Empty field', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}

		if(rabbit == ''){
			document.getElementById('rabbit').style.borderColor = '#a94442';
			document.getElementById('rabbit').style.borderWidth = '2px';
			document.getElementById('alert10').className = 'alert alert-danger show';
			document.getElementById('error10').innerHTML = translate('Amount of rabbits - Empty field', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}

		if(wolf == ''){
			document.getElementById('wolf').style.borderColor = '#a94442';
			document.getElementById('wolf').style.borderWidth = '2px';
			document.getElementById('alert11').className = 'alert alert-danger show';
			document.getElementById('error11').innerHTML = translate('Amount of wolves - Empty field', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}

		return false;
	}

	if(!(/^([0-9])*$/.test(carrot)) || !(/^([0-9])*$/.test(tree)) || !(/^([0-9])*$/.test(lair)) || !(/^([0-9])*$/.test(rabbit)) || !(/^([0-9])*$/.test(wolf))){
		if(!(/^([0-9])*$/.test(carrot))){
			document.getElementById('carrot').style.borderColor = '#a94442';
			document.getElementById('carrot').style.borderWidth = '2px';
			document.getElementById('alert7').className = 'alert alert-danger show';
			document.getElementById('error7').innerHTML = translate('Amount of carrots - Wrong format', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}else{
			document.getElementById('carrot').style.borderColor = '#3c763d';
			document.getElementById('carrot').style.borderWidth = '2px';
			document.getElementById('alert7').className = 'alert alert-danger hide';
		}

		if(!(/^([0-9])*$/.test(tree))){
			document.getElementById('tree').style.borderColor = '#a94442';
			document.getElementById('tree').style.borderWidth = '2px';
			document.getElementById('alert8').className = 'alert alert-danger show';
			document.getElementById('error8').innerHTML = translate('Amount of trees - Wrong format', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}else{
			document.getElementById('tree').style.borderColor = '#3c763d';
			document.getElementById('tree').style.borderWidth = '2px';
			document.getElementById('alert8').className = 'alert alert-danger hide';
		}

		if(!(/^([0-9])*$/.test(lair))){
			document.getElementById('lair').style.borderColor = '#a94442';
			document.getElementById('lair').style.borderWidth = '2px';
			document.getElementById('alert9').className = 'alert alert-danger show';
			document.getElementById('error9').innerHTML = translate('Amount of lair - Wrong format', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}else{
			document.getElementById('lair').style.borderColor = '#3c763d';
			document.getElementById('lair').style.borderWidth = '2px';
			document.getElementById('alert9').className = 'alert alert-danger hide';
		}

		if(!(/^([0-9])*$/.test(rabbit))){
			document.getElementById('rabbit').style.borderColor = '#a94442';
			document.getElementById('rabbit').style.borderWidth = '2px';
			document.getElementById('alert10').className = 'alert alert-danger show';
			document.getElementById('error10').innerHTML = translate('Amount of rabbits - Wrong format', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}else{
			document.getElementById('rabbit').style.borderColor = '#3c763d';
			document.getElementById('rabbit').style.borderWidth = '2px';
			document.getElementById('alert10').className = 'alert alert-danger hide';
		}

		if(!(/^([0-9])*$/.test(wolf))){
			document.getElementById('wolf').style.borderColor = '#a94442';
			document.getElementById('wolf').style.borderWidth = '2px';
			document.getElementById('alert11').className = 'alert alert-danger show';
			document.getElementById('error11').innerHTML = translate('Amount of wolves - Wrong format', language);
			document.getElementById('alert12').className = 'alert alert-danger hide';
		}else{
			document.getElementById('wolf').style.borderColor = '#3c763d';
			document.getElementById('wolf').style.borderWidth = '2px';
			document.getElementById('alert11').className = 'alert alert-danger hide';
		}

		return false;
	}else if(!checkAmountElements(carrot, tree, lair, rabbit, wolf, sizeX, sizeY)){
		document.getElementById('carrot').style.borderColor = '#a94442';
		document.getElementById('carrot').style.borderWidth = '2px';
		document.getElementById('tree').style.borderColor = '#a94442';
		document.getElementById('tree').style.borderWidth = '2px';
		document.getElementById('lair').style.borderColor = '#a94442';
		document.getElementById('lair').style.borderWidth = '2px';
		document.getElementById('rabbit').style.borderColor = '#a94442';
		document.getElementById('rabbit').style.borderWidth = '2px';
		document.getElementById('wolf').style.borderColor = '#a94442';
		document.getElementById('wolf').style.borderWidth = '2px';

		document.getElementById('alert7').className = 'alert alert-danger hide';
		document.getElementById('alert8').className = 'alert alert-danger hide';
		document.getElementById('alert9').className = 'alert alert-danger hide';
		document.getElementById('alert10').className = 'alert alert-danger hide';
		document.getElementById('alert11').className = 'alert alert-danger hide';
		
		document.getElementById('alert12').className = 'alert alert-danger show';
		document.getElementById('error12').innerHTML = 'Cantidad inicial de elementos - Tiene que ser menor o igual que la dimensión del mundo';

		return false;
	}else{
		document.getElementById('carrot').style.borderColor = '#3c763d';
		document.getElementById('carrot').style.borderWidth = '2px';
		document.getElementById('tree').style.borderColor = '#3c763d';
		document.getElementById('tree').style.borderWidth = '2px';
		document.getElementById('lair').style.borderColor = '#3c763d';
		document.getElementById('lair').style.borderWidth = '2px';
		document.getElementById('rabbit').style.borderColor = '#3c763d';
		document.getElementById('rabbit').style.borderWidth = '2px';
		document.getElementById('wolf').style.borderColor = '#3c763d';
		document.getElementById('wolf').style.borderWidth = '2px';
		document.getElementById('alert7').className = 'hide';
		document.getElementById('alert8').className = 'hide';
		document.getElementById('alert9').className = 'hide';
		document.getElementById('alert10').className = 'hide';
		document.getElementById('alert11').className = 'hide';
		document.getElementById('alert12').className = 'hide';

		return true;
	}
}

/**
 * It checks if the inputs 'regeneration of carrots' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number}
 *
 * @return {Boolean}
 */
function moreCarrot(each, amount, totalPeriod){
	if(each == ''){
		document.getElementById('timeMoreCarrot').style.borderColor = '#a94442';
		document.getElementById('timeMoreCarrot').style.borderWidth = '2px';
		document.getElementById('alert13').className = 'alert alert-danger show';
		document.getElementById('error13').innerHTML = translate('Regeneration of carrots each - Empty field', language);
		document.getElementById('alert14').className = 'alert alert-danger hide';
	
		return false;
	}

	if(!(/^([0-9])*$/.test(each))){
		document.getElementById('timeMoreCarrot').style.borderColor = '#a94442';
		document.getElementById('timeMoreCarrot').style.borderWidth = '2px';
		document.getElementById('alert13').className = 'alert alert-danger show';
		document.getElementById('error13').innerHTML = translate('Regeneration of carrots each - Wrong format', language);
		document.getElementById('alert14').className = 'alert alert-danger hide';

		return false;
	}

	totalPeriod = parseInt(totalPeriod);
	each = parseInt(each);

	if(each > 0){
		if(each > totalPeriod){
			document.getElementById('timeMoreCarrot').style.borderColor = '#a94442';
			document.getElementById('timeMoreCarrot').style.borderWidth = '2px';
			document.getElementById('alert13').className = 'alert alert-danger show';
			document.getElementById('error13').innerHTML = translate('Regeneration of carrots each - The number of cycles mustn\'t be more than total period', language);
			
			return false;
		}else{
			document.getElementById('timeMoreCarrot').style.borderColor = '#3c763d';
			document.getElementById('timeMoreCarrot').style.borderWidth = '2px';
			document.getElementById('alert13').className = 'alert alert-danger hide';
		}

		if(amount == ''){
			document.getElementById('amountMoreCarrot').style.borderColor = '#a94442';
			document.getElementById('amountMoreCarrot').style.borderWidth = '2px';
			document.getElementById('alert14').className = 'alert alert-danger show';
			document.getElementById('error14').innerHTML = translate('Regeneration of carrots (amount) - Empty field', language);

			return false;
		}

		if(!(/^([0-9])*$/.test(amount))){
			document.getElementById('amountMoreCarrot').style.borderColor = '#a94442';
			document.getElementById('amountMoreCarrot').style.borderWidth = '2px';
			document.getElementById('alert14').className = 'alert alert-danger show';
			document.getElementById('error14').innerHTML = translate('Regeneration of carrots (amount) - Wrong format', language);

			return false;
		}else{
			document.getElementById('amountMoreCarrot').style.borderColor = '#3c763d';
			document.getElementById('amountMoreCarrot').style.borderWidth = '2px';
			document.getElementById('alert14').className = 'alert alert-danger hide';

			return true;
		}
	}else{
		document.getElementById('amountMoreCarrot').value = '';

		return true;
	}
}

/**
 * It checks if the inputs 'lifetime carrots' have the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {String}
 * @param {String}
 *
 * @return {Boolean}
 */
function strickingCarrot(lifetimeCarrot, amountCarrot){
	fail = 0;

	if(amountCarrot > 0){
		if(lifetimeCarrot == ''){
			document.getElementById('lifetimeCarrot').style.borderColor = '#a94442';
			document.getElementById('lifetimeCarrot').style.borderWidth = '2px';
			document.getElementById('alert57').className = 'alert alert-danger show';
			document.getElementById('error57').innerHTML = translate('Lifetime of carrots - Empty field', language);

			fail++;
		}else if(!(/^([0-9])*$/.test(lifetimeCarrot))){
			document.getElementById('lifetimeCarrot').style.borderColor = '#a94442';
			document.getElementById('lifetimeCarrot').style.borderWidth = '2px';
			document.getElementById('alert57').className = 'alert alert-danger show';
			document.getElementById('error57').innerHTML = translate('Lifetime of carrots - Wrong format', language);

			fail++;
		}else{
			document.getElementById('lifetimeCarrot').style.borderColor = '#3c763d';
			document.getElementById('lifetimeCarrot').style.borderWidth = '2px';
			document.getElementById('alert57').className = 'alert alert-danger hide';
		}
	}else{
		document.getElementById('lifetimeCarrot').value = 0;
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'period without eat' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function maxEat(eatRabbit, eatWolf, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(eatRabbit == ''){
				document.getElementById('maxEatRabbit').style.borderColor = '#a94442';
				document.getElementById('maxEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert15').className = 'alert alert-danger show';
				document.getElementById('error15').innerHTML = translate('Cycles without eat (rabbits) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(eatRabbit))){
				document.getElementById('maxEatRabbit').style.borderColor = '#a94442';
				document.getElementById('maxEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert15').className = 'alert alert-danger show';
				document.getElementById('error15').innerHTML = translate('Cycles without eat (rabbits) - Wrong format', language);

				fail++;
			}else{
				document.getElementById('maxEatRabbit').style.borderColor = '#3c763d';
				document.getElementById('maxEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert15').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(eatWolf == ''){
				document.getElementById('maxEatWolf').style.borderColor = '#a94442';
				document.getElementById('maxEatWolf').style.borderWidth = '2px';
				document.getElementById('alert16').className = 'alert alert-danger show';
				document.getElementById('error16').innerHTML = translate('Cycles without eat (wolves) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(eatWolf))){
				document.getElementById('maxEatWolf').style.borderColor = '#a94442';
				document.getElementById('maxEatWolf').style.borderWidth = '2px';
				document.getElementById('alert16').className = 'alert alert-danger show';
				document.getElementById('error16').innerHTML = translate('Cycles without eat (wolves) - Wrong format', language);

				fail++;
			}else{
				document.getElementById('maxEatWolf').style.borderColor = '#3c763d';
				document.getElementById('maxEatWolf').style.borderWidth = '2px';
				document.getElementById('alert16').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('maxEatRabbit').value = 0;
		document.getElementById('maxEatRabbit').style.borderWidth = '1px';
		document.getElementById('maxEatRabbit').style.borderColor = '#ccc';
		document.getElementById('alert15').className = 'alert alert-danger hide';

		document.getElementById('maxEatWolf').value = 0;
		document.getElementById('maxEatWolf').style.borderWidth = '1px';
		document.getElementById('maxEatWolf').style.borderColor = '#ccc';
		document.getElementById('alert16').className = 'alert alert-danger hide';
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'period without sleep' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function maxSleep(sleepRabbit, sleepWolf, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(sleepRabbit == ''){
				document.getElementById('maxSleepRabbit').style.borderColor = '#a94442';
				document.getElementById('maxSleepRabbit').style.borderWidth = '2px';
				document.getElementById('alert17').className = 'alert alert-danger show';
				document.getElementById('error17').innerHTML = translate('Cycles without sleep (rabbits) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(sleepRabbit))){
				document.getElementById('maxSleepRabbit').style.borderColor = '#a94442';
				document.getElementById('maxSleepRabbit').style.borderWidth = '2px';
				document.getElementById('alert17').className = 'alert alert-danger show';
				document.getElementById('error17').innerHTML = translate('Cycles without sleep (rabbits) - Wrong format', language);

				fail++;
			}else{
				document.getElementById('maxSleepRabbit').style.borderColor = '#3c763d';
				document.getElementById('maxSleepRabbit').style.borderWidth = '2px';
				document.getElementById('alert17').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(sleepWolf == ''){
				document.getElementById('maxSleepWolf').style.borderColor = '#a94442';
				document.getElementById('maxSleepWolf').style.borderWidth = '2px';
				document.getElementById('alert18').className = 'alert alert-danger show';
				document.getElementById('error18').innerHTML = translate('Cycles without sleep (wolves) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(sleepWolf))){
				document.getElementById('maxSleepWolf').style.borderColor = '#a94442';
				document.getElementById('maxSleepWolf').style.borderWidth = '2px';
				document.getElementById('alert18').className = 'alert alert-danger show';
				document.getElementById('error18').innerHTML = translate('Cycles without sleep (wolves) - Wrong format', language);

				fail++;
			}else{
				document.getElementById('maxSleepWolf').style.borderColor = '#3c763d';
				document.getElementById('maxSleepWolf').style.borderWidth = '2px';
				document.getElementById('alert18').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('maxSleepRabbit').value = 0;
		document.getElementById('alert17').className = 'alert alert-danger hide';
		document.getElementById('maxSleepRabbit').style.borderColor = '#ccc';
		document.getElementById('maxSleepRabbit').style.borderWidth = '1px';

		document.getElementById('maxSleepWolf').value = 0;
		document.getElementById('alert18').className = 'alert alert-danger hide';
		document.getElementById('maxSleepWolf').style.borderColor = '#ccc';
		document.getElementById('maxSleepWolf').style.borderWidth = '1px';
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the input 'place to sleep for rabbits' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @return {Boolean}
 */
function placeToSleepRabbit(){
	document.getElementById('placeToSleepRabbit').style.borderColor = '#3c763d';
	document.getElementById('placeToSleepRabbit').style.borderWidth = '2px';

	return true;
}

/**
 * It checks if the inputs 'breed for rabbits and wolfs' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function breed(breedRabbitEach, breedRabbitAmount, breedWolfEach, breedWolfAmount, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(breedRabbitEach == ''){
				document.getElementById('breedRabbitEach').style.borderColor = '#a94442';
				document.getElementById('breedRabbitEach').style.borderWidth = '2px';
				document.getElementById('alert19').className = 'alert alert-danger show';
				document.getElementById('error19').innerHTML = translate('Rabbits - Limit each (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(breedRabbitEach))){
				document.getElementById('breedRabbitEach').style.borderColor = '#a94442';
				document.getElementById('breedRabbitEach').style.borderWidth = '2px';
				document.getElementById('alert19').className = 'alert alert-danger show';
				document.getElementById('error19').innerHTML = translate('Rabbits - Limit each (cycles) - Wrong format', language);

				fail++;
			}else{
				document.getElementById('breedRabbitEach').style.borderColor = '#3c763d';
				document.getElementById('breedRabbitEach').style.borderWidth = '2px';
				document.getElementById('alert19').className = 'alert alert-danger hide';

				if(breedRabbitEach > 0){
					if(breedRabbitAmount == ''){
						document.getElementById('breedRabbitAmount').style.borderColor = '#a94442';
						document.getElementById('breedRabbitAmount').style.borderWidth = '2px';
						document.getElementById('alert20').className = 'alert alert-danger show';
						document.getElementById('error20').innerHTML = translate('Rabbits - Maximum amount - Empty field', language);

						fail++;
					}else if(!(/^([0-9])*$/.test(breedRabbitAmount))){
						document.getElementById('breedRabbitAmount').style.borderColor = '#a94442';
						document.getElementById('breedRabbitAmount').style.borderWidth = '2px';
						document.getElementById('alert20').className = 'alert alert-danger show';
						document.getElementById('error20').innerHTML = translate('Rabbits - Maximum amount - Wrong format', language);

						fail++;
					}else{
						document.getElementById('breedRabbitAmount').style.borderColor = '#3c763d';
						document.getElementById('breedRabbitAmount').style.borderWidth = '2px';
						document.getElementById('alert20').className = 'alert alert-danger hide';
					}
				}else{
					document.getElementById('breedRabbitAmount').value = 0;
				}
			}
		}

		if(amountWolf > 0){
			if(breedWolfEach == ''){
				document.getElementById('breedWolfEach').style.borderColor = '#a94442';
				document.getElementById('breedWolfEach').style.borderWidth = '2px';
				document.getElementById('alert19').className = 'alert alert-danger show';
				document.getElementById('error19').innerHTML = translate('Rabbits - Limit each (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(breedWolfEach))){
				document.getElementById('breedWolfEach').style.borderColor = '#a94442';
				document.getElementById('breedWolfEach').style.borderWidth = '2px';
				document.getElementById('alert21').className = 'alert alert-danger show';
				document.getElementById('error21').innerHTML = translate('Wolves - Limit each (cycles) - Wrong format', language);

				fail++;
			}else{
				document.getElementById('breedWolfEach').style.borderColor = '#3c763d';
				document.getElementById('breedWolfEach').style.borderWidth = '2px';
				document.getElementById('alert21').className = 'alert alert-danger hide';

				if(breedWolfEach > 0){
					if(breedWolfAmount == ''){
						document.getElementById('breedWolfAmount').style.borderColor = '#a94442';
						document.getElementById('breedWolfAmount').style.borderWidth = '2px';
						document.getElementById('alert22').className = 'alert alert-danger show';
						document.getElementById('error22').innerHTML = translate('Wolves - Maximum amount - Empty field', language);

						fail++;
					}if(!(/^([0-9])*$/.test(breedWolfAmount))){
						document.getElementById('breedWolfAmount').style.borderColor = '#a94442';
						document.getElementById('breedWolfAmount').style.borderWidth = '2px';
						document.getElementById('alert22').className = 'alert alert-danger show';
						document.getElementById('error22').innerHTML = translate('Wolves - Maximum amount - Wrong format', language);

						fail++;
					}else{
						document.getElementById('breedWolfAmount').style.borderColor = '#3c763d';
						document.getElementById('breedWolfAmount').style.borderWidth = '2px';
						document.getElementById('alert22').className = 'alert alert-danger hide';
					}
				}else{
					document.getElementById('breedWolfAmount').value = 0;
				}
			}
		}
	}else{
		document.getElementById('breedRabbitEach').value = 0;
		document.getElementById('breedRabbitAmount').value = 0;
		document.getElementById('breedWolfEach').value = 0;
		document.getElementById('breedWolfAmount').value = 0;
		document.getElementById('alert19').className = 'alert alert-danger hide';
		document.getElementById('alert20').className = 'alert alert-danger hide';
		document.getElementById('alert21').className = 'alert alert-danger hide';
		document.getElementById('alert22').className = 'alert alert-danger hide';
		document.getElementById('breedRabbitEach').style.borderColor = '#ccc';
		document.getElementById('breedRabbitEach').style.borderWidth = '0px';
		document.getElementById('breedRabbitAmount').style.borderColor = '#ccc';
		document.getElementById('breedRabbitAmount').style.borderWidth = '0px';
		document.getElementById('breedWolfEach').style.borderColor = '#ccc';
		document.getElementById('breedWolfEach').style.borderWidth = '0px';
		document.getElementById('breedWolfAmount').style.borderColor = '#ccc';
		document.getElementById('breedWolfAmount').style.borderWidth = '0px';
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'turn to eat' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number}
 *
 * @return {Boolean}
 */
function turnEat(turnEatRabbit, turnEatWolf, dayPeriod, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		dayPeriod = parseInt(dayPeriod);

		if(amountRabbit > 0){
			if(turnEatRabbit == ''){
				document.getElementById('turnEatRabbit').style.borderColor = '#a94442';
				document.getElementById('turnEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert23').className = 'alert alert-danger show';
				document.getElementById('error23').innerHTML = translate('Rabbits - Need (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(turnEatRabbit))){
				document.getElementById('turnEatRabbit').style.borderColor = '#a94442';
				document.getElementById('turnEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert23').className = 'alert alert-danger show';
				document.getElementById('error23').innerHTML = translate('Rabbits - Need (cycles) - Wrong format', language);

				fail++;
			}else if(turnEatRabbit > dayPeriod){
				document.getElementById('turnEatRabbit').style.borderColor = '#a94442';
				document.getElementById('turnEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert23').className = 'alert alert-danger show';
				document.getElementById('error23').innerHTML = translate('Rabbits - Need (cycles) - Can\'t need more than daylight duration to eat', language);

				fail++;
			}else{
				document.getElementById('turnEatRabbit').style.borderColor = '#3c763d';
				document.getElementById('turnEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert23').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(turnEatWolf == ''){
				document.getElementById('turnEatWolf').style.borderColor = '#a94442';
				document.getElementById('turnEatWolf').style.borderWidth = '2px';
				document.getElementById('alert24').className = 'alert alert-danger show';
				document.getElementById('error24').innerHTML = translate('Wolves - Need (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(turnEatWolf))){
				document.getElementById('turnEatWolf').style.borderColor = '#a94442';
				document.getElementById('turnEatWolf').style.borderWidth = '2px';
				document.getElementById('alert24').className = 'alert alert-danger show';
				document.getElementById('error24').innerHTML = translate('Wolves - Need (cycles) - Wrong format', language);

				fail++;
			}else if(turnEatWolf > dayPeriod){
				document.getElementById('turnEatWolf').style.borderColor = '#a94442';
				document.getElementById('turnEatWolf').style.borderWidth = '2px';
				document.getElementById('alert24').className = 'alert alert-danger show';
				document.getElementById('error24').innerHTML = translate('Wolves - Need (cycles) - Can\'t need more than daylight duration to eat', language);

				fail++;
			}else{
				document.getElementById('turnEatWolf').style.borderColor = '#3c763d';
				document.getElementById('turnEatWolf').style.borderWidth = '2px';
				document.getElementById('alert24').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('turnEatRabbit').value = 0;
		document.getElementById('turnEatWolf').value = 0;
		document.getElementById('turnEatRabbit').style.borderColor = '#ccc';
		document.getElementById('turnEatRabbit').style.borderWidth = '1px';
		document.getElementById('alert23').className = 'alert alert-danger hide';
		document.getElementById('turnEatWolf').style.borderColor = '#ccc';
		document.getElementById('turnEatWolf').style.borderWidth = '1px';
		document.getElementById('alert24').className = 'alert alert-danger hide';
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the input 'no need to eat' has the correct format and changes the colour of the input
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function noNeedToEat(noNeedToEatRabbit, noNeedToEatWolf, maxEatRabbit, maxEatWolf, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		maxEatRabbit = parseInt(maxEatRabbit);
		maxEatWolf = parseInt(maxEatWolf);

		if(amountRabbit > 0){
			if(noNeedToEatRabbit == ''){
				document.getElementById('noNeedToEatRabbit').style.borderColor = '#a94442';
				document.getElementById('noNeedToEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert47').className = 'alert alert-danger show';
				document.getElementById('error47').innerHTML = translate('Rabbits - Are sated for (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(noNeedToEatRabbit))){
				document.getElementById('noNeedToEatRabbit').style.borderColor = '#a94442';
				document.getElementById('noNeedToEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert47').className = 'alert alert-danger show';
				document.getElementById('error47').innerHTML = translate('Rabbits - Are sated for (cycles) - Wrong format', language);

				fail++;
			}else if(noNeedToEatRabbit >= maxEatRabbit){
				document.getElementById('noNeedToEatRabbit').style.borderColor = '#a94442';
				document.getElementById('noNeedToEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert47').className = 'alert alert-danger show';
				document.getElementById('error47').innerHTML = translate('Rabbits - Are sated for (cycles) - The number of cycles must be less than the time without eat', language);

				fail++;
			}else{
				document.getElementById('noNeedToEatRabbit').style.borderColor = '#3c763d';
				document.getElementById('noNeedToEatRabbit').style.borderWidth = '2px';
				document.getElementById('alert47').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(noNeedToEatWolf == ''){
				document.getElementById('noNeedToEatWolf').style.borderColor = '#a94442';
				document.getElementById('noNeedToEatWolf').style.borderWidth = '2px';
				document.getElementById('alert48').className = 'alert alert-danger show';
				document.getElementById('error48').innerHTML = translate('Wolves - Are sated for (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(noNeedToEatWolf))){
				document.getElementById('noNeedToEatWolf').style.borderColor = '#a94442';
				document.getElementById('noNeedToEatWolf').style.borderWidth = '2px';
				document.getElementById('alert48').className = 'alert alert-danger show';
				document.getElementById('error48').innerHTML = translate('Wolves - Are sated for (cycles) - Wrong format', language);

				fail++;
			}else if(noNeedToEatWolf >= maxEatWolf){
				document.getElementById('noNeedToEatWolf').style.borderColor = '#a94442';
				document.getElementById('noNeedToEatWolf').style.borderWidth = '2px';
				document.getElementById('alert48').className = 'alert alert-danger show';
				document.getElementById('error48').innerHTML = translate('Wolves - Are sated for (cycles) - The number of cycles must be less than the time without eat', language);

				fail++;
			}else{
				document.getElementById('noNeedToEatWolf').style.borderColor = '#3c763d';
				document.getElementById('noNeedToEatWolf').style.borderWidth = '2px';
				document.getElementById('alert48').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('noNeedToEatRabbit').value = 0;
		document.getElementById('noNeedToEatWolf').value = 0;
		document.getElementById('noNeedToEatRabbit').style.borderColor = '#ccc';
		document.getElementById('noNeedToEatRabbit').style.borderWidth = '1px';
		document.getElementById('alert47').className = 'alert alert-danger hide';
		document.getElementById('noNeedToEatWolf').style.borderColor = '#ccc';
		document.getElementById('noNeedToEatWolf').style.borderWidth = '1px';
		document.getElementById('alert48').className = 'alert alert-danger hide';
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'turn to sleep' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number}
 *
 * @return {Boolean}
 */
function turnSleep(turnSleepRabbit, turnSleepWolf, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(turnSleepRabbit == ''){
				document.getElementById('turnSleepRabbit').style.borderColor = '#a94442';
				document.getElementById('turnSleepRabbit').style.borderWidth = '2px';
				document.getElementById('alert25').className = 'alert alert-danger show';
				document.getElementById('error25').innerHTML = translate('Rabbits - Need (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(turnSleepRabbit))){
				document.getElementById('turnSleepRabbit').style.borderColor = '#a94442';
				document.getElementById('turnSleepRabbit').style.borderWidth = '2px';
				document.getElementById('alert25').className = 'alert alert-danger show';
				document.getElementById('error25').innerHTML = translate('Rabbits - Need (cycles) - Wrong format', language);

				fail++;
			}else{
				document.getElementById('turnSleepRabbit').style.borderColor = '#3c763d';
				document.getElementById('turnSleepRabbit').style.borderWidth = '2px';
				document.getElementById('alert25').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(turnSleepWolf == ''){
				document.getElementById('turnSleepWolf').style.borderColor = '#a94442';
				document.getElementById('turnSleepWolf').style.borderWidth = '2px';
				document.getElementById('alert26').className = 'alert alert-danger show';
				document.getElementById('error26').innerHTML = translate('Wolves - Need (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(turnSleepWolf))){
				document.getElementById('turnSleepWolf').style.borderColor = '#a94442';
				document.getElementById('turnSleepWolf').style.borderWidth = '2px';
				document.getElementById('alert26').className = 'alert alert-danger show';
				document.getElementById('error26').innerHTML = translate('Wolves - Need (cycles) - Wrong format', language);

				fail++;
			}else{
				document.getElementById('turnSleepWolf').style.borderColor = '#3c763d';
				document.getElementById('turnSleepWolf').style.borderWidth = '2px';
				document.getElementById('alert26').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('turnSleepRabbit').value = 0;
		document.getElementById('turnSleepWolf').value = 0;
		document.getElementById('turnSleepRabbit').style.borderColor = '#ccc';
		document.getElementById('turnSleepRabbit').style.borderWidth = '1px';
		document.getElementById('alert25').className = 'alert alert-danger hide';
		document.getElementById('turnSleepWolf').style.borderColor = '#ccc';
		document.getElementById('turnSleepWolf').style.borderWidth = '1px';
		document.getElementById('alert26').className = 'alert alert-danger hide';
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the input 'be not sleepy' has the correct format and changes the colour of the input
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {String}
 * @param {String}
 * @param {String}
 * @param {String}
 *
 * @return {Boolean}
 */
function notSleepy(notSleepyRabbit, notSleepyWolf, maxSleepRabbit, maxSleepWolf, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(notSleepyRabbit == ''){
				document.getElementById('notSleepyRabbit').style.borderColor = '#a94442';
				document.getElementById('notSleepyRabbit').style.borderWidth = '2px';
				document.getElementById('alert55').className = 'alert alert-danger show';
				document.getElementById('error55').innerHTML = translate('Rabbits - Be not sleepy for (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(notSleepyRabbit))){
				document.getElementById('notSleepyRabbit').style.borderColor = '#a94442';
				document.getElementById('notSleepyRabbit').style.borderWidth = '2px';
				document.getElementById('alert55').className = 'alert alert-danger show';
				document.getElementById('error55').innerHTML = translate('Rabbits - Be not sleepy for (cycles) - Wrong format', language);

				fail++;
			}else{
				var maxSleepRabbit = parseInt(maxSleepRabbit);

				if(notSleepyRabbit >= maxSleepRabbit){
					document.getElementById('notSleepyRabbit').style.borderColor = '#a94442';
					document.getElementById('notSleepyRabbit').style.borderWidth = '2px';
					document.getElementById('alert55').className = 'alert alert-danger show';
					document.getElementById('error55').innerHTML = translate('Rabbits - Be not sleepy for (cycles) - The number of cycles must be less than the time without sleep', language);

					fail++;
				}else{
					document.getElementById('notSleepyRabbit').style.borderColor = '#3c763d';
					document.getElementById('notSleepyRabbit').style.borderWidth = '2px';
					document.getElementById('alert55').className = 'alert alert-danger hide';
				}
			}
		}

		if(amountWolf > 0){
			if(notSleepyWolf == ''){
				document.getElementById('notSleepyWolf').style.borderColor = '#a94442';
				document.getElementById('notSleepyWolf').style.borderWidth = '2px';
				document.getElementById('alert56').className = 'alert alert-danger show';
				document.getElementById('error56').innerHTML = translate('Wolves - Be not sleepy for (cycles) - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(notSleepyWolf))){
				document.getElementById('notSleepyWolf').style.borderColor = '#a94442';
				document.getElementById('notSleepyWolf').style.borderWidth = '2px';
				document.getElementById('alert56').className = 'alert alert-danger show';
				document.getElementById('error56').innerHTML = translate('Wolves - Be not sleepy for (cycles) - Wrong format', language);

				fail++;
			}else{
				var maxSleepWolf = parseInt(maxSleepWolf);

				if(notSleepyWolf >= maxSleepWolf){
					document.getElementById('notSleepyWolf').style.borderColor = '#a94442';
					document.getElementById('notSleepyWolf').style.borderWidth = '2px';
					document.getElementById('alert56').className = 'alert alert-danger show';
					document.getElementById('error56').innerHTML = translate('Wolves - Be not sleepy for (cycles) - The number of cycles must be less than the time without sleep', language);

					fail++;
				}else{
					document.getElementById('notSleepyWolf').style.borderColor = '#3c763d';
					document.getElementById('notSleepyWolf').style.borderWidth = '2px';
					document.getElementById('alert56').className = 'alert alert-danger hide';
				}
			}
		}
	}else{

	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'points per period' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function maxUse(maxUseRabbit, maxUseWolf, amountRabbit, amountWolf){
	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(maxUseRabbit == ''){
				document.getElementById('maxUseRabbit').style.borderColor = '#a94442';
				document.getElementById('maxUseRabbit').style.borderWidth = '2px';
				document.getElementById('alert27').className = 'alert alert-danger show';
				document.getElementById('error27').innerHTML = translate('Points per actions - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(maxUseRabbit))){
				document.getElementById('maxUseRabbit').style.borderColor = '#a94442';
				document.getElementById('maxUseRabbit').style.borderWidth = '2px';
				document.getElementById('alert27').className = 'alert alert-danger show';
				document.getElementById('error27').innerHTML = translate('Points per actions - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('maxUseRabbit').style.borderColor = '#3c763d';
				document.getElementById('maxUseRabbit').style.borderWidth = '2px';
				document.getElementById('alert27').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(maxUseWolf == ''){
				document.getElementById('maxUseWolf').style.borderColor = '#a94442';
				document.getElementById('maxUseWolf').style.borderWidth = '2px';
				document.getElementById('alert28').className = 'alert alert-danger show';
				document.getElementById('error28').innerHTML = translate('Points per actions - Wolves - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(maxUseWolf))){
				document.getElementById('maxUseWolf').style.borderColor = '#a94442';
				document.getElementById('maxUseWolf').style.borderWidth = '2px';
				document.getElementById('alert28').className = 'alert alert-danger show';
				document.getElementById('error28').innerHTML = translate('Points per actions - Wolves - Wrong format', language);

				fail++;
			}else{
				document.getElementById('maxUseWolf').style.borderColor = '#3c763d';
				document.getElementById('maxUseWolf').style.borderWidth = '2px';
				document.getElementById('alert28').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('maxUseRabbit').value = 0;
		document.getElementById('maxUseWolf').value = 0;
		document.getElementById('maxUseRabbit').style.borderColor = '#ccc';
		document.getElementById('maxUseRabbit').style.borderWidth = '1px';
		document.getElementById('alert27').className = 'alert alert-danger hide';
		document.getElementById('maxUseWolf').style.borderColor = '#ccc';
		document.getElementById('maxUseWolf').style.borderWidth = '1px';
		document.getElementById('alert28').className = 'alert alert-danger hide';
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'use per action' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function useAct(smellRabbitUse, smellWolfUse, hearRabbitUse, hearWolfUse, seeRabbitUse, seeWolfUse, moveRabbitUse, moveWolfUse, sleepRabbitUse, sleepWolfUse, breedRabbitUse, breedWolfUse, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(smellRabbitUse == ''){
				document.getElementById('smellRabbitUse').style.borderColor = '#a94442';
				document.getElementById('smellRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert29').className = 'alert alert-danger show';
				document.getElementById('error29').innerHTML = translate('Use per action - Smell - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(smellRabbitUse))){
				document.getElementById('smellRabbitUse').style.borderColor = '#a94442';
				document.getElementById('smellRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert29').className = 'alert alert-danger show';
				document.getElementById('error29').innerHTML = translate('Use per action - Smell - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('smellRabbitUse').style.borderColor = '#3c763d';
				document.getElementById('smellRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert29').className = 'alert alert-danger hide';
			}

			if(hearRabbitUse == ''){
				document.getElementById('hearRabbitUse').style.borderColor = '#a94442';
				document.getElementById('hearRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert31').className = 'alert alert-danger show';
				document.getElementById('error31').innerHTML = translate('Use per action - Hear - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(hearRabbitUse))){
				document.getElementById('hearRabbitUse').style.borderColor = '#a94442';
				document.getElementById('hearRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert31').className = 'alert alert-danger show';
				document.getElementById('error31').innerHTML = translate('Use per action - Hear - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('hearRabbitUse').style.borderColor = '#3c763d';
				document.getElementById('hearRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert31').className = 'alert alert-danger hide';
			}

			if(seeRabbitUse == ''){
				document.getElementById('seeRabbitUse').style.borderColor = '#a94442';
				document.getElementById('seeRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert33').className = 'alert alert-danger show';
				document.getElementById('error33').innerHTML = translate('Use per action - See - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(seeRabbitUse))){
				document.getElementById('seeRabbitUse').style.borderColor = '#a94442';
				document.getElementById('seeRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert33').className = 'alert alert-danger show';
				document.getElementById('error33').innerHTML = translate('Use per action - See - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('seeRabbitUse').style.borderColor = '#3c763d';
				document.getElementById('seeRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert33').className = 'alert alert-danger hide';
			}

			if(moveRabbitUse == ''){
				document.getElementById('moveRabbitUse').style.borderColor = '#a94442';
				document.getElementById('moveRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert35').className = 'alert alert-danger show';
				document.getElementById('error35').innerHTML = translate('Use per action - Move - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(moveRabbitUse))){
				document.getElementById('moveRabbitUse').style.borderColor = '#a94442';
				document.getElementById('moveRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert35').className = 'alert alert-danger show';
				document.getElementById('error35').innerHTML = translate('Use per action - Move - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('moveRabbitUse').style.borderColor = '#3c763d';
				document.getElementById('moveRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert35').className = 'alert alert-danger hide';
			}

			if(sleepRabbitUse == ''){
				document.getElementById('sleepRabbitUse').style.borderColor = '#a94442';
				document.getElementById('sleepRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert37').className = 'alert alert-danger show';
				document.getElementById('error37').innerHTML = translate('Use per action - Sleep - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(sleepRabbitUse))){
				document.getElementById('sleepRabbitUse').style.borderColor = '#a94442';
				document.getElementById('sleepRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert37').className = 'alert alert-danger show';
				document.getElementById('error37').innerHTML = translate('Use per action - Sleep - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('sleepRabbitUse').style.borderColor = '#3c763d';
				document.getElementById('sleepRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert37').className = 'alert alert-danger hide';
			}

			if(breedRabbitUse == ''){
				document.getElementById('breedRabbitUse').style.borderColor = '#a94442';
				document.getElementById('breedRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert39').className = 'alert alert-danger show';
				document.getElementById('error39').innerHTML = translate('Use per action - Breed - Rabbits - Empty field');

				fail++;
			}else if(!(/^([0-9])*$/.test(breedRabbitUse))){
				document.getElementById('breedRabbitUse').style.borderColor = '#a94442';
				document.getElementById('breedRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert39').className = 'alert alert-danger show';
				document.getElementById('error39').innerHTML = translate('Use per action - Breed - Rabbits - Wrong format');

				fail++;
			}else{
				document.getElementById('breedRabbitUse').style.borderColor = '#3c763d';
				document.getElementById('breedRabbitUse').style.borderWidth = '2px';
				document.getElementById('alert39').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(seeWolfUse == ''){
				document.getElementById('smellWolfUse').style.borderColor = '#a94442';
				document.getElementById('smellWolfUse').style.borderWidth = '2px';
				document.getElementById('alert30').className = 'alert alert-danger show';
				document.getElementById('error30').innerHTML = translate('Use per action - Smell - Wolves - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(smellWolfUse))){
				document.getElementById('smellWolfUse').style.borderColor = '#a94442';
				document.getElementById('smellWolfUse').style.borderWidth = '2px';
				document.getElementById('alert30').className = 'alert alert-danger show';
				document.getElementById('error30').innerHTML = translate('Use per action - Smell - Wolves - Wrong format', language);

				fail++;
			}else{
				document.getElementById('smellWolfUse').style.borderColor = '#3c763d';
				document.getElementById('smellWolfUse').style.borderWidth = '2px';
				document.getElementById('alert30').className = 'alert alert-danger hide';
			}

			if(hearWolfUse == ''){
				document.getElementById('hearWolfUse').style.borderColor = '#a94442';
				document.getElementById('hearWolfUse').style.borderWidth = '2px';
				document.getElementById('alert32').className = 'alert alert-danger show';
				document.getElementById('error32').innerHTML = translate('Use per action - Hear - Wolves - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(hearWolfUse))){
				document.getElementById('hearWolfUse').style.borderColor = '#a94442';
				document.getElementById('hearWolfUse').style.borderWidth = '2px';
				document.getElementById('alert32').className = 'alert alert-danger show';
				document.getElementById('error32').innerHTML = translate('Use per action - Hear - Wolves - Wrong format', language);

				fail++;
			}else{
				document.getElementById('hearWolfUse').style.borderColor = '#3c763d';
				document.getElementById('hearWolfUse').style.borderWidth = '2px';
				document.getElementById('alert32').className = 'alert alert-danger hide';
			}

			if(seeWolfUse == ''){
				document.getElementById('seeWolfUse').style.borderColor = '#a94442';
				document.getElementById('seeWolfUse').style.borderWidth = '2px';
				document.getElementById('alert34').className = 'alert alert-danger show';
				document.getElementById('error34').innerHTML = translate('Use per action - See - Wolves - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(seeWolfUse))){
				document.getElementById('seeWolfUse').style.borderColor = '#a94442';
				document.getElementById('seeWolfUse').style.borderWidth = '2px';
				document.getElementById('alert34').className = 'alert alert-danger show';
				document.getElementById('error34').innerHTML = translate('Use per action - See - Wolves - Wrong format', language);

				fail++;
			}else{
				document.getElementById('seeWolfUse').style.borderColor = '#3c763d';
				document.getElementById('seeWolfUse').style.borderWidth = '2px';
				document.getElementById('alert34').className = 'alert alert-danger hide';
			}

			if(moveWolfUse == ''){
				document.getElementById('moveWolfUse').style.borderColor = '#a94442';
				document.getElementById('moveWolfUse').style.borderWidth = '2px';
				document.getElementById('alert36').className = 'alert alert-danger show';
				document.getElementById('error36').innerHTML = 'Use per action - Move - Wolves - Empty field';

				fail++;
			}else if(!(/^([0-9])*$/.test(moveWolfUse))){
				document.getElementById('moveWolfUse').style.borderColor = '#a94442';
				document.getElementById('moveWolfUse').style.borderWidth = '2px';
				document.getElementById('alert36').className = 'alert alert-danger show';
				document.getElementById('error36').innerHTML = 'Use per action - Move - Wolves - Wrong format';

				fail++;
			}else{
				document.getElementById('moveWolfUse').style.borderColor = '#3c763d';
				document.getElementById('moveWolfUse').style.borderWidth = '2px';
				document.getElementById('alert36').className = 'alert alert-danger hide';
			}

			if(sleepWolfUse == ''){
				document.getElementById('sleepWolfUse').style.borderColor = '#a94442';
				document.getElementById('sleepWolfUse').style.borderWidth = '2px';
				document.getElementById('alert38').className = 'alert alert-danger show';
				document.getElementById('error38').innerHTML = translate('Use per action - Sleep - Wolves - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(sleepWolfUse))){
				document.getElementById('sleepWolfUse').style.borderColor = '#a94442';
				document.getElementById('sleepWolfUse').style.borderWidth = '2px';
				document.getElementById('alert38').className = 'alert alert-danger show';
				document.getElementById('error38').innerHTML = translate('Use per action - Sleep - Wolves - Wrong format', language);

				fail++;
			}else{
				document.getElementById('sleepWolfUse').style.borderColor = '#3c763d';
				document.getElementById('sleepWolfUse').style.borderWidth = '2px';
				document.getElementById('alert38').className = 'alert alert-danger hide';
			}

			if(breedWolfUse == ''){
				document.getElementById('breedWolfUse').style.borderColor = '#a94442';
				document.getElementById('breedWolfUse').style.borderWidth = '2px';
				document.getElementById('alert40').className = 'alert alert-danger show';
				document.getElementById('error40').innerHTML = translate('Use per action - Breed - Wolves - Empty field');

				fail++;
			}else if(!(/^([0-9])*$/.test(breedWolfUse))){
				document.getElementById('breedWolfUse').style.borderColor = '#a94442';
				document.getElementById('breedWolfUse').style.borderWidth = '2px';
				document.getElementById('alert40').className = 'alert alert-danger show';
				document.getElementById('error40').innerHTML = translate('Use per action - Breed - Wolves - Wrong format');

				fail++;
			}else{
				document.getElementById('breedWolfUse').style.borderColor = '#3c763d';
				document.getElementById('breedWolfUse').style.borderWidth = '2px';
				document.getElementById('alert40').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('smellRabbitUse').value = 0;
		document.getElementById('hearRabbitUse').value = 0;
		document.getElementById('seeRabbitUse').value = 0;
		document.getElementById('moveRabbitUse').value = 0;
		document.getElementById('sleepRabbitUse').value = 0;
		document.getElementById('breedRabbitUse').value = 0;
		document.getElementById('smellRabbitUse').style.borderColor = '#ccc';
		document.getElementById('smellRabbitUse').style.borderWidth = '1px';
		document.getElementById('alert29').className = 'alert alert-danger hide';
		document.getElementById('hearRabbitUse').style.borderColor = '#ccc';
		document.getElementById('hearRabbitUse').style.borderWidth = '1px';
		document.getElementById('alert31').className = 'alert alert-danger hide';
		document.getElementById('seeRabbitUse').style.borderColor = '#ccc';
		document.getElementById('seeRabbitUse').style.borderWidth = '1px';
		document.getElementById('alert33').className = 'alert alert-danger hide';
		document.getElementById('moveRabbitUse').style.borderColor = '#ccc';
		document.getElementById('moveRabbitUse').style.borderWidth = '1px';
		document.getElementById('alert35').className = 'alert alert-danger hide';
		document.getElementById('sleepRabbitUse').style.borderColor = '#ccc';
		document.getElementById('sleepRabbitUse').style.borderWidth = '1px';
		document.getElementById('alert37').className = 'alert alert-danger hide';
		document.getElementById('breedRabbitUse').style.borderColor = '#ccc';
		document.getElementById('breedRabbitUse').style.borderWidth = '1px';
		document.getElementById('alert39').className = 'alert alert-danger hide';

		document.getElementById('smellWolfUse').value = 0;
		document.getElementById('hearWolfUse').value = 0;
		document.getElementById('seeWolfUse').value = 0;
		document.getElementById('moveWolfUse').value = 0;
		document.getElementById('sleepWolfUse').value = 0;
		document.getElementById('breedWolfUse').value = 0;
		document.getElementById('smellWolfUse').style.borderColor = '#ccc';
		document.getElementById('smellWolfUse').style.borderWidth = '1px';
		document.getElementById('alert30').className = 'alert alert-danger hide';
		document.getElementById('hearWolfUse').style.borderColor = '#ccc';
		document.getElementById('hearWolfUse').style.borderWidth = '1px';
		document.getElementById('alert32').className = 'alert alert-danger hide';
		document.getElementById('seeWolfUse').style.borderColor = '#ccc';
		document.getElementById('seeWolfUse').style.borderWidth = '1px';
		document.getElementById('alert34').className = 'alert alert-danger hide';
		document.getElementById('moveWolfUse').style.borderColor = '#ccc';
		document.getElementById('moveWolfUse').style.borderWidth = '1px';
		document.getElementById('alert36').className = 'alert alert-danger hide';
		document.getElementById('sleepWolfUse').style.borderColor = '#ccc';
		document.getElementById('sleepWolfUse').style.borderWidth = '1px';
		document.getElementById('alert38').className = 'alert alert-danger hide';
		document.getElementById('breedWolfUse').style.borderColor = '#ccc';
		document.getElementById('breedWolfUse').style.borderWidth = '1px';
		document.getElementById('alert40').className = 'alert alert-danger hide';
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'range per action' has the correct format and changes the colour of the input 
 * (green if it is correct or red if not) and throw a new message if it has an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function rangeAct(seeRabbit, seeWolf, smellRabbit, smellWolf, hearRabbit, hearWolf, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(seeRabbit == ''){
				document.getElementById('seeRabbit').style.borderColor = '#a94442';
				document.getElementById('seeRabbit').style.borderWidth = '2px';
				document.getElementById('alert41').className = 'alert alert-danger show';
				document.getElementById('error41').innerHTML = translate('Range per action - See - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(seeRabbit))){
				document.getElementById('seeRabbit').style.borderColor = '#a94442';
				document.getElementById('seeRabbit').style.borderWidth = '2px';
				document.getElementById('alert41').className = 'alert alert-danger show';
				document.getElementById('error41').innerHTML = translate('Range per action - See - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('seeRabbit').style.borderColor = '#3c763d';
				document.getElementById('seeRabbit').style.borderWidth = '2px';
				document.getElementById('alert41').className = 'alert alert-danger hide';
			}

			if(smellRabbit == ''){
				document.getElementById('smellRabbit').style.borderColor = '#a94442';
				document.getElementById('smellRabbit').style.borderWidth = '2px';
				document.getElementById('alert43').className = 'alert alert-danger show';
				document.getElementById('error43').innerHTML = translate('Range per action - Smell - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(smellRabbit))){
				document.getElementById('smellRabbit').style.borderColor = '#a94442';
				document.getElementById('smellRabbit').style.borderWidth = '2px';
				document.getElementById('alert43').className = 'alert alert-danger show';
				document.getElementById('error43').innerHTML = translate('Range per action - Smell - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('smellRabbit').style.borderColor = '#3c763d';
				document.getElementById('smellRabbit').style.borderWidth = '2px';
				document.getElementById('alert43').className = 'alert alert-danger hide';
			}

			if(hearRabbit == ''){
				document.getElementById('hearRabbit').style.borderColor = '#a94442';
				document.getElementById('hearRabbit').style.borderWidth = '2px';
				document.getElementById('alert45').className = 'alert alert-danger show';
				document.getElementById('error45').innerHTML = translate('Range per action - See - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(hearRabbit))){
				document.getElementById('hearRabbit').style.borderColor = '#a94442';
				document.getElementById('hearRabbit').style.borderWidth = '2px';
				document.getElementById('alert45').className = 'alert alert-danger show';
				document.getElementById('error45').innerHTML = translate('Range per action - See - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('hearRabbit').style.borderColor = '#3c763d';
				document.getElementById('hearRabbit').style.borderWidth = '2px';
				document.getElementById('alert45').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(seeWolf == ''){
				document.getElementById('seeWolf').style.borderColor = '#a94442';
				document.getElementById('seeWolf').style.borderWidth = '2px';
				document.getElementById('alert42').className = 'alert alert-danger show';
				document.getElementById('error42').innerHTML = translate('Range per action - See - Wolves - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(seeWolf))){
				document.getElementById('seeWolf').style.borderColor = '#a94442';
				document.getElementById('seeWolf').style.borderWidth = '2px';
				document.getElementById('alert42').className = 'alert alert-danger show';
				document.getElementById('error42').innerHTML = translate('Range per action - See - Wolves - Wrong format', language);

				fail++;
			}else{
				document.getElementById('seeWolf').style.borderColor = '#3c763d';
				document.getElementById('seeWolf').style.borderWidth = '2px';
				document.getElementById('alert42').className = 'alert alert-danger hide';
			}

			if(smellWolf == ''){
				document.getElementById('smellWolf').style.borderColor = '#a94442';
				document.getElementById('smellWolf').style.borderWidth = '2px';
				document.getElementById('alert44').className = 'alert alert-danger show';
				document.getElementById('error44').innerHTML = translate('Range per action - Smell - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(smellWolf))){
				document.getElementById('smellWolf').style.borderColor = '#a94442';
				document.getElementById('smellWolf').style.borderWidth = '2px';
				document.getElementById('alert44').className = 'alert alert-danger show';
				document.getElementById('error44').innerHTML = translate('Range per action - Smell - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('smellWolf').style.borderColor = '#3c763d';
				document.getElementById('smellWolf').style.borderWidth = '2px';
				document.getElementById('alert44').className = 'alert alert-danger hide';
			}

			if(hearWolf == ''){
				document.getElementById('hearWolf').style.borderColor = '#a94442';
				document.getElementById('hearWolf').style.borderWidth = '2px';
				document.getElementById('alert46').className = 'alert alert-danger show';
				document.getElementById('error46').innerHTML = translate('Range per action - See - Wolves - Empty field');

				fail++;
			}else if(!(/^([0-9])*$/.test(hearWolf))){
				document.getElementById('hearWolf').style.borderColor = '#a94442';
				document.getElementById('hearWolf').style.borderWidth = '2px';
				document.getElementById('alert46').className = 'alert alert-danger show';
				document.getElementById('error46').innerHTML = translate('Range per action - See - Wolves - Wrong format');

				fail++;
			}else{
				document.getElementById('hearWolf').style.borderColor = '#3c763d';
				document.getElementById('hearWolf').style.borderWidth = '2px';
				document.getElementById('alert46').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('seeRabbit').style.borderColor = '#ccc';
		document.getElementById('seeRabbit').style.borderWidth = '1px';
		document.getElementById('alert41').className = 'alert alert-danger hide';
		document.getElementById('smellRabbit').style.borderColor = '#ccc';
		document.getElementById('smellRabbit').style.borderWidth = '1px';
		document.getElementById('alert43').className = 'alert alert-danger hide';
		document.getElementById('hearRabbit').style.borderColor = '#ccc';
		document.getElementById('hearRabbit').style.borderWidth = '1px';
		document.getElementById('alert45').className = 'alert alert-danger hide';
		document.getElementById('seeWolf').style.borderColor = '#ccc';
		document.getElementById('seeWolf').style.borderWidth = '1px';
		document.getElementById('alert42').className = 'alert alert-danger hide';
		document.getElementById('smellWolf').style.borderColor = '#ccc';
		document.getElementById('smellWolf').style.borderWidth = '1px';
		document.getElementById('alert44').className = 'alert alert-danger hide';
		document.getElementById('hearWolf').style.borderColor = '#ccc';
		document.getElementById('hearWolf').style.borderWidth = '1px';
		document.getElementById('alert46').className = 'alert alert-danger hide';
		document.getElementById('seeRabbit').value = 0;
		document.getElementById('smellRabbit').value = 0;
		document.getElementById('hearRabbit').value = 0;
		document.getElementById('seeWolf').value = 0;
		document.getElementById('smellWolf').value = 0;
		document.getElementById('hearWolf').value = 0;
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'comfort' has the correct format and changes the colour of the input 
 * (green if they are correct or red if not) and throw a new message if they have an error
 *
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 * @param {Number|String}
 *
 * @return {Boolean}
 */
function comfort(eatComfortRabbit, eatComfortWolf, sleepComfortRabbit, sleepComfortWolf, amountRabbit, amountWolf){
	fail = 0;

	if(amountRabbit > 0 || amountWolf > 0){
		if(amountRabbit > 0){
			if(eatComfortRabbit == ''){
				document.getElementById('eatComfortRabbit').style.borderColor = '#a94442';
				document.getElementById('eatComfortRabbit').style.borderWidth = '2px';
				document.getElementById('alert49').className = 'alert alert-danger show';
				document.getElementById('error49').innerHTML = translate('Until (cycles) after eating - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(eatComfortRabbit))){
				document.getElementById('eatComfortRabbit').style.borderColor = '#a94442';
				document.getElementById('eatComfortRabbit').style.borderWidth = '2px';
				document.getElementById('alert49').className = 'alert alert-danger show';
				document.getElementById('error49').innerHTML = translate('Until (cycles) after eating - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('eatComfortRabbit').style.borderColor = '#3c763d';
				document.getElementById('eatComfortRabbit').style.borderWidth = '2px';
				document.getElementById('alert49').className = 'alert alert-danger hide';
			}

			if(sleepComfortRabbit == ''){
				document.getElementById('sleepComfortRabbit').style.borderColor = '#a94442';
				document.getElementById('sleepComfortRabbit').style.borderWidth = '2px';
				document.getElementById('alert51').className = 'alert alert-danger show';
				document.getElementById('error51').innerHTML = translate('Until (cycles) after sleeping - Rabbits - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(sleepComfortRabbit))){
				document.getElementById('sleepComfortRabbit').style.borderColor = '#a94442';
				document.getElementById('sleepComfortRabbit').style.borderWidth = '2px';
				document.getElementById('alert51').className = 'alert alert-danger show';
				document.getElementById('error51').innerHTML = translate('Until (cycles) after sleeping - Rabbits - Wrong format', language);

				fail++;
			}else{
				document.getElementById('sleepComfortRabbit').style.borderColor = '#3c763d';
				document.getElementById('sleepComfortRabbit').style.borderWidth = '2px';
				document.getElementById('alert51').className = 'alert alert-danger hide';
			}
		}

		if(amountWolf > 0){
			if(eatComfortWolf == ''){
				document.getElementById('eatComfortWolf').style.borderColor = '#a94442';
				document.getElementById('eatComfortWolf').style.borderWidth = '2px';
				document.getElementById('alert50').className = 'alert alert-danger show';
				document.getElementById('error50').innerHTML = translate('Until (cycles) after eating - Wolves - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(eatComfortWolf))){
				document.getElementById('eatComfortWolf').style.borderColor = '#a94442';
				document.getElementById('eatComfortWolf').style.borderWidth = '2px';
				document.getElementById('alert50').className = 'alert alert-danger show';
				document.getElementById('error50').innerHTML = translate('Until (cycles) after eating - Wolves - Wrong format', language);

				fail++;
			}else{
				document.getElementById('eatComfortWolf').style.borderColor = '#3c763d';
				document.getElementById('eatComfortWolf').style.borderWidth = '2px';
				document.getElementById('alert50').className = 'alert alert-danger hide';
			}

			if(sleepComfortWolf == ''){
				document.getElementById('sleepComfortWolf').style.borderColor = '#a94442';
				document.getElementById('sleepComfortWolf').style.borderWidth = '2px';
				document.getElementById('alert52').className = 'alert alert-danger show';
				document.getElementById('error52').innerHTML = translate('Until (cycles) after sleeping - Wolves - Empty field', language);

				fail++;
			}else if(!(/^([0-9])*$/.test(sleepComfortWolf))){
				document.getElementById('sleepComfortWolf').style.borderColor = '#a94442';
				document.getElementById('sleepComfortWolf').style.borderWidth = '2px';
				document.getElementById('alert52').className = 'alert alert-danger show';
				document.getElementById('error52').innerHTML = translate('Until (cycles) after sleeping - Wolves - Wrong format', language);

				fail++;
			}else{
				document.getElementById('sleepComfortWolf').style.borderColor = '#3c763d';
				document.getElementById('sleepComfortWolf').style.borderWidth = '2px';
				document.getElementById('alert52').className = 'alert alert-danger hide';
			}
		}
	}else{
		document.getElementById('eatComfortRabbit').style.borderColor = '#ccc';
		document.getElementById('eatComfortRabbit').style.borderWidth = '1px';
		document.getElementById('alert49').className = 'alert alert-danger hide';
		document.getElementById('sleepComfortRabbit').style.borderColor = '#ccc';
		document.getElementById('sleepComfortRabbit').style.borderWidth = '1px';
		document.getElementById('alert51').className = 'alert alert-danger hide';
		document.getElementById('eatComfortWolf').style.borderColor = '#ccc';
		document.getElementById('eatComfortWolf').style.borderWidth = '1px';
		document.getElementById('alert50').className = 'alert alert-danger hide';
		document.getElementById('sleepComfortWolf').style.borderColor = '#ccc';
		document.getElementById('sleepComfortWolf').style.borderWidth = '1px';
		document.getElementById('alert52').className = 'alert alert-danger hide';
		document.getElementById('eatComfortRabbit').value = 0;
		document.getElementById('sleepComfortRabbit').value = 0;
		document.getElementById('eatComfortWolf').value = 0;
		document.getElementById('sleepComfortWolf').value = 0;
	}

	if(fail == 0){
		return true;
	}else{
		return false;
	}
}

/**
 * It checks if the inputs 'codeRabbit' has the correct format and changes the colour of the input 
 * (green if they are correct or red if not) and throw a new message if they have an error
 *
 * @param {String}
 *
 * @return {Boolean}
 */
function codeRabbit(codeRabbit){
	if(codeRabbit == ''){
		document.getElementById('codeRabbit').style.borderColor = '#a94442';
		document.getElementById('codeRabbit').style.borderWidth = '2px';
		document.getElementById('alert53').className = 'alert alert-danger show';
		document.getElementById('error53').innerHTML = translate('Behaviour rabbits', language);

		return false;
	}else{
		ban = ['system', 'exec', 'passthru', 'shell_exec', 'eval', 'proc_close', 'proc_open', 'proc_get_status', 'proc_nice', 'proc_terminate'];
		flag = false;

		for(i = 0; i < ban.length; i++){
			found = codeRabbit.search(ban[i]);

			if(found != -1){
				flag = true;
				break;
			}
		}

		if(flag){
			document.getElementById('codeRabbit').style.borderColor = '#a94442';
			document.getElementById('codeRabbit').style.borderWidth = '2px';
			document.getElementById('alert53').className = 'alert alert-danger show';
			document.getElementById('error53').innerHTML = translate('Behaviour rabbits - Malicious code', language);

			return false;
		}else{
			document.getElementById('codeRabbit').style.borderColor = '#3c763d';
			document.getElementById('codeRabbit').style.borderWidth = '2px';
			document.getElementById('alert53').className = 'alert alert-danger hide';

			return true;
		}
	}
}

/**
 * It checks if the inputs 'codeWolf' has the correct format and changes the colour of the input 
 * (green if they are correct or red if not) and throw a new message if they have an error
 *
 * @param {String}
 *
 * @return {Boolean}
 */
function codeWolf(codeWolf){
	if(codeWolf == ''){
		document.getElementById('codeWolf').style.borderColor = '#a94442';
		document.getElementById('codeWolf').style.borderWidth = '2px';
		document.getElementById('alert54').className = 'alert alert-danger show';
		document.getElementById('error54').innerHTML = translate('Behaviour wolves', language);

		return false;
	}else{
		ban = ['system', 'exec', 'passthru', 'shell_exec', 'eval', 'proc_close', 'proc_open', 'proc_get_status', 'proc_nice', 'proc_terminate'];
		flag = false;

		for(i = 0; i < ban.length; i++){
			found = codeWolf.search(ban[i]);

			if(found != -1){
				flag = true;
				break;
			}
		}

		if(flag){
			document.getElementById('codeWolf').style.borderColor = '#a94442';
			document.getElementById('codeWolf').style.borderWidth = '2px';
			document.getElementById('alert54').className = 'alert alert-danger show';
			document.getElementById('error54').innerHTML = translate('Behaviour wolves - Malicious code', language);
		}else{
			document.getElementById('codeWolf').style.borderColor = '#3c763d';
			document.getElementById('codeWolf').style.borderWidth = '2px';
			document.getElementById('alert54').className = 'alert alert-danger hide';

			return true;
		}
	}
}