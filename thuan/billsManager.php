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
        //day du lieu vo code html de trinh bay (du lieu bao gom chitiethd,ten va gia sp) $data['MaHD'] va $data['chitiethd'][$i]['Ten'] 
        //$data['chitiethd'][$i]['GiaBan'] $data['chitiethd'][$i]['MaSP']
        // $res = $res."mahd = ".$data['MaHD']."<br>makh = ".$data['MaKH']."<br>ngayxuat = ".$data['NGAYXUAT']."<br>tinhtrang = ".$data['TinhTrang']."<br>thanhtien = ".$data['ThanhTien'];
        print_r($data);
    }
    require_once('../utils/close_db.php');
    echo $res;
?>