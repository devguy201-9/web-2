<?php
    include "ConnectDB.php";

    class Shopping{
        public $conn;
        public $request;
        public $response;
        public $mkh;
        public $mhd;
        function __construct(){
            $this->conn=new ConnectDB();
            $this->request=json_decode($_POST['requestData'],true);
            $this->response=null;
        }
        function checkRequest(){
            if($this->getID()==0){
                return $this->response;
            }
            // if($this->response['status']==)
            switch($_POST['requestType']){
                case 1:return $this->add();
                case 2:return $this->delete();
                case 3:return $this->order();
                default:break;
            }
            // return $this
        }
        function getID(){
            $element=['mkh'];
            $query="select makh from khachhang where khachhang.email='".$this->request['email']."'";
            $result=$this->conn->readData($query,$element);
            if($result['status']==1){
                $this->mkh=$result['data'][0]['mkh'];
                $element=['mhd'];
                $query="select mahd from hoadon where tinhtrang=0 and makh='".$this->mkh."'";
                $result=$this->conn->readData($query,$element);
                // echo $result['status'];
                // echo $this->mkh;
                if ($result['status'] != 0)
                    $this->mhd = $result['data'][0]['mhd'];
                else
                {
                    $query="insert into hoadon(makh, tinhtrang) values ('".$this->mkh."', 0)";
                    
                    $this->conn->writeData($query);
                    $query="select mahd from hoadon where tinhtrang=0 and makh='".$this->mkh."'";
                    $result=$this->conn->readData($query,$element);
                    $this->mhd = $result['data'][0]['mhd'];
                }
                return 1;
            }
            else{
                $this->response=$result;
                return 0;
            }
        }

        function add(){
            $element=['sl'];
            $query="select soluongton from sanpham where masp='".$this->request['msp']."'";
            $result=$this->conn->readData($query,$element);
            if($result['data'][0]['sl']>$this->request['sl']){
                $query="select soluongton from sanpham where masp='".$this->request['msp']."'";
                $sl=$this->conn->readData($query,['sl']);
                $sl=$sl['data'][0]['sl'];
                $sl-=$this->request['sl'];

                $query="UPDATE `sanpham` SET `SoLuongTon`='".$sl."' where masp='".$this->request['msp']."'";
                $this->conn->writeData($query);

                $query="INSERT INTO `chitiethd`(`MaHD`, `MaSP`, `Size`, `SoLuong`, `GiaBan`) VALUES ('".$this->mhd."','".$this->request['msp']."','".$this->request['size']."','".$this->request['sl']."','".$this->request['gia']."') ON DUPLICATE KEY UPDATE  soluong= soluong+".$this->request['sl'].",giaban='".$this->request['gia']."'";
                return $this->conn->writeData($query);
            }
            else{
                $this->response['status']=0;
                $this->response['statusText']="run out";
            }
            return $this->response;
        }
        function delete(){
            $query="select soluongton from sanpham where masp='".$this->request['msp']."'";
            $sl=$this->conn->readData($query,['sl']);
            $sl=$sl['data'][0]['sl'];
            $sl+=$this->request['sl'];
            $query="UPDATE `sanpham` SET `SoLuongTon`='".$sl."' where masp='".$this->request['msp']."'";
            $this->conn->writeData($query);

            $query="DELETE FROM `chitiethd` WHERE masp='".$this->request['msp']."' and mahd='".$this->mhd."'"."and size='".$this->request['size']."'";
            return $this->conn->writeData($query);
        }
        function order(){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            
            $query="UPDATE `hoadon` SET `NGAYXUAT`='".date("Y-m-d H:i:s")."',`TinhTrang`=1, thanhtien = ".$this->request['total']."  WHERE MaHD='".$this->mhd."'";
            $result=$this->conn->writeData($query);

            $query="INSERT INTO `hoadon`(`MaKH`, `TinhTrang`) VALUES ('".$this->mkh."','0')";
            $this->conn->writeData($query);

            return $result;
        }
    }

    $shopping=new Shopping();
    echo json_encode($shopping->checkRequest());
?>