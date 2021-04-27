<?php
    $typeProducts = $_GET["typeProducts"];
    $monthBills = $_GET["month"];
    $yearBills = $_GET["year"];

    require_once('../utils/connect_db.php');
    ['statisticProducts' => $statistic] = require '../Entities/detailbill.php';
    $data = $statistic($conn,$monthBills,$yearBills,12,$typeProducts);
    require_once('../utils/close_db.php');
    if(count($data) == 0){
        echo "<script>document.getElementById('result-statistic-product').innerHTML='No best selling products found !';</script>";
        return;
    }else {
        echo "<script>document.getElementById('result-statistic-product').innerHTML='<canvas id=\"myChart2\" width=\"500\" height=\"400\"></canvas>';</script>";
    }
    $dataName = "['";
    $dataNumber = "[";
    for ($i=0; $i <count($data) ; $i++) {
        $dataName = $dataName.$data[$i]['Ten']."','";
        $dataNumber = $dataNumber.$data[$i]['tongsoluong'].",";
    }
    $dataName = substr($dataName, 0, -2)."]; ";
    $dataNumber = substr($dataNumber, 0, -1)."]; ";
    $res = "<script> var labels2 = ".$dataName."
    var data2 = ".$dataNumber."
    var colors2 = []; 
    for (let i = 0; i < data2.length; i++) {
        colors2.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
    } 
    var myChart2 = document.getElementById('myChart2').getContext('2d'); 
    var chart2 = new Chart(myChart2, {
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