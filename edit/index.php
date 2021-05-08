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
        $pass = md5($this->request['matkhau']);
        $query="INSERT INTO `nhanvien`(`Email`,`Ten`, `MaCh`, `DiaChi`, `Password`, `TinhTrang`) VALUES ('".$this->request['email']."','".$this->request['ten']."','".$this->request['mach']."','".$this->request['diachi']."','".$pass."','".$this->request['status']."')";
        return $this->conn->writeData($query);
    }

    function edit(){
        if (!empty($this->request['matkhau']))
        {
            $pass = md5($this->request['matkhau']);
            $query="UPDATE `nhanvien` SET `Ten`='".$this->request['ten']."',`MaCh`='".$this->request['mach']."',`DiaChi`='".$this->request['diachi']."',`Password`='".$pass."',`TinhTrang`='".$this->request['status']."' WHERE email='".$this->request['email']."'";
        }
        else
            $query="UPDATE `nhanvien` SET `Ten`='".$this->request['ten']."',`MaCh`='".$this->request['mach']."',`DiaChi`='".$this->request['diachi']."',`TinhTrang`='".$this->request['status']."' WHERE email='".$this->request['email']."'";
        return $this->conn->writeData($query);
    }

    function editKH(){
        $query="UPDATE `khachhang` SET `TinhTrang`='".$this->request['status']."' WHERE email='".$this->request['email']."'";
        return $this->conn->writeData($query);
    }
}
$edit=new Edit();
echo json_encode($edit->checkRequest());
?>