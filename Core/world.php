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
	$vars['iTime'] = 1;
	$vars['ground'] = null;

	$vars['moreCarrot'] = 0;
	$vars['moreWolf'] = 0;

	$vars['auxSleep'] = intval(getLengthNight() * 25 / 100);

	/* ** Elemento ** */
	$vars['static'] = array();
	$vars['dynamic'] = array();
	$vars['prize'] = array();
	//$vars['moveTo'] = array('up', 'down', 'left', 'right');
	$vars['turnEatRabbit'] = 0;
	$vars['turnEatWolf'] = 0;
	$vars['turnSleepRabbit'] = 0;
	$vars['turnSleepWolf'] = 0;

	/* ** Fichero ** */
	$vars['fileWorld'] = openFile('world');
	$vars['fileLog'] = openFile('log');
	$vars['fileDebug'] = openFile('debug');

	/* ** Estadísticas ** */
	$vars['countWeather'] = array(0, 0, 0, 0);

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

		$GLOBALS['vars']['daylight'] = false;
		writeFile('Log', 'Status day: night' . "\n");

		$GLOBALS['vars']['currentWeather'] = $_POST['weather'];
		writeFile('Log', 'Weather: ' . getWeather() . "\n");

		$GLOBALS['vars']['changeWeather'] = $_POST['changeWeather'];
		writeFile('Log', 'Change weather every ' . getChangeWeather() . ' turns' . "\n");

		$GLOBALS['vars']['ground'] = new Ground();

		$GLOBALS['vars']['turnEatRabbit'] = $_POST['eatRabbit'];
		writeFile('Log', 'Rabbit need ' . getTurnEatRabbit() . ' turns to eat' . "\n");
		
		$GLOBALS['vars']['turnEatWolf'] = $_POST['eatWolf'];
		writeFile('Log', 'Wolf need ' . getTurnEatWolf() . ' turns to eat' . "\n");

		$GLOBALS['vars']['turnSleepRabbit'] = $_POST['sleepRabbit'];
		writeFile('Log', 'Rabbit need ' . getTurnSleepRabbit() . ' turns to sleep' . "\n");
		
		$GLOBALS['vars']['turnSleepWolf'] = $_POST['sleepWolf'];
		writeFile('Log', 'Wolf need ' . getTurnSleepWolf() . ' turns to sleep' . "\n");

		writeFile('Log', 'Rabbits have ' . $_POST['maxUseRabbit'] . ' points to do actions' . "\n");
		writeFile('Log', 'Wolfs have ' . $_POST['maxUseWolf'] . ' points to do actions' . "\n");

		writeFile('Log', 'See spend ' . $_POST['smellRabbitUse'] . ' points in Rabbits' . "\n");
		writeFile('Log', 'See spend ' . $_POST['smellWolfUse'] . ' points in Wolfs' . "\n");
		writeFile('Log', 'Move spend ' . $_POST['smellRabbitUse'] . ' points in Rabbits' . "\n");
		writeFile('Log', 'Move spend ' . $_POST['smellWolfUse'] . ' points in Wolfs' . "\n");
		writeFile('Log', 'Sleep spend ' . $_POST['sleepRabbitUse'] . ' points in Rabbits' . "\n");
		writeFile('Log', 'Sleep spend ' . $_POST['sleepWolfUse'] . ' points in Wolfs' . "\n");
		writeFile('Log', 'Smell spend ' . $_POST['smellRabbitUse'] . ' points in Rabbits' . "\n");
		writeFile('Log', 'Smell spend ' . $_POST['smellWolfUse'] . ' points in Wolfs' . "\n");
		writeFile('Log', 'Hear spend ' . $_POST['hearRabbitUse'] . ' points in Rabbits' . "\n");
		writeFile('Log', 'Hear spend ' . $_POST['hearWolfUse'] . ' points in Wolfs' . "\n");

		writeFile('Log', 'Rabbits have ' . $_POST['seeRabbit'] . ' of view range' . "\n");
		writeFile('Log', 'Wolfs have ' . $_POST['seeWolf'] . ' of view range' . "\n");
		writeFile('Log', 'Rabbits have ' . $_POST['smellRabbit'] . ' of smell range' . "\n");
		writeFile('Log', 'Wolfs have ' . $_POST['smellWolf'] . ' of smell range' . "\n");
		writeFile('Log', 'Rabbits have ' . $_POST['hearRabbit'] . ' of hear range' . "\n");
		writeFile('Log', 'Wolfs have ' . $_POST['hearWolf'] . ' of hear range' . "\n");

		$GLOBALS['vars']['moreCarrot'] = $_POST['timeMoreCarrot'];
		writeFile('Log', $_POST['amountMoreCarrot'] . ' carrots more each ' . $GLOBALS['vars']['moreCarrot'] . ' turns' . "\n");
		$GLOBALS['vars']['moreWolf'] = $_POST['timeMoreWolf'];
		writeFile('Log', $_POST['amountMoreWolf'] . ' wolfs more each ' . $GLOBALS['vars']['moreWolf'] . ' turns' . "\n");
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
				$GLOBALS['vars']['world'][$row][$col] = getGround();
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
				if(get_class($GLOBALS['vars']['world'][$row][$col]) != 'Ground'){
					writeFile('World', $row . ':' . $col . ':' . substr(get_class($GLOBALS['vars']['world'][$row][$col]), 0, 1) . ';');
				}
			}
		}
		writeFile('World', '.');
	}

	/**
	 * Retorna un objeto de tipo Ground
	 *
	 * @return Ground Objeto de tipo Ground
	 */
	function getGround(){
		return $GLOBALS['vars']['ground'];
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
	 * Cambia el estado del mundo a día si es de noche o noche si es de día
	 */
	function setStatusDay(){
		if($GLOBALS['vars']['daylight']){
			$GLOBALS['vars']['daylight'] = false;
			writeFile('Log', 'Status day changed to night' . "\n");
		}else{
			$GLOBALS['vars']['daylight'] = true;
			writeFile('Log', 'Status day changed to day' . "\n");
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
		$GLOBALS['vars']['currentWeather'] = $GLOBALS['vars']['weather'][mt_rand(0, 3)];
		writeFile('Log', 'Weather changed to ' . getWeather() . "\n");
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

	/**
	 * Retorna el día actual
	 *
	 * @return int Contador de días
	 */
	function getiTime(){
		return $GLOBALS['vars']['iTime'];
	}

	/**
	 * Incrementa en 1 el contador de día actual
	 */
	function setiTime(){
		$GLOBALS['vars']['iTime']++;
	}

	/* --------------------------------------------------------------------- */

	/* ----------------------------- Elementos ----------------------------- */
	/**
	 * Devuelve los turnos que necesita un elemento Conejo para comer
	 *
	 * @return int Turnos
	 */
	function getTurnEatRabbit(){
		return $GLOBALS['vars']['turnEatRabbit'];
	}

	/**
	 * Devuelve los turnos que necesita un elemento Lobo para comer
	 *
	 * @return int Turnos
	 */
	function getTurnEatWolf(){
		return $GLOBALS['vars']['turnEatWolf'];
	}

	/**
	 * Devuelve los turnos que necesita un elemento Conejo para dormir
	 *
	 * @return int Turnos
	 */
	function getTurnSleepRabbit(){
		return $GLOBALS['vars']['turnSleepRabbit'];
	}

	/**
	 * Devuelve los turnos que necesita un elemento Lobo para dormir
	 *
	 * @return int Turnos
	 */
	function getTurnSleepWolf(){
		return $GLOBALS['vars']['turnSleepWolf'];
	}

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
	 * Elimina un elemento del hashmap de elementos dinámicos y del array mundo
	 *
	 * @param Element Elemento
	 */
	function delDynamic($element){
		if(get_class(getWorld()[$element->getPosition()[0]][$element->getPosition()[1]]) != 'Lair'){
			setWorld(getGround(), $element->getPosition()[0], $element->getPosition()[1]);
		}
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
	 * Elimina un elemento del hashmap de elementos premio y del array mundo
	 *
	 * @param Element Elemento
	 */
	function delPrize($element){
		setWorld(getGround(), $element->getPosition()[0], $element->getPosition()[1]);
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
			if(get_class(getWorld()[$row][$col]) == 'Ground'){
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
            $rabbit->setNumHasBred(0);

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

            writeFile('Log', '( ' . $lair->getPosition()[0] . ' , ' . $lair->getPosition()[1] . ' ) - Lair' . "\n");
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

            writeFile('Log', '( ' . $tree->getPosition()[0] . ' , ' . $tree->getPosition()[1] . ' ) - Tree' . "\n");
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
					useAction($args[0], 'see');
					return $see;
				}else{
					writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t see, hasn\'t enough uses' . "\n");
				}
				break;
			case 'move':
				if(canAct($args[0], $args[1])){
					move($args[0], $args[2]);
					useAction($args[0], 'move');
				}else{
					writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t move, hasn\'t enough uses' . "\n");
				}
				break;
			case 'sleep':
				if(canAct($args[0], $args[1])){
					toSleep($args[0]);
					useAction($args[0], 'sleep');
				}else{
					writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t sleep, hasn\'t enough uses' . "\n");
				}
				break;
			case 'smell':
				if(canAct($args[0], $args[1])){
					$smell = smell($args[0]);
					useAction($args[0], 'smell');
					return $smell;
				}else{
					writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t smell, hasn\'t enough uses' . "\n");
				}
				break;
			case 'hear':
				if(canAct($args[0], $args[1])){
					$hear = hear($args[0]);
					useAction($args[0], 'hear');
					return $hear;
				}else{
					writeFile('Log', get_class($args[0]) . ' ' . $args[0]->getId() . ' can\'t hear, hasn\'t enough uses' . "\n");
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
		}
	}

	/**
	 * Decrementa los puntos por uno que tiene un elemento para realizar una acción en base a los puntos que consuma una acción
	 *
	 * @param Element Elemento
	 * @param string Acción
	 */
	function useAction($element, $action){
		if($action == 'max'){
			$element->setActPerTurn($_POST['maxUse' . get_class($element)]);
		}else{
			$element->setActPerTurn($element->getActPerTurn() - $_POST[$action . get_class($element) . 'Use']);
		}
	}

	/**
	 * Acción ver
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
        			if(!($rowStart == $position[0] && $colStart == $position[1]) && get_class(getWorld()[$rowStart][$colStart]) != 'Ground'){
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

	/**
	 * Acción mover
	 * Realiza el movimiento de un elemento en caso de que sea posible
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
			writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - Denied' . "\n");
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

							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' )' . "\n");
							break;
						case 'Carrot':
							if($element->getHidden()){
								$element->setHidden(false);
								getWorld()[$position[0]][$position[1]]->leaveElement();
							}else{
								setWorld(getGround(), $position[0], $position[1]);
							}

							$element->setEating(getTurnEatRabbit());
							$element->setPosition(array($row, $col));
							$element->setHasEaten(true);
							delPrize(getWorld()[$row][$col]);
							setWorld($element, $row, $col);

							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' ) - Eating' . "\n");
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
							}else{
								writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - Denied - Lair busy' . "\n");
							}

							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' )' . "\n");
							break;
						default:
							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - Denied' . "\n");
					}
					break;
				case 'Wolf':
					switch(get_class(getWorld()[$row][$col])){
						case 'Ground':
							setWorld(getGround(), $position[0], $position[1]);
							$element->setPosition(array($row, $col));
							setWorld($element, $row, $col);

							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' )' . "\n");
							break;
						case 'Rabbit':
							setWorld(getGround(), $position[0], $position[1]);
							$element->setPosition(array($row, $col));
							$element->setEating(getTurnEatWolf());
							$element->setHasEaten(true);
							delDynamic(getWorld()[$row][$col]);
							setWorld($element, $row, $col);

							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - ( ' . $row . ' , ' . $col . ' ) - Eating' . "\n");
							break;
						default:
							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - move - ' . $movement . ' - Denied' . "\n");
					}
					break;
			}
		}
	}

	/**
	 * Acción dormir
	 * Cambia el estado del elemento a 'durmiendo'
	 */
	function toSleep($element){
		if(getTime() >= (getLengthDay() * getiTime() - getLengthNight() / 2 - $GLOBALS['vars']['auxSleep']) && getTime() < (getLengthDay() * getiTime())){ //+ getLengthNight() / 2 + $GLOBALS['vars']['auxSleep'])){
			switch(get_class($element)){
				case 'Rabbit':
					if($_POST['placeToSleepRabbit'] == 'ground'){
						$element->setSleeping(getTurnSleepRabbit());
						$element->setDaysWithoutSleep(0);
						writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleep' . "\n");
					}else{
						if($element->getHidden()){
							$element->setSleeping(getTurnSleepRabbit());
							$element->setDaysWithoutSleep(0);
							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleep' . "\n");
						}else{
							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleep - Denied' . "\n");
						}
					}
					break;
				case 'Wolf':
					$element->setSleeping(getTurnSleepRabbit());
					$element->setDaysWithoutSleep(0);
					break;
			}
		}else{
			writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleep - Denied' . "\n");
		}
	}

	/**
	 * Acción olfatear
	 * Retorna las posiciones y los elementos que puede olfatear el elemento en el caso de que dichas posiciones contengan un elemento
	 *
	 * @return array Posiciones
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

        writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - smell - Rabbit: ' . $numRabbit . ', Wolf: ' . $numWolf . ', Carrot: ' . $numCarrot . "\n");

        return array('Rabbit' => $numRabbit, 'Wolf' => $numWolf, 'Carrot' => $numCarrot);
	}

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

        writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - hear - Rabbit: ' . $numRabbit . ', Wolf: ' . $numWolf . ', Carrot: ' . $numCarrot . "\n");

        return array('Rabbit' => $numRabbit, 'Wolf' => $numWolf, 'Carrot' => $numCarrot);
	}

	function breed($element){

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
		fclose($GLOBALS['vars']['file' . $file]);
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

	// Estadísticas - Tiempo atmosférico
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
	
	if(getLengthNight() % 2 == 0){
		$x = 0;
	}else{
		$x = 1;
	}

	$timeWeather = 1;

	while(getTime() <= getLength()){
		while(getTime() < getLengthDay() * getiTime() && getTime() <= getLength()){
			writeFile('Log', '----Turn ' . getTime() . "\n");

			// Cambiar estado día (Día / Noche)
			if(getTime() == getLengthDay() * getiTime() - intval(getLengthNight() / 2) || getTime() ==  getLengthDay() * (getiTime() - 1) + intval(getLengthNight() / 2) + $x){
				setStatusDay();
			}

			// Cambiar tiempo atmosférico
			if(getTime() == getChangeWeather() * $timeWeather){
				setWeather();
				$timeWeather++;
			}

			foreach(getDynamic() as $element){
				if($element->getEating() > 0){
					$element->setEating($element->getEating() - 1);
					writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - eating' . "\n");
				}else{
					if($element->getSleeping() > 0){
						$element->setSleeping($element->getSleeping() - 1);
						writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleeping' . "\n");
					}else{
						$element->act();
						useAction($element, 'max');
					}
				}
			}

			// Generación de zanahorias
            if($GLOBALS['vars']['moreCarrot'] > 0){
                $GLOBALS['vars']['moreCarrot']--;
            }else{
                for($i = 0; $i < $_POST['amountMoreCarrot']; $i++){
                    addCarrot();
                }
                $GLOBALS['vars']['moreCarrot'] = $_POST['timeMoreCarrot'];
            }

            // Generación de lobos
            if($GLOBALS['vars']['moreWolf'] > 0){
                $GLOBALS['vars']['moreWolf']--;
            }else{
                for($i = 0; $i < $_POST['amountMoreWolf']; $i++){
                    addWolf();
                }
                $GLOBALS['vars']['moreWolf'] = $_POST['timeMoreWolf'];
            }

			setTime();
			writeWorld();

			// Estadísticas - Tiempo atmosférico
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

			writeFile('Log', "\n");
		}

		writeFile('Log', '----Turn ' . getTime() . "\n");

		// Cambiar estado día (Día / Noche)
		if(getTime() == getLengthDay() * getiTime() - intval(getLengthNight() / 2) || getTime() == getLengthDay() * (getiTime() - 1) + intval(getLengthNight() / 2) + $x){
			setStatusDay();
		}

		// Cambiar tiempo atmosférico
		if(getTime() == getChangeWeather() * $timeWeather){
			setWeather();
			$timeWeather++;
		}

		foreach(getDynamic() as $element){
			if((get_class($element) == 'Rabbit' && $element->getDaysWithoutEat() == $_POST['maxEatRabbit']) || (get_class($element) == 'Wolf' && $element->getDaysWithoutEat() == $_POST['maxEatWolf'])){
				delDynamic($element);
				writeFile('Log', get_class($element) . ' ' . $element->getId() . ' has dead because he has not eaten enough' . "\n");
			}else{
				if((get_class($element) == 'Rabbit' && $element->getDaysWithoutSleep() == $_POST['maxSleepRabbit']) || (get_class($element) == 'Wolf' && $element->getDaysWithoutSleep() == $_POST['maxSleepWolf'])){
					delDynamic($element);
					writeFile('Log', get_class($element) . ' ' . $element->getId() . ' has dead because he has not slept enough' . "\n");
				}else{
					if($element->getEating() > 0){
						$element->setEating($element->getEating() - 1);
						writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - eating' . "\n");
					}else{
						if($element->getSleeping() > 0){
							$element->setSleeping($element->getSleeping() - 1);
							if(!$element->getHasEaten()){
								$element->setDaysWithoutEat($element->getDaysWithoutEat() + 1);
							}else{
								$element->setHasEaten(false);
								$element->setDaysWithoutEat(0);
							}
							writeFile('Log', get_class($element) . ' ' . $element->getId() . ' - sleeping' . "\n");
						}else{
							$element->setDaysWithoutSleep($element->getDaysWithoutSleep() + 1);
							if(!$element->getHasEaten()){
								$element->setDaysWithoutEat($element->getDaysWithoutEat() + 1);
							}else{
								$element->setHasEaten(false);
								$element->setDaysWithoutEat(0);
							}
							$element->act();
							useAction($element, 'max');
						}
					}
				}
			}
		}

		// Generación de zanahorias
        if($GLOBALS['vars']['moreCarrot'] > 0){
            $GLOBALS['vars']['moreCarrot']--;
        }else{
            for($i = 0; $i < $_POST['amountMoreCarrot']; $i++){
                addCarrot();
            }
            $GLOBALS['vars']['moreCarrot'] = $_POST['timeMoreCarrot'];
        }

        // Generación de lobos
        if($GLOBALS['vars']['moreWolf'] > 0){
            $GLOBALS['vars']['moreWolf']--;
        }else{
            for($i = 0; $i < $_POST['amountMoreWolf']; $i++){
                addWolf();
            }
            $GLOBALS['vars']['moreWolf'] = $_POST['timeMoreWolf'];
        }

		setTime();
		writeWorld();
		
		setiTime();

		// Estadísticas - Tiempo atmosférico
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

		writeFile('Log', "\n");
	}

	closeFile('Log');
	closeFile('World');
	closeFile('Debug');

	$memory = memory_get_usage(true);
    $timeFinish = microtime(true);
	
	session_start();

	// Mundo
	$_SESSION['row'] = getSizeWorld()['row'];
	$_SESSION['col'] = getSizeWorld()['col'];

	$_SESSION['memory'] = $memory / 1024 / 1024;
	$_SESSION['time'] = bcsub($timeFinish, $timeStart, 2);

	// Estadísticas
	$_SESSION['weather'] = $GLOBALS['vars']['countWeather'];

	session_write_close();

	header('Location: ../View/output.php', false);
?>