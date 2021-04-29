<?php
    $res = "";
    require_once('../utils/connect_db.php');	
    if(isset($_POST["idProd"])){
        $idProd = $_POST["idProd"];
        $typeActionProd = $_POST["typeActionProd"];
        if($typeActionProd == "delete") {
            ['deleteProduct' => $check] = require '../Entities/product.php';
            $flag = $check($conn,$idProd);
            if(!$flag) {
                $res = $res."<script>document.getElementById('btnConfirm').style=\"display: none\";
                document.getElementById('message-confirm').style=\"color: red\";
                document.getElementById('message-confirm').innerHTML=\"Delete product failed !\";
                document.getElementById('btnConfirmNo').innerHTML=\"Close\"; searchProduct();</script>";
            } else {
                $res = $res."<script>document.getElementById('btnConfirm').style=\"display: none\";
                document.getElementById('message-confirm').style=\"color: green\";
                document.getElementById('message-confirm').innerHTML=\"Delete product success !\";
                document.getElementById('btnConfirmNo').innerHTML=\"Close\"; searchProduct();</script>";
            }
        } else if($typeActionProd == "findProd") {
            $selectType = "";
            ['findProductById' => $func] = require '../Entities/product.php';
            ['findAllTypes' => $arrayType] = require '../Entities/category.php';
            $product = $func($conn,$idProd);
            $types = $arrayType($conn);
            for($i=0;$i<count($types);$i++) {
                $selected = "";
                if($product['MaLoai'] == $types[$i]['MaLo']){
                    $selected = "selected";
                }
                $selectType = $selectType . "<option ".$selected." value=\"".$types[$i]['MaLo']."\">".$types[$i]['TenLoai']."</option>";
            }
            $res = $res . "<script> document.getElementById('addProductForm').style.top = \"15%\";document.getElementById('addProductForm').style.height = \"393px\";"
            ."document.getElementById('product-name').value='".$product['Ten']."';document.getElementById('product-price').value='".$product['GiaBan']."';document.getElementById('quantity-in-stock').value='"
            .$product['SoLuongTon']."';document.getElementById('updateType').innerHTML='".$selectType."';document.getElementById(\"idAddOrUpdateProd\").value = '".$product['MaSP']."'; searchProduct();</script>";
            //document.getElementById('product-image').value='".$product['Hinh']."';
        } else if($typeActionProd == "create") {
            $selectType = "";
            ['findAllTypes' => $arrayType] = require '../Entities/category.php';
            $types = $arrayType($conn);
            for($i=0;$i<count($types);$i++) {
                $selectType = $selectType . "<option value=\"".$types[$i]['MaLo']."\">".$types[$i]['TenLoai']."</option>";
            }
            $res = $res . "<script> document.getElementById('addProductForm').style.top = \"15%\";document.getElementById('addProductForm').style.height = \"393px\";
            document.getElementById('updateType').innerHTML='".$selectType."'; document.getElementById('title-AddOrUp').innerHTML=\"CREATE PRODUCT\";document.getElementById('btnAddOrUpdate').innerHTML=\"CREATE\"; ".
            " document.getElementById('product-name').value='';document.getElementById('product-price').value='';document.getElementById('quantity-in-stock').value='';document.getElementById(\"idAddOrUpdateProd\").value=''; </script>";
            //document.getElementById('product-image').value='';
        }
    }

    if(isset($_POST['idAddOrUpdateProd'])){
        $id = $_POST["idAddOrUpdateProd"];
        $name = $_POST["productName"];
        $price = $_POST["productPrice"];
        $quantity = $_POST["quantityInStock"];
        $type = $_POST["updateType"];
        // $image = $_POST["productImage"];
        $image = "hinhabc";
        if(!empty($id)) {
            ['updateProduct' => $func] = require '../Entities/product.php';
            $productUpdate = $func($conn,array($name,$price,$type,$quantity,$image),$id);
            if(!$productUpdate) {
                $res = "<script>setTimeout(function() {alert('Update product failed !');}, 500)</script>";
            } else {
                $res = "<script>setTimeout(function() {alert('Update product success !');}, 500)</script>";
            }     
        } else {
            ['insertProduct' => $func] = require '../Entities/product.php';
            $productCreate = $func($conn,array($name,$price,$type,$quantity,$image));
            if(!$productCreate) {
                $res = "<script>setTimeout(function() {alert('Create product failed !');}, 500)</script>";
            } else {
                $res = "<script>closeDetail(); setTimeout(function() {alert('Create product success !');}, 500)</script>";
            }
        }
    }
    require_once('../utils/close_db.php');
    echo $res;
?>