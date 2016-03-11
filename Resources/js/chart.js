google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

/* Tiempo atmosférico */
function drawChart() {
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