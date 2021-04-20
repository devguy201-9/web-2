<?php
    $idBill = $_POST["idBill"];
    $typeActionBill = $_POST["typeActionBill"];
    $res = "";
    require_once('../utils/connect_db.php');	
    if($typeActionBill == "edit") {
        $statusBill = $_POST["statusBill"];
        ['updateBill' => $check] = require '../Entities/bill.php';
        $flag = $check($conn,$idBill,$statusBill);
        if(!$flag) {
            $res = $res."<script>document.getElementById('btnConfirm').style=\"display: none\";
            document.getElementById('message-confirm').style=\"color: red\";
            document.getElementById('message-confirm').innerHTML=\"Change status failed !\";
            document.getElementById('btnConfirmNo').innerHTML=\"Close\";</script>";
        } else {
            $res = $res."<script>document.getElementById('btnConfirm').style=\"display: none\";
            document.getElementById('message-confirm').style=\"color: green\";
            document.getElementById('message-confirm').innerHTML=\"Change status success !\";
            document.getElementById('btnConfirmNo').innerHTML=\"Close\";</script>";
        }        
    } else if($typeActionBill == "delete") {
        ['deleteBill' => $check] = require '../Entities/bill.php';
        $flag = $check($conn,$idBill);
        if(!$flag) {
            $res = $res."<script>document.getElementById('btnConfirm').style=\"display: none\";
            document.getElementById('message-confirm').style=\"color: red\";
            document.getElementById('message-confirm').innerHTML=\"Delete failed !\";
            document.getElementById('btnConfirmNo').innerHTML=\"Close\";</script>";
        } else {
            $res = $res."<script>document.getElementById('btnConfirm').style=\"display: none\";
            document.getElementById('message-confirm').style=\"color: red\";
            document.getElementById('message-confirm').innerHTML=\"Delete success !\";
            document.getElementById('btnConfirmNo').innerHTML=\"Close\";</script>";
        }       
    } else {
        ['findDetailBillByIdBill' => $bill] = require '../Entities/bill.php';
        $data = $bill($conn,$idBill);
        $res = $res."<table class=\"table table-striped\"><thead><tr><th>Name</th><th>Type name</th><th>Price</th><th>Amount</th><th>Total price</th></tr></thead><tbody>";
        for ($i=0; $i <count($data) ; $i++) { 
            $price = intval($data[$i]['GiaSP']);
            $price1 =  number_format($price, 0, '', '.');
            $totalPrice = intval($data[$i]['TongTien']);
            $totalPrice1 =  number_format($totalPrice, 0, '', '.');
            $res = $res."<tr><td>".$data[$i]['Ten']."</td><td>".$data[$i]['TenLoai']."</td><td>".$price1." VND</td><td>".$data[$i]['SoLuong']
            ."</td><td>".$totalPrice1." VND</td></tr>";
        }
        $res = $res."</tbody></table>";
    }
    require_once('../utils/close_db.php');
    echo $res;
?>