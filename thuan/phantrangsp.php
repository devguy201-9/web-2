<?php
    require_once('../utils/connect_db.php');	
	$page = $_GET["page"];
	$maxPageItem = $_GET["maxPageItem"];
	settype ($page, "int");
	$from = ($page - 1) * $maxPageItem;
	['findAllProducts' => $array] = require '../Entities/product.php';
	$data = $array($conn,$from,$maxPageItem);
    require_once('../utils/close_db.php');
    $products = "";
    $temp = "";
    $i = 0;
    
    foreach ($data as $values) {
        $price = intval($data[$i]['GiaBan']);
        $price1 =  number_format($price, 0, '', '.');

        $temp = $temp.'<div class="col4" id="'.$data[$i]['MaSP'].'">'.'<img src="'.$data[$i]['Hinh'].'"><h4>'.$data[$i]['Ten'].'</h4><p>'.$price1.' VND'.'</p><button class="DetailBtn" id="'.$data[$i]['MaSP'].'"' . ' onclick="showProductDetail(this.id)">Details</button></div>';
        if ($i + 1 != 0 && ($i + 1)%4 == 0 || $i == count($data)-1)
        {
            $products = $products.'<div class="row2" style="margin-top: 10%;margin-bottom: -12%">'.$temp.'</div>';
            $temp = '';
        }
        $i++;
    }
    echo('<h2 class="title" style="margin-bottom:-90px">All products/page '.$page.'</h2>'.$products);
?>