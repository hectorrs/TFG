/**
 * Load the charts used below
 */
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
google.charts.setOnLoadCallback(drawChartBornWolf);

/**
 * It draws the chart 'weather'
 */
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

/**
 * It draws the chart 'all population'
 */
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
            title: 'Ciclos',
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

/**
 * It draws the chart 'population of rabbits'
 */
function drawChartPopulationRabbit(){
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Conejos');

    for(i = 0; i < amountRabbit.length; i++){
        data.addRows([[i, amountRabbit[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Ciclos'
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

/**
 * It draws the chart 'population of wolfs'
 */
function drawChartPopulationWolf(){
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Lobos');

    for(i = 0; i < amountWolf.length; i++){
        data.addRows([[i, amountWolf[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Ciclos'
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

/**
 * It draws the chart 'population of carrots'
 */
function drawChartPopulationCarrot(){
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Zanahorias');

    for(i = 0; i < amountCarrot.length; i++){
        data.addRows([[i, amountCarrot[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Ciclos'
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

/**
 * It draws the chart 'hunted rabbits'
 */
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
            title: 'Ciclos',
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

/**
 * It draws the chart 'eaten carrots'
 */
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
            title: 'Ciclos',
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

/**
 * It draws the chart 'dead rabbits and wolves for not eating'
 */
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
            title: 'Ciclos',
            viewWindow: {min:0, max:100}
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
            options.hAxis.viewWindow.max = deadEatRabbit.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();

    chart.draw(data, options);
}

/**
 * It draws the chart 'dead rabbits and wolves for not sleeping'
 */
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
            title: 'Ciclos',
            viewWindow: {min:0, max:100}
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
            options.hAxis.viewWindow.max = deadSleepRabbit.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();

    chart.draw(data, options);
}

/**
 * It draws the chart 'born rabbits'
 */
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
            title: 'Ciclos',
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

/**
 * It draws the chart 'born wolves'
 */
function drawChartBornWolf(){
    var chart = new google.visualization.LineChart(document.getElementById('chartBornWolf'));
    
    var data = new google.visualization.DataTable();

    data.addColumn('number', 'X');
    data.addColumn('number', 'Lobos');

    for(i = 0; i < bornWolf.length; i++){
        data.addRows([[i, bornWolf[i]]]);
    }

    var options = {
        hAxis: {
            title: 'Ciclos',
            viewWindow: {min:0, max:100}
        },
        vAxis: {
            title: 'Cantidad'
        },
        legend: {position: 'top'},
        backgroundColor: '#f1f8e9',
        colors: ['#F2B50F']
    };

    var prevButton = document.getElementById('prevBornWolf');
    var nextButton = document.getElementById('nextBornWolf');
    var changeZoomButton = document.getElementById('zoomBornWolf');

    function drawChart(){
        // Disabling the button while the chart is drawing.
        prevButton.disabled = true;
        nextButton.disabled = true;
        changeZoomButton.disabled = true;

        google.visualization.events.addListener(chart, 'ready', function(){
            prevButton.disabled = options.hAxis.viewWindow.min <= 0;
            nextButton.disabled = options.hAxis.viewWindow.max >= bornWolf.length - 1;
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
            options.hAxis.viewWindow.max = bornWolf.length - 1;
        }
        zoomed = !zoomed;

        drawChart();
    }

    drawChart();

    chart.draw(data, options);
}