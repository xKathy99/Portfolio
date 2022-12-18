
<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Homepage</title>
		<link rel="stylesheet" href="login_css.css">
	</head>
    <body>

        
        <div class="centerGray">
            <?php
                session_start(); 
                // user not logged in
                if (!isset($_SESSION['username'])) { //username not set
                    echo '<h1 class="container">You must log in first</h1>';
                    echo '<a href="login.php"><button type="button" class="button">Proceed to login page</button></a>';
                    session_destroy();  
                    unset($_SESSION['username']);
                }
                else if (isset($_GET['logout'])) {
                    session_destroy();
                    unset($_SESSION['username']);
                    echo "error??";
                    // header("location: login.php");
                }
            ?>
            <!-- Login success -->
            <?php if (isset($_SESSION['username'])) : ?>
                <?php 
                    echo 'Welcome to the homepage ';
                    echo $_SESSION['username'];
                ?>
                <h1>Login sucessfull~!</h1><br>
                
                <a href="../BookingModule/00 PreLogInBook_Customer.php">
                    <button type="button" class="button_green">
                        BOOK APPOINTMENT
                    </button>
                </a>
                <a href="../BookingModule/04 Reschedule_Customer.php">
                    <button type="button" class="button_green">
                        VIEW APPOINTMENT
                    </button>
                </a>
                <a href="../feedback module/feedbackform.php">
                    <button type="button" class="button_green">
                        WRITE A FEEDBACK
                    </button>
                </a>
                <a href="../feedback module/customer_view_feedback.php">
                    <button type="button" class="button_green">
                        CUSTOMER VIEW FEEDBACK
                    </button>
                </a>




                <a href="login.php?logout='1'">
                    <button type="button" class="cancelbtn1">
                        LOGOUT
                    </button>
                </a>
                
            <?php endif ?>
            <br><br>
        </div>
    </body>
    
</html>


<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>