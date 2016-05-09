<?php
	/**
	 * @global int ID of the element
	 */
	global $stock;
	$stock = 0;

	/**
	 * Class Element
	 *
	 * It represents an element in the world
	 */
	class Element{
		/**
		 * @var int Id of the element
		 */
		private $id;

		/**
		 * @var int[] Position of the element in the world
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
		 * It returns the ID of the element
		 *
		 * @return int ID of the element
		 */
		public function getId(){
			return $this->id;
		}

		/**
		 * It returns the position of the element in the world, both coordinates
		 *
		 * @return int[] Position
		 */
		public function getPosition(){
			return $this->position;
		}

		/**
		 * It updates the position of the element
		 *
		 * @param int[] New position
		 */
		public function setPosition($position){
			$this->position = $position;
		}
	}

	/**
	 * Class Dynamic
	 *
	 * It represents an dynamic element of type Element
	 */
	class Dynamic extends Element{
		/**
		 * @var int Actions per turn that an element can do
		 */
		private $actPerTurn;

		/**
		 * @var int Status 'eating' of the element. It is 0 if the element is not eating and more than 0 if it is eating |
		 * Turns that the rabbit has for finishing his meal
		 */
		private $eating;

		/**
		 * @var int Status 'eating' of the element. It is 0 if the element is not sleeping and more than 0 if it is sleeping |
		 * Turns that the rabbit has for stopping his sleep
		 */
		private $sleeping;

		/**
		 * @var bool|null Status 'hidden' of the element
		 */
		private $hidden;

		/**
		 * @var int Period since last time the element ate
		 */
		private $ateAgo;

		/**
		 * @var int Period since last time the element slept
		 */
		private $sleptAgo;

		/**
		 * @var int Period since last ime the element bred
		 */
		private $bredAgo;

		/*
		 * Constructor
		 */
		function __construct(){
			parent::__construct();
			$this->actPerTurn = 0;
			$this->eating = 0;
			$this->sleeping = 0;
			$this->hidden = null;
			$this->ateAgo = 0;
			$this->sleptAgo = 0;
			$this->bredAgo = 0;
			$data = array();
		}

		/**
		 * It returns the number of actions per turn allowed for the element
		 *
		 * @return int Actions
		 */
		public function getActPerTurn(){
			return $this->actPerTurn;
		}

		/**
		 * It returns the status 'eating' of the element. It is 0 if the element is not eating and more than 0 if it is eating |
		 * Turns that the rabbit has for finishing his meal
		 *
		 * @return int Status|Period
		 */
		public function getEating(){
			return $this->eating;
		}

		/**
		 * It returns the status 'sleeping' of the element. 0, if it is not sleeping; more than 0, in the opposite case |
		 * Period that he needs to finish sleeping
		 *
		 * @return int Status|Period
		 */
		public function getSleeping(){
			return $this->sleeping;
		}

		/**
		 * It returns the status 'hidden' of the element
		 *
		 * @return bool Status
		 */
		public function getHidden(){
			return $this->hidden;
		}

		/**
		 * It returns the period since last time the element ate
		 *
		 * @return int Period
		 */
		public function getAteAgo(){
			return $this->ateAgo;
		}

		/**
		 * It returns the period since last time the element slept
		 *
		 * @return int Period
		 */
		public function getSleptAgo(){
			return $this->sleptAgo;
		}

		/**
		 * It returns the period since last time the element breed
		 *
		 * @return int Period
		 */
		public function getBredAgo(){
			return $this->bredAgo;
		}

		/**
		 * It updates the number of actions per turn allowed for the element
		 *
		 * @param int Acciones
		 */
		public function setActPerTurn($actPerTurn){
			$this->actPerTurn = $actPerTurn;
		}

		/**
		 * It updates the status 'eating' of the element
		 *
		 * @param int Estado
		 */
		public function setEating($eating){
			$this->eating = $eating;
		}

		/**
		 * It updates the status 'sleeping' of the element
		 *
		 * @param int Estado
		 */
		public function setSleeping($sleeping){
			$this->sleeping = $sleeping;
		}

		/**
		 * It updates the status 'hidden' of the element
		 *
		 * @param bool Estado
		 */
		public function setHidden($hidden){
			$this->hidden = $hidden;
		}

		/**
		 * It updates the period since last time the element ate
		 *
		 * @param int Period
		 */
		public function setAteAgo($ateAgo){
			$this->ateAgo = $ateAgo;
		}

		/**
		 * It updates the period since last time the element slept
		 *
		 * @param int Period
		 */
		public function setSleptAgo($sleptAgo){
			$this->sleptAgo = $sleptAgo;
		}

		/**
		 * It updates the period since last time the element bred
		 *
		 * @param int Period
		 */
		public function setBredAgo($bredAgo){
			$this->bredAgo = $bredAgo;
		}
	}
?>