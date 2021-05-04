<?php
include "ConnectDB.php";
class Edit{
    public $request;
    public $response;
    public $result;
    public $conn;
    function __construct(){
        $this->conn=new ConnectDB();
        $this->request=json_decode($_POST['requestData'],true);
    }

    function checkRequest(){
        switch($_POST['requestType']){
            case 1:return $this->add();
            case 2:return $this->edit();
            case 3:return $this->editKH();
            default:break;
        }
    }
    function add(){
        $query="INSERT INTO `nhanvien`(`Email`,`Ten`, `MaCh`, `DiaChi`, `Password`, `TinhTrang`) VALUES ('".$this->request['email']."','".$this->request['ten']."','".$this->request['chucvu']."','".$this->request['diachi']."','".$this->request['pass']."','".$this->request['tinhtrang']."')";
        return $this->conn->writeData($query);
    }

    function edit(){
        $query="UPDATE `nhanvien` SET `Email`='".$this->request['ten']."',`Ten`='".$this->request['ten']."',`MaCh`='".$this->request['chucvu']."',`DiaChiTT`='".$this->request['diachi']."',`Password`='".$this->request['pass']."',`TinhTrang`='".$this->request['tinhtrang']."' WHERE ten='".$this->request['ten']."'";
        return $this->conn->writeData($query);
    }

    function editKH(){
        $query="UPDATE `khachhang` SET `TinhTrang`='".$this->request['tinhtrang']."' WHERE email='".$this->request['email']."'";
        return $this->conn->writeData($query);
    }
}
$edit=new Edit();
echo json_encode($edit->checkRequest());
?>