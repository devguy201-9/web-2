<?php
session_start();
$_SESSION['statusLogin'] = 0;
class loginAdmin
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

    function collectDataNV()
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
            $i++;
        }
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
            default:
            break;
        }
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
            $this->json['thongtin']['maCh'] = $row['MaCh'];
        }
    }
    function checkForm()
    {
        $_POST['pass'] = md5($_POST['pass']);
        $this->query = 'SELECT * FROM nhanvien WHERE Email="'.$_POST['email'].'" AND PassWord="'.$_POST['pass'].'" and tinhtrang=1';
        // echo $this->query;
        $this->excuteQuery();
        $this->json['status'] = 0;
        if ($this->result != null)
        {
            $this->json['status'] = 1;
            $this->colectInfo();
            $_SESSION['loginData'] = $this->json;
            $_SESSION['statusLogin'] = 1;
            setcookie('login', json_encode($_POST) , time() + 54000, "/");
        }
    }

    function logout()
    {
        setcookie("login", "", time() - 3600, "/");
        session_destroy();
        $this->json['status'] = 1;    
    }

    function checkCookie()
    {
        // echo "run";
        if (isset($_COOKIE['login']))
        {
            $this->json['status'] = 0;
            $this->obj = json_decode($_COOKIE['login'], true);
            $this->query = 'SELECT * FROM nhanvien WHERE Email="'.$this->obj['email'].'" AND PassWord="'.$this->obj['pass'].'" and tinhtrang=1';
            // echo $this->query;
            $this->excuteQuery();
            if ($this->result != null)
            {
                $this->colectInfo();
                $this->json['status'] = 1;

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
}

$login = new loginAdmin();
$login->checkRequest();
echo json_encode($login->getJson());
?>
