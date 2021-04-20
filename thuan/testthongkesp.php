<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>statistic chart product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <style>
        .chart {
            text-align: center;
            margin: auto;
        }
        .row-chart {
            margin-bottom: 150px;
        }
    </style>
</head>
<body>
<div class="row-chart">
    <div class="col-6 chart">
        <canvas id="myChart2" width="500" height="400"></canvas>
    </div>
</div>
<?php
    require_once('../utils/connect_db.php');
    ['statisticProducts' => $statistic] = require '../Entities/detailbill.php';
    $data = $statistic($conn,4,2021,12,0);
    require_once('../utils/close_db.php');
    $dataName = "['";
    $dataNumber = "[";
    for ($i=0; $i <count($data) ; $i++) {
        $dataName = $dataName.$data[$i]['Ten']."','";
        $dataNumber = $dataNumber.$data[$i]['tongsoluong'].",";
    }
    $dataName = substr($dataName, 0, -2)."];";
    $dataNumber = substr($dataNumber, 0, -1)."];";
    $res = "<script>
    let labels2 = ".$dataName."
    let data2 = ".$dataNumber."
    let colors2 = [];
    for (let i = 0; i < data2.length; i++) {
        colors2.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
    }
    let myChart2 = document.getElementById('myChart2').getContext('2d');
    let chart2 = new Chart(myChart2, {
        type: 'bar',
        data: {
            labels: labels2,
            datasets: [ {
                data: data2,
                backgroundColor: colors2
            }]
        },
        options: {
            title: {
                text: 'Hot-selling product statistics table',
                display: true
            },
            legend: {
            display: false
            }
        }
    });
    </script>";
    echo $res;
?>
</body>
</html>