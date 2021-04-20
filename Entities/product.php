<?php
    return [
        'findAllProducts' => function($conn,$from,$maxPageItem) {
            $query ="SELECT * FROM sanpham ORDER BY GiaBan ASC
            LIMIT $from, $maxPageItem";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'findAllProductsNumb' => function($conn,$number) {
            $query ="SELECT * FROM sanpham ORDER BY RAND () LIMIT ".$number;
            $result = mysqli_query($conn,$query);
            $data = array();
            if ($result) {
                while($row = mysqli_fetch_array($result)){
                    $data[] = $row;
                }
            }
            return $data;
        },
        'findProductById' => function($conn,$idprod) {
            $query ="SELECT * FROM sanpham WHERE MaSP = ".$idprod;
            $result = mysqli_query($conn,$query);
            $data = array();
            if ($result) {
                while($row = mysqli_fetch_array($result)){
                    $data[] = $row;
                }
            }
            return $data[0];
        },
        'countProducts' => function($conn) {
            $query ="SELECT COUNT(*) FROM sanpham";
            $result = mysqli_query($conn,$query);
            $result = $result->fetch_array();
            return intval($result[0]);
        },
        'countProductsByType' => function($conn,$MaLoai) {
            $query ="SELECT COUNT(*) FROM sanpham WHERE MaLoai = ".$MaLoai;
            $result = mysqli_query($conn,$query);
            $result = $result->fetch_array();
            return intval($result[0]);
        },
        'findProductByType' => function($conn,$MaLoai,$from, $maxPageItem) {
            $query ="SELECT * FROM sanpham WHERE MaLoai = $MaLoai LIMIT $from, $maxPageItem";
            $result = mysqli_query($conn,$query);
            $data = array();
            if ($result) {
                while($row = mysqli_fetch_array($result)){
                    $data[] = $row;
                }
            }
            return $data;
        },
        'SearchProducts' => function($conn,$name,$type,$price,$typeId) {
            $condition1 = " = ";
            if (empty($typeId)) {
                $condition1 = " <> ";
                $typeId = 0;
            }
            if (empty($type)) {
                $type = ">=";
                $price = 0;
            }
            $query = "SELECT * FROM sanpham WHERE (MaLoai".$condition1.$typeId. " AND Giaban ".$type." ".$price." AND Ten LIKE '%".$name."%')";

            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'updateProduct' => function($conn,$products) {
            $query ="UPDATE sanpham SET Ten = '".$products['Ten']."',Hinh = '".$products['Hinh']."',GiaBan = "
            .$products['GiaBan'].",MaLoai = ".$products['MaLoai'].",SoLuongTon = ".$products['SoLuongTon']
            ." WHERE MaSP = ".$products['MaSP'];
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
        'insertProduct' => function($conn,$products) {
            $query ="INSERT INTO sanpham (Ten,Hinh,GiaBan,MaLoai,SoLuongTon) VALUES ('".$products['Ten']."','".$products['Hinh']."',"
            .$products['GiaBan'].",".$products['MaLoai'].",".$products['SoLuongTon'].")";
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
        'deleteProduct' => function($conn,$MaSP) {
            $query ="DELETE FROM sanpham WHERE MaSP = ".$MaSP;
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
    ];

