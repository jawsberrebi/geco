google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

var xhr = new XMLHttpRequest();
xhr.open("POST", "backend/graphiques.php");
xhr.onload = function () {
    var phpGraphics = this.response;

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Dur�e', 'Fr�quence cardiaque'], console.log(phpGraphics)

        ]);

        var options = {
            title: 'Fr�quence cardiaque',
            //curveType: 'function',
            legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
}
xhr.send();

