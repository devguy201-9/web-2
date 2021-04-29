<?php
    if (isset($_GET['inputSearch'])) {
        require_once('../utils/connect_db.php');
        ['SearchProductsAdmin' => $array] = require '../Entities/product.php';
        $data = $array($conn,$_GET['inputSearch'],$_GET['kind']);
        require_once('../utils/close_db.php');
        $products = "";
        $temp = "";        
        for($i=0;$i<count($data);$i++) {
            $price = intval($data[$i]['GiaBan']);
            $price1 =  number_format($price, 0, '', '.');
            $temp = $temp . "<div class='col4' style=\"position: relative;\"> <img src=\"".$data[$i]['Hinh']."\"><h4 style=\"font-size: 20px;margin-top:2%;margin-bottom: 6%;\">".$data[$i]['Ten']."</h4><span style=\"margin-left: 5px; color: #FF8C00;position: absolute;top: 77%;right: 4%;font-size: 18px;\">Type: ".$data[$i]['TenLoai']."</span><p style=\"margin-top: -5px;margin-bottom: 5px;\">Price: "
            .$price1." VND</p><p style=\"margin-top: -2px;margin-bottom: 5px;\">Quantity in stock: ".$data[$i]['SoLuongTon']."</p><button class=\"btn2\" onclick=\"deleteProduct(".$data[$i]['MaSP'].")\">Delete</button><button class=\"btn2\" onclick=\"openFormEdit(".$data[$i]['MaSP'].")\">Edit</button></div>";
            if ($i + 1 != 0 && ($i + 1)%4 == 0 || $i == count($data)-1) {
                $products = $products.'<div class="row2">'.$temp.'</div>';
                $temp = "";
            }
        }
        echo $products;
    }
?>