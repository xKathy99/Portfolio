<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Admin</title>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="login_css.css">
        
    </head>
    <div class="centerGray">
        <?php
            session_start(); 
            // user not logged in
            if (!isset($_SESSION['username'])) { //username not set
                echo '<h1 class="container">ADMIN PLEASE log in first</h1>';
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
         <?php if (isset($_SESSION['username'])) : ?>
            <h1>Admin homepage<br>
            Login sucessfull~!<br>
            Welcome ADMIN~ </h1>
        
            <a href="../ReportingModule/RE01_MostCrowdedSeason.php">
                <button type="button" class="button_green">
                    Reporting Module
                </button>
            </a>
            
            <a href="../ReportingModule/RE02_VisitorPattern.php">
                <button type="button" class="button_green">
                    Visitor Pattern
                </button>
            </a>

            <a href="../BookingModule/A0 CreateSlots_Admin.php">
                <button type="button" class="button_green">
                    Appointment Slot
                </button>
            </a>
            <a href="../feedback module/admin_view_feedback.php">
                <button type="button" class="button_green">
                    View&Reply Feedback
                </button>
            </a>

            <a href="login.php?logout='1'"><button type="button" class="cancelbtn1">LOGOUT</button></a>
        <?php endif ?>
    </div> 
</html>

<?php

echo "<script src='../notification_module/public/notification_page.js'></script>";
echo "<script src='../notification_module/public/ajax.js'></script>";
include_once('../notification_module/public/popUp.php');

?>