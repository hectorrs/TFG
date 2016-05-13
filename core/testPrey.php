<?php
	class Test{
		public $data;

		function __construct(){}
		
		function getPosition(){return array();}
		function getEating(){return boolean;}
		function getSleeping(){return boolean;}
		function getHidden(){return boolean;}
		function getAteAgo(){return int;}
		function sleptAgo(){return int;}
		function bredAgo(){return int;}

		function test(){
			function actionManager($obj, $action){return array();}
			function getTime(){return int;}
			function getWeather(){return string;}
			function getPeriodWithouEat($obj){return int;}
			function getPeriodWithouSleep($obj){return int;}
			function getPlaceToSleep(){return string;}
			function getBreedEach($obj){return int;}
			function getPeriodEat($obj){return int;}
			function getPeriodSated($obj){return int;}
			function getPeriodToSleep($obj){return int;}
			function getPeriodBright($obj){return int;}
			function getUsesPerCycle($obj){return int;}
			function getUsePerAction($obj, $action){return int;}
			function getRange($obj, $action){return int;}
			function getConfortZone($obj){return array();}

			require_once('../model/customRabbit.php');
		}
	}

	$test = new Test();
	$test->test();
?>