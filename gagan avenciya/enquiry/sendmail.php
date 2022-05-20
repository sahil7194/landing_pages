<?php

   
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 require '../enquiry/DbConnector.php'; 
 $dc = new DbConnector();
 $con=$dc->createDbConnection();
 $con=$dc->createDbConnection1();
 
 
 
 
 if($con===true)
 {
    $enquiry_lead_data=$_POST;
    $res=$dc->checkLectureStatus("enquiry_lead",$enquiry_lead_data);
   
    if($res == 'Available'){}else{
    $res=$dc->postData("enquiry_lead",$enquiry_lead_data,"Enquiry");
    $res=$dc->postData1("enquiry_lead",$enquiry_lead_data,"Enquiry");
    }
    if($res === true)
    {
        
         $to="faizan@holdingbricks.com,holdingbricks@gmail.com";
        $subject = 'New contact info from koltepatildevelopers';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
       //  $headers .= 'Cc: sales@finora.com' . "\r\n";
         $headers .= 'Bcc: admin@ibrandtech.in' . "\r\n"; 
        $message = '<html><body>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
        $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
        $message .= "<tr><td><strong>mobile:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        
         mail($to, $subject, $message, $headers);
         
            header("Location: ../enquiry/thank-you.html"); 
    
    }else{  header("Location: ../enquiry/thank-you.html");  }
}
  
  
?>