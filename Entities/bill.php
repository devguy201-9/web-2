<?php
    return [
        'findAllBills' => function($conn) {
            $query ="SELECT * FROM hoadon";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            usort($data, function ($a, $b) {
                return -strtotime($a['NGAYXUAT']) + strtotime($b['NGAYXUAT']);
            });
            return $data;
        },
        'findBillsByMonthAndYearAndStatus' => function($conn,$month,$year,$status) {
            $condition1 = " = ";
            $condition2 = " = ";
            if ($month == 0) {
                $condition1 = " <> ";
            }
            if ($year == 0) {
                $condition2 = " <> ";
            }
            $query ="SELECT * FROM hoadon WHERE month(NGAYXUAT)".$condition1.$month." AND year(NGAYXUAT)".$condition2.$year;
            if ($status >=-1 ){
                $query = $query." AND TinhTrang = ".$status;
            }
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            if ($status > 1) {
                usort($data, function ($a, $b) {
                    return -strtotime($a['NGAYXUAT']) + strtotime($b['NGAYXUAT']);
                });
            } else {
                usort($data, function ($a, $b) {
                    return strtotime($a['NGAYXUAT']) - strtotime($b['NGAYXUAT']);
                });
            }
            return $data;
        },
        'insertBill' => function($conn,$Bills) {
            //date('Y-m-d H:i:s')
            $query ="INSERT INTO hoadon(MaKH,TinhTrang,ThanhTien,NGAYXUAT) VALUES (".
                $Bills['MaKH'].",".$Bills['TinhTrang'].",".$Bills['ThanhTien'].",'".$Bills['NGAYXUAT']."')";
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
        'deleteBill' => function($conn,$MaHD) {
            $query ="DELETE FROM hoadon WHERE MaHD = ".$MaHD;
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
        'updateBill' => function($conn,$MaHD,$status) {
            $query ="UPDATE hoadon SET TinhTrang = ".$status." WHERE MaHD = ".$MaHD;
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
        'findDetailBillByIdBill' => function($conn,$MaHD) {
            $query ="SELECT sp.Ten,loai.TenLoai,sp.GiaBan as GiaSP,cthd.SoLuong,cthd.GiaBan AS TongTien FROM chitiethd AS cthd 
            INNER JOIN sanpham AS sp ON cthd.MaSP = sp.MaSP INNER JOIN loai AS loai ON loai.MaLo = sp.MaLoai WHERE MaHD = $MaHD";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
    ];

