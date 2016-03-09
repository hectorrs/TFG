<?php
	require_once("element.php");

	/**
	 * Class Rabbit
	 *
	 * Representa un elemento conejo en el mundo
	 */
	class Rabbit extends Dynamic{
		/**
		 * Realiza una acción del elemento
		 */
		public function act(){
			$see = actionManager($this, 'see');
			$smell = actionManager($this, 'smell');
			$hear = actionManager($this, 'hear');
			$move = array('up', 'down', 'left', 'right');
			actionManager($this, 'move', $move[rand(0, 3)]);
			//actionManager($this, 'sleep');
		}
	}

	/**
	 * Class Wolf
	 *
	 * Representa un elemento lobo en el mundo
	 */
	class Wolf extends Dynamic{
		/**
		 * Realiza una acción del elemento
		 */
		public function act(){
			$see = actionManager($this, 'see');
			$smell = actionManager($this, 'smell');
			$hear = actionManager($this, 'hear');
			$move = array('up', 'down', 'left', 'right');
			actionManager($this, 'move', $move[rand(0, 3)]);
			actionManager($this, 'sleep');
		}
	}

	/**
	 * Class Carrot
	 *
	 * Representa un elemento zanahoria en el mundo
	 */
	class Carrot extends Element{

	}

	/**
	 * Class Tree
	 *
	 * Representa un elemento árbol en el mundo
	 */
	class Tree extends Element{

	}

	/**
	 * Class Lair
	 *
	 * Representa un elemento madriguera en el mundo
	 */
	class Lair extends Element{
		/**
		 * @var Rabbit|null Elemento conejo
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
		 * Devuelve el elemento conejo contenido en la madriguera
		 *
		 * @return Rabbit|null Elemento conejo
		 */
		public function getElement(){
			return $this->element;
		}

		/**
		 * Almacena un elemento conejo
		 *
		 * @param Rabbit Elemento conejo
		 */
		public function saveElement($element){
			$this->element = $element;
		}

		/**
		 * Elimina un elemento conejo
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