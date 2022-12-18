<link rel="stylesheet" href="../home.css">
<?php
    echo
    '
    <header>
    <a href="home.php" class="logo">CACTI SUCCULENT</a>

    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="../BookingModule/00 PreLogInBook_Customer.php">Booking</a></li>
        <li><a href="../BookingModule/04 Reschedule_Customer.php">Schedule</a></li>
        <li><a href="">Enquiry</a></li>
        <li>
            <!-- <a class="dropbtn" href="../feedback module/feedbackform.php">Feedback</a> -->
            <div class="dropdown">
                <a class="dropbtn">Feedback</a>
                <div class="dropdown-content">
                    <a href="../feedback module/feedbackform.php">Feedback Form</a>
                    <a href="../feedback module/customer_view_feedback.php">View Feedback</a>
                </div>
            </div>
        </li>
        <li><a href="">About Us</a></li>
        <li><a id="showlogin" href="../LoginModule/login.php">Login</a></li>
        <li><a id="showlogout" href="../LoginModule/login.php?logout=1">Logout</a></li>
    </ul>';
    
        session_start();
        if(isset($_SESSION['username'])){
            echo '
            user logged in
            <script>
                document.getElementById("showlogin").style.display = "none"; 
                document.getElementById("showlogout").style.display = "block"; 
            </script>
            ';

        }
        else{
            echo '
            user logged out
            <script>
                document.getElementById("showlogin").style.display = "block"; 
                document.getElementById("showlogout").style.display = "none"; 
            </script>
            ';

        }
    echo '

    <a href="admin.php" class="profile_icon" img src="images/user1.png"></a>
</header>
    ';
    // <header>
    //     <link rel="stylesheet" href="../home.css">
    //     <a href="home.php" class="logo">CACTI SUCCULENT</a>

    //     <ul>
    //         <li><a href="home.php">Home</a></li>
    //         <li><a href="">Reservation</a></li>
    //         <li><a href="">Schedule</a></li>
    //         <li><a href="">Enquiry</a></li>
    //         <li><a href="">About Us</a></li>
    //         <li><a href="../LoginModule/login.php">Login</a></li>
    //     </ul>

    //     <a href="login.php" class="profile_icon" img src="images/user1.png"></a>
    // </header>
?>