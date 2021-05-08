<?php
    $typeProduct = $_GET["typeProductBill"];
    $monthBills = $_GET["month"];
    $yearBills = $_GET["year"];
    $res = "";
    require_once('../utils/connect_db.php');
    ['statisticProducts' => $statistic] = require '../Entities/detailbill.php';
    $data = $statistic($conn,$monthBills,$yearBills,0,$typeProduct);
    require_once('../utils/close_db.php');
    for($i=0;$i<count($data);$i++) {
        $price = intval($data[$i]['tonggia']);
        $price1 =  number_format($price, 0, '', '.');
        $res = $res."<tr><td style=\"width: 105px;\">".$data[$i]['MaSP']."</td><td style=\"width: 105px;\">".$data[$i]['MaLoai']."</td><td>"
        .$data[$i]['Ten']."</td><td>".$data[$i]['TenLoai']."</td><td>".$data[$i]['tongsoluong']."</td><td>".$price1." VND</td></tr>";
    }
    if(count($data) == 0) {
        $res = $res."<tr style=\"border: 1px solid orange;\"><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td><td style=\"border: 0px; width: 100%;\">No data was found !</td><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td></tr>";
    }
    echo $res;
?>