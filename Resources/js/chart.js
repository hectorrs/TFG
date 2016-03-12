google.charts.load('current', {'packages': ['corechart', 'line']});

google.charts.setOnLoadCallback(drawChartWeather);
google.charts.setOnLoadCallback(drawChartPopulation);
google.charts.setOnLoadCallback(drawChartPopulationRabbit);
google.charts.setOnLoadCallback(drawChartPopulationWolf);
google.charts.setOnLoadCallback(drawChartPopulationCarrot);
google.charts.setOnLoadCallback(drawChartHuntedRabbit);
google.charts.setOnLoadCallback(drawChartCarrotEaten);
google.charts.setOnLoadCallback(drawChartDeadEat);
google.charts.setOnLoadCallback(drawChartDeadSleep);
google.charts.setOnLoadCallback(drawChartBornRabbit);

/* Tiempo atmosférico */
function drawChartWeather(){
    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Soleado', weather[0]],
        ['Lluvioso', weather[1]],
        ['Con viento', weather[2]],
        ['Con niebla', weather[3]]
    ]);

    var options = {
        title: 'Tiempo atmosférico',
        backgroundColor: '#f1f8e9',
        is3D: true,
        pieSliceText: 'value',
        legend: 'left'
    };

    var chart = new google.visualization.PieChart(document.getElementById('chartWeather'));

    chart.draw(data, options);
}

/* Población total */
function drawChartPopulation(){
    var chart = new google.visualization.LineChart(document.getElementById('chartPopulation'));

    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Conejos');
    data.addColumn('number', 'Lobos');
    data.addColumn('number', 'Zanahorias');

    for(i = 0; i < amountCarrot.length; i++){
        data.addRows([[i, amountRabbit[i], amountWolf[i], amountCarrot[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días',
            viewWindow: {min:0, max:100}
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#0266C8', '#F90101', '#F2B50F']
    };

    var prevButton = document.getElementById('prevPopulation');
    var nextButton = document.getElementById('nextPopulation');
    var changeZoomButton = document.getElementById('zoomPopulation');

    function drawChart(){
        // Disabling the button while the chart is drawing.
        prevButton.disabled = true;
        nextButton.disabled = true;
        changeZoomButton.disabled = true;

        google.visualization.events.addListener(chart, 'ready', function(){
            prevButton.disabled = options.hAxis.viewWindow.min <= 0;
            nextButton.disabled = options.hAxis.viewWindow.max >= amountRabbit.length - 1;
            changeZoomButton.disabled = false;
        });

        chart.draw(data, options);
    }

    prevButton.onclick = function(){
        options.hAxis.viewWindow.min -= 100;
        options.hAxis.viewWindow.max -= 100;

        drawChart();
    }

    nextButton.onclick = function(){
        options.hAxis.viewWindow.min += 100;
        options.hAxis.viewWindow.max += 100;

        drawChart();
    }

    var zoomed = false;
    changeZoomButton.onclick = function(){
        if(zoomed){
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = 100;
        }else{
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = amountRabbit.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();
}

/* Población de conejos */
function drawChartPopulationRabbit(){
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Conejos');

    for(i = 0; i < amountRabbit.length; i++){
        data.addRows([[i, amountRabbit[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días'
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#0266C8']
    };

    var chart = new google.visualization.LineChart(document.getElementById('chartPopulationRabbit'));

    chart.draw(data, options);
}

/* Población de lobos */
function drawChartPopulationWolf(){
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Lobos');

    for(i = 0; i < amountWolf.length; i++){
        data.addRows([[i, amountWolf[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días'
        },
        vAxis: {
            title: 'Cantidad'
        },
        backgroundColor: '#f1f8e9',
        legend: {position: 'top'},
        colors: ['#F90101']
    };

    var chart = new google.visualization.LineChart(document.getElementById('chartPopulationWolf'));

    chart.draw(data, options);
}

/* Población de zanahorias */
function drawChartPopulationCarrot(){
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Zanahorias');

    for(i = 0; i < amountCarrot.length; i++){
        data.addRows([[i, amountCarrot[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días'
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#F2B50F']
    };

    var chart = new google.visualization.LineChart(document.getElementById('chartPopulationCarrot'));

    chart.draw(data, options);
}

// Conejos cazados
function drawChartHuntedRabbit(){
    var chart = new google.visualization.LineChart(document.getElementById('chartHuntedRabbit'));
    
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Conejos');

    for(i = 0; i < huntedRabbit.length; i++){
        data.addRows([[i + 1, huntedRabbit[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días',
            viewWindow: {min:0, max:100}
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#F2B50F']
    };

    var prevButton = document.getElementById('prevHuntedRabbit');
    var nextButton = document.getElementById('nextHuntedRabbit');
    var changeZoomButton = document.getElementById('zoomHuntedRabbit');

    function drawChart(){
        // Disabling the button while the chart is drawing.
        prevButton.disabled = true;
        nextButton.disabled = true;
        changeZoomButton.disabled = true;

        google.visualization.events.addListener(chart, 'ready', function(){
            prevButton.disabled = options.hAxis.viewWindow.min <= 0;
            nextButton.disabled = options.hAxis.viewWindow.max >= huntedRabbit.length - 1;
            changeZoomButton.disabled = false;
        });

        chart.draw(data, options);
    }

    prevButton.onclick = function(){
        options.hAxis.viewWindow.min -= 100;
        options.hAxis.viewWindow.max -= 100;

        drawChart();
    }

    nextButton.onclick = function(){
        options.hAxis.viewWindow.min += 100;
        options.hAxis.viewWindow.max += 100;

        drawChart();
    }

    var zoomed = false;
    changeZoomButton.onclick = function(){
        if(zoomed){
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = 100;
        }else{
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = huntedRabbit.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();

    chart.draw(data, options);
}

// Zanahorias comidas
function drawChartCarrotEaten(){
    var chart = new google.visualization.LineChart(document.getElementById('chartCarrotEaten'));
    
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Zanahorias');

    for(i = 0; i < eatenCarrot.length; i++){
        data.addRows([[i, eatenCarrot[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días',
            viewWindow: {min:0, max:100}
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#F2B50F']
    };

    var prevButton = document.getElementById('prevEatenCarrot');
    var nextButton = document.getElementById('nextEatenCarrot');
    var changeZoomButton = document.getElementById('zoomEatenCarrot');

    function drawChart(){
        // Disabling the button while the chart is drawing.
        prevButton.disabled = true;
        nextButton.disabled = true;
        changeZoomButton.disabled = true;

        google.visualization.events.addListener(chart, 'ready', function(){
            prevButton.disabled = options.hAxis.viewWindow.min <= 0;
            nextButton.disabled = options.hAxis.viewWindow.max >= eatenCarrot.length - 1;
            changeZoomButton.disabled = false;
        });

        chart.draw(data, options);
    }

    prevButton.onclick = function(){
        options.hAxis.viewWindow.min -= 100;
        options.hAxis.viewWindow.max -= 100;

        drawChart();
    }

    nextButton.onclick = function(){
        options.hAxis.viewWindow.min += 100;
        options.hAxis.viewWindow.max += 100;

        drawChart();
    }

    var zoomed = false;
    changeZoomButton.onclick = function(){
        if(zoomed){
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = 100;
        }else{
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = eatenCarrot.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();

    chart.draw(data, options);
}

// Conejos y lobos muertos por no comer
function drawChartDeadEat(){
    var chart = new google.visualization.LineChart(document.getElementById('chartDeadEat'));
    
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Conejos');
    data.addColumn('number', 'Lobos');

    for(i = 0; i < deadEatRabbit.length; i++){
        data.addRows([[i, deadEatRabbit[i], deadEatWolf[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días',
            viewWindow: {min:0, max:10}
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#F2B50F', '#F90101']
    };

    var prevButton = document.getElementById('prevDeadEat');
    var nextButton = document.getElementById('nextDeadEat');
    var changeZoomButton = document.getElementById('zoomDeadEat');

    function drawChart(){
        // Disabling the button while the chart is drawing.
        prevButton.disabled = true;
        nextButton.disabled = true;
        changeZoomButton.disabled = true;

        google.visualization.events.addListener(chart, 'ready', function(){
            prevButton.disabled = options.hAxis.viewWindow.min <= 0;
            nextButton.disabled = options.hAxis.viewWindow.max >= deadEatRabbit.length - 1;
            changeZoomButton.disabled = false;
        });

        chart.draw(data, options);
    }

    prevButton.onclick = function(){
        options.hAxis.viewWindow.min -= 10;
        options.hAxis.viewWindow.max -= 10;

        drawChart();
    }

    nextButton.onclick = function(){
        options.hAxis.viewWindow.min += 10;
        options.hAxis.viewWindow.max += 10;

        drawChart();
    }

    var zoomed = false;
    changeZoomButton.onclick = function(){
        if(zoomed){
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = 10;
        }else{
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = deadEatRabbit.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();

    chart.draw(data, options);
}

// Conejos y lobos muertos por no comer
function drawChartDeadSleep(){
    var chart = new google.visualization.LineChart(document.getElementById('chartDeadSleep'));
    
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Conejos');
    data.addColumn('number', 'Lobos');

    for(i = 0; i < deadSleepRabbit.length; i++){
        data.addRows([[i, deadSleepRabbit[i], deadSleepWolf[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días',
            viewWindow: {min:0, max:10}
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#F2B50F', '#F90101']
    };

    var prevButton = document.getElementById('prevDeadSleep');
    var nextButton = document.getElementById('nextDeadSleep');
    var changeZoomButton = document.getElementById('zoomDeadSleep');

    function drawChart(){
        // Disabling the button while the chart is drawing.
        prevButton.disabled = true;
        nextButton.disabled = true;
        changeZoomButton.disabled = true;

        google.visualization.events.addListener(chart, 'ready', function(){
            prevButton.disabled = options.hAxis.viewWindow.min <= 0;
            nextButton.disabled = options.hAxis.viewWindow.max >= deadSleepRabbit.length - 1;
            changeZoomButton.disabled = false;
        });

        chart.draw(data, options);
    }

    prevButton.onclick = function(){
        options.hAxis.viewWindow.min -= 10;
        options.hAxis.viewWindow.max -= 10;

        drawChart();
    }

    nextButton.onclick = function(){
        options.hAxis.viewWindow.min += 10;
        options.hAxis.viewWindow.max += 10;

        drawChart();
    }

    var zoomed = false;
    changeZoomButton.onclick = function(){
        if(zoomed){
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = 10;
        }else{
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = deadSleepRabbit.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();

    chart.draw(data, options);
}

// Conejos y lobos muertos por no comer
function drawChartBornRabbit(){
    var chart = new google.visualization.LineChart(document.getElementById('chartBornRabbit'));
    
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Conejos');

    for(i = 0; i < bornRabbit.length; i++){
        data.addRows([[i, bornRabbit[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Días',
            viewWindow: {min:0, max:100}
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#F2B50F']
    };

    var prevButton = document.getElementById('prevBornRabbit');
    var nextButton = document.getElementById('nextBornRabbit');
    var changeZoomButton = document.getElementById('zoomBornRabbit');

    function drawChart(){
        // Disabling the button while the chart is drawing.
        prevButton.disabled = true;
        nextButton.disabled = true;
        changeZoomButton.disabled = true;

        google.visualization.events.addListener(chart, 'ready', function(){
            prevButton.disabled = options.hAxis.viewWindow.min <= 0;
            nextButton.disabled = options.hAxis.viewWindow.max >= bornRabbit.length - 1;
            changeZoomButton.disabled = false;
        });

        chart.draw(data, options);
    }

    prevButton.onclick = function(){
        options.hAxis.viewWindow.min -= 100;
        options.hAxis.viewWindow.max -= 100;

        drawChart();
    }

    nextButton.onclick = function(){
        options.hAxis.viewWindow.min += 100;
        options.hAxis.viewWindow.max += 100;

        drawChart();
    }

    var zoomed = false;
    changeZoomButton.onclick = function(){
        if(zoomed){
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = 100;
        }else{
            options.hAxis.viewWindow.min = 0;
            options.hAxis.viewWindow.max = bornRabbit.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();

    chart.draw(data, options);
}