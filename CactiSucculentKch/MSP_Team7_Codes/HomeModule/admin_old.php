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
        <main>
            <div class="content">
            <h1>Profile Page</h1>
            <br>
            
            <div class="cont1">
            <form class = "details">
            <div>
            <table>
              <tr>
                <th>NAME</th>
                <th>DATE OF BIRTH</th>
              </tr>
              <br>
              <tr>  
                <td>name</td>
                <td>dbirth</td>
              </tr>
                
              <tr>
                <th>EMAIL ADDRESS</th>
                <th>ROLES</th>
              </tr>
            
              <tr>
                <td>email</td>
                <td>Visitor</td>
              </tr>
            
              <tr>
                <th>NATIONALITY</th>
                <th>GENDER</th>
              </tr>
              <tr>  
                <td>nationality</td>
                <td>gender
                </td>
              </tr>
            
              <tr>
                <th>PHONE NUMBER</th>
              <tr>
                <td>tel</td>
              </tr>
            
            </table>
            </div>
            
            <div class= "buttondel-container-div">
            <a href = "EditUserInfo.php"><button type="button" class="buttons">Edit User Info</button></a>
            </div>
            </div>
            </form>
            
            </div>
            </div>
            </main>
        <aside>
            <div class="col1">
                <section>
                    <div class="title">
                        <a href="#" class="active">Home</a>
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
                        <a href="adminvisitor.php">Visitor</a>
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
                        <a href="home.php">Logout</a>
                    </div>
                </section>
            </div>
        </aside>
        
        <main>
            <div class="content">
                <div class="cont1">
                    <a onclick="link" type="button" href="home.php" class="button">Visitor View</a>
                    <ul>
                        <li>
                            <a href="#">Add Banner</a>
                        </li>
                        <li>
                            <a href="#">Update Banner</a>
                        </li>
                        <li>
                            <a href="#">Delete Banner</a>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
    </body>
</html>

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>