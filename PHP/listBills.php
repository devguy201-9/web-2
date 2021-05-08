<?php
    $statusBills = $_GET["status"];
    $monthBills = $_GET["month"];
    $yearBills = $_GET["year"];
    $res = "";
    require_once('../utils/connect_db.php');	
    ['findBillsByMonthAndYearAndStatus' => $Bills] = require '../Entities/bill.php';
    $data = $Bills($conn,$monthBills,$yearBills,$statusBills);
    require_once('../utils/close_db.php');
    for($i=0;$i<count($data);$i++) {
        $price = intval($data[$i]['ThanhTien']);
        $price1 =  number_format($price, 0, '', '.');
        $status = "";
        if($data[$i]['TinhTrang'] == 0) {
            $status = "Has n't been settled";
        } else if($data[$i]['TinhTrang'] == 1){
            $status = "Has been settled";
        } else {
            $status = "Has been shipped";
        }
        $res = $res."<tr><td style=\"width: 85px;\">".$data[$i]['MaHD']."</td><td style=\"width: 85px;\">".$data[$i]['MaKH']."</td><td>".$status."</td><td>".$data[$i]['NGAYXUAT']."</td><td>".$price1." VND</td><td><button data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"infoBill(".$data[$i]['MaHD'].")\" style=\"margin-left:30px;\" class=\"btn btn-sm btn-info btn-info\" data-toggle=\"tooltip\" title=\"Info\"><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i></button>
                <button onclick=\"editBill(".$data[$i]['MaHD'].",".$data[$i]['TinhTrang'].")\" style=\"margin-left:1px;\" class=\"btn btn-sm btn-primary btn-edit\" data-toggle=\"tooltip\" title=\"Update\"><i class=\"fa fa-level-up\" aria-hidden=\"true\"></i></button>
                <button onclick=\"deleteBill(".$data[$i]['MaHD'].")\" style=\"margin-left:1px;\" class=\"btn btn-sm btn-danger btn-delete\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
                </td></tr>";
    }
    if(count($data) == 0) {
        $res = $res."<tr style=\"border: 1px solid orange;\"><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td><td style=\"border: 0px; width: 100%;\">No data was found !</td><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td></tr>";
    }
    echo $res;
?>