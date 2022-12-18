<!DOCTYPE html>
<html lang="en">
    <head>
		<title>DATABASE</title>
	</head>
    <?php
        //specify the server name and here it is localhost
        $server_name = "localhost";
        //specify the username - here it is root
        $user_name = "root";
        //specify the password - it is empty
        $password = "";
        //database name
        $dbname = "userlogindb";

// NECESSARY FOR DATABASE INITIALISATION
//====================================================================================================    // NECESSARY FOR DATABASE INITIALISATION
$connection = mysqli_connect($server_name, $user_name, $password);     
if (!$connection) {
    die("Failed ". mysqli_connect_error());
}
$query = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($connection, $query)) {
    // echo "A new DATABASE is successfully created!<br>";
}
else {
    echo "Error: " . mysqli_error($connection);
}
mysqli_close($connection);
//====================================================================================================


        // Creating the connection by specifying the connection details
        $connection = mysqli_connect($server_name, $user_name, $password);
        // Checking the  connection
        if (!$connection) {
        die("Failed ". mysqli_connect_error());
        }
        // echo "Connection established successfully.<br> ";
        
        //sql query to create a database named userlogindb
        $query = "CREATE DATABASE IF NOT EXISTS $dbname";
        if (mysqli_query($connection, $query)) {
            // echo "A new DATABASE is successfully created!<br>";
        } 
        else {
            echo "Error: " . mysqli_error($connection);
        }

        //sql query to create table named userlogin
        $query_table = "CREATE TABLE IF NOT EXISTS `userlogindb`.`userlogin` (
            `id` INT(32) NOT NULL AUTO_INCREMENT , 
            `email` VARCHAR(255) NOT NULL , 
            `password` VARCHAR(255) NOT NULL , 
            `name` VARCHAR(255) NOT NULL , 
            `contact` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        if (mysqli_query($connection, $query_table)) {
            // echo "A new TABLE is successfully created!<br>";
        } 
        else {
            echo "Error: " . mysqli_error($connection);
        }

        $query_table2 = "CREATE TABLE IF NOT EXISTS `userlogindb`.`notification` (
            `id` INT(32) NOT NULL AUTO_INCREMENT , 
            `user_id` int NOT NULL , 
            `admin_id` int NOT NULL , 
            `type` VARCHAR(255) NOT NULL , 
            `description` VARCHAR(255) NOT NULL,
            `status` VARCHAR(10) NOT NULL,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        if (mysqli_query($connection, $query_table2)) {
            //  echo "A new TABLE is successfully created!<br>";
        } 
        else {
            echo "Error: " . mysqli_error($connection);
        }

        echo "<link rel=stylesheet href=login_css.css>";
        // REGISTER USER
        if (isset($_POST['reg_user'])) {
            $Em = $_POST["email"];
            $Pw = md5($_POST["psw"]);
            $Nm = $_POST["name"];
            $Ct = $_POST["contact"];
            $query_insert1 = "INSERT INTO `userlogindb`.`userlogin` (
                `email`, `password`, `name`, `contact`) 
                VALUES ('$Em','$Pw', '$Nm', '$Ct')";
            $query_search = "SELECT * FROM `userlogindb`.`userlogin` WHERE `email` LIKE '$Em';"; 
            if ($result=mysqli_query($connection,$query_search)){ // if the account exists
                // Return the number of rows in result set
                $rowcount=mysqli_num_rows($result);
                if ($rowcount > 0){
                    header('location: accountexist.php');
                }
                else{ // account not fount in DB table, then create account
                    if (mysqli_query($connection, $query_insert1)) {
                        header('location: accountcreated.php');
                    } else {
                        echo "Error: " . $query_insert . "<br>" . mysqli_error($connection);
                    }
                }
                // Free result set
                mysqli_free_result($result);            
            }
        } 

        // LOGIN USER
        if (isset($_POST['login_user'])) {
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $password = md5($password);
            //read database
            $query_checkmail = "SELECT * FROM `userlogindb`.`userlogin` WHERE `email` LIKE '$username'";
            $results_mail = mysqli_query($connection, $query_checkmail);

            $query = "SELECT * FROM `userlogindb`.`userlogin` WHERE `email` LIKE '$username' AND `password`='$password'"; 
            $results = mysqli_query($connection, $query);
            if (mysqli_num_rows($results_mail) != 1){ //user not found 
                header('location: account_NOexist.php');
            }
            else if (mysqli_num_rows($results) == 1) { // user exists in database password correct // CAN LOG IN

                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = 44;
                while( $row=$results->fetch_assoc())
                    $id=$row['id'];
                echo $id;
                $_SESSION['user_id']=$id;
                // $_SESSION['success'] = "You are now logged in";
                header('location: ../HomeModule/home.php');
            }
            
            else {             // user email or password error
                echo '<div class="centerGray">
                <h1>Wrong Password</h1>
                <button type="button" class="cancelbtn1" onclick="history.back()">Try Again</button>
                </div>';
            }
        }


        // RESET PASSWORD
        if (isset($_POST['change_psw'])) {
            echo 'for reset psw<br>';
            $to_email = $_GET['getemail'];
            echo $to_email;
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            // $password = md5($password);
            // $query = 'UPDATE Customers SET ContactName='Alfred Schmidt', City='Frankfurt' WHERE CustomerID=1';
            // $query = "UPDATE `userlogindb`.`userlogin` SET `password` = 'MD5('$password')', WHERE `userlogindb`.`userlogin`.`email` = '$to_email'";
            $query = "SELECT * FROM `userlogindb`.`userlogin` WHERE `email` LIKE '$to_email'"; //read database
            // $results = mysqli_query($connection, $query);
            if (mysqli_query($connection, $query)) { 
                echo "<br>can find user $to_email <br>";
                $query_password = "UPDATE `userlogindb`.`userlogin` SET `password` = MD5('$password') WHERE `userlogin`.`email` = '$to_email'";
                
                if (mysqli_query($connection, $query_password)) { 
                    echo "<br>Password is' $password 'and updated successfully!<br>";
                    header('location: reset_sucess.php');
                }
            }
        }
        //this is when username=admin
        if (isset($_GET['username'])){
            session_start();
            $_SESSION['username'] = "admin";
            $_SESSION['user_id'] = 44;
            header('location: ../HomeModule/admin.php');
        }

// ==================================== BOOKING MODULE ==================================
//=======================================================================================

    // ============================ appointmentslot ==========================
    $sql = "CREATE TABLE IF NOT EXISTS `userlogindb`.`appointmentslot` (
        `id` int(32) NOT NULL AUTO_INCREMENT,
        `appointmentDate` date NOT NULL,
        `customerID` int(32) NOT NULL,
        `availableSlotFrom` time NOT NULL,
        `availableSlotUntil` time NOT NULL,
        `bookform_name` varchar(255) NOT NULL,
        `bookform_number` int(11) NOT NULL,
        `bookform_numberofpeople` int(11) NOT NULL,
        `bookform_additionalnotes` varchar(255) NOT NULL,
        `status` BOOLEAN NOT NULL,

        PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    if (!mysqli_query($connection, $sql)) {
        echo "Error: " . mysqli_error($connection);
    } 

    // ============================ currentselection ==========================
    $sql = "CREATE TABLE IF NOT EXISTS `userlogindb`.`currentselection` (
        `id` int(32) NOT NULL,
        `appointmentDate` date NOT NULL,
        `pickedSlotFrom` time NOT NULL,
        `pickedSlotUntil` time NOT NULL,
        `bookform_name` VARCHAR(100) NOT NULL, 
        `bookform_number` INT NOT NULL , 
        `bookform_numberofpeople` INT NOT NULL , 
        `bookform_additionalnotes` VARCHAR(500) NOT NULL ,
        PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    if (!mysqli_query($connection, $sql)) {
        echo "Error: " . mysqli_error($connection);
    }

// =================================== ADD FOREIGN KEY =====================================
$sql = "ALTER TABLE `userlogindb`.`appointmentslot` DROP CONSTRAINT IF EXISTS `view1`;";
if (!mysqli_query($connection, $sql)) {
    echo "Error: " . mysqli_error($connection);
}

$sql = "ALTER TABLE `userlogindb`.`appointmentslot` ADD CONSTRAINT `view1` 
FOREIGN KEY (`customerID`) REFERENCES `userlogin`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;";
if (!mysqli_query($connection, $sql)) {
    echo "Error: " . mysqli_error($connection);
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


// ==================================================================================
// DUMMY CODE FOR REPORTING MODULE (SLOT FULL)
// ==================================================================================


$dummyCodeInitialise = false;

// $dummyCodeInitialise = true;

if($dummyCodeInitialise){

echo "dummyCodeInitialise: true<br>";

// 2018
$sql = "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-1-12', 1, '17:00:00', '19:00:00', bookform_name, 1, 2, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-1-02', 1, '13:00:00', '15:00:00', bookform_name, 1, 5, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-2-01', 1, '09:00:00', '11:00:00', bookform_name, 1, 1, 'bookform_additionalnotes1');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-2-01', 1, '09:00:00', '11:00:00', bookform_name, 1, 4, 'bookform_additionalnotes1');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-5-02', 1, '11:00:00', '13:00:00', bookform_name, 1, 4, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-7-02', 1, '13:00:00', '15:00:00', bookform_name, 1, 2, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-7-03', 1, '13:00:00', '15:00:00', bookform_name, 1, 3, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-12-03', 1, '17:00:00', '19:00:00', bookform_name, 1, 1, 'bookform_additionalnotes3');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2018-12-12', 1, '17:00:00', '19:00:00', bookform_name, 1, 1, 'bookform_additionalnotes4');";

// 2019
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2019-2-01', 1, '09:00:00', '11:00:00', bookform_name, 1, 1, 'bookform_additionalnotes1');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2019-5-02', 1, '11:00:00', '13:00:00', bookform_name, 1, 4, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2019-7-02', 1, '13:00:00', '15:00:00', bookform_name, 1, 4, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2019-7-03', 1, '13:00:00', '15:00:00', bookform_name, 1, 5, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2019-12-03', 1, '17:00:00', '19:00:00', bookform_name, 1, 2, 'bookform_additionalnotes3');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2019-12-12', 1, '17:00:00', '19:00:00', bookform_name, 1, 4, 'bookform_additionalnotes4');";

// 2020
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-1-01', 1, '09:00:00', '11:00:00', bookform_name, 1, 1, 'bookform_additionalnotes1');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-1-02', 1, '09:00:00', '11:00:00', bookform_name, 1, 1, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-1-02', 1, '13:00:00', '15:00:00', bookform_name, 1, 4, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-1-03', 1, '17:00:00', '19:00:00', bookform_name, 1, 2, 'bookform_additionalnotes3');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-1-04', 1, '09:00:00', '11:00:00', bookform_name, 1, 2, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-3-04', 1, '09:00:00', '11:00:00', bookform_name, 1, 5, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-3-05', 1, '09:00:00', '11:00:00', bookform_name, 1, 3, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-5-05', 1, '09:00:00', '11:00:00', bookform_name, 1, 1, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-6-06', 1, '09:00:00', '11:00:00', bookform_name, 1, 2, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-8-05', 1, '09:00:00', '11:00:00', bookform_name, 1, 4, 'bookform_additionalnotes4');";

// 2021
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2021-1-02', 1, '09:00:00', '11:00:00', bookform_name, 1, 2, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2020-1-02', 1, '13:00:00', '15:00:00', bookform_name, 1, 2, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2021-3-04', 1, '09:00:00', '11:00:00', bookform_name, 1, 1, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2021-3-05', 1, '09:00:00', '11:00:00', bookform_name, 1, 1, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2021-7-02', 1, '13:00:00', '15:00:00', bookform_name, 1, 5, 'bookform_additionalnotes2');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2021-12-05', 1, '09:00:00', '11:00:00', bookform_name, 1, 5, 'bookform_additionalnotes4');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2021-12-02', 1, '13:00:00', '15:00:00', bookform_name, 1, 2, 'bookform_additionalnotes2');";

// 2022
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2022-11-01', 1, '11:00:00', '13:00:00', bookform_name, 1, 1, 'bookform_additionalnotes5');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2022-11-01', 1, '13:00:00', '15:00:00', bookform_name, 1, 4, 'bookform_additionalnotes6');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2022-10-01', 1, '15:00:00', '17:00:00', bookform_name, 1, 5, 'bookform_additionalnotes7');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2022-11-02', 1, '17:00:00', '19:00:00', bookform_name, 1, 3, 'bookform_additionalnotes8');";
$sql .= "INSERT INTO `userlogindb`.`appointmentslot` (
    appointmentDate, customerID , availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes)
VALUES ('2022-7-02', 1, '13:00:00', '15:00:00', bookform_name, 1, 2, 'bookform_additionalnotes2');";

if (mysqli_multi_query($connection, $sql)){
    echo "2018-2022: New records created successfully<br>";
}else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}else{
    echo "dummyCodeInitialise: false<br>";
}

    

// ==================================================================================
// ==================================================================================
// ==================================================================================


mysqli_close($connection);  
?>

</html>

<?php
echo "<script src='../notification_module/public/notification_page.js'></script>";
echo "<script src='../notification_module/public/ajax.js'></script>";
include_once('../notification_module/public/popUp.php');
?>
