<?php
    class ConnectDB{
        public $result;
        public $conn;
        // public $status;
        function __construct(){
            $this->conn=new mysqli('localhost','root','','ecommerce');
            $this->result=null;
            if($this->conn->connect_error){
                $this->result['status']=0;
                $this->result['statusText']='Can not connect to sql';
            }
            else{
                $this->result['status']=1;
                $this->result['statusText']='Connected sql';
            }
        }
        function readData($query,$element){
            $this->result=null;
            $result=$this->conn->query($query);
            if($result->num_rows>0){
                $this->result['status']=1;
                $this->result['statusText']="$result->num_rows found with query: $query";
                $i=0;
                while($row = $result -> fetch_array(MYSQLI_NUM)){
                    for($j=0;$j<count($element);$j++){
                        $this->result['data'][$i][$element[$j]]=$row[$j];
                    }
                    $i++;
                }
            }
            else{
                $this->result['status']=0;
                $this->result['statusText']="No result with query: $query";
            }
            return $this->result;
        }
        function writeData($query){
            $this->result=null;
            if($this->conn->query($query)==true){
                $this->result['status']=1;
                $this->result['statusText']="Excuted query: $query";
            }
            else{
                $this->result['status']=0;
                $this->result['statusText']="Can not Excuted query: $query";
            }
            return $this->result;
        }
    }
?>