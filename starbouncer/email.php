<?php
		 if (isset($_POST['name']))  {

	  	// Email information

		$name = $_POST['name'];
	  	$mobile = $_POST['number'];
	  	$emailid= $_POST['email'];
	  	$requirements = $_POST['message'];

	  // send email

		$to      = "starbouncers@gmail.com";

		$subject = 'Enquiry From starsecuritybouncer.com web site';

		$message = 'Name :' . $name  ."\n" . 'Mobile :' . $mobile ."\n" . 'EmailId :' . $emailid ."\n".'Requirements :' . $requirements ."\n\n";

		$message = wordwrap($message, 2000, "\r\n");



		$from = 'From: webenq@starsecuritybouncer.com'. "\r\n" .

		"BCC: info@starbizsolutions.com,stanleys1970@gmail.com";



		mail($to, $subject, $message, $from);  

	   // Email response

		$msgconfirm= "Thank you for contacting us!<br>";

	  }
	
?>