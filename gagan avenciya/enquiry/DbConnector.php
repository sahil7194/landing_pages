<?php
class DbConnector{
    
    public $servername="";
    public $username="";
    public $password="";
    public $dbname=" ";
    
      
    
    //public $conn =  mysqli($servername,$username,$password,$dbname);
    function createDbConnection()
    {
      $conn = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);
      // Check connection
      if($conn->connect_error) 
      {
         die("Connection failed: " . $conn->connect_error);
      } 
      else
      {
         return true;
      }
    }
    function postData($tbl,$data,$type)
    {
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if($type ==="Enquiry")
        {
            $sql="INSERT INTO `$tbl` (`name`, `phone`,`email`)
                VALUES
                ('$data[name]','$data[phone]','$data[email]')";
        }
        else{
             $sql="INSERT INTO `$tbl` (`name`, `phone`)
                VALUES
                ('$data[name]','$data[phone]')";
        }
        
        if (mysqli_query($conn, $sql))
        {       
            return true;
        }
        else
        {
            echo mysqli_error($conn);
        }
       
    }
    
    function createDbConnection1() {
         $conn1 = mysqli_connect($this->fservername,$this->fusername,$this->fpassword,$this->fdbname);
      // Check connection
      if($conn1->connect_error) 
      {
         die("Connection failed: " . $conn1->connect_error);
      } 
      else
      {
         return true;
      }
    }
    
    function postData1($tbl,$data,$type)
    {
        $conn1 = mysqli_connect($this->fservername,$this->fusername,$this->fpassword,$this->fdbname);
        if($type ==="Enquiry")
        {
            $sql="INSERT INTO `$tbl` (`name`, `phone`,`email`)
                VALUES
                ('$data[name]','$data[phone]','$data[email]')";
        }
        else{
             $sql="INSERT INTO `$tbl` (`name`, `phone`)
                VALUES
                ('$data[name]','$data[phone]')";
        }
        
        if (mysqli_query($conn1, $sql))
        {       
            return true;
        }
        else
        {
            echo mysqli_error($conn1);
        }
       
    }
    
     
    function checkLectureStatus($tbl,$data)
                {
                  $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
                            
                 $sql="select * from `$tbl` where phone =$data[phone]";
                           $res=mysqli_query($conn, $sql);
                             if ($res->num_rows >= 1)
                            {       
                                return 'Available';
                            }
                            else
                            {
                                echo mysqli_error($conn);
                            }
                           
                }
}
?>