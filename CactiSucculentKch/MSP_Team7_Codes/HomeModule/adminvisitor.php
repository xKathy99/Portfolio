<!DOCTYPE HTML>
<html>  
    <head>
        <meta charset="utf-8">
        <title>Admin Page</title>
        <link rel="stylesheet" href="admin.css"/>
        <script src="./script.js" type="text/javascript"></script>
    </head>

    <header>
        <div class="header-wrapper">
            <div class="admin-wrapper">
                <a href="home.php" class="logo">CACTI SUCCULENT</a>
                <span>Admin</span>
            </div>
            <a href="home.php" class="profile_icon" img src="images/user1.png"></a>
        </div>
    </header>

    <body>
        <aside>
            <div class="col1">
                <section>
                    <div class="title">
                        <a href="admin.php">Home</a>
                    </div>
                </section>
            </div>

            <div class="col2">
                <section>
                    <div class="title">
                        <a href="adminappointment.php">Appointment</a>
                    </div>    
                </section>
                
                <section>
                    <div class="title"> 
                        <a href="#" class="active">Visitor</a>
                    </div>
                </section>

                <section>
                    <div class="title">
                        <a href="adminenquiry.php">Enquiry</a>
                    </div>
                </section>
                
                <section>
                    <div class="title">
                        <a href="adminfeedback.php">Feedback</a>
                    </div>
                </section>

                <section>
                    <div class="title">
                        <a href="adminreport.php">Report</a>
                    </div>
                </section>
            </div>

            <div class="col3">
                <section>
                    <div class="title">
                        <a href="../LoginModule/login.php?logout='1'">Logout</a>
                    </div>
                </section>
            </div>
        </aside>


        <main>
            <div class="content">
                <div class="cont1">
                    <ul>
                        <li>
                            <a href="../Visitor Profile/visitorprofiles.php">Visitor Profiles</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </main>        
    </body>
</html>