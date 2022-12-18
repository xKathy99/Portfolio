<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Send</title>
        <?php include '../includefile/homeheader.php';?>
		<link rel="stylesheet" href="login_css.css">
	</head>
<?php
    if(!isset($_GET['email'])){
        echo '<div class="centerGray"><h1>error, mail not set. </h1></div>';
    }
    else{
        $to_email = $_GET['email'];
        // $to_email = "101218529@students.swinburne.edu.my";
        $subject = "Reset Password Link";
        $body = 'Dear Cacti-Succulent-KCH user,
        <br><br>';
        // $body .= "halo $to_email ";
        $body .= '<style>
        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 15px;
            font-family: Georgia, serif;
            border-radius: 5px;
        }
        button:hover {
            opacity: 0.5;
        }
        .container {
            padding: 16px;
            width: 60%;
            margin-left: auto;
            margin-right: auto;
        }
        </style>
        <div class="container" style="background-color:#f1f1f1">
            We received a request to change password for your account.<br>
            Please follow the link below to reset your password<br><br>
            
            <a href="http://localhost/MSP_Team7_Codes/LoginModule/forgot_password.php?getemail=';
        $body .= $to_email;
        $body .='"><button type="button">RESET LINK</button></a><br><br>
        Or click <a href="http://localhost/MSP_Team7_Codes/LoginModule/forgot_password.php?getemail=';
        $body .= $to_email;
        $body .='">here </a><br>
        Check your SPAM and mark as NOT spam if you cannot find the email.<br>
        </div>
        <br>
        <h3>If you do not perform this action, Please IGNORE this email.</h3>
        <br>
        Sincerely yours,<br>
        The Cacti-Succulent_KCH team
        ';
        $headers = "From: hokaixian@gmail.com";

        // To send HTML mail, the Content-type header must be set
        $headers .= 'MIME-Version: CACTI-SUCCULENT-KCH' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        
        if (mail($to_email, $subject, $body, $headers)) {
            echo '<div class="centerGray">';
            echo '<h2>Email successfully sent to <h1 style="overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;">';
            echo $to_email;
            echo '...</h1></h2>';
            echo '<h2>Please check your email.</h2><br><br><br></div>';
        } else {
            echo "Email sending failed...";
        }
    }
    
    
?>
</html>


<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>