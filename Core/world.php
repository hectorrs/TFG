<?php
	require_once('../Model/element.php');
	require_once('../Model/elements.php');

	$timeStart = microtime(true);

	/**
	 * @global array $vars Contiene las variables del mundo
	 */
	$vars = array();

	/* ** Mundo ** */
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

	/* ** Elemento ** */
	$vars['static'] = array();
	$vars['dynamic'] = array();
	$vars['prize'] = array();
	//$vars['moveTo'] = array('up', 'down', 'left', 'right');

	/* ** Fichero ** */
	$vars['fileWorld'] = openFile('world');
	$vars['fileLog'] = openFile('log');
	$vars['fileDebug'] = openFile('debug');

	/* ------------------------------- Mundo ------------------------------- */
	/**
	 * Recoge los datos de configuración inicial del mundo y los registra en el log
	 */
	function conf(){
		$GLOBALS['vars']['size']['row'] = $_POST['sizeX'];
		$GLOBALS['vars']['size']['col'] = $_POST['sizeY'];
		writeFile('Log', 'Dimensions: ' . getSizeWorld()['row'] . ' x ' . getSizeWorld()['col'] . "\n");

		$GLOBALS['vars']['length'] = $_POST['turn'];
		writeFile('Log', 'Turns: ' . getLength() . "\n");

		$GLOBALS['vars']['day'] = $_POST['day'];
		writeFile('Log', 'Length day: ' . getLengthDay() . "\n");

		$GLOBALS['vars']['night'] = $_POST['night'];
		writeFile('Log', 'Length night: ' . getLengthNight() . "\n");

		$GLOBALS['vars']['daylight'] = $_POST['daylight'];
		writeFile('Log', 'Status day: ' . getStatusDay() . "\n");

		$GLOBALS['vars']['currentWeather'] = $_POST['weather'];
		writeFile('Log', 'Weather: ' . getWeather() . "\n");

		$GLOBALS['vars']['changeWeather'] = $_POST['changeWeather'];
		writeFile('Log', 'Change weather every ' . getChangeWeather() . ' turns' . "\n");
	}

	/**
	 * Obtiene el tamaño del mundo
	 *
	 * @return int[] Largo y ancho
	 */
	function getSizeWorld(){
		return $GLOBALS['vars']['size'];
	}

	/**
	 * Crea la matriz mundo, con cada posición a null
	 */
	function createWorld(){
		for($row = 0; $row < getSizeWorld()['row']; $row++){
			for($col = 0; $col < getSizeWorld()['col']; $col++){
				$GLOBALS['vars']['world'][$row][$col] = null;
			}
		}
	}

	/**
	 * Obtiene la matriz mundo
	 *
	 * @return int[][] Matriz mundo
	 */
	function getWorld(){
		return $GLOBALS['vars']['world'];
	}

	/**
	 * Modifica el contenido de una posición del mundo
	 *
	 * @param Element $element Objeto a colocar en el mundo
	 * @param int $row Posición x del mundo
	 * @param int $col Posición y del mundo
	 */
	function setWorld($element, $row, $col){
		$GLOBALS['vars']['world'][$row][$col] = $element;
	}

	/**
	 * Escribe en un fichero de texto el contenido del mundo
	 */
	function writeWorld(){
		for($row = 0; $row < getSizeWorld()['row']; $row++){
			for($col = 0; $col < getSizeWorld()['col']; $col++){
				if($GLOBALS['vars']['world'][$row][$col] != null){
					writeFile('World', $row . ':' . $col . ':' . substr(get_class($GLOBALS['vars']['world'][$row][$col]), 0, 1) . ';');
				}
			}
		}
		writeFile('World', '.');
	}

	/**
	 * Comprueba si el mundo está lleno de elementos
	 *
	 * @return bool True, en caso de que esté lleno; false, en caso contrario
	 */
	function isFull(){
		if(count(getStatic()) + count(getDynamic()) + count(getPrize()) < getSizeWorld()['row'] * getSizeWorld()['col']){
			return false;
		}else{
			return true;
		}
	}

	/**
	 * Retorna el estado del día (día o noche)
	 *
	 * @return bool True, si es de día; false, si es de noche
	 */
	function getStatusDay(){
		return $GLOBALS['vars']['daylight'];
	}

	/**
	 * Modifica el estado del día
	 */
	function setStatusDay(){
		if($GLOBALS['vars']['daylight']){
			$GLOBALS['vars']['daylight'] = false;
		}else{
			$GLOBALS['vars']['daylight'] = true;
		}
	}

	/**
	 * Retorna los turnos de ejecución
	 *
	 * @return int Turnos
	 */
	function getLength(){
		return $GLOBALS['vars']['length'];
	}

	/**
	 * Retorna la duración de un día
	 *
	 * @return int Duración
	 */
	function getLengthDay(){
		return $GLOBALS['vars']['day'];
	}

	/**
	 * Retorna la duración de una noche
	 *
	 * @return int Duración
	 */
	function getLengthNight(){
		return $GLOBALS['vars']['night'];
	}

	/**
	 * Retorna el tiempo atmosférico actual
	 *
	 * @return string Tiempo atmosférico
	 */
	function getWeather(){
		return $GLOBALS['vars']['currentWeather'];
	}

	/**
	 * Modifica el tiempo atmosférico actual
	 */
	function setWeather(){
		$GLOBALS['vars']['currentWeather'] = $GLOBALS['vars']['weather'][rand(0, 3)];
	}

	/**
	 * Retorna cada cuántos turnos cambia el tiempo atmosférico
	 *
	 * @return int Turnos
	 */
	function getChangeWeather(){
		return $GLOBALS['vars']['changeWeather'];
	}

	/**
	 * Retorna el instante de tiempo actual
	 *
	 * @return int Tiempo
	 */
	function getTime(){
		return $GLOBALS['vars']['time'];
	}

	/**
	 * Avanza el tiempo
	 */
	function setTime(){
		$GLOBALS['vars']['time']++;
	}

	/* --------------------------------------------------------------------- */

	/* ----------------------------- Elementos ----------------------------- */
	/**
	 * Devuelve el hashmap que contiene los elementos estáticos
	 *
	 * @return Element Elementos estáticos
	 */
	function getStatic(){
		return $GLOBALS['vars']['static'];
	}

	/**
	 * Añade un elemento al hashmap de elementos estáticos
	 *
	 * @param Element Elemento
	 */
	function addStatic($element){
		setWorld($element, $element->getPosition()[0], $element->getPosition()[1]);
		$GLOBALS['vars']['static'][$element->getId()] = $element;
	}

	/**
	 * Devuelve el hashmap que contiene los elementos dinámicos
	 *
	 * @return Element Elementos dinámicos
	 */
	function getDynamic(){
		return $GLOBALS['vars']['dynamic'];
	}

	/**
	 * Añade un elemento al hashmap de elementos dinámicos
	 *
	 * @param Element Elemento
	 */
	function addDynamic($element){
		setWorld($element, $element->getPosition()[0], $element->getPosition()[1]);
		$GLOBALS['vars']['dynamic'][$element->getId()] = $element;
	}

	/**
	 * Elimina un elemento del hashmap de elementos dinámicos
	 *
	 * @param Element Elemento
	 */
	function delDynamic($element){
		setWorld(null, $element->getPosition()[0], $element->getPosition()[1]);
		unset($GLOBALS['vars']['dynamic'][$element->getId()]);
	}

	/**
	 * Devuelve el hashmap que contiene los elementos premio
	 *
	 * @return Element Elementos premio
	 */
	function getPrize(){
		return $GLOBALS['vars']['prize'];
	}

	/**
	 * Añade un elemento al hashmap de elementos premio
	 *
	 * @param Element Elemento
	 */
	function addPrize($element){
		setWorld($element, $element->getPosition()[0], $element->getPosition()[1]);
		$GLOBALS['vars']['prize'][$element->getId()] = $element;
	}

	/**
	 * Elimina un elemento del hashmap de elementos premio
	 *
	 * @param Element Elemento
	 */
	function delPrize($element){
		setWorld(null, $element->getPosition()[0], $element->getPosition()[1]);
		unset($GLOBALS['vars']['prize'][$element->getId()]);
	}

	/**
	 * Comprueba si un elemento se puede colocar en el mundo
	 *
	 * @param Element Elemento
	 * @param int Fila
	 * @param int Columna
	 *
	 * @return bool True, en caso de que se coloque el elemento; false, en contrario
	 */
	function putElement($element, $row, $col){
		if($row < 0 || $row > (getSizeWorld()['row'] - 1) || $col < 0 || $col > (getSizeWorld()['col'] - 1)){
			return false;
		}else{
			if(getWorld()[$row][$col] == null){
				return true;
			}else{
				return false;
			}
		}
	}

	/**
	 * Coloca un elemento Conejo en el mundo. Lo inserta en el hashmap de elementos dinámicos y en array Mundo
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

            writeFile('Log', '( ' . $rabbit->getPosition()[0] . ' , ' . $rabbit->getPosition()[1] . ' ) - Rabbit ' . $rabbit->getId() . "\n");
		}else{
			writeFile('Log', 'World is full! It can\'t put a rabbit' . "\n");
		}
	}

	/**
	 * Coloca un elemento Lobo en el mundo. Lo inserta en el hashmap de elementos dinámicos y en el array Mundo
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

            writeFile('Log', '( ' . $wolf->getPosition()[0] . ' , ' . $wolf->getPosition()[1] . ' ) - Wolf ' . $wolf->getId() . "\n");
		}else{
			writeFile('Log', 'World is full! It can\'t put a wolf' . "\n");
		}
	}

	/**
	 * Coloca un elemento Zanahoria en el mundo. Lo inserta en el hashmap de elementos premio y en el array Mundo
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

            addPrize($carrot);

            writeFile('Log', '( ' . $carrot->getPosition()[0] . ' , ' . $carrot->getPosition()[1] . ' ) - Carrot' . "\n");
		}else{
			writeFile('Log', 'World is full! It can\'t put a carrot' . "\n");
		}
	}

	/**
	 * Coloca un elemento Madriguera en el mundo. Lo inserta en el hashmap de elementos estáticos y en el array Mundo
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

            writeFile('Log', '( ' . $lair->getPosition()[0] . ' , ' . $lair->getPosition()[1] . ' ) - Madriguera' . "\n");
		}else{
			writeFile('Log', 'World is full! It can\'t put a lair' . "\n");
		}
	}

	/**
	 * Coloca un elemento Árbol en el mundo. Lo inserta en el hashmap de elementos estáticos y en el array Mundo
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

            writeFile('Log', '( ' . $tree->getPosition()[0] . ' , ' . $tree->getPosition()[1] . ' ) - Árbol' . "\n");
		}else{
			writeFile('Log', 'World is full! It can\'t put a tree' . "\n");
		}
	}

	/**
	 * Maneja las acciones que puede realizar cada elemento
	 *
	 * @return array|void Varía según el tipo de acción a realizar
	 */
	function actionManager(...$args){
		switch($args[1]){
			case 'see':
				if(canAct($args[0], $args[1])){
					$see = see($args[0]);
					return $see;
				}else{
					writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t act' . "\n");
				}
				break;
		}
	}

	/**
	 * Comprueba si un elemento puede realizar una acción en base a los puntos que le queden de turno
	 *
	 * @return bool True, si puede realizar la acción; false, si no puede
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
	 * Devuelve el consumo de una acción
	 *
	 * @return int Consumo
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
		}
	}

	/**
	 * Retorna las posiciones y los elementos que puede ver el elemento en el caso de que dichas posiciones contengan un elemento
	 *
	 * @return array Posiciones
	 */
	function see($element){
		writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - see - ');

		$see = array();

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
        			if(!($rowStart == $position[0] && $colStart == $position[1]) && getWorld()[$rowStart][$colStart] != null){
        				array_push($see, array(get_class(getWorld()[$rowStart][$colStart]), array($rowStart, $rowEnd)));
        				writeFile('Log', get_class(getWorld()[$rowStart][$colStart]) . ' ( ' . $rowStart . ' , ' . $colStart . ' ) ');
        			}
        		}
        		$colStart++;
        	}
        	$colStart = $position[1] - $viewRange;
        	$rowStart++;
        }

        writeFile('Log', "\n");

		return $see;
	}

	/**
	 * Retorna si una posición se encuentra fuera de los límites del mundo
	 *
	 * @return bool True, en caso afirmativo; false, en caso contrario
	 */
	function isLocked($row, $col){
		if($row < 0 || $row >= getSizeWorld()['row'] || $col < 0 || $col >= getSizeWorld()['col']){
			return true;
		}else{
			return false;
		}
	}
	/* --------------------------------------------------------------------- */

	/* ------------------------------ Archivos ----------------------------- */
	/**
	 * Abre la conexión a un archivo
	 *
	 * @param string Fichero
	 */
	function openFile($file){
		$file = fopen('../Resources/log/' . $file . '.txt', 'w');
		return $file;
	}

	/**
	 * Escribe en el fichero
	 *
	 * @param string Fichero
	 * @param string Texto a escribir en el fichero
	 */
	function writeFile($file, $text){
		fputs($GLOBALS['vars']['file' . $file], $text);
	}

	/**
	 * Cierra la conexión a un archivo
	 *
	 * @param object Fichero al cual se va a cerrar la conexión
	 */
	function closeFile($file){
		fclose($file);
	}
	/* --------------------------------------------------------------------- */

	/* **** Main **** */
	conf();
	createWorld();

	for($i = 0; $i < $_POST['rabbit']; $i++) addRabbit();
	for($i = 0; $i < $_POST['wolf']; $i++) addWolf();
	for($i = 0; $i < $_POST['carrot']; $i++) addCarrot();
	for($i = 0; $i < $_POST['lair']; $i++) addLair();
	for($i = 0; $i < $_POST['tree']; $i++) addTree();

	writeWorld();

	while(getTime() <= getLength()){
		writeFile('Log', '----Turn ' . getTime() . "\n");

		foreach(getDynamic() as $element){
			$element->act();
		}

		setTime();
		writeWorld();

		writeFile('Log', "\n");
	}

	$memory = memory_get_usage(true);
    $timeFinish = microtime(true);
	
	session_start();

	$_SESSION['row'] = getSizeWorld()['row'];
	$_SESSION['col'] = getSizeWorld()['col'];
	$_SESSION['memory'] = $memory / 1024 / 1024;
	$_SESSION['time'] = bcsub($timeFinish, $timeStart, 2);

	session_write_close();

	header('Location: ../View/output.php', false);
?>