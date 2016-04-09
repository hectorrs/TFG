/**
 * var Language
 */
var language = location.search.substring(6);

/**
 * Show the tab 'world' and hide the others
 */
function world(){
	document.getElementById('world').className = 'show';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = '> ' + translate('World', language) + ' <';
	document.getElementById('elementBtn').value = translate('Elements', language);
	document.getElementById('restrictionBtn').value = translate('Restrictions', language);
	document.getElementById('periodBtn').value = translate('Period', language);
	document.getElementById('actionBtn').value = translate('Actions', language);
	document.getElementById('rangeBtn').value = translate('Ranges', language);
	document.getElementById('behaviourBtn').value = translate('Behaviour', language);
}

/**
 * Show the tab 'element' and hide the others
 */
function element(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'show';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = translate('World', language);
	document.getElementById('elementBtn').value = '> ' + translate('Elements', language) + ' <';
	document.getElementById('restrictionBtn').value = translate('Restrictions', language);
	document.getElementById('periodBtn').value = translate('Period', language);
	document.getElementById('actionBtn').value = translate('Actions', language);
	document.getElementById('rangeBtn').value = translate('Ranges', language);
	document.getElementById('behaviourBtn').value = translate('Behaviour', language);
}

/**
 * Show the tab 'restriction' and hide the others
 */
function restriction(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'show';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = translate('World', language);
	document.getElementById('elementBtn').value = translate('Elements', language);
	document.getElementById('restrictionBtn').value = '> ' + translate('Restrictions', language) + ' <';
	document.getElementById('periodBtn').value = translate('Period', language);
	document.getElementById('actionBtn').value = translate('Actions', language);
	document.getElementById('rangeBtn').value = translate('Ranges', language);
	document.getElementById('behaviourBtn').value = translate('Behaviour', language);
}

/**
 * Show the tab 'period' and hide the others
 */
function period(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'show';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = translate('World', language);
	document.getElementById('elementBtn').value = translate('Elements', language);
	document.getElementById('restrictionBtn').value = translate('Restrictions', language);
	document.getElementById('periodBtn').value = '> ' + translate('Period', language) + ' <';
	document.getElementById('actionBtn').value = translate('Actions', language);
	document.getElementById('rangeBtn').value = translate('Ranges', language);
	document.getElementById('behaviourBtn').value = translate('Behaviour', language);
}

/**
 * Show the tab 'action' and hide the others
 */
function action(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'show';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = translate('World', language);
	document.getElementById('elementBtn').value = translate('Elements', language);
	document.getElementById('restrictionBtn').value = translate('Restrictions', language);
	document.getElementById('periodBtn').value = translate('Period', language);
	document.getElementById('actionBtn').value = '> ' + translate('Actions', language) + ' <';
	document.getElementById('rangeBtn').value = translate('Ranges', language);
	document.getElementById('behaviourBtn').value = translate('Behaviour', language);
}

/**  
 * Show the tab 'range' and hide the others
 */
function range(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'show';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = translate('World', language);
	document.getElementById('elementBtn').value = translate('Elements', language);
	document.getElementById('restrictionBtn').value = translate('Restrictions', language);
	document.getElementById('periodBtn').value = translate('Period', language);
	document.getElementById('actionBtn').value = translate('Actions', language);
	document.getElementById('rangeBtn').value = '> ' + translate('Ranges', language) + ' <';
	document.getElementById('behaviourBtn').value = translate('Behaviour', language);
}

/**
 * Show the tab 'behaviour' and hide the others
 */
function behaviour(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'show';

	document.getElementById('worldBtn').value = 'Mundo';
	document.getElementById('elementBtn').value = 'Elementos';
	document.getElementById('restrictionBtn').value = 'Restricciones';
	document.getElementById('periodBtn').value = 'Ciclos';
	document.getElementById('actionBtn').value = 'Acciones';
	document.getElementById('rangeBtn').value = 'Rangos';
	document.getElementById('behaviourBtn').value = '> ' + translate('Behaviour', language) + ' <';
}

/**
 * It completes the values of the inputs from json file
 *
 * @param json file
 */
function refill(file){
	file = JSON.parse(file);

	document.getElementById('totalPeriod').value = file['totalPeriod'];
	document.getElementById('dayPeriod').value = file['dayPeriod'];
	document.getElementById('nightPeriod').value = file['nightPeriod'];
	document.getElementById('sizeX').value = file['sizeX'];
	document.getElementById('sizeY').value = file['sizeY'];
	document.getElementById('changeWeather').value = file['changeWeather'];
	document.getElementById('carrot').value = file['carrot'];
	document.getElementById('tree').value = file['tree'];
	document.getElementById('lair').value = file['lair'];
	document.getElementById('rabbit').value = file['rabbit'];
	document.getElementById('wolf').value = file['wolf'];
	document.getElementById('timeMoreCarrot').value = file['timeMoreCarrot'];
	document.getElementById('amountMoreCarrot').value = file['amountMoreCarrot'];
	document.getElementById('maxEatRabbit').value = file['maxEatRabbit'];
	document.getElementById('maxEatWolf').value = file['maxEatWolf'];
	document.getElementById('maxSleepRabbit').value = file['maxSleepRabbit'];
	document.getElementById('maxSleepWolf').value = file['maxSleepWolf'];
	document.getElementById('noNeedToEatRabbit').value = file['noNeedToEatRabbit'];
	document.getElementById('noNeedToEatWolf').value = file['noNeedToEatWolf'];
	document.getElementById('breedRabbitEach').value = file['breedRabbitEach'];
	document.getElementById('breedWolfEach').value = file['breedWolfEach'];
	document.getElementById('breedRabbitAmount').value = file['breedRabbitAmount'];
	document.getElementById('breedWolfAmount').value = file['breedWolfAmount'];
	document.getElementById('turnEatRabbit').value = file['turnEatRabbit'];
	document.getElementById('turnEatWolf').value = file['turnEatWolf'];
	document.getElementById('turnSleepRabbit').value = file['turnSleepRabbit'];
	document.getElementById('turnSleepWolf').value = file['turnSleepWolf'];
	document.getElementById('notSleepyRabbit').values = file['notSleepyRabbit'];
	document.getElementById('notSleepyWolf').values = file['notSleepyWolf'];
	document.getElementById('maxUseRabbit').value = file['maxUseRabbit'];
	document.getElementById('maxUseWolf').value = file['maxUseWolf'];
	document.getElementById('smellRabbitUse').value = file['smellRabbitUse'];
	document.getElementById('smellWolfUse').value = file['smellWolfUse'];
	document.getElementById('hearRabbitUse').value = file['hearRabbitUse'];
	document.getElementById('hearWolfUse').value = file['hearWolfUse'];
	document.getElementById('seeRabbitUse').value = file['seeRabbitUse'];
	document.getElementById('seeWolfUse').value = file['seeWolfUse'];
	document.getElementById('moveRabbitUse').value = file['moveRabbitUse'];
	document.getElementById('moveWolfUse').value = file['moveWolfUse'];
	document.getElementById('sleepRabbitUse').value = file['sleepRabbitUse'];
	document.getElementById('sleepWolfUse').value = file['sleepWolfUse'];
	document.getElementById('breedRabbitUse').value = file['breedRabbitUse'];
	document.getElementById('breedWolfUse').value = file['breedWolfUse'];
	document.getElementById('seeRabbit').value = file['seeRabbit'];
	document.getElementById('seeWolf').value = file['seeWolf'];
	document.getElementById('smellRabbit').value = file['smellRabbit'];
	document.getElementById('smellWolf').value = file['smellWolf'];
	document.getElementById('hearRabbit').value = file['hearRabbit'];
	document.getElementById('hearWolf').value = file['hearWolf'];
	document.getElementById('eatComfortRabbit').value = file['eatComfortRabbit'];
	document.getElementById('eatComfortWolf').value = file['eatComfortWolf'];
	document.getElementById('sleepComfortRabbit').value = file['sleepComfortRabbit'];
	document.getElementById('sleepComfortWolf').value = file['sleepComfortWolf'];
	document.getElementById('codeRabbit').value = file['codeRabbit'];
	document.getElementById('codeWolf').value = file['codeWolf'];
}