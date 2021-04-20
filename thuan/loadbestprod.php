<?php
    require_once('../utils/connect_db.php');	
    ['findAllProductsNumb' => $arrayNumb] = require '../Entities/product.php';
    $dataNumb = $arrayNumb($conn,8);
    require_once('../utils/close_db.php');
    $products = "<h2 class=\"title\">Best sellers</h2><div class=\"row2\" id=\"bestSeller\">";
    $temp = "";
    $i = 0;
    
    foreach ($dataNumb as $values) {
        $price = intval($dataNumb[$i]['GiaBan']);
        $price1 =  number_format($price, 0, '', '.');
        $temp = $temp.'<div class="col4" id="'.$dataNumb[$i]['MaSP'].'">'.'<img src="'.$dataNumb[$i]['Hinh'].'"><h4>'.$dataNumb[$i]['Ten'].'</h4><p>'.$price1.' VND'
        .'</p><a class="DetailBtn" href="detailProduct.php?idProduct='.$dataNumb[$i]['MaSP'].'" style="text-decoration: none;">Details</a></div>';
        if ($i + 1 != 0 && ($i + 1)%4 == 0 || $i == count($dataNumb)-1)
        {
            $products = $products.'<div class="row2" margin-top: 0%; margin-bottom: 2%;">'.$temp.'</div>';
            $temp = '';
        }
        if ($i == 3) {
            $products = $products."</div><h2 class=\"title\">News arrivals</h2>
            <div class=\"row2\" id=\"newArrival\">";
        }
        $i++;
    }
    echo $products."</div>";
?>