<?php
session_start();
$_SESSION['statusLogin'] = 0;
class login
{
    public $conn;
    public $json;
    public $obj;
    public $result;
    public $query;

    function __construct()
    {
        $this->connectDB();
    }

    function connectDB()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'ecommerce');
        if ($this
            ->conn
            ->connect_error)
        {
            die("connect fail");
        }
    }

    function excuteQuery($i = 0)
    {
        if ($i == 0)
        {
            $this->result = $this
                ->conn
                ->query($this->query);
            if ($this->result->num_rows <1)
            {
                $this->result = null;
            }
        }
        else
        {
            $this->result = $this
                ->conn
                ->query($this->query);
        }
    }

    function renderInfo(){
        $this->json['thongtin']=$_SESSION['thongtin'];
        $this->json['sp']=$_SESSION['sp'];
    }

    function checkRequest()
    {
        if($_SESSION['statusLogin']==1){
            $this->json['status']=1;
            $this->renderInfo();
            // renderData();

        }
        else{
        switch ($_POST['requestType'])
        {
            case 1:
                $this->checkCookie();
            break;
            case 2:
                $this->checkForm();
            break;
            case 3:
                $this->logout();
            break;
            case 4:
                $this->register();
            break;
            default:
            break;
        }
    }
    }

    function collectData()
    {
        $i = 0;
        while ($row = $this
            ->result
            ->fetch_assoc())
        {
            $this->json['sp'][$i]['ten'] = $row['Ten'];
            $this->json['sp'][$i]['soluong'] = $row['SoLuong'];
            $this->json['sp'][$i]['giaban'] = $row['GiaBan'];
            $this->json['sp'][$i]['masp'] = $row['MaSP'];
            $this->json['sp'][$i]['size'] = $row['Size'];
            // var_dump($row);
            $i++;
        }
    }

    function collectDataHD()
    {
        $i = 0;
        while ($row = $this
            ->result
            ->fetch_assoc())
        {
            $this->json['hd'][$i]['mahd'] = $row['MaHD'];
            $this->json['hd'][$i]['tinhtrang'] = $row['TinhTrang'];
            $this->json['hd'][$i]['ten'] = $row['Ten'];
            $this->json['hd'][$i]['soluong'] = $row['SoLuong'];
            $this->json['hd'][$i]['giaban'] = $row['GiaBan'];
            $this->json['hd'][$i]['masp'] = $row['MaSP'];
            $this->json['hd'][$i]['size'] = $row['Size'];
            // var_dump($row);
            $i++;
        }
    }

    function colectInfo()
    {
        while ($row = $this
            ->result
            ->fetch_assoc())
        {
            $this->json['thongtin']['name'] = $row['Ten'];
            $this->json['thongtin']['email'] = $row['Email'];
            $this->json['thongtin']['diaChi'] = $row['DiaChi'];
            $this->json['thongtin']['sdt'] = $row['SDT'];
            // $this->json['thongtin']['mach'] = '0';
        }
    }
    function checkForm()
    {
        $_POST['pass'] = md5($_POST['pass']);
        $this->query = 'SELECT * FROM khachhang WHERE Email="'.$_POST['email'].'" AND MatKhau="'.$_POST['pass'].'" and tinhtrang=1';
        $this->excuteQuery();
        $this->json['status'] = 0;
        if ($this->result != null)
        {
            $this->json['status'] = 1;
            $this->colectInfo();

            $this->query = 'SELECT sanpham.*, chitiethd.* FROM khachhang,hoadon,chitiethd,sanpham WHERE email="' . $_POST['email'] . '" AND matkhau="' . $_POST['pass'] . '" AND khachhang.makh=hoadon.makh and hoadon.mahd=chitiethd.mahd and chitiethd.masp=sanpham.masp and hoadon.tinhtrang=0';
            $this->excuteQuery();
            if ($this->result != null)
            {
                $this->collectData();
            }

            $this->query = 'SELECT sanpham.*, chitiethd.*, hoadon.* FROM khachhang,hoadon,chitiethd,sanpham WHERE email="' . $_POST['email'] . '" AND matkhau="' . $_POST['pass'] . '" AND khachhang.makh=hoadon.makh and hoadon.mahd=chitiethd.mahd and chitiethd.masp=sanpham.masp and hoadon.tinhtrang>0';
            $this->excuteQuery();
            if ($this->result != null)
            {
                $this->collectDataHD();
            }

            $_SESSION['loginData'] = $this->json;
            $_SESSION['statusLogin'] = 1;
            setcookie('login', json_encode($_POST) , time() + 54000, "/");
            // var_dump($_POST);
            
        }
    }

    function logout()
    {
        setcookie("login", "", time() - 3600, "/");
        // setcookie('PHPSESSID',time()-3600,"/");
        session_destroy();
        $this->json['status'] = 1;
        
    }
    function checkCookie()
    {
        if (isset($_COOKIE['login']))
        {
            $this->json['status'] = 0;
            $this->obj = json_decode($_COOKIE['login'], true);
            $this->query = 'SELECT * FROM khachhang WHERE Email="'.$this->obj['email'].'" AND MatKhau="'.$this->obj['pass'].'" and tinhtrang=1';

            $this->excuteQuery();
            if ($this->result != null)
            {
                $this->colectInfo();
                $this->json['status'] = 1;

                $this->query = 'SELECT sanpham.*, chitiethd.* FROM khachhang,hoadon,chitiethd,sanpham WHERE email="' . $this->obj['email'] . '" AND matkhau="' . $this->obj['pass'] . '" AND khachhang.makh=hoadon.makh and hoadon.mahd=chitiethd.mahd and chitiethd.masp=sanpham.masp and hoadon.tinhtrang=0';
                // echo $this->query;
                $this->excuteQuery();

                if ($this->result != null)
                {
                    $this->collectData();
                }

                $this->query = 'SELECT sanpham.*, chitiethd.*, hoadon.* FROM khachhang,hoadon,chitiethd,sanpham WHERE email="' . $this->obj['email'] . '" AND matkhau="' . $this->obj['pass'] . '" AND khachhang.makh=hoadon.makh and hoadon.mahd=chitiethd.mahd and chitiethd.masp=sanpham.masp and hoadon.tinhtrang>0';
                $this->excuteQuery();
                if ($this->result != null)
                {
                    $this->collectDataHD();
                }
                $_SESSION['loginData'] = $this->json;
                $_SESSION['statusLogin'] = 1;
            }
        }
        else
        {
            $this->json['status'] = - 1;
        }
    }

    function getJson()
    {
        return $this->json;
    }

    function register()
    {
        // echo "dang ky";
        if ($_SESSION['statusLogin'] == 0)
        {
            $this->json['status'] = 1;
            $this->query = 'SELECT * FROM khachhang WHERE email="' . $_POST['email'] . '"';
            $this->excuteQuery();
            // echo $this->query;
            if ($this->result == null)
            {
                $pass = md5($_POST['pass']);
                $this->query = "INSERT INTO khachhang (ten, matkhau, email, sdt, tinhtrang, diachi) VALUES ('".$_POST['name']."', '".$pass."', '".$_POST['email']."','".$_POST['sdt']."',1,'".$_POST['diachi']."')";
                // echo $this->query;
                $this->excuteQuery(1);
            }
            else
            {
                $this->json['status'] = 0;
            }
        }
        else
        {
            $this->json['status'] = 0;
        }
    }
}

$login = new login();
$login->checkRequest();
echo json_encode($login->getJson());
?>
