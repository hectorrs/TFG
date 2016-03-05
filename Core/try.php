<?php
	require_once("../Model/element.php");
	require_once("../Model/elements.php");

	/*
		@var
		@global
		@param
		@return
	*/

	// Pruebas
	// Estáticos
	$lair = new Lair();
	$tree = new Tree();

	// Dinámicos
	$rabbit = new Rabbit();
	$wolf = new Wolf();

	// Premio
	$carrot = new Carrot();

	// Almacenamiento
	$static = array();
	$dynamic = array();
	$prize = array();

	var_dump($rabbit->getPosition());
	var_dump($rabbit->getActPerTurn());

	function prueba($param){
		return $param;
	}

	if(prueba(false)){
		echo 'True';
	}else echo 'False';

	/*$static[get_class($lair)."#".$lair->getId()] = $lair;
	$static[get_class($tree)."#".$tree->getId()] = $tree;

	$dynamic[get_class($rabbit)."#".$rabbit->getId()] = $rabbit;
	$dynamic[get_class($wolf)."#".$wolf->getId()] = $wolf;

	$prize[get_class($carrot)."#".$carrot->getId()] = $carrot;

	var_dump($static);
	var_dump($dynamic);
	var_dump($prize);

	foreach($static as $element){
		$element->who();
	}

	foreach($dynamic as $element){
		$element->act();
	}

	foreach($prize as $element){
		$element->who();
	}*/
?>