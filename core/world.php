<?php
	// Language
	require_once('../core/language.php');

	global $lang;
    if(!isset($_GET['lang'])){
        $lang = 'en';
    }else{
        $lang = $_GET['lang'];
    }

	register_shutdown_function(
		function(){
			if(isset($_POST['from'])){
				$error = error_get_last();

				if($error != ''){
					$err = array();

					$err['type'] = $error['type'];
					$err['file'] = $error['file'];
					$err['line'] = $error['line'];
					$err['message'] = $error['message'];

					$dir = substr(__DIR__, 0, -4);
					$errorFile = fopen($dir . 'resources/log/error.json', 'w');

					fwrite($errorFile, json_encode($err, JSON_PRETTY_PRINT));

					fclose($errorFile);

					header('Location: ../view/inputS2.php?lang=' . $GLOBALS['lang']);
				}
			}
		}
	);

	require_once('../model/element.php');
	require_once('../model/elements.php');

	$timeStart = microtime(true);

	/**
	 * @global array $vars It stores the variables of the world
	 */
	$vars = array();

	/* ** World ** */
	$vars['world'] = array();
	$vars['size'] = array();
	$vars['length'] = 0;
	$vars['day'] = 0;
	$vars['night'] = 0;
	$vars['daylight'] = null;
	$vars['weather'] = array('sunny', 'rainy', 'windy', 'foggy');
	$vars['currentWeather'] = '';
	$vars['changeWeather'] = 0;
	$vars['time'] = 1;
	$vars['iTime'] = 1;
	$vars['ground'] = null;

	$vars['moreCarrot'] = 0;
	$vars['moreWolf'] = 0;

	/* ** Element ** */
	$vars['static'] = array();
	$vars['dynamic'] = array();
	$vars['prize'] = array();
	$vars['turnEatRabbit'] = 0;
	$vars['turnEatWolf'] = 0;
	$vars['turnSleepRabbit'] = 0;
	$vars['turnSleepWolf'] = 0;

	/* ** File ** */
	$vars['fileConf'] = openFile('conf');
	$vars['fileLog'] = openFileCSV('log');
	//$vars['fileWorld'] = openFileCSV('world');
	$vars['fileWorld'] = openFile('world');
	//$vars['fileLog'] = openFile('log');
	$vars['fileDebug'] = openFile('debug');

	/* ** Statistics ** */
	// Weather per day
	$vars['countWeather'] = array(0, 0, 0, 0);

	// Population of elements per day
	$vars['amountRabbit'] = array();
	$vars['amountWolf'] = array();
	$vars['amountCarrot'] = array();

	// Hunted rabbits per day
	$vars['huntedRabbit'] = array();

	// Eaten carrots per day
	$vars['eatenCarrot'] = array();

	// Dead rabbits and wolves for not eating
	$vars['deadEatRabbit'] = array();
	$vars['deadEatWolf'] = array();

	// Dead rabbits and wolves for not sleeping
	$vars['deadSleepRabbit'] = array();
	$vars['deadSleepWolf'] = array();

	// Breeding of rabbits
	$vars['bornRabbit'] = array();

	// Breeding of wolves
	$vars['bornWolf'] = array();

	/* ------------------------------- World ------------------------------- */
	/**
	 * It gets the data of the first configuration of the world and log's files
	 */
	function conf(){
		$fileConf = fopen('../resources/conf/settings.json', 'w');
		$conf = array();

		writeFile('Conf', '********************** Archivo de configuración inicial ***********************' . "\n");
		writeFile('Conf', '*********************************** World *************************************' . "\n");
		writeFile('Conf', '******** -------------------------- World ---------------------------- ********' . "\n");
		writeFile('Conf', '**** ---------------------------- Life cycle ----------------------------- ****' . "\n");
		$GLOBALS['vars']['length'] = $_POST['totalPeriod'];
		writeFile('Conf', '**** Total period' . "\n");
		writeFile('Conf', getLength() . ' cycles' . "\n\n");
		$conf['totalPeriod'] = $_POST['totalPeriod'];
		
		$GLOBALS['vars']['day'] = $_POST['dayPeriod'];
		writeFile('Conf', '**** Daylight period' . "\n");
		writeFile('Conf', getLengthDay() . ' cycles' . "\n\n");
		$conf['dayPeriod'] = $_POST['dayPeriod'];

		$GLOBALS['vars']['night'] = $_POST['nightPeriod'];
		writeFile('Conf', '**** Night period' . "\n");
		writeFile('Conf', getLengthNight() . ' cycles' . "\n\n");
		$conf['nightPeriod'] = $_POST['nightPeriod'];

		writeFile('Conf', '**** ------------------------------ Size --------------------------------- ****' . "\n");
		$GLOBALS['vars']['size']['row'] = $_POST['sizeX'];
		$GLOBALS['vars']['size']['col'] = $_POST['sizeY'];
		writeFile('Conf', 'Width: ' . getSizeWorld()['col'] . "\n");
		writeFile('Conf', 'Height: ' . getSizeWorld()['row'] . "\n\n");
		$conf['sizeX'] = $_POST['sizeX'];
		$conf['sizeY'] = $_POST['sizeY'];

		writeFile('Conf', '**** ----------------------------- Weather ------------------------------- ****' . "\n");
		$GLOBALS['vars']['daylight'] = false;
		writeFile('Conf', '**** Status day' . "\n");
		writeFile('Conf', 'night' . "\n\n");

		$GLOBALS['vars']['currentWeather'] = $_POST['weather'];
		writeFile('Conf', '**** First weather' . "\n");
		writeFile('Conf', getWeather() . "\n\n");
		$conf['weather'] = $_POST['weather'];

		$GLOBALS['vars']['changeWeather'] = $_POST['changeWeather'];
		writeFile('Conf', '**** Change weather each' . "\n");
		writeFile('Conf', getChangeWeather() . ' cycles' . "\n\n");
		$conf['changeWeather'] = $_POST['changeWeather'];

		writeFile('Conf', '******** ------------------------- Elements --------------------------- *******' . "\n");

		writeFile('Conf', '**** --------------------- First amount of elements ---------------------- ****' . "\n");
		writeFile('Conf', $_POST['carrot'] . ' carrots' . "\n");
		writeFile('Conf', $_POST['tree'] . ' trees' . "\n");
		writeFile('Conf', $_POST['lair'] . ' lairs' . "\n");
		writeFile('Conf', $_POST['rabbit'] . ' rabbits' . "\n");
		writeFile('Conf', $_POST['wolf'] . ' wolfs' . "\n\n");
		$conf['carrot'] = $_POST['carrot'];
		$conf['tree'] = $_POST['tree'];
		$conf['lair'] = $_POST['lair'];
		$conf['rabbit'] = $_POST['rabbit'];
		$conf['wolf'] = $_POST['wolf'];

		writeFile('Conf', '**** ---------------------- Regeneration of carrots ---------------------- ****' . "\n");
		writeFile('Conf', '**** Each' . "\n");
		writeFile('Conf', $_POST['timeMoreCarrot'] . ' cycles' . "\n\n");
		$conf['timeMoreCarrot'] = $_POST['timeMoreCarrot'];
		
		writeFile('Conf', '**** Amount' . "\n");
		writeFile('Conf', $_POST['amountMoreCarrot'] . ' carrots' . "\n\n");
		$conf['amountMoreCarrot'] = $_POST['amountMoreCarrot'];

		writeFile('Conf', '**** ------------------------ Striking of carrots ------------------------ ****' . "\n");
		writeFile('Conf', '**** Lifetime' . "\n");
		writeFile('Conf', $_POST['lifetimeCarrot'] . ' cycles' . "\n");
		$conf['lifetimeCarrot'] = $_POST['lifetimeCarrot'];

		writeFile('Conf', '******** ----------------------- Restrictions ------------------------ ********' . "\n");

		writeFile('Conf', '**** ------------------------------- Eat --------------------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'Can be ' . $_POST['maxEatRabbit'] . ' cycles without eat' . "\n\n");
		$conf['maxEatRabbit'] = $_POST['maxEatRabbit'];

		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'Can be ' . $_POST['maxEatWolf'] . ' cycles without eat' . "\n\n");
		$conf['maxEatWolf'] = $_POST['maxEatWolf'];
		
		writeFile('Conf', '**** ------------------------------ Sleep -------------------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'Can be ' . $_POST['maxSleepRabbit'] . ' cycles without sleep' . "\n");
		writeFile('Conf', 'Place to sleep: ' . $_POST['placeToSleepRabbit'] . "\n\n");
		$conf['maxSleepRabbit'] = $_POST['maxSleepRabbit'];
		$conf['placeToSleepRabbit'] = $_POST['placeToSleepRabbit'];

		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'Can be ' . $_POST['maxSleepWolf'] . ' cycles without sleep' . "\n\n");
		$conf['maxSleepWolf'] = $_POST['maxSleepWolf'];

		writeFile('Conf', '**** ------------------------------ Breed -------------------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'Each ' . $_POST['breedRabbitEach'] . ' cycles' . "\n");
		writeFile('Conf', $_POST['breedRabbitAmount'] . ' new rabbits' . "\n\n");
		$conf['breedRabbitEach'] = $_POST['breedRabbitEach'];
		$conf['breedRabbitAmount'] = $_POST['breedRabbitAmount'];
		
		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'Each ' . $_POST['breedWolfEach'] . ' cycles' . "\n");
		writeFile('Conf', $_POST['breedWolfAmount'] . ' new wolves' . "\n\n");
		$conf['breedWolfEach'] = $_POST['breedWolfEach'];
		$conf['breedWolfAmount'] = $_POST['breedWolfAmount'];
		
		writeFile('Conf', '********************************** Elements ***********************************' . "\n");

		writeFile('Conf', '******** -------------------------- Cycles --------------------------- ********' . "\n");

		$GLOBALS['vars']['turnEatRabbit'] = $_POST['turnEatRabbit'];
		writeFile('Conf', '**** ------------------------------- Eat --------------------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'Need ' . $_POST['turnEatRabbit'] . ' cycles to eat' . "\n");
		writeFile('Conf', 'Are sated until ' . $_POST['noNeedToEatRabbit'] . ' after eat' . "\n\n");
		$conf['turnEatRabbit'] = $_POST['turnEatRabbit'];
		$conf['noNeedToEatRabbit'] = $_POST['noNeedToEatRabbit'];
		
		$GLOBALS['vars']['turnEatWolf'] = $_POST['turnEatWolf'];
		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'Need ' . $_POST['turnEatWolf'] . ' cycles to eat' . "\n");
		writeFile('Conf', 'Are sated until ' . $_POST['noNeedToEatWolf'] . ' after eat' . "\n\n");
		$conf['turnEatWolf'] = $_POST['turnEatWolf'];
		$conf['noNeedToEatWolf'] = $_POST['noNeedToEatWolf'];

		$GLOBALS['vars']['turnSleepRabbit'] = $_POST['turnSleepRabbit'];
		writeFile('Conf', '**** ------------------------------ Sleep -------------------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'Need ' . $_POST['turnSleepRabbit'] . ' cycles to sleep' . "\n\n");
		$conf['turnSleepRabbit'] = $_POST['turnSleepRabbit'];

		$GLOBALS['vars']['turnSleepWolf'] = $_POST['turnSleepWolf'];
		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'Need ' . $_POST['turnSleepWolf'] . ' cycles to sleep' . "\n\n");
		$conf['turnSleepWolf'] = $_POST['turnSleepWolf'];

		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'Be not sleepy for ' . $_POST['notSleepyRabbit'] . 'cycles' . "\n");
		$conf['notSleepyRabbit'] = $_POST['notSleepyRabbit'];

		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'Be not sleepy for ' . $_POST['notSleepyWolf'] . 'cycles' . "\n");
		$conf['notSleepyWolf'] = $_POST['notSleepyWolf'];

		writeFile('Conf', '******** ------------------------- Actions --------------------------- ********' . "\n");

		writeFile('Conf', '**** ----------------- Points per cycle to do actions -------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', $_POST['maxUseRabbit'] . ' points' . "\n\n");
		$conf['maxUseRabbit'] = $_POST['maxUseRabbit'];
		
		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', $_POST['maxUseWolf'] . ' points' . "\n\n");
		$conf['maxUseWolf'] = $_POST['maxUseWolf'];

		writeFile('Conf', '**** ------------------------- Use per action ---------------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'Smell: ' . $_POST['smellRabbitUse'] . ' points' . "\n");
		writeFile('Conf', 'Hear: ' . $_POST['hearRabbitUse'] . ' points' . "\n");
		writeFile('Conf', 'See: ' . $_POST['seeRabbitUse'] . ' points' . "\n");
		writeFile('Conf', 'Move: ' . $_POST['moveRabbitUse'] . ' points' . "\n");
		writeFile('Conf', 'Sleep: ' . $_POST['sleepRabbitUse'] . ' points' . "\n");
		writeFile('Conf', 'Breed: ' . $_POST['breedRabbitUse'] . ' points' . "\n\n");
		$conf['smellRabbitUse'] = $_POST['smellRabbitUse'];
		$conf['hearRabbitUse'] = $_POST['hearRabbitUse'];
		$conf['seeRabbitUse'] = $_POST['seeRabbitUse'];
		$conf['moveRabbitUse'] = $_POST['moveRabbitUse'];
		$conf['sleepRabbitUse'] = $_POST['sleepRabbitUse'];
		$conf['breedRabbitUse'] = $_POST['breedRabbitUse'];
		
		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'Smell: ' . $_POST['smellWolfUse'] . ' points' . "\n");
		writeFile('Conf', 'Hear: ' . $_POST['hearWolfUse'] . ' points' . "\n");
		writeFile('Conf', 'See: ' . $_POST['seeWolfUse'] . ' points' . "\n");
		writeFile('Conf', 'Move: ' . $_POST['moveWolfUse'] . ' points' . "\n");
		writeFile('Conf', 'Sleep: ' . $_POST['sleepWolfUse'] . ' points' . "\n");
		writeFile('Conf', 'Breed: ' . $_POST['breedWolfUse'] . ' points' . "\n\n");
		$conf['smellWolfUse'] = $_POST['smellWolfUse'];
		$conf['hearWolfUse'] = $_POST['hearWolfUse'];
		$conf['seeWolfUse'] = $_POST['seeWolfUse'];
		$conf['moveWolfUse'] = $_POST['moveWolfUse'];
		$conf['sleepWolfUse'] = $_POST['sleepWolfUse'];
		$conf['breedWolfUse'] = $_POST['breedWolfUse'];

		writeFile('Conf', '******** -------------------------- Ranges --------------------------- ********' . "\n");
		writeFile('Conf', '**** ------------------------------ Ranges ------------------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'See: ' . $_POST['seeRabbit'] . "\n");
		writeFile('Conf', 'Smell: ' . $_POST['smellRabbit'] . "\n");
		writeFile('Conf', 'Hear: ' . $_POST['hearRabbit'] . "\n\n");
		$conf['seeRabbit'] = $_POST['seeRabbit'];
		$conf['smellRabbit'] = $_POST['smellRabbit'];
		$conf['hearRabbit'] = $_POST['hearRabbit'];
		
		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'See: ' . $_POST['seeWolf'] . "\n");
		writeFile('Conf', 'Smell: ' . $_POST['smellWolf'] . "\n");
		writeFile('Conf', 'Hear: ' . $_POST['hearWolf'] . "\n\n");
		$conf['seeWolf'] = $_POST['seeWolf'];
		$conf['smellWolf'] = $_POST['smellWolf'];
		$conf['hearWolf'] = $_POST['hearWolf'];

		writeFile('Conf', '**** --------------------------- Comfort zone ---------------------------- ****' . "\n");
		writeFile('Conf', '**** Rabbit' . "\n");
		writeFile('Conf', 'Until ' . $_POST['eatComfortRabbit'] . ' cycles after eat' . "\n");
		writeFile('Conf', 'Until ' . $_POST['sleepComfortRabbit'] . ' cycles after sleep' . "\n\n");
		$conf['eatComfortRabbit'] = $_POST['eatComfortRabbit'];
		$conf['sleepComfortRabbit'] = $_POST['sleepComfortRabbit'];
		
		writeFile('Conf', '**** Wolf' . "\n");
		writeFile('Conf', 'Until ' . $_POST['eatComfortWolf'] . ' cycles after eat' . "\n");
		writeFile('Conf', 'Until ' . $_POST['sleepComfortWolf'] . ' cycles after sleep');
		$conf['eatComfortWolf'] = $_POST['eatComfortWolf'];
		$conf['sleepComfortWolf'] = $_POST['sleepComfortWolf'];

		$GLOBALS['vars']['ground'] = new Ground();

		writeFileCSV('Log', array('Element', 'ID', 'Position', 'Status', 'Action', 'Effect'));

		/* Rabbits and wolf customization */
		if(isset($_POST['codeRabbit'])){
			$codeRabbit = fopen('../model/customRabbit.php', 'w');

			fputs($codeRabbit, '<?php ');
			$code = strip_tags($_POST['codeRabbit']);
			fputs($codeRabbit, $code);
			fputs($codeRabbit, "\n" . '?>');

			fclose($codeRabbit);

			$conf['codeRabbit'] = $code;
		}

		if(isset($_POST['codeWolf'])){
			$codeWolf = fopen('../model/customWolf.php', 'w');

			fputs($codeWolf, '<?php ');
			$code = strip_tags($_POST['codeWolf']);
			fputs($codeWolf, strip_tags($code));
			fputs($codeWolf, "\n" . '?>');

			fclose($codeWolf);

			$conf['codeWolf'] = $code;
		}

		fwrite($fileConf, json_encode($conf, JSON_PRETTY_PRINT));

		fclose($fileConf);

		
	}

	/**
	 * It gets the size of the world
	 *
	 * @return int[] Width and height
	 */
	function getSizeWorld(){
		return $GLOBALS['vars']['size'];
	}

	/**
	 * It creates the matrix world. There is 'Ground' in each position
	 */
	function createWorld(){
		for($row = 0; $row < getSizeWorld()['row']; $row++){
			for($col = 0; $col < getSizeWorld()['col']; $col++){
				$GLOBALS['vars']['world'][$row][$col] = getGround();
			}
		}
	}

	/**
	 * It gets the matrix world
	 *
	 * @return int[][] Matriz mundo
	 */
	function getWorld(){
		return $GLOBALS['vars']['world'];
	}

	/**
	 * It changes the contents of a position of the world
	 *
	 * @param Element $element Object to put in the world
	 * @param int $row Coordinate x of the world
	 * @param int $col Coordinate y of the world
	 */
	function setWorld($element, $row, $col){
		$GLOBALS['vars']['world'][$row][$col] = $element;
	}

	/**
	 * It writes in a text file the contents of the world
	 */
	function writeWorld(){
		for($row = 0; $row < getSizeWorld()['row']; $row++){
			for($col = 0; $col < getSizeWorld()['col']; $col++){
				if(get_class($GLOBALS['vars']['world'][$row][$col]) != 'Ground'){
					writeFile('World', $row . ':' . $col . ':' . substr(get_class($GLOBALS['vars']['world'][$row][$col]), 0, 1) . ';');
					//writeFileCSV('World', array($row, $col, substr(get_class($GLOBALS['vars']['world'][$row][$col]), 0, 1)));
				}
			}
		}
		writeFile('World', '.');
		//writeFileCSV('World', array());
	}

	/**
	 * It returns a Ground object
	 *
	 * @return Ground Ground object
	 */
	function getGround(){
		return $GLOBALS['vars']['ground'];
	}

	/**
	 * It checks if the world is full
	 *
	 * @return bool True, if it is full; false, in the opposite case
	 */
	function isFull(){
		if(count(getStatic()) + count(getDynamic()) + count(getPrize()) < getSizeWorld()['row'] * getSizeWorld()['col']){
			return false;
		}else{
			return true;
		}
	}

	/**
	 * It returns the status of the day (daylight or night)
	 *
	 * @return bool True, if it is daylight; false, in the opposite case
	 */
	function getStatusDay(){
		return $GLOBALS['vars']['daylight'];
	}

	/**
	 * It changes the status of the world to 'daylight' if it is 'night' or 'night' if it is 'daylight'
	 */
	function setStatusDay(){
		if($GLOBALS['vars']['daylight']){
			$GLOBALS['vars']['daylight'] = false;
			//writeFile('Log', 'Status day changed to night' . "\n");
		}else{
			$GLOBALS['vars']['daylight'] = true;
			//writeFile('Log', 'Status day changed to day' . "\n");
		}
	}

	/**
	 * It returns the period of execution
	 *
	 * @return int Period
	 */
	function getLength(){
		return $GLOBALS['vars']['length'];
	}

	/**
	 * It returns the period of the daylight
	 *
	 * @return int Period
	 */
	function getLengthDay(){
		return $GLOBALS['vars']['day'];
	}

	/**
	 * It returns the period of the daylight
	 *
	 * @return int Period
	 */
	function getLengthNight(){
		return $GLOBALS['vars']['night'];
	}

	/**
	 * It returns the current weather
	 *
	 * @return string Weather
	 */
	function getWeather(){
		return $GLOBALS['vars']['currentWeather'];
	}

	/**
	 * It updates the current weather
	 */
	function setWeather(){
		$GLOBALS['vars']['currentWeather'] = $GLOBALS['vars']['weather'][mt_rand(0, 3)];
		//writeFile('Log', 'Weather changed to ' . getWeather() . "\n");
	}

	/**
	 * It returns every period changes the weather
	 *
	 * @return int Period
	 */
	function getChangeWeather(){
		return $GLOBALS['vars']['changeWeather'];
	}

	/**
	 * It returns the current period
	 *
	 * @return int Tiempo
	 */
	function getTime(){
		return $GLOBALS['vars']['time'];
	}

	/**
	 * It advance the time
	 */
	function setTime(){
		$GLOBALS['vars']['time']++;
	}

	/**
	 * It returns the current day
	 *
	 * @return int Counter of days
	 */
	function getiTime(){
		return $GLOBALS['vars']['iTime'];
	}

	/**
	 * It increases the counter of the current day in 1
	 */
	function setiTime(){
		$GLOBALS['vars']['iTime']++;
	}

	/* --------------------------------------------------------------------- */

	/* ----------------------------- Elementos ----------------------------- */
	/**
	 * It returns the period which the Rabbit element needs to eat
	 *
	 * @return int Period
	 */
	function getTurnEatRabbit(){
		return $GLOBALS['vars']['turnEatRabbit'];
	}

	/**
	 * It returns the period which the Wolf element needs to eat
	 *
	 * @return int Period
	 */
	function getTurnEatWolf(){
		return $GLOBALS['vars']['turnEatWolf'];
	}

	/**
	 * * It returns the period which the Rabbit element needs to sleep
	 *
	 * @return int Period
	 */
	function getTurnSleepRabbit(){
		return $GLOBALS['vars']['turnSleepRabbit'];
	}

	/**
	 * It returns the period which the Wolf element needs to sleep
	 *
	 * @return int Period
	 */
	function getTurnSleepWolf(){
		return $GLOBALS['vars']['turnSleepWolf'];
	}

	/**
	 * It returns the hashmap which contains the static elements
	 *
	 * @return Element Static elements
	 */
	function getStatic(){
		return $GLOBALS['vars']['static'];
	}

	/**
	 * It adds an element into the hashmap of static elements
	 *
	 * @param Element Elemento
	 */
	function addStatic($element){
		setWorld($element, $element->getPosition()[0], $element->getPosition()[1]);
		$GLOBALS['vars']['static'][$element->getId()] = $element;
	}

	/**
	 * It returns the hashmap which contains dynamic elements
	 *
	 * @return Element Dynamic elements
	 */
	function getDynamic(){
		return $GLOBALS['vars']['dynamic'];
	}

	/**
	 * It adds an element into the hashmap of dynamic elements
	 *
	 * @param Element Element
	 */
	function addDynamic($element){
		setWorld($element, $element->getPosition()[0], $element->getPosition()[1]);
		$GLOBALS['vars']['dynamic'][$element->getId()] = $element;
	}

	/**
	 * It removes an element of the hashmap of dynamic elements and of the world array
	 *
	 * @param Element Element
	 */
	function delDynamic($element){
		if(get_class(getWorld()[$element->getPosition()[0]][$element->getPosition()[1]]) != 'Lair'){
			setWorld(getGround(), $element->getPosition()[0], $element->getPosition()[1]);
		}
		unset($GLOBALS['vars']['dynamic'][$element->getId()]);
	}

	/**
	 * It returns the hashmap which contains prize elements
	 *
	 * @return Element Prize element
	 */
	function getPrize(){
		return $GLOBALS['vars']['prize'];
	}

	/**
	 * It adds an element into the hashmap of prize elements
	 *
	 * @param Element Element
	 */
	function addPrize($element){
		setWorld($element, $element->getPosition()[0], $element->getPosition()[1]);
		$GLOBALS['vars']['prize'][$element->getId()] = $element;
	}

	/**
	 * It removes an element of the hashmap of prize elements and of the world array
	 *
	 * @param Element Element
	 */
	function delPrize($element){
		setWorld(getGround(), $element->getPosition()[0], $element->getPosition()[1]);
		unset($GLOBALS['vars']['prize'][$element->getId()]);
	}

	/**
	 * It checks if an element can be put into the world
	 *
	 * @param Element Element
	 * @param int Row
	 * @param int Col
	 *
	 * @return bool True, if the element is put; false, in the opposite case
	 */
	function putElement($element, $row, $col){
		if($row < 0 || $row > (getSizeWorld()['row'] - 1) || $col < 0 || $col > (getSizeWorld()['col'] - 1)){
			return false;
		}else{
			if(get_class(getWorld()[$row][$col]) == 'Ground'){
				return true;
			}else{
				return false;
			}
		}
	}

	/**
	 * It puts a Rabbit element into the world. It adds it in the hashmap of dynamic elements and in the world array
	 *
	 * @return bool True, if the element is putted in the world; false, in the opposite case
	 */
	function addRabbit(){
		if(!isFull()){
			$rabbit = new Rabbit();

			$row = rand(0, getSizeWorld()['row'] - 1);
            $col = rand(0, getSizeWorld()['col'] - 1);

            while(!putElement($rabbit, $row, $col)){
                $row = rand(0, getSizeWorld()['row'] - 1);
                $col = rand(0, getSizeWorld()['col'] - 1);
            }

            $rabbit->setPosition(array($row, $col));
            $rabbit->setActPerTurn($_POST['maxUseRabbit']);
            $rabbit->setHidden(false);

            addDynamic($rabbit);

            //writeFile('Log', '( ' . $rabbit->getPosition()[0] . ' , ' . $rabbit->getPosition()[1] . ' ) - Rabbit ' . $rabbit->getId() . "\n");
            writeFileCSV('Log', array(get_class($rabbit), $rabbit->getId(), $rabbit->getPosition()[0] . '.' . $rabbit->getPosition()[1]));

            return true;
		}else{
			//writeFile('Log', 'World is full! It can\'t put a rabbit' . "\n");

			return false;
		}
	}

	/**
	 * It puts a Wolf element into the world. It adds it in the hashmap of dynamic elements and in the world array
	 *
	 * @return bool True, if the element is putted in the world; false, in the opposite case
	 */
	function addWolf(){
		if(!isFull()){
			$wolf = new Wolf();

			$row = rand(0, getSizeWorld()['row'] - 1);
            $col = rand(0, getSizeWorld()['col'] - 1);

            while(!putElement($wolf, $row, $col)){
                $row = rand(0, getSizeWorld()['row'] - 1);
                $col = rand(0, getSizeWorld()['col'] - 1);
            }

            $wolf->setPosition(array($row, $col));
            $wolf->setActPerTurn($_POST['maxUseWolf']);

            addDynamic($wolf);

            //writeFile('Log', '( ' . $wolf->getPosition()[0] . ' , ' . $wolf->getPosition()[1] . ' ) - Wolf ' . $wolf->getId() . "\n");
            writeFileCSV('Log', array(get_class($wolf), $wolf->getId(), $wolf->getPosition()[0] . '.' . $wolf->getPosition()[1]));

            return true;
		}else{
			//writeFile('Log', 'World is full! It can\'t put a wolf' . "\n");

			return false;
		}
	}

	/**
	 * It puts a Carrot element into the world. It adds it in the hashmap of prize elements and in the world array
	 */
	function addCarrot(){
		if(!isFull()){
			$carrot = new Carrot();

			$row = rand(0, getSizeWorld()['row'] - 1);
            $col = rand(0, getSizeWorld()['col'] - 1);

            while(!putElement($carrot, $row, $col)){
                $row = rand(0, getSizeWorld()['row'] - 1);
                $col = rand(0, getSizeWorld()['col'] - 1);
            }

            $carrot->setPosition(array($row, $col));
            $carrot->setLifeTime($_POST['lifetimeCarrot']);

            addPrize($carrot);

            //writeFile('Log', '( ' . $carrot->getPosition()[0] . ' , ' . $carrot->getPosition()[1] . ' ) - Carrot' . "\n");
            writeFileCSV('Log', array(get_class($carrot), $carrot->getId(), $carrot->getPosition()[0] . '.' . $carrot->getPosition()[1]));
		}else{
			//writeFile('Log', 'World is full! It can\'t put a carrot' . "\n");
		}
	}

	/**
	 * It puts a Lair element into the world. It adds it in the hashmap of static elements and in the world array
	 */
	function addLair(){
		if(!isFull()){
			$lair = new Lair();

			$row = rand(0, getSizeWorld()['row'] - 1);
            $col = rand(0, getSizeWorld()['col'] - 1);

            while(!putElement($lair, $row, $col)){
                $row = rand(0, getSizeWorld()['row'] - 1);
                $col = rand(0, getSizeWorld()['col'] - 1);
            }

            $lair->setPosition(array($row, $col));

            addStatic($lair);

            //writeFile('Log', '( ' . $lair->getPosition()[0] . ' , ' . $lair->getPosition()[1] . ' ) - Lair' . "\n");
            writeFileCSV('Log', array(get_class($lair), $lair->getId(), $lair->getPosition()[0] . '.' . $lair->getPosition()[1]));
		}else{
			//writeFile('Log', 'World is full! It can\'t put a lair' . "\n");
		}
	}

	/**
	 * It puts a Tree element into the world. It adds it in the hashmap of static elements and in the world array
	 */
	function addTree(){
		if(!isFull()){
			$tree = new Tree();

			$row = rand(0, getSizeWorld()['row'] - 1);
            $col = rand(0, getSizeWorld()['col'] - 1);

            while(!putElement($tree, $row, $col)){
                $row = rand(0, getSizeWorld()['row'] - 1);
                $col = rand(0, getSizeWorld()['col'] - 1);
            }

            $tree->setPosition(array($row, $col));

            addStatic($tree);

            //writeFile('Log', '( ' . $tree->getPosition()[0] . ' , ' . $tree->getPosition()[1] . ' ) - Tree' . "\n");
            writeFileCSV('Log', array(get_class($tree), $tree->getId(), $tree->getPosition()[0] . '.' . $tree->getPosition()[1]));
		}else{
			//writeFile('Log', 'World is full! It can\'t put a tree' . "\n");
		}
	}

	/**
	 * It manages the actions which an element can do
	 *
	 * @return array|void It depends on the type of action to do
	 */
	function actionManager(...$args){
		switch($args[1]){
			case 'see':
				if(canAct($args[0], $args[1])){
					$see = see($args[0]);
					useAction($args[0], 'see');
					return $see;
				}else{
					//writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t see, hasn\'t enough uses' . "\n");
				}
				break;
			case 'move':
				if(canAct($args[0], $args[1])){
					move($args[0], $args[2]);
					useAction($args[0], 'move');
				}else{
					//writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t move, hasn\'t enough uses' . "\n");
				}
				break;
			case 'sleep':
				if(canAct($args[0], $args[1])){
					toSleep($args[0]);
					useAction($args[0], 'sleep');
				}else{
					//writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t sleep, hasn\'t enough uses' . "\n");
				}
				break;
			case 'smell':
				if(canAct($args[0], $args[1])){
					$smell = smell($args[0]);
					useAction($args[0], 'smell');
					return $smell;
				}else{
					//writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t smell, hasn\'t enough uses' . "\n");
				}
				break;
			case 'hear':
				if(canAct($args[0], $args[1])){
					$hear = hear($args[0]);
					useAction($args[0], 'hear');
					return $hear;
				}else{
					//writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t hear, hasn\'t enough uses' . "\n");
				}
				break;
			case 'breed':
				if(canAct($args[0], $args[1])){
					breed($args[0]);
					useAction($args[0], 'breed');
				}else{
					//writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t breed, hasn\'t enough uses' . "\n");
				}
				break;
		}
	}

	/**
	 * It checks if an element can do an action. It depends on the points that the element has in each period
	 *
	 * @param Element Element
	 * @param string Action
	 *
	 * @return bool True, if it can do the action; false, in the opposite case
	 */
	function canAct($element, $action){
		$remain = $element->getActPerTurn();
		$use = usePerAction($element, $action);

		if($use <= $remain){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * It returns the use of an action
	 *
	 * @param Element Element
	 * @param string Action
	 *
	 * @return int Use
	 */
	function usePerAction($element, $action){
		switch($action){
			case 'see':
				if(get_class($element) == 'Rabbit'){
					return $_POST['seeRabbitUse'];
				}else{
					return $_POST['seeWolfUse'];
				}
				break;
			case 'move':
				if(get_class($element) == 'Rabbit'){
					return $_POST['moveRabbitUse'];
				}else{
					return $_POST['moveWolfUse'];
				}
				break;
			case 'sleep':
				if(get_class($element) == 'Rabbit'){
					return $_POST['sleepRabbitUse'];
				}else{
					return $_POST['sleepWolfUse'];
				}
				break;
			case 'smell':
				if(get_class($element) == 'Rabbit'){
					return $_POST['smellRabbitUse'];
				}else{
					return $_POST['smellWolfUse'];
				}
				break;
			case 'hear':
				if(get_class($element) == 'Rabbit'){
					return $_POST['hearRabbitUse'];
				}else{
					return $_POST['hearWolfUse'];
				}
				break;
			case 'breed':
				if(get_class($element) == 'Rabbit'){
					return $_POST['breedRabbitUse'];
				}else{
					return $_POST['breedWolfUse'];
				}
				break;
		}
	}

	/**
	 * It decreases the points that an element has to do an action. It depends on the points that an action uses.
	 *
	 * @param Element Element
	 * @param string Action
	 */
	function useAction($element, $action){
		if($action == 'max'){
			$element->setActPerTurn($_POST['maxUse' . get_class($element)]);
		}else{
			$element->setActPerTurn($element->getActPerTurn() - $_POST[$action . get_class($element) . 'Use']);
		}
	}

	/**
	 * Action see
	 * It returns the positions and the elements that an element can see, if these positions have an element
	 *
	 * @param Element Element
	 *
	 * @return array Positions and elements
	 */
	function see($element){
		//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - see - ');

		$see = array();
		$seeWrite = '';

		$position = $element->getPosition();

		switch(get_class($element)){
			case 'Rabbit':
				if(getWeather() == 'foggy' || !getStatusDay()){
					$viewRange = 0;
				}else{
					$viewRange = $_POST['seeRabbit'];
				}
				break;
			case 'Wolf':
				if(getWeather() == 'foggy' || !getStatusDay()){
					$viewRange = 0;
				}else{
					$viewRange = $_POST['seeWolf'];
				}
				break;
		}

		$rowStart = $position[0] - $viewRange;
        $colStart = $position[1] - $viewRange;
        $rowEnd = $position[0] + $viewRange;
        $colEnd = $position[1] + $viewRange;

        while($rowStart <= $rowEnd){
        	while($colStart <= $colEnd){
        		if(!isLocked($rowStart, $colStart)){
        			if(!($rowStart == $position[0] && $colStart == $position[1]) && get_class(getWorld()[$rowStart][$colStart]) != 'Ground'){
        				array_push($see, array(get_class(getWorld()[$rowStart][$colStart]), array($rowStart, $rowEnd)));
        				//writeFile('Log', get_class(getWorld()[$rowStart][$colStart]) . ' ( ' . $rowStart . ' , ' . $colStart . ' ) ');
        				$seeWrite .= $rowStart . '.' . $colStart . get_class(getWorld()[$rowStart][$colStart]) . ',';
        			}
        		}
        		$colStart++;
        	}
        	$colStart = $position[1] - $viewRange;
        	$rowStart++;
        }

        //writeFile('Log', "\n");
        writeFileCSV('Log', array(get_class($element), $element->getId(), $element->getPosition()[0] . '.' . $element->getPosition()[1], '', 'see', $seeWrite));

		return $see;
	}

	/**
	 * It returns if a position is out of range of the world
	 *
	 * @param int Row
	 * @param int Col
	 *
	 * @return bool True, if es true; false, in the opposite case
	 */
	function isLocked($row, $col){
		if($row < 0 || $row >= getSizeWorld()['row'] || $col < 0 || $col >= getSizeWorld()['col']){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Action move
	 * It does a movement of an element if it is possible
	 *
	 * @param Element Element
	 * @param string Movement
	 */
	function move($element, $movement){
		$position = $element->getPosition();

		switch($movement){
			case 'up';
				$row = $position[0] - 1;
				$col = $position[1];
				break;
			case 'down':
				$row = $position[0] + 1;
				$col = $position[1];
				break;
			case 'left':
				$row = $position[0];
				$col = $position[1] - 1;
				break;
			case 'right':
				$row = $position[0];
				$col = $position[1] + 1;
				break;
		}

		if($row < 0 || $row >= getSizeWorld()['row'] || $col < 0 || $col >= getSizeWorld()['col']){
			//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - Denied' . "\n");
		}else{
			switch(get_class($element)){
				case 'Rabbit':
					switch(get_class(getWorld()[$row][$col])){
						case 'Ground':
							if($element->getHidden()){
								$element->setHidden(false);
								getWorld()[$position[0]][$position[1]]->leaveElement();
							}else{
								setWorld(getGround(), $position[0], $position[1]);
							}

							$element->setPosition(array($row, $col));
							setWorld($element, $row, $col);

							//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' )' . "\n");
							writeFileCSV('Log', array(get_class($element), $element->getId(), $row . '.' . $col, '', 'move', ''));
							break;
						case 'Carrot':
							// Eat
							if($element->getAteAgo() >= $_POST['noNeedToEatRabbit']){
								if($element->getHidden()){
									$element->setHidden(false);
									getWorld()[$position[0]][$position[1]]->leaveElement();
								}else{
									setWorld(getGround(), $position[0], $position[1]);
								}

								$element->setEating(getTurnEatRabbit());
								$element->setPosition(array($row, $col));
								$element->setAteAgo(0);

								delPrize(getWorld()[$row][$col]);
								setWorld($element, $row, $col);

								// Estadísticas - Zanahorias comidas
								$GLOBALS['vars']['eatenCarrot'][getTime() - 1]++;

								//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' ) - Eating' . "\n");
								writeFileCSV('Log', array(get_class($element), $element->getId(), $row . '.' . $col, '', 'move', 'eat'));
							}else{
								//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' ) - Denied - He is sated' . "\n");
							}
							break;
						case 'Lair':
							if(getWorld()[$row][$col]->getElement() == null){
								if($element->getHidden()){
									getWorld()[$position[0]][$position[1]]->leaveElement();
								}else{
									$element->setHidden(true);
									setWorld(getGround(), $position[0], $position[1]);
								}

								getWorld()[$row][$col]->saveElement($element);

								$element->setPosition(array($row, $col));
								//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' )' . "\n");
								writeFileCSV('Log', array(get_class($element), $element->getId(), $row . '.' . $col, '', 'move', 'hide'));
							}else{
								//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - Denied - Lair busy' . "\n");
							}
							break;
						default:
							//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - Denied' . "\n");
					}
					break;
				case 'Wolf':
					switch(get_class(getWorld()[$row][$col])){
						case 'Ground':
							setWorld(getGround(), $position[0], $position[1]);
							$element->setPosition(array($row, $col));
							setWorld($element, $row, $col);

							//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' )' . "\n");
							writeFileCSV('Log', array(get_class($element), $element->getId(), $row . '.' . $col, '', 'move', ''));
							break;
						case 'Rabbit':
							if($element->getAteAgo() >= $_POST['noNeedToEatWolf']){
								setWorld(getGround(), $position[0], $position[1]);

								$element->setPosition(array($row, $col));
								$element->setEating(getTurnEatWolf());
								$element->setAteAgo(0);

								delDynamic(getWorld()[$row][$col]);
								setWorld($element, $row, $col);

								// Statistics - Hunted rabbits
								$GLOBALS['vars']['huntedRabbit'][getTime() - 1]++;

								//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' ) - Eating' . "\n");
								writeFileCSV('Log', array(get_class($element), $element->getId(), $row . '.' . $col, '', 'move', 'eat'));
							}else{
								//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' ) - Denied - He is sated' . "\n");
							}
							
							break;
						default:
							//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - Denied' . "\n");
					}
					break;
			}
		}
	}

	/**
	 * Action sleep
	 * Change the status of the element to 'sleeping'
	 *
	 * @param Element Element
	 */
	function toSleep($element){
		switch(get_class($element)){
			case 'Rabbit':
				if($element->getSleptAgo() >= $_POST['notSleepyRabbit']){
					if($_POST['placeToSleepRabbit'] == 'ground'){
						$element->setSleeping(getTurnSleepRabbit());
						$element->setSleptAgo(0);
						//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleep' . "\n");
						writeFileCSV('Log', array(get_class($element), $element->getId(), $element->getPosition()[0] . '.' . $element->getPosition()[1], '', 'sleep', ''));
					}else{
						if($element->getHidden()){
							$element->setSleeping(getTurnSleepRabbit());
							$element->setSleptAgo(0);
							//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleep' . "\n");
							writeFileCSV('Log', array(get_class($element), $element->getId(), $element->getPosition()[0] . '.' . $element->getPosition()[1], '', 'sleep', ''));
						}else{
							//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleep - Denied' . "\n");
						}
					}
				}else{
					
				}
				break;
			case 'Wolf':
				$element->setSleeping(getTurnSleepRabbit());
				$element->setSleptAgo(0);
				writeFileCSV('Log', array(get_class($element), $element->getId(), $element->getPosition()[0] . '.' . $element->getPosition()[1], '', 'sleep', ''));
				break;
		}
	}

	/**
	 * Action smell
	 * It returns the positions that an element can smell, if these positions have an element
	 *
	 * @param Element Element
	 *
	 * @return array Positions
	 */
	function smell($element){
		$position = $element->getPosition();
		
		switch(get_class($element)){
            case 'Rabbit':
                $smellRange = $_POST['smellRabbit'];
                break;
            case 'Wolf':
                $smellRange = $_POST['smellWolf'];
                break;
        }

        $rowStart = $position[0] - $smellRange;
        $colStart = $position[1] - $smellRange;
        $rowEnd = $position[0] + $smellRange;
        $colEnd = $position[1] + $smellRange;

        $numRabbit = 0;
        $numWolf = 0;
        $numCarrot = 0;

        while($rowStart <= $rowEnd){
        	while($colStart <= $colEnd){
        		if(!isLocked($rowStart, $colStart)){
        			if(!($rowStart == $position[0] && $colStart == $position[1]) && get_class(getWorld()[$rowStart][$colStart]) != 'Ground'){
        				$currentElement = get_class(getWorld()[$rowStart][$colStart]);
        				switch($currentElement){
        					case 'Rabbit':
        						$numRabbit++;
        						break;
        					case 'Wolf':
        						$numWolf++;
        						break;
        					case 'Carrot':
        						$numCarrot++;
        						break;
        					case 'Lair':
        						if(getWorld()[$rowStart][$colStart]->getElement() != null){
        							$numRabbit++;
        						}
        						break;
        				}
        			}
        		}
        		$colStart++;
        	}
        	$colStart = $position[1] - $smellRange;
        	$rowStart++;
        }

        //writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - smell - Rabbit: ' . $numRabbit . ', Wolf: ' . $numWolf . ', Carrot: ' . $numCarrot . "\n");
        writeFileCSV('Log', array(get_class($element), $element->getId(), $position[0] . '.' . $position[1], '', 'smell', 'Rabbit (' . $numRabbit . '), Wolf (' . $numWolf . '), Carrot(' . $numCarrot . ')'));

        return array('Rabbit' => $numRabbit, 'Wolf' => $numWolf, 'Carrot' => $numCarrot);
	}

	/**
	 * Action hear
	 * It returns the positions that an element can smell, if these positions have an element
	 *
	 * @param Element Element
	 *
	 * @return array Positions
	 */
	function hear($element){
		$position = $element->getPosition();
		
		switch(get_class($element)){
            case 'Rabbit':
                $hearRange = $_POST['hearRabbit'];
                break;
            case 'Wolf':
                $hearRange = $_POST['hearWolf'];
                break;
        }

        $rowStart = $position[0] - $hearRange;
        $colStart = $position[1] - $hearRange;
        $rowEnd = $position[0] + $hearRange;
        $colEnd = $position[1] + $hearRange;

        $numRabbit = 0;
        $numWolf = 0;
        $numCarrot = 0;

        while($rowStart <= $rowEnd){
        	while($colStart <= $colEnd){
        		if(!isLocked($rowStart, $colStart)){
        			if(!($rowStart == $position[0] && $colStart == $position[1]) && get_class(getWorld()[$rowStart][$colStart]) != 'Ground'){
        				$currentElement = get_class(getWorld()[$rowStart][$colStart]);
        				switch($currentElement){
        					case 'Rabbit':
        						$numRabbit++;
        						break;
        					case 'Wolf':
        						$numWolf++;
        						break;
        					case 'Carrot':
        						$numCarrot++;
        						break;
        				}
        			}
        		}
        		$colStart++;
        	}
        	$colStart = $position[1] - $hearRange;
        	$rowStart++;
        }

        //writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - hear - Rabbit: ' . $numRabbit . ', Wolf: ' . $numWolf . ', Carrot: ' . $numCarrot . "\n");
        writeFileCSV('Log', array(get_class($element), $element->getId(), $position[0] . '.' . $position[1], '', 'hear', 'Rabbit (' . $numRabbit . '), Wolf (' . $numWolf . '), Carrot(' . $numCarrot . ')'));

        return array('Rabbit' => $numRabbit, 'Wolf' => $numWolf, 'Carrot' => $numCarrot);
	}

	/**
	 * Action breed
	 *
	 * @param Element Element 
	 */
	function breed($element){
		if(isInComfort($element) && $element->getEating() == 0 && $element->getSleeping() == 0){
			switch(get_class($element)){
				case 'Rabbit':
					if($element->getBredAgo() > $_POST['breedRabbitEach']){
						$probability = rand(1, 100) / 100;
						if($probability > 0.5){
							$position = $element->getPosition();

							foreach(getDynamic() as $elem){
								if(get_class($elem) == 'Rabbit'){
									$positionCouple = $elem->getPosition();

									if(($positionCouple[0] == $position[0] - 1 && $positionCouple[1] == $position[1]) ||
										($positionCouple[0] == $position[0] + 1 && $positionCouple[1] == $position[1]) ||
										($positionCouple[0] == $position[0] && $positionCouple[1] == $position[1] - 1) ||
										($positionCouple[0] == $position[0] && $positionCouple[1] == $position[1] + 1)){
										$children = rand(1, $_POST['breedRabbitAmount']);
										$numChildren = 0;
										for($i = 0; $i < $children; $i++){
											if(addRabbit()){
												$numChildren++;
											}
										}

										$element->setBredAgo(0);

										// Estadísticas - Reproducción de conejos
										$GLOBALS['vars']['bornRabbit'][getTime() - 1] += $numChildren;

										//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - breed' . "\n");
										writeFileCSV('Log', array(get_class($element), $element->getId(), $position[0] . '.' . $position[1], '', 'breed', 'Children (' . $numChildren . ')'));

										break;
									}
								}
							}
						}else{
							//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - breed - Denied - Children lost' . "\n");
						}
					}else{
						//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - breed - Denied' . "\n");
					}
					break;
				case 'Wolf':
					if($element->getBredAgo() > $_POST['breedWolfEach']){
						$probability = rand(1, 100) / 100;
						if($probability > 0.75){
							$position = $element->getPosition();

							foreach(getDynamic() as $elem){
								if(get_class($elem) == 'Wolf'){
									$positionCouple = $elem->getPosition();

									if(($positionCouple[0] == $position[0] - 1 && $positionCouple[1] == $position[1]) ||
										($positionCouple[0] == $position[0] + 1 && $positionCouple[1] == $position[1]) ||
										($positionCouple[0] == $position[0] && $positionCouple[1] == $position[1] - 1) ||
										($positionCouple[0] == $position[0] && $positionCouple[1] == $position[1] + 1)){
										$children = rand(1, $_POST['breedWolfAmount']);
										$numChildren = 0;
										for($i = 0; $i < $children; $i++){
											if(addWolf()){
												$numChildren++;
											}
										}

										$element->setBredAgo(0);

										// Estadísticas - Reproducción de lobos
										$GLOBALS['vars']['bornWolf'][getTime() - 1] += $numChildren;

										//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - breed' . "\n");
										writeFileCSV('Log', array(get_class($element), $element->getId(), $position[0] . '.' . $position[1], '', 'breed', 'Children (' . $numChildren . ')'));

										break;
									}
								}
							}
						}else{
							//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - breed - Denied - Children lost' . "\n");
						}
					}else{
						//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - breed - Denied' . "\n");
					}
					break;
			}
		}else{
			//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - breed - Denied' . "\n");
		}
	}

	/**
	 * It checks if an element is in the comfort zone
	 *
	 * @param Element
	 *
	 * @return bool True, if the element is in the comfort zone; false, in the opposite case
	 */
	function isInComfort($element){
		switch(get_class($element)){
			case 'Rabbit':
				if($element->getAteAgo() > $_POST['eatComfortRabbit'] || $element->getSleptAgo() > $_POST['sleepComfortRabbit']){
					return false;
				}else{
					return true;
				}
				break;
			case 'Wolf':
				if($element->getAteAgo() > $_POST['eatComfortWolf'] || $element->getSleptAgo() > $_POST['sleepComfortWolf']){
					return false;
				}else{
					return true;
				}
				break;
		}
	}

	/* --------------------------------------------------------------------- */

	/* ------------------------------ Files ----------------------------- */
	/**
	 * It opens the connection to a file
	 *
	 * @param string File
	 */
	function openFile($file){
		$file = fopen('../Resources/log/' . $file . '.txt', 'w');
		return $file;
	}

	/**
	 * It writes in a file
	 *
	 * @param string File
	 * @param string Text to write in a file
	 */
	function writeFile($file, $text){
		fputs($GLOBALS['vars']['file' . $file], $text);
	}

	/**
	 * It opens the connection to a file
	 *
	 * @param string File
	 */
	function openFileCSV($file){
		$file = fopen('../resources/log/' . $file . '.csv', 'w');
		return $file;
	}

	/**
	 * It writes in a file
	 *
	 *
	 * @param string file
	 * @param string Text to write in a file
	 */
	function writeFileCSV($file, $text){
		fputcsv($GLOBALS['vars']['file' . $file], $text, ':');
	}

	/**
	 * It closes the connection to a file
	 *
	 * @param object File which connection is going to be closed
	 */
	function closeFile($file){
		fclose($GLOBALS['vars']['file' . $file]);
	}
	/* --------------------------------------------------------------------- */

	/* **** Main **** */
	conf();
	createWorld();

	//writeFile('Log', '----Turn 0' . "\n");
	writeFileCSV('Log', array('Turn 0'));

	for($i = 0; $i < $_POST['rabbit']; $i++) addRabbit();
	for($i = 0; $i < $_POST['wolf']; $i++) addWolf();
	for($i = 0; $i < $_POST['carrot']; $i++) addCarrot();
	for($i = 0; $i < $_POST['lair']; $i++) addLair();
	for($i = 0; $i < $_POST['tree']; $i++) addTree();

	writeWorld();

	// Statistics - Weather
	switch(getWeather()){
		case 'sunny':
			$GLOBALS['vars']['countWeather'][0]++;
			break;
		case 'rainy':
			$GLOBALS['vars']['countWeather'][1]++;
			break;
		case 'windy':
			$GLOBALS['vars']['countWeather'][2]++;
			break;
		case 'foggy':
			$GLOBALS['vars']['countWeather'][3]++;
			break;
	}

	// Statistics - Population of elements
	$amountRabbit = 0;
	$amountWolf = 0;

	foreach(getDynamic() as $element){
		if(get_class($element) == 'Rabbit'){
			$amountRabbit++;
		}else{
			$amountWolf++;
		}
	}

	array_push($GLOBALS['vars']['amountRabbit'], $amountRabbit);
	array_push($GLOBALS['vars']['amountWolf'], $amountWolf);
	array_push($GLOBALS['vars']['amountCarrot'], count(getPrize()));
	
	if(getLengthNight() % 2 == 0){
		$x = 0;
	}else{
		$x = 1;
	}

	$timeWeather = 1;

	while(getTime() <= getLength()){
		//writeFile('Log', '----Turn ' . getTime() . "\n");
		writeFileCSV('Log', array('Turn ' . getTime()));

		// Change day status (daylight / night)
		if(getTime() == (getLengthDay() + getLengthNight()) * getiTime() - intval(getLengthNight() / 2) || getTime() == (getLengthDay() + getLengthNight()) * (getiTime() - 1) + intval(getLengthNight() / 2) + $x){
			setStatusDay();
		}

		// Change the weather
		if(getTime() == getChangeWeather() * $timeWeather){
			setWeather();
			$timeWeather++;
		}

		// Statistics - Hunted rabbits
		array_push($GLOBALS['vars']['huntedRabbit'], 0);

		// Statistics - Eaten carrots
		array_push($GLOBALS['vars']['eatenCarrot'], 0);

		// Statistics - Dead rabbits and wolves for not eating
		array_push($GLOBALS['vars']['deadEatRabbit'], 0);
		array_push($GLOBALS['vars']['deadEatWolf'], 0);

		// Statistics - Dead rabbits and wolves for not sleeping
		array_push($GLOBALS['vars']['deadSleepRabbit'], 0);
		array_push($GLOBALS['vars']['deadSleepWolf'], 0);

		// Statistics - Breed of rabbits
		array_push($GLOBALS['vars']['bornRabbit'], 0);

		// Statistics - Breed of wolves
		array_push($GLOBALS['vars']['bornWolf'], 0);

		foreach(getDynamic() as $element){
			if((get_class($element) == 'Rabbit' && $element->getAteAgo() == $_POST['maxEatRabbit']) || (get_class($element) == 'Wolf' && $element->getAteAgo() == $_POST['maxEatWolf'])){
				delDynamic($element);

				// Statistics - Dead rabbits and wolves for not eating
				if(get_class($element) == 'Rabbit'){
					$GLOBALS['vars']['deadEatRabbit'][getTime() - 1]++;
				}else{
					$GLOBALS['vars']['deadEatWolf'][getTime() - 1]++;
				}

				//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' has dead because he has not eaten enough' . "\n");
				writeFileCSV('Log', array(get_class($element), $element->getId(), 'dead', 'not eat enough'));
			}else if((get_class($element) == 'Rabbit' && $element->getSleptAgo() == $_POST['maxSleepRabbit']) || (get_class($element) == 'Wolf' && $element->getSleptAgo() == $_POST['maxSleepWolf'])){
				delDynamic($element);

				// Statistics - Dead rabbits and wolves for not sleeping
				if(get_class($element) == 'Rabbit'){
					$GLOBALS['vars']['deadSleepRabbit'][getiTime() - 1]++;
				}else{
					$GLOBALS['vars']['deadSleepWolf'][getiTime() - 1]++;
				}

				//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' has dead because he has not slept enough' . "\n");
				writeFileCSV('Log', array(get_class($element), $element->getId(), 'dead', 'not sleep enough'));
			}else if($element->getEating() > 0){
				$element->setEating($element->getEating() - 1);

				//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - eating' . "\n");
				writeFileCSV('Log', array(get_class($element), $element->getId(), $element->getPosition()[0] . '.' . $element->getPosition()[1], 'eating', '', ''));
			}else if($element->getSleeping() > 0){
				$element->setSleeping($element->getSleeping() - 1);

				//writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleeping' . "\n");
				writeFileCSV('Log', array(get_class($element), $element->getId(), $element->getPosition()[0] . '.' . $element->getPosition()[1], 'sleeping', '', ''));
			}else{
				$element->setAteAgo($element->getAteAgo() + 1);
				$element->setSleptAgo($element->getSleptAgo() + 1);

				$element->act();

				useAction($element, 'max');

				$element->setBredAgo($element->getBredAgo() + 1);
			}
		}

		// Striking of carrots
		foreach(getPrize() as $carrot){
			if($carrot->getLifeTime() == 0){
				delPrize($carrot);
			}else{
				$carrot->setLifeTime($carrot->getLifeTime() - 1);
			}
		}

		// Regeneration of carrots
        if($GLOBALS['vars']['moreCarrot'] > 0){
            $GLOBALS['vars']['moreCarrot']--;
        }else{
            for($i = 0; $i < $_POST['amountMoreCarrot']; $i++){
                addCarrot();
            }
            $GLOBALS['vars']['moreCarrot'] = $_POST['timeMoreCarrot'];
        }

		setTime();
		writeWorld();

		if(getTime() == getiTime() * (getLengthDay() + getLengthNight())){
			setiTime();
		}

		// Statistics - Weather
		switch(getWeather()){
			case 'sunny':
				$GLOBALS['vars']['countWeather'][0]++;
				break;
			case 'rainy':
				$GLOBALS['vars']['countWeather'][1]++;
				break;
			case 'windy':
				$GLOBALS['vars']['countWeather'][2]++;
				break;
			case 'foggy':
				$GLOBALS['vars']['countWeather'][3]++;
				break;
		}

		// Statistics - Population of elements
		$amountRabbit = 0;
		$amountWolf = 0;

		foreach(getDynamic() as $element){
			if(get_class($element) == 'Rabbit'){
				$amountRabbit++;
			}else{
				$amountWolf++;
			}
		}

		array_push($GLOBALS['vars']['amountRabbit'], $amountRabbit);
		array_push($GLOBALS['vars']['amountWolf'], $amountWolf);
		array_push($GLOBALS['vars']['amountCarrot'], count(getPrize()));

		//writeFile('Log', "\n");
	}

	closeFile('Log');
	closeFile('World');
	closeFile('Debug');
	closeFile('Conf');

	$memory = memory_get_usage(true);
	$memory2 = memory_get_peak_usage(true);
    $timeFinish = microtime(true);
	
	session_start();

	// World
	// Size
	$_SESSION['row'] = getSizeWorld()['row'];
	$_SESSION['col'] = getSizeWorld()['col'];

	// Memory and execution time
	$_SESSION['memory'] = $memory / 1024 / 1024;
	$_SESSION['time'] = bcsub($timeFinish, $timeStart, 2);

	// Statistics
	// Weather
	$_SESSION['weather'] = $GLOBALS['vars']['countWeather'];

	// Population of elements
	$_SESSION['amountRabbit'] = $GLOBALS['vars']['amountRabbit'];
	$_SESSION['amountWolf'] = $GLOBALS['vars']['amountWolf'];
	$_SESSION['amountCarrot'] = $GLOBALS['vars']['amountCarrot'];

	// Hunted rabbits
	$_SESSION['huntedRabbit'] = $GLOBALS['vars']['huntedRabbit'];

	// Eaten carrots
	$_SESSION['eatenCarrot'] = $GLOBALS['vars']['eatenCarrot'];

	// Statistics - Dead rabbits and wolves for not eating
	$_SESSION['deadEatRabbit'] = $GLOBALS['vars']['deadEatRabbit'];
	$_SESSION['deadEatWolf'] = $GLOBALS['vars']['deadEatWolf'];

	// Statistics - Dead rabbits and wolves for not sleeping
	$_SESSION['deadSleepRabbit'] = $GLOBALS['vars']['deadSleepRabbit'];
	$_SESSION['deadSleepWolf'] = $GLOBALS['vars']['deadSleepWolf'];

	// Breed of rabbits
	$_SESSION['bornRabbit'] = $GLOBALS['vars']['bornRabbit'];

	// Breed of wolves
	$_SESSION['bornWolf'] = $GLOBALS['vars']['bornWolf'];

	session_write_close();

	$lang = $_GET['lang'];

	header('Location: ../View/output.php?lang=' . $lang, false);
?>