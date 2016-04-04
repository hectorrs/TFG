<?php
	require_once("element.php");

	/**
	 * Class Rabbit
	 *
	 * It represents an element Rabbit in the world
	 */
	class Rabbit extends Dynamic{
		/**
		 * It lets Rabbit to do an action
		 */
		public function act(){
			if(isset($_POST['codeRabbit'])){
				require('customRabbit.php');
			}else{
				require('rabbit.php');
			}
		}
	}

	/**
	 * Class Wolf
	 *
	 * It represents an element Wolf in the world
	 */
	class Wolf extends Dynamic{
		/**
		 * It lets Wolf to do an action
		 */
		public function act(){
			if(isset($_POST['codeWolf'])){
				require('customWolf.php');
			}else{
				require('wolf.php');
			}
		}
	}

	/**
	 * Class Carrot
	 *
	 * It represents an element Carrot in the world
	 */
	class Carrot extends Element{

	}

	/**
	 * Class Tree
	 *
	 * It represents an element Tree in the world
	 */
	class Tree extends Element{

	}

	/**
	 * Class Lair
	 *
	 * It represents an element Lair in the world
	 */
	class Lair extends Element{
		/**
		 * @var Rabbit|null Element Rabbit
		 */
		private $element;

		/**
		 * Constructor
		 */
		function __construct(){
			parent::__construct();
			$this->element = null;
		}

		/**
		 * It returns an element Rabbit which is in the lair
		 *
		 * @return Rabbit|null Element Rabbit
		 */
		public function getElement(){
			return $this->element;
		}

		/**
		 * It stores an element Rabbit
		 *
		 * @param Rabbit Element Rabbit
		 */
		public function saveElement($element){
			$this->element = $element;
		}

		/**
		 * It deletes an element Rabbit
		 */
		public function leaveElement(){
			$this->element = null;
		}
	}

	/**
	 * Class Ground
	 */
	class Ground{

	}
?>