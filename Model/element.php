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
			$this->position = null;
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
		 * @var int Estado 'comiendo' del elemento. 0, si no está comiendo; > 0, en caso contrario | Turnos que le quedan al elemento para terminar de comer
		 */
		private $eating;

		/**
		 * @var int Estado 'durmiendo' del elemento. 0, si no está durmiendo; > 0, en caso contrario | Turnos que le quedan al elemento para terminar de dormir
		 */
		private $sleeping;

		/**
		 * @var bool|null Estado 'escondido' del elemento
		 */
		private $hidden;

		/**
		 * @var int Días sin comer
		 */
		private $daysWithoutEat;

		/**
		 * @var int Días sin dormir
		 */
		private $daysWithoutSleep;

		/**
		 * @var bool Estado 'ha comido durante el día' del elemento
		 */
		private $hasEaten;

		/*
		 * Constructor
		 */
		function __construct(){
			parent::__construct();
			$this->actPerTurn = 0;
			$this->eating = 0;
			$this->sleeping = 0;
			$this->hidden = null;
			$this->daysWithoutEat = 0;
			$this->daysWithoutSleep = 0;
			$this->hasEaten = false;
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
		 * Devuelve el estado 'comiendo' del elemento. 0, si no está comiendo; > 0, en caso contrario | Turnos que le quedan al elemento para terminar de comer
		 *
		 * @return int Estado|Turnos
		 */
		public function getEating(){
			return $this->eating;
		}

		/**
		 * Devuelve el estado 'durmiendo' del elemento. 0, si no está durmiendo; > 0, en caso contrario | Turnos que le quedan al elemento para terminar de dormir
		 *
		 * @return int Estado|Turnos
		 */
		public function getSleeping(){
			return $this->sleeping;
		}

		/**
		 * Devuelve el estado 'escondido' del elemento
		 *
		 * @return bool Estado
		 */
		public function getHidden(){
			return $this->hidden;
		}

		/**
		 * Devuelve el número de días que lleva sin comer el elemento
		 *
		 * @return int Días
		 */
		public function getDaysWithoutEat(){
			return $this->daysWithoutEat;
		}

		/**
		 * Devuelve el número de días que lleva sin dormir el elemento
		 *
		 * @return int Días
		 */
		public function getDaysWithoutSleep(){
			return $this->daysWithoutSleep;
		}

		/**
		 * Devuelve el estado 'ha comido durante el día' del elemento
		 *
		 * @return bool Estado
		 */
		public function getHasEaten(){
			return $this->hasEaten;
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
		 * Modifica el estado 'comiendo' del elemento
		 *
		 * @param int Estado
		 */
		public function setEating($eating){
			$this->eating = $eating;
		}

		/**
		 * Modifica el estado 'durmiendo' del elemento
		 *
		 * @param int Estado
		 */
		public function setSleeping($sleeping){
			$this->sleeping = $sleeping;
		}

		/**
		 * Modifica el estado 'escondido' del elemento
		 *
		 * @param bool Estado
		 */
		public function setHidden($hidden){
			$this->hidden = $hidden;
		}

		/**
		 * Modifica los días que lleva sin comer un elemento
		 *
		 * @param int Días
		 */
		public function setDaysWithoutEat($daysWithoutEat){
			$this->daysWithoutEat = $daysWithoutEat;
		}

		/**
		 * Modifica los días que lleva sin dormir un elemento
		 *
		 * @param int Días
		 */
		public function setDaysWithoutSleep($daysWithoutSleep){
			$this->daysWithoutSleep = $daysWithoutSleep;
		}

		/**
		 * Modifica el estado 'ha comido durante el día' del elemento
		 *
		 * @param bool Estado
		 */
		public function setHasEaten($hasEaten){
			$this->hasEaten = $hasEaten;
		}

	}
?>