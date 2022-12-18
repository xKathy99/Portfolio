<link rel="stylesheet" href="../HomeModule/home.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="../HomeModule/script.js" type="text/javascript"></script>
<?php



    echo
    '
    <header>
    
    <a href="../HomeModule/home.php" class="logo">CACTI SUCCULENT</a>
    
    <ul>
    <li><a href="../HomeModule/home.php">Home</a></li>
    <li><a href="../BookingModule/00 PreLogInBook_Customer.php">Booking</a></li>
    <li><a href="../BookingModule/04 Reschedule_Customer.php">Schedule</a></li>
    <li><a href="../EnquiryModule/EN01_ViewEnquiries.php">Enquiry</a></li>
	<li><a href="../notification_module/public/Notification_Page.php">Notifs</a></li>
    <li>
    <!-- <a class="dropbtn" href="../feedback module/feedbackform.php">Feedback</a> -->
    <div class="dropdown">
        <a class="dropbtn">Feedback</a>
        <div class="dropdown-content">
            <div style="padding-top:10px;background:#3a302b;">
                <a href="../feedback module/feedbackform.php">Feedback Form</a>
                <a href="../feedback module/customer_view_feedback.php">View Feedback</a>
            </div>
        </div>
    </div>
    </li>
    <li><a id="showlogin" href="../LoginModule/login.php">Login</a></li>
    <li><a id="showlogout" href="../LoginModule/login.php?logout=1">Logout</a></li>
    </ul>
    <span class="welcome">';
    
    session_start();
    if(isset($_SESSION['username'])){
        echo '
        <script>
        document.getElementById("showlogin").style.display = "none"; 
        document.getElementById("showlogout").style.display = "block"; 
        </script>
        <a class="loggedin">Logged in as '.$_SESSION['username'].'</a>
        ';
        
    }
    else{
        echo '
        <script>
        document.getElementById("showlogin").style.display = "block"; 
        document.getElementById("showlogout").style.display = "none"; 
        </script>
        <ul>
        <li><a href="../LoginModule/create_account.php" class="register">Register Now</a></li>
        </ul>
        ';
        
    }
    // <a href="../HomeModule/admin.php" class="profile_icon" img src="images/user1.png"></a></span>
    //===================== can be used as view profile======================
    echo '
    

    <div class="dropdown">
        <a href="?admin_login?" class="profile_icon" img src="images/user1.png"></a></span>  
        <div class="dropdown-content">
            <div style="padding-top:10px;background:#3a302b;">
                <a style="margin-right:0;" href="../Visitor Profile/EditUserInfo.php">Edit Profile Form</a>
            </div>
            <div style="background:#3a302b;">
                <a style="margin-right:0;" href="../Visitor Profile/UserProfile.php">View User Profile</a>
            </div>
        </div>
    </div>
    </header>
    ';
    // // need admin login only can run this
    // if(isset($_SESSION['username'])){
    //     echo $_SESSION['username'];
    //     if($_SESSION['username'] == "admin"){
    //         echo '<a onclick="link" type="button" href="admin.php" class="buttonside">Admin View</a>';
    //     }
    // }
    ?>