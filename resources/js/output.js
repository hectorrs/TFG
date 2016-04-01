/**
 * var Language
 */
var language = location.search.substring(6);

/**
 * Show the first step of the world when the web page is loaded
 */
onload = function(){
	main = document.getElementById('time');
	update('begin');
	transition = null;
}

/**
 * It updates the state of the world when the buttons 'begin', 'previous', 'next' or 'end' are clicked
 *
 * @param {String}
 */
function update(option){
	switch(option){
		case 'begin':
			time = 0;
			var current = data[time].split(';');
			//var current = data[time].split('\n');
			current.pop();
			printWorld(current);
			main.innerHTML = '<h4><strong>' + translate('Current cycle', language) + ': ' + time + '</strong></h4>';
			break;
		case 'previous':
			if(time > 0){
				time--;
				var current = data[time].split(';');
				//var current = data[time].split('\n');
				current.pop();
				printWorld(current);
				main.innerHTML = '<h4><strong>' + translate('Current cycle', language) + ': ' + time + '</strong></h4>';
			}
			break;
		case 'next':
			if(time < data.length - 2){
				time++;
				var current = data[time].split(';');
				//var current = data[time].split('\n');
				current.pop();
				printWorld(current);
				main.innerHTML = '<h4><strong>' + translate('Current cycle', language) + ': ' + time + '</strong></h4>';
			}
			break;
		case 'end':
			time = data.length - 2;
			var current = data[time].split(';');
			//var current = data[time].split('\n');
			current.pop();
			printWorld(current);
			main.innerHTML = '<h4><strong>' + translate('Current cycle', language) + ': ' + time + '</strong></h4>';
			break;
		case 'goTo':
			var goTo = document.getElementById('goTo').value;
			document.getElementById('goTo').value = '';
			if((/^([0-9])*$/.test(goTo)) && goTo != ''){
				if(goTo < data.length - 1){
					time = goTo;
					var current = data[time].split(';');
					//var current = data[time].split('\n');
					current.pop();
					printWorld(current);
					main.innerHTML = '<h4><strong>' + translate('Current cycle', language) + ': ' + time + '</strong></h4>';
				}
			}
			break;
	}
}

/**
 * Draw the current step of the world
 *
 * @param {String}
 */
function printWorld(current){
	for(i = 0; i < row; i++){
		for(j = 0; j < col; j++){
			cell = document.getElementById('row' + i.toString() + 'col' + j.toString());
			cell.style.backgroundColor = 'green';
		}
	}

	for(x = 0; x < current.length; x++){
		position = current[x].split(':');
		cell = document.getElementById('row' + position[0].toString() + 'col' + position[1].toString());
		switch(position[2]){
			case 'R':
				cell.style.backgroundColor = 'blue';
				break;
			case 'W':
				cell.style.backgroundColor = 'red';
				break;
			case 'C':
				cell.style.backgroundColor = 'orange';
				break;
			case 'L':
				cell.style.backgroundColor = 'grey';
				break;
			case 'T':
				cell.style.backgroundColor = 'purple';
				break;
		}
	}
}

/**
 * It runs the display and show from the first step until the last step.
 * When it arrives the last step, it stops calling the method pause()
 */
function play(){
	if(time < data.length - 1){
		var current = data[time].split(";");
		//var current = data[time].split('\n');
		current.pop();
		printWorld(current);
		main.innerHTML = '<h4><strong>' + translate('Current cycle', language) + ': ' + time + '</strong></h4>';
		time++;
	}else{
		pause();
	}
}

/**
 * It pauses the display and keep the current step
 */
function pause(){
	if(transition != null){
		clearInterval(transition);
	}
}

/**
 * It stops the display and returns to the first step
 */
function stop(){
	if(transition != null){
		clearInterval(transition);
	}
	time = 0;
	var current = data[time].split(";");
	//var current = data[time].split('\n');
	current.pop();
	printWorld(current);
	main.innerHTML = '<h4><strong>' + translate('Current cycle', language) + ': ' + time + '</strong></h4>';
}