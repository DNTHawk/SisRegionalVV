<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Grafico Chart</title>
</head>
<body>
    <canvas class="line-chart"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    <script>
        var ctx = document.getElementsByClassName("line-chart");

        //Type, Data e options
        var chartGraph = new Chart(ctx, {
            type: 'line';
        });

    </script>

</body>
</html>