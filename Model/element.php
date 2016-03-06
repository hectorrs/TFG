<?php
	/**
	 * @global int Número autoincremental que da lugar al id del elemento
	 */
	global $stock;
	$stock = 0;
	
	/**
	 * Class Element
	 *
	 * Representa un elemento en el mundo
	 */
	class Element{
		/**
		 * @var int Id del elemento
		 */
		private $id;

		/**
		 * @var int[] Posición del elemento en el mundo
		 */
		private $position;

		/**
		 * Constructor
		 */
		public function __construct(){
			$this->id = $GLOBALS['stock']++;
		}

		/**
		 * Devuelve el id del elemento
		 *
		 * @return int Id del elemento
		 */
		public function getId(){
			return $this->id;
		}

		/**
		 * Devuelve la posición del elemento en el mundo
		 *
		 * @return int[] Posición
		 */
		public function getPosition(){
			return $this->position;
		}

		/**
		 * Modifica la posición del elemento
		 *
		 * @param int[] Nueva posición
		 */
		public function setPosition($position){
			$this->position = $position;
		}
	}

	/**
	 * Class Dynamic
	 *
	 * Representa un elemento dinámico de tipo elemento
	 */
	class Dynamic extends Element{
		/**
		 * @var int Acciones por turno que puede realizar un elemento
		 */
		private $actPerTurn;

		/**
		 * @var bool Estado "comiendo" del elemento
		 */
		private $eating;

		/**
		 * @var bool Estado "durmiendo" del elemento
		 */
		private $sleeping;

		/**
		 * @var bool|null Estado "escondido" del elemento
		 */
		private $hidden;

		/*
		 * Constructor
		 */
		function __construct(){
			parent::__construct();
			$this->actPerTurn = 0;
			$this->eating = false;
			$this->sleeping = false;
			$this->hidden = null;
		}

		/**
		 * Devuelve el número de acciones por turno permitidas para el elemento
		 *
		 * @return int Acciones
		 */
		public function getActPerTurn(){
			return $this->actPerTurn;
		}

		/**
		 * Devuelve el estado "comiendo" del elemento
		 *
		 * @return bool Estado
		 */
		public function getEating(){
			return $this->eating;
		}

		/**
		 * Devuelve el estado "durmiendo" del elemento
		 *
		 * @return bool Estado
		 */
		public function getSleeping(){
			return $this->sleeping;
		}

		/**
		 * Devuelve el estado "escondido" del elemento
		 *
		 * @return bool Estado
		 */
		public function getHidden(){
			return $this->hidden;
		}

		/**
		 * Modifica el número de acciones por turno del elemento
		 *
		 * @param int Acciones
		 */
		public function setActPerTurn($actPerTurn){
			$this->actPerTurn = $actPerTurn;
		}

		/**
		 * Modifica el estado "comiendo" del elemento
		 *
		 * @param bool Estado
		 */
		public function setEating($eating){
			$this->eating = $eating;
		}

		/**
		 * Modifica el estado "durmiendo" del elemento
		 *
		 * @param bool Estado
		 */
		public function setSleeping($sleeping){
			$this->sleeping = $sleeping;
		}

		/**
		 * Modifica el estado "escondido" del elemento
		 *
		 * @param bool Estado
		 */
		public function setHidden($hidden){
			$this->hidden = $hidden;
		}
	}
?>