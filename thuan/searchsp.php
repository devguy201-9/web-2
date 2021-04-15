<?php
    if (isset($_GET['txtSearch'])) {
        $inputSearch = $_GET['txtSearch'];
        $priceSearch = $_GET['priceValue'];
        $typeSearch = $_GET['typeId'];
        $typePrice = "";
        if ($priceSearch == '1') {
            $typePrice = ">=";
        }else if ($priceSearch == '2'){
            $typePrice = "<=";
        }
        require_once('../utils/connect_db.php');
        ['SearchProducts' => $array] = require '../Entities/product.php';
        $data = $array($conn,$inputSearch,$typePrice,1000000,$typeSearch);
        require_once('../utils/close_db.php');
        $products = "";
        $temp = "";
        
        for($i=0;$i<count($data);$i++) {
            $price = intval($data[$i]['GiaBan']);
            $price1 =  number_format($price, 0, '', '.');

            $temp = $temp.'<div class="col4" id="'.$data[$i]['MaSP'].'">'.'<img src="'.$data[$i]['Hinh'].'"><h4>'.$data[$i]['Ten'].'</h4><p>'.$price1.' VND'.'</p><button class="DetailBtn" id="'.$data[$i]['MaSP'].'"' . ' onclick="showProductDetail(this.id)">Details</button></div>';
            if ($i + 1 != 0 && ($i + 1)%4 == 0 || $i == count($data)-1)
            {
                $products = $products.'<div class="row2" style="margin-top: 10%;margin-bottom: -12%">'.$temp.'</div>';
                $temp = '';
            }
        }
        echo($products);
    }
?>