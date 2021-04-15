<?php
return [
    'findAllTypes' => function($conn) {
        $query ="SELECT * FROM loai";
        $result = mysqli_query($conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    },
    'findTypeNameById' => function($conn,$MaLoai) {
        $query ="SELECT TenLoai FROM loai"." WHERE MaLo = ".$MaLoai;
        $result = mysqli_query($conn,$query);
        $result = $result->fetch_array();
        return strval($result[0]);
    },
];
