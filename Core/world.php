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

	/* ** Elemento ** */
	$vars['static'] = array();
	$vars['dynamic'] = array();
	$vars['prize'] = array();
	$vars['lookTo'] = array('up', 'down', 'left', 'right');

	/* ** Fichero ** */
	$vars['fileWorld'] = openFile('world');
	$vars['fileLog'] = openFile('log');
	$vars['fileDebug'] = openFile('debug');

	/* ------------------------------- Mundo ------------------------------- */
	/**
	 * Obtiene el tamaño del mundo
	 *
	 * @return int[] Largo y ancho
	 */
	function getSizeWorld(){
		return $GLOBALS['vars']['size'];
	}

	/**
	 * Almacena el tamaño del mundo
	 */
	function addSizeWorld(){
		$GLOBALS['vars']['size']['row'] = $_POST['sizeX'];
		$GLOBALS['vars']['size']['col'] = $_POST['sizeY'];
		writeFile('Log', 'Dimensiones: ' . getSizeWorld()['row'] . ' x ' . getSizeWorld()['col'] . "\n");
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
	 * Devuelve las direcciones hacia las que puede mirar un elemento
	 *
	 * @return array Direcciones
	 */
	function getLookTo(){
		return $GLOBALS['vars']['lookTo'];
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
            $rabbit->setLookTo(randLookTo());
            $rabbit->setActPerTurn($_POST['maxUseRabbit']);
            $rabbit->setHidden(false);

            addDynamic($rabbit);

            writeFile('Log', '( ' . $rabbit->getPosition()[0] . ' , ' . $rabbit->getPosition()[1] . ' ) - Conejo' . "\n");
		}else{
			writeFile('Log', 'Mundo lleno! No se ha podido colocar el conejo' . "\n");
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
            $wolf->setLookTo(randLookTo());
            $wolf->setActPerTurn($_POST['maxUseWolf']);

            addDynamic($wolf);

            writeFile('Log', '( ' . $wolf->getPosition()[0] . ' , ' . $wolf->getPosition()[1] . ' ) - Lobo' . "\n");
		}else{
			writeFile('Log', 'Mundo lleno! No se ha podido colocar el lobo' . "\n");
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

            writeFile('Log', '( ' . $carrot->getPosition()[0] . ' , ' . $carrot->getPosition()[1] . ' ) - Zanahoria' . "\n");
		}else{
			writeFile('Log', 'Mundo lleno! No se ha podido colocar la zanahoria' . "\n");
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
			writeFile('Log', 'Mundo lleno! No se ha podido colocar la madriguera' . "\n");
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
			writeFile('Log', 'Mundo lleno! No se ha podido colocar el árbol' . "\n");
		}
	}

	/**
	 * Dirección, aleatoria, hacia la que mira un elemento
	 *
	 * @return string Dirección
	 */
	function randLookTo(){
		return getLookTo()[rand(0, 3)];
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
	addSizeWorld();
	createWorld();

	for($i = 0; $i < $_POST['rabbit']; $i++) addRabbit();
	for($i = 0; $i < $_POST['wolf']; $i++) addWolf();
	for($i = 0; $i < $_POST['carrot']; $i++) addCarrot();
	for($i = 0; $i < $_POST['lair']; $i++) addLair();
	for($i = 0; $i < $_POST['tree']; $i++) addTree();

	writeWorld();

	for($i = 0; $i < $_POST['rabbit']; $i++) addRabbit();
	for($i = 0; $i < $_POST['wolf']; $i++) addWolf();
	for($i = 0; $i < $_POST['carrot']; $i++) addCarrot();
	for($i = 0; $i < $_POST['lair']; $i++) addLair();
	for($i = 0; $i < $_POST['tree']; $i++) addTree();
		
	writeWorld();

	$memory = memory_get_usage(true);
    $timeFinish = microtime(true);
	
	session_start();

	$_SESSION['row'] = getSizeWorld()['row'];
	$_SESSION['col'] = getSizeWorld()['col'];
	$_SESSION['memory'] = $memory / 1024 / 1024;
	$_SESSION['time'] = bcsub($timeFinish, $timeStart, 2);

	session_write_close();

	header('Location: ../View/output.php');
?>