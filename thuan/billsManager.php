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
            $status = "Chua xu ly";
        } else {
            $status = "Da xu ly";
        }
        $res = $res."<tr><td style=\"width: 75px;\">".$data[$i]['MaHD']."</td><td style=\"width: 75px;\">".$data[$i]['MaKH']."</td><td>".$status."</td><td>".$data[$i]['NGAYXUAT']."</td><td>".$price1." VND</td><td><button onclick=\"infoBill()\" style=\"margin-left:30px;\" class=\"btn btn-sm btn-info btn-info\" data-toggle=\"tooltip\" title=\"Info\"><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i></button>
                <button onclick=\"editBill()\" style=\"margin-left:1px;\" class=\"btn btn-sm btn-primary btn-edit\" data-toggle=\"tooltip\" title=\"Update\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button>
                <button onclick=\"deleteBill()\" style=\"margin-left:1px;\" class=\"btn btn-sm btn-danger btn-delete\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
                </td></tr>";
    }
    if(count($data) == 0) {
        $res = $res."<tr style=\"border: 1px solid orange;\"><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td><td style=\"border: 0px; width: 100%;\">Khong co du lieu nao duoc tim thay !</td><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td></tr>";
    }
    echo($res);
?>