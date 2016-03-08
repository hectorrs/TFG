onload = function(){
	main = document.getElementById('time');
	update('begin');
}

function update(option){
	switch(option){
		case 'begin':
			time = 0;
			var current = data[time].split(';');
			current.pop();
			printWorld(current);
			main.innerHTML = '<div>Tiempo: ' + time + '</div>';
			break;
		case 'previous':
			if(time > 0){
				time--;
				var current = data[time].split(';');
				current.pop();
				printWorld(current);
				main.innerHTML = '<div>Tiempo: ' + time + '</div>';
			}
			break;
		case 'next':
			if(time < data.length - 2){
				time++;
				var current = data[time].split(';');
				current.pop();
				printWorld(current);
				main.innerHTML = '<div>Tiempo: ' + time + '</div>';
			}
			break;
		case 'end':
			time = data.length - 2;
			var current = data[time].split(';');
			current.pop();
			printWorld(current);
			main.innerHTML = '<div>Tiempo: ' + time + '</div>';
			break;
	}
}

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

function play(){
	if(time < data.length - 1){
		var current = data[time].split(";");
		current.pop();
		printWorld(current);
		main.innerHTML = '<div>Tiempo: ' + time + '</div>';
		time++;
	}else{
		pause();
	}
}

function pause(){
	clearInterval(transition);
}

function stop(){
	clearInterval(transition);
	time = 0;
	var current = data[time].split(";");
	current.pop();
	printWorld(current);
	main.innerHTML = '<div>Tiempo: ' + time + '</div>';
}