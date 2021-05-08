<?php
    return [
        'getNV' => function($conn, $name) {
            $query ="SELECT * FROM nhanvien ";
            if(!empty($name)) 
            {
                $query = $query."WHERE Ten LIKE '%".$name."%'";
            }
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'getKH' => function($conn, $name) {
            $query ="SELECT * FROM khachhang ";
            if(!empty($name)) 
            {
                $query = $query."WHERE Ten LIKE '%".$name."%'";
            }
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
    ];