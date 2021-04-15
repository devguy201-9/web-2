<?php
    require_once('../utils/connect_db.php');	
    ['findBillsByMOrY' => $Bills] = require '../Entities/bill.php';
    $data = $Bills($conn,11,'M');
    require_once('../utils/close_db.php');
    print_r($data);
?>