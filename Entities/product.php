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
    ];

