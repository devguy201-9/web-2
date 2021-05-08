<?php

    function returnState($state) 
    {
        if ($state == 0)
            return "Blocked";
        return "Normal";
    }
    
    require_once('../utils/connect_db.php');
    ['getNV' => $array] = require '../Entities/user.php';
    $data = $array($conn, $_GET['inputSearch']);

    ['getKH' => $array1] = require '../Entities/user.php';
    $data1 = $array1($conn, $_GET['inputSearch']);

    require_once('../utils/close_db.php');
    $products = "";
    $temp = "";        
    for($i=0;$i<count($data);$i++) {
        if ($data[$i]['MaCh'] == '1')
            $temp = $temp. '<div class="col4" style="border: 3px solid red; flex-basis:22%"><h4 style="font-size: 20px; margin-top:2%">'.$data[$i]['Ten'].'</h4><br><p style="margin-bottom: -10px">Address: '.$data[$i]['DiaChi'].'</p><br><p style="margin-bottom: -10px">Email: '.$data[$i]['Email'].'</p><br><p id="AccState'.$data[$i]['MaNV'].'">State: '.returnState($data[$i]['TinhTrang']).'</p>'.'<button id="nv'.$data[$i]['MaNV'].'"class="btn2" onclick="openForm3(this.id)" style="margin-left: 25%;" email="'.$data[$i]['Email'].'" name="'.$data[$i]['Ten'].'" address="'.$data[$i]['DiaChi'].'" mach="1" state="'.$data[$i]['TinhTrang'].'">Edit</button>'.'</div>';
        else 
            $temp = $temp. '<div class="col4" style="border: 3px solid yellow; flex-basis:22%"><h4 style="font-size: 20px; margin-top:2%">'.$data[$i]['Ten'].'</h4><br><p style="margin-bottom: -10px">Address: '.$data[$i]['DiaChi'].'</p><br><p style="margin-bottom: -10px">Email: '.$data[$i]['Email'].'</p><br><p id="AccState'.$data[$i]['MaNV'].'">State: '.returnState($data[$i]['TinhTrang']).'</p>'.'<button id="nv'.$data[$i]['MaNV'].'"class="btn2" onclick="openForm3(this.id)" style="margin-left: 25%;" email="'.$data[$i]['Email'].'" name="'.$data[$i]['Ten'].'" address="'.$data[$i]['DiaChi'].'" mach="2" state="'.$data[$i]['TinhTrang'].'">Edit</button>'.'</div>';
        if ($i + 1 != 0 && ($i + 1)%4 == 0 || $i == count($data)-1) {
            $products = $products.'<div class="row2">'.$temp.'</div>';
            $temp = "";
        }
    }

    for($i=0;$i<count($data1);$i++) {
        $temp = $temp. '<div class="col4" style="border: 3px solid #ff8c00; flex-basis:22%"><h4 style="font-size: 20px; margin-top:2%">'.$data1[$i]['Ten'].'</h4><br><p style="margin-top: -21px; margin-bottom: -10px">Phone number: '.$data1[$i]['SDT'].'</p><br><p style="margin-bottom: -10px">Address: '.$data1[$i]['DiaChi'].'</p><br><p style="margin-bottom: -10px">Email: '.$data1[$i]['Email'].'</p><br><p id="AccState'.$data1[$i]['MaKH'].'">State: '.returnState($data1[$i]['TinhTrang']).'</p>'.'<button id="kh'.$data1[$i]['MaKH'].'"class="btn2" onclick="openForm3(this.id)" style="margin-left: 25%;" state="'.$data1[$i]['TinhTrang'].'" email="'.$data1[$i]['Email'].'">Edit</button>'.'</div>';
        if ($i + 1 != 0 && ($i + 1)%4 == 0 || $i == count($data1)-1) {
            $products = $products.'<div class="row2">'.$temp.'</div>';
            $temp = "";
        }

    }
    echo $products;

?>

