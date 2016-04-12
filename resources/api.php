<?php
	/**
	 * Devuelve la posición del elemento. En la primera posición del array, la coordenada X; en la segunda, la coordenada Y
	 *
	 * @return Array Posición
	 */
	$this->getPosition();

	/**
	 * Indica si el elemento está comiendo
	 *
	 * @return Boolean Estado 'comiendo'
	 */
	$this->getEating();

	/**
	 * Indica si el elemento está durmiendo
	 *
	 * @return Boolean Estado 'durmiendo'
	 */
	$this->getSleeping();

	/**
	 * Indica si el elemento Conejo está escondido en una madriguera
	 *
	 * @return Boolean Estado 'escondido'
	 */
	$this->getHidden();

	/**
	 * Devuelve el período de tiempo desde la última vez que comió
	 *
	 * @return Int Ciclos
	 */
	$this->getAteAgo();

	/**
	 * Devuelve el período de tiempo desde la última vez que durmió
	 *
	 * @return Int Ciclos
	 */
	$this->sleptAgo();

	/**
	 * Devuelve el período de tiempo desde la última vez que se ha reproducido
	 *
	 * @return Int Ciclos
	 */
	$this->bredAgo();

	/**
	 * Almacenamiento interno de información del elemento
	 */
	$this->data;

	/**
	 * Acción 'ver' del elemento
	 *
	 * @param Element Elemento
	 * @param String Acción
	 *
	 * @return Array Los elementos que ve con sus respectivas posiciones
	 */
	actionManager($this, 'see');

	/**
	 * Acción 'olfatear' del elemento
	 *
	 * @param Element Elemento
	 * @param String Acción
	 *
	 * @return Array Los elementos que olfatea
	 */
	actionManager($this, 'smell');

	/**
	 * Acción 'oir' del elemento
	 *
	 * @param Element Elemento
	 * @param String Acción
	 *
	 * @return Array Los elementos que escucha
	 */
	actionManager($this, 'hear');

	/**
	 * Acción 'mover' del elemento
	 *
	 * @param Element Elemento
	 * @param String Acción
	 * @param String Dirección ('up', 'down', 'left', 'right')
	 */
	actionManager($this, 'move', $direction)

	/**
	 * Acción 'dormir' del elemento
	 *
	 * @param Element Elemento
	 * @param String Acción
	 */
	actionManager($this, 'sleep');

	/**
	 * Acción 'reproducirse' del elemento
	 *
	 * @param Element Elemento
	 * @param String Acción
	 */
	actionManager($this, 'breed');

	/**
	 * Devuelve el instante de tiempo actual
	 *
	 * @return Int Ciclo
	 */
	getTime();

	/**
	 * Devuelve el tiempo atmosférico actual
	 *
	 * @return String Tiempo atmosférico
	 */
	getWeather();

	/**
	 * Devuelve los ciclos que puede pasar sin comer un elemento. Después de dichos ciclos, muere
	 *
	 * @param Element Elemento
	 *
	 * @return Int Ciclos
	 */
	getPeriodWithoutEat($this);

	/**
	 * Devuelve los ciclos que puede pasar sin dormir un elemento. Después de dichos ciclos, muere
	 *
	 * @param Element Elemento
	 *
	 * @return Int Ciclos
	 */
	getPeriodWithoutSleep($this);

	/**
	 * Devuelve el lugar dónde pueden dormir los conejos
	 *
	 * @return String Lugar
	 */
	getPlaceToSleep();

	/**
	 * Devuelve cada cúantos ciclos se puede reproducir un elemento
	 *
	 * @param Element Elemento
	 *
	 * @return Int Ciclos
	 */
	getBreedEach($this);

	/**
	 * Devuelve cuántos ciclos necesita un elemento para comer
	 *
	 * @param Element Elemento
	 *
	 * @return Int Ciclos
	 */
	getPeriodToEat($this);

	/**
	 * Devuelve durante cuántos ciclos un elemento está saciado
	 *
	 * @param Element Elemento
	 *
	 * @return Int Ciclos
	 */
	getPeriodSated($this);

	/**
	 * Devuelve cuántos ciclos necesita un elemento para dormir
	 *
	 * @param Element Elemento
	 *
	 * @return Int Ciclos
	 */
	getPeriodToSleep($this);

	/**
	 * Devuelve durante cuántos ciclos un elemento no tiene sueño
	 *
	 * @param Element Elemento
	 *
	 * @return Int Ciclos
	 */
	getPeriodBright($this);

	/**
	 * Devuelve cúantos puntos tiene un elemento para realizar acciones durante un turno
	 *
	 * @param Element Elemento
	 *
	 * @return Int Puntos
	 */
	getUsesPerCycle($this);

	/**
	 * Devuelve cúantos puntos consume la realización de una acción
	 *
	 * @param Element Elemento
	 * @param String Acción ('see', 'smell', 'hear', 'move', 'sleep', 'breed')
	 *
	 * @return Int Puntos
	 */
	getUsePerAction($this, $action);

	/**
	 * Devuelve el rango de una acción de un elemento
	 *
	 * @param Element Elemento
	 * @param String Acción ('see', 'smell', 'hear')
	 *
	 * @return Int Rango
	 */
	getRange($this, $action);

	/**
	 * Devuelve durante cúanto tiempo un elemento se encuentra en zona de confort. En la primera posición, cuántos ciclos después de comer; en la segunda, cúantos después de dormir
	 *
	 * @param Element Elemento
	 *
	 * @return Array Zona de confort
	 */
	getConfortZone($this);
?>