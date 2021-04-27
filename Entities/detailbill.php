<?php
    return [
        'statisticProducts' => function($conn,$month,$year,$minimumQuantity,$typeProducts) {
            $condition1 = " = ";
            $condition2 = " = ";
            $condition4 = " = ";
            if ($month == 0) {
                $condition1 = " <> ";
            }
            if ($year == 0) {
                $condition2 = " <> ";
            }
            if ($typeProducts == 0) {
                $condition4 = " <> ";
            }
            $query1 ="SELECT MaHD FROM hoadon WHERE month(NGAYXUAT)".$condition1.$month." AND year(NGAYXUAT)"
            .$condition2.$year." AND TinhTrang = 2";
            $result1 = mysqli_query($conn,$query1);
            $data1 = array();
            while($row = mysqli_fetch_array($result1)){
                $data1[] = $row;
            }
            $condition3 = " IN(";
            for ($i=0; $i < count($data1); $i++) { 
                $condition3 = $condition3 . $data1[$i]['MaHD'].",";
            }
            $condition3 = substr($condition3, 0, -1).") ";

            // SELECT sp.MaSP,sp.Ten,sp.MaLoai,loai.TenLoai,SUM(cthd.SoLuong) AS tongsoluong,SUM(cthd.GiaBan) AS tonggia FROM chitiethd AS cthd INNER JOIN sanpham AS sp ON cthd.MaSP = sp.MaSP INNER JOIN loai AS loai ON loai.MaLo = sp.MaLoai 
            // WHERE MaHD IN(10,15) AND SP.MaLoai <> 0
            // GROUP BY cthd.MaSP
            // Having SUM(cthd.SoLuong) >= 12

            $query ="SELECT sp.MaSP,sp.Ten,sp.MaLoai,loai.TenLoai,SUM(cthd.SoLuong) AS tongsoluong,SUM(cthd.GiaBan) AS tonggia 
            FROM chitiethd AS cthd INNER JOIN sanpham AS sp ON cthd.MaSP = sp.MaSP INNER JOIN loai AS loai ON loai.MaLo = sp.MaLoai 
            WHERE MaHD".$condition3." AND sp.MaLoai".$condition4.$typeProducts." GROUP BY cthd.MaSP";
            if ($minimumQuantity > 0) {
                $query = $query." Having SUM(cthd.SoLuong) >= ".$minimumQuantity;
            }
            $result = mysqli_query($conn,$query);
            $data = array();
            if($result){
                while($row = mysqli_fetch_array($result)){
                    $data[] = $row;
                }
            }
            return $data;
        },
    ];

