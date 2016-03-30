/**
 * Show the tab 'world' and hide the others
 */
function world(){
	document.getElementById('world').className = 'show';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = '> Mundo <';
	document.getElementById('elementBtn').value = 'Elementos';
	document.getElementById('restrictionBtn').value = 'Restricciones';
	document.getElementById('periodBtn').value = 'Ciclos';
	document.getElementById('actionBtn').value = 'Acciones';
	document.getElementById('rangeBtn').value = 'Rangos';
	document.getElementById('behaviourBtn').value = 'Comportamiento';
}

/**
 * Show the tab 'element' and hide the others
 */
function element(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'show';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = 'Mundo';
	document.getElementById('elementBtn').value = '> Elementos <';
	document.getElementById('restrictionBtn').value = 'Restricciones';
	document.getElementById('periodBtn').value = 'Ciclos';
	document.getElementById('actionBtn').value = 'Acciones';
	document.getElementById('rangeBtn').value = 'Rangos';
	document.getElementById('behaviourBtn').value = 'Comportamiento';
}

/**
 * Show the tab 'restriction' and hide the others
 */
function restriction(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'show';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = 'Mundo';
	document.getElementById('elementBtn').value = 'Elementos';
	document.getElementById('restrictionBtn').value = '> Restricciones <';
	document.getElementById('periodBtn').value = 'Ciclos';
	document.getElementById('actionBtn').value = 'Acciones';
	document.getElementById('rangeBtn').value = 'Rangos';
	document.getElementById('behaviourBtn').value = 'Comportamiento';
}

/**
 * Show the tab 'period' and hide the others
 */
function period(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'show';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = 'Mundo';
	document.getElementById('elementBtn').value = 'Elementos';
	document.getElementById('restrictionBtn').value = 'Restricciones';
	document.getElementById('periodBtn').value = '> Ciclos <';
	document.getElementById('actionBtn').value = 'Acciones';
	document.getElementById('rangeBtn').value = 'Rangos';
	document.getElementById('behaviourBtn').value = 'Comportamiento';
}

/**
 * Show the tab 'action' and hide the others
 */
function action(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'show';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = 'Mundo';
	document.getElementById('elementBtn').value = 'Elementos';
	document.getElementById('restrictionBtn').value = 'Restricciones';
	document.getElementById('periodBtn').value = 'Ciclos';
	document.getElementById('actionBtn').value = '> Acciones <';
	document.getElementById('rangeBtn').value = 'Rangos';
	document.getElementById('behaviourBtn').value = 'Comportamiento';
}

/**  
 * Show the tab 'range' and hide the others
 */
function range(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'show';
	document.getElementById('behaviour').className = 'hide';

	document.getElementById('worldBtn').value = 'Mundo';
	document.getElementById('elementBtn').value = 'Elementos';
	document.getElementById('restrictionBtn').value = 'Restricciones';
	document.getElementById('periodBtn').value = 'Ciclos';
	document.getElementById('actionBtn').value = 'Acciones';
	document.getElementById('rangeBtn').value = '> Rangos <';
	document.getElementById('behaviourBtn').value = 'Comportamiento';
}

/**
 * Show the tab 'behaviour' and hide the others
 */
function behaviour(){
	document.getElementById('world').className = 'hide';
	document.getElementById('element').className = 'hide';
	document.getElementById('restriction').className = 'hide';
	document.getElementById('period').className = 'hide';
	document.getElementById('action').className = 'hide';
	document.getElementById('range').className = 'hide';
	document.getElementById('behaviour').className = 'show';

	document.getElementById('worldBtn').value = 'Mundo';
	document.getElementById('elementBtn').value = 'Elementos';
	document.getElementById('restrictionBtn').value = 'Restricciones';
	document.getElementById('periodBtn').value = 'Ciclos';
	document.getElementById('actionBtn').value = 'Acciones';
	document.getElementById('rangeBtn').value = 'Rangos';
	document.getElementById('behaviourBtn').value = '> Comportamiento <';
}