function world(){
	var world = document.getElementById('world');
	var element = document.getElementById('element');

	if(element.style.display == 'block')
		element.style.display = 'none';

	world.style.display = 'block';
}

function element(){
	var world = document.getElementById('world');
	var element = document.getElementById('element');

	if(world.style.display == 'block')
		world.style.display = 'none';

	element.style.display = 'block';
}

function execution(){
	var execution = document.getElementById('execution');
	var weather = document.getElementById('weather');
	var elements = document.getElementById('elements');
	var restriction = document.getElementById('restriction');

	if(weather.style.display == 'block' || elements.style.display == 'block' || restriction.style.display == 'block'){
		weather.style.display = 'none';
		elements.style.display = 'none';
		restriction.style.display = 'none';
	}

	execution.style.display = 'block';
}

function weatherTime(){
	var execution = document.getElementById('execution');
	var weather = document.getElementById('weather');
	var elements = document.getElementById('elements');
	var restriction = document.getElementById('restriction');

	if(execution.style.display == 'block' || elements.style.display == 'block' || restriction.style.display == 'block'){
		execution.style.display = 'none';
		elements.style.display = 'none';
		restriction.style.display = 'none';
	}

	weather.style.display = 'block';
}

function amountElement(){
	var execution = document.getElementById('execution');
	var weather = document.getElementById('weather');
	var elements = document.getElementById('elements');
	var restriction = document.getElementById('restriction');

	if(execution.style.display == 'block' || weather.style.display == 'block' || restriction.style.display == 'block'){
		execution.style.display = 'none';
		weather.style.display = 'none';
		restriction.style.display = 'none';
	}

	elements.style.display = 'block';
}

function restriction(){
	var execution = document.getElementById('execution');
	var weather = document.getElementById('weather');
	var elements = document.getElementById('elements');
	var restriction = document.getElementById('restriction');

	if(execution.style.display == 'block' || elements.style.display == 'block' || weather.style.display == 'block'){
		execution.style.display = 'none';
		elements.style.display = 'none';
		weather.style.display = 'none';
	}

	restriction.style.display = 'block';
}

function turns(){
	var turn = document.getElementById('turn');
	var action = document.getElementById('action');
	var range = document.getElementById('range');

	if(action.style.display == 'block' || action.style.display == 'block' || range.style.display == 'block'){
		action.style.display = 'none';
		range.style.display = 'none';
	}

	turn.style.display = 'block';
}

function actions(){
	var turn = document.getElementById('turn');
	var action = document.getElementById('action');
	var range = document.getElementById('range');

	if(turn.style.display == 'block' || action.style.display == 'block' || range.style.display == 'block'){
		turn.style.display = 'none';
		range.style.display = 'none';
	}

	action.style.display = 'block';
}

function ranges(){
	var turn = document.getElementById('turn');
	var action = document.getElementById('action');
	var range = document.getElementById('range');

	if(action.style.display == 'block' || action.style.display == 'block' || turn.style.display == 'block'){
		action.style.display = 'none';
		turn.style.display = 'none';
	}

	range.style.display = 'block';
}