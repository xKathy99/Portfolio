<script>
    var conn = new WebSocket('ws://localhost:8080');
var flag=false
var data;
</script>
<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$dbname = "userlogindb";

$conn = mysqli_connect($server_name, $user_name, $password, $dbname);

if (!$conn) {
    die("Failed ". mysqli_connect_error());
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if (isset($_POST['PreLogInBook_Customer_date'])) {

    $sql = "SELECT * FROM `userlogindb`.`currentselection`";
    $result = mysqli_query($conn, $sql);

    $currentselectedTime = "";         

    if(mysqli_num_rows($result)>0){
        $sql = "UPDATE `userlogindb`.`currentselection` SET `appointmentDate` = '$_POST[PreLogInBook_Customer_date]' WHERE id=1";
        if(!mysqli_query($conn, $sql)){
            echo "Error";
        }
    }else{
        $sql = "INSERT INTO `userlogindb`.`currentselection` (
            `id`,`appointmentDate`) 
            VALUES ('1','$_POST[PreLogInBook_Customer_date]')";
        if(!mysqli_query($conn, $sql)){
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
    }

    // =====================================================
        header('location: 00 PreLogInBook_Customer.php'); 
    // =====================================================

}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if(isset($_POST['PreLogInBook_Customer_time'])){

    $currentselected = ""; 

    $sql = "SELECT * FROM `userlogindb`.`currentselection`";
    $result = mysqli_query($conn,$sql);

    if($result){
        while($row=mysqli_fetch_array($result)){
            $currentselected = $row['appointmentDate'];
        }
    }else{
        echo "result empty";
    }

    // echo $currentselected."<br>"; 
    // echo "$_POST[availableTime]<br>";

    $availableFrom = "";
    $availableUntil = "";

    switch($_POST['availableTime']){
        case 'time1':
            $availableFrom = "09:00:00";
            $availableUntil = "11:00:00";
            break;
        case 'time2':
            $availableFrom = "11:00:00";
            $availableUntil = "13:00:00";
            break;
        case 'time3':
            $availableFrom = "13:00:00";
            $availableUntil = "15:00:00";
            break;
        case 'time4':
            $availableFrom = "15:00:00";
            $availableUntil = "17:00:00";
            break;
        case 'time5':
            $availableFrom = "17:00:00";
            $availableUntil = "19:00:00";
            break;
        default:
            echo "Something Went Wrong";
    }

    $sql = "SELECT * FROM `userlogindb`.`currentselection`";
    $result = mysqli_query($conn, $sql);

    // echo "AvailableFrom: $availableFrom<br>";
    // echo "AvailableUntil: $availableUntil<br>";

    if(mysqli_num_rows($result)>0){
        $sql = "UPDATE `userlogindb`.`currentselection` SET 
        `pickedSlotFrom`='$availableFrom',
        `pickedSlotUntil`='$availableUntil' WHERE 1";

        if(!mysqli_query($conn, $sql)){
            echo "Error";
        }
    }

    // =========================== CHECK LOGIN ===========================
    session_start();

    if (!isset($_SESSION['username'])) { //username not set
        unset($_SESSION['username']);
        session_destroy();
    // =====================================================
        header('location: ../LoginModule/login.php');
    // =====================================================
    }else{
    // =====================================================
        header('location: 01 ViewAvailableSlots_Customer.php');
    // =====================================================
    }

}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if(isset($_POST['ViewAvailableSlots_Customer_date'])){

    $sql = "SELECT * FROM `userlogindb`.`currentselection`";
    $result = mysqli_query($conn, $sql);

    $currentselectedTime = "";         

    if(mysqli_num_rows($result)>0){
        $sql = "UPDATE `userlogindb`.`currentselection` SET `appointmentDate` = '$_POST[ViewAvailableSlots_Customer_date]' WHERE id=1";
        if(!mysqli_query($conn, $sql)){
            echo "Error";
        }
    }else{
        $sql = "INSERT INTO `userlogindb`.`currentselection` (
            `id`,`appointmentDate`) 
            VALUES ('1','$_POST[ViewAvailableSlots_Customer_date]')";
        if(!mysqli_query($conn, $sql)){
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
    }

    // =====================================================
        header('location: 01 ViewAvailableSlots_Customer.php'); 
    // =====================================================

}


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if(isset($_POST['ViewAvailableSlots_Customer_time'])){

    $currentselected = ""; 

    $sql = "SELECT * FROM `userlogindb`.`currentselection`";
    $result = mysqli_query($conn,$sql);

    if($result){
        while($row=mysqli_fetch_array($result)){
            $currentselected = $row['appointmentDate'];
        }
    }else{
        echo "result empty";
    }

    // echo "$_POST[availableTime]<br>";

    $availableFrom = "";
    $availableUntil = "";

    switch($_POST['ViewAvailableSlots_Customer_time']){
        case 'time1':
            $availableFrom = "09:00:00";
            $availableUntil = "11:00:00";
            break;
        case 'time2':
            $availableFrom = "11:00:00";
            $availableUntil = "13:00:00";
            break;
        case 'time3':
            $availableFrom = "13:00:00";
            $availableUntil = "15:00:00";
            break;
        case 'time4':
            $availableFrom = "15:00:00";
            $availableUntil = "17:00:00";
            break;
        case 'time5':
            $availableFrom = "17:00:00";
            $availableUntil = "19:00:00";
            break;
        default:
            echo "Something Went Wrong";
    }

    $sql = "SELECT * FROM `userlogindb`.`currentselection`";
    $result = mysqli_query($conn, $sql);

    // echo "AvailableFrom: $availableFrom<br>";
    // echo "AvailableUntil: $availableUntil<br>";

    if(mysqli_num_rows($result)>0){
        $sql = "UPDATE `userlogindb`.`currentselection` SET 
        `pickedSlotFrom`='$availableFrom',
        `pickedSlotUntil`='$availableUntil' WHERE 1";

        if(!mysqli_multi_query($conn, $sql)){
            echo "Error";
        }
    }

    // =========================== CHECK LOGIN ===========================
    session_start();

    if (!isset($_SESSION['username'])) { //username not set
        unset($_SESSION['username']);
        session_destroy();
    // =====================================================
        header('location: ../LoginModule/login.php');
    // =====================================================
    }else{
    // =====================================================
        header('location: 01 ViewAvailableSlots_Customer.php');
    // =====================================================
    }

}


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


if(isset($_POST['ViewAvailableSlots_Customer_details'])){

    $sql = "UPDATE `userlogindb`.`currentselection` SET 
    `bookform_name` = '$_POST[bookform_name]',
    `bookform_number` = '$_POST[bookform_number]',
    `bookform_numberofpeople` = '$_POST[bookform_numberofpeople]',
    `bookform_additionalnotes` = '$_POST[bookform_additionalnotes]' WHERE 1";


    if(!mysqli_query($conn, $sql)){
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }else{
        header('location: 02 BookingSuccessful_Customer.php');
    }

    $name = $_POST["bookform_name"];
    $number = $_POST["bookform_number"];
    $numberofpeople = $_POST["bookform_numberofpeople"];
    $additionalnotes = $_POST["bookform_additionalnotes"];

    echo $name."</br>";
    echo $number."</br>";
    echo $numberofpeople."</br>";
    echo $additionalnotes."</br>";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if(isset($_POST['BookingSuccessful_Customer_confirmBooking'])){

    $appointmentDate = "";
    $customerID = "";
    $availableSlotFrom = "";
    $availableSlotUntil = "";
    $bookform_name = "";
    $bookform_number = "";
    $bookform_numberofpeople = "";
    $bookform_additionalnotes = "";
    $status = "";

    $sql = "SELECT * FROM `userlogindb`.`userlogin` WHERE 1";
    $result = mysqli_query($conn, $sql);



    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $customerID = $row['id'];
        }
    }else{
        echo "Result Empty";
    }

    $sql = "SELECT * FROM `userlogindb`.`currentselection` WHERE 1";
    $result = mysqli_query($conn, $sql);

    

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $appointmentDate = $row['appointmentDate'];
            $availableSlotFrom = $row['pickedSlotFrom'];
            $availableSlotUntil = $row['pickedSlotUntil'];
            $bookform_name = $row['bookform_name'];
            $bookform_number = $row['bookform_number'];
            $bookform_numberofpeople = $row['bookform_numberofpeople'];
            $bookform_additionalnotes = $row['bookform_additionalnotes'];
            $status = true;
        }
    }else{
        echo "Result Empty";
    }

    echo "appointmentDate: $appointmentDate<br>";
    echo "customerID: $customerID<br>";
    echo "availableSlotFrom: $availableSlotFrom<br>";
    echo "availableSlotUntil: $availableSlotUntil<br>";
    echo "bookform_name: $bookform_name<br>";
    echo "bookform_number: $bookform_number<br>";
    echo "bookform_numberofpeople: $bookform_numberofpeople<br>";
    echo "bookform_additionalnotes: $bookform_additionalnotes<br>";
    echo "status: $status<br>";

    $sql = "INSERT INTO `userlogindb`.`appointmentslot` (
            appointmentDate, customerID, availableSlotFrom, availableSlotUntil, bookform_name, bookform_number, bookform_numberofpeople, bookform_additionalnotes, status)
    VALUES ('$appointmentDate', '$customerID', '$availableSlotFrom', '$availableSlotUntil', '$bookform_name', '$bookform_number', '$bookform_numberofpeople', '$bookform_additionalnotes', '$status');";
    

        $sql2 = "INSERT INTO notification (`type`, `user_id`,`admin_id`,`description`,`status`) VALUES ('appointment has been Scheduled',$customerID,'44','appointment is Scheduled  on date $appointmentDate and time $availableSlotFrom','false')";
                    if ($conn->query($sql2) === TRUE ) {
                        echo "Success";
                    } else {
                      echo "Error: " . $sql2 . "<br>" . $conn->error;
                    }
                        ?>
                    <script>
                    flag=true;
                    data='booking appointment have been cancelled'
                    conn.onopen = function(e)
                    {
                    console.log("Connection established!");
                    conn.send(JSON.stringify({type:'appointment have been Scheduled',user_id:<?php echo $customerID;?>,admin_id:'44',description:'appointment have been Scheduled on'+ new Date('<?php echo $appointmentDate.'T'.$availableSlotFrom; ?>'),status:'false'}));   
                    window.location="02_1 BookingSuccessful_Customer.php";    
                    };

    </script>
<?php

    if(!mysqli_query($conn, $sql)){
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }else{

      //header('location: 02_1 BookingSuccessful_Customer.php');
    }
 
}



if(isset($_POST['reschedule_bookedTime'])){
    
    session_start();

    $_SESSION['reschedule_bookedID'] = $_POST['reschedule_bookedID'];
    
    // echo $_SESSION['reschedule_bookedID'];
    
    header('location: 04_3 Reschedule_Customer.php');

}

if(isset($_POST['BookingSuccessful_Customer_reschedule'])){

    
    header('location: 01 ViewAvailableSlots_Customer.php');
}

if(isset($_POST['cancelBooking'])){

    session_start();

    $_SESSION['userAppointmentDelete'] = $_POST['cancelBookingID'];
    echo $_SESSION['userAppointmentDelete'];


    // =====================================================
    header('location: 04_2 Redo CancelConfirmation_Customer.php'); 
    // =====================================================

}
if(isset($_POST['cancelBooking_cancel'])){
    //  =====================================================
        header('location: ../LoginModule/homepage.php'); 
    //  =====================================================

}

if(isset($_POST['cancelBooking_admin'])){

    session_start();

    $_SESSION['userAppointmentDelete'] = $_POST['cancelBookingID'];
    echo $_SESSION['userAppointmentDelete'];


    // =====================================================
    header('location: A1 CancelConfirmation_Admin.php'); 
    // =====================================================

}

if(isset($_POST['cancelBooking_cancel_admin'])){
    //  =====================================================
        header('location: ../LoginModule/admintest.php'); 
    //  =====================================================

}


if(isset($_POST['cancelBooking_confirm_admin'])){

    
    session_start();

    echo $_SESSION['userAppointmentDelete'];

    if (!isset($_SESSION['username'])) { //username not set
        unset($_SESSION['username']);
        session_destroy();
        echo "You are not logged in!";
    }else{

        $sql = "SELECT * FROM `userlogindb`.`appointmentslot` WHERE `id` LIKE '$_SESSION[userAppointmentDelete]'"; // appointment ID
        $result = mysqli_query($conn,$sql);
    
        if(mysqli_num_rows($result)==1){

            $sql = "DELETE FROM `userlogindb`.`appointmentslot` WHERE `id` LIKE '$_SESSION[userAppointmentDelete]'"; // appointment ID

            if(!mysqli_query($conn,$sql)){
                echo "Cannot cancel: AppointmentID does not exist"; 
            }

            //  =====================================================
                header('location: A2 CancelSuccessful_Admin.php'); 
            //  =====================================================
        }
    }
}

if(isset($_POST['cancelBooking_confirm'])){

    
    session_start();

    echo $_SESSION['userAppointmentDelete'];

    if (!isset($_SESSION['username'])) { //username not set
        unset($_SESSION['username']);
        session_destroy();
        echo "You are not logged in!";
    }else{

        $sql = "SELECT * FROM `userlogindb`.`appointmentslot` WHERE `id` LIKE '$_SESSION[userAppointmentDelete]'"; // appointment ID
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)==1){

            $sql = "DELETE FROM `userlogindb`.`appointmentslot` WHERE `id` LIKE '$_SESSION[userAppointmentDelete]'"; // appointment ID

            if(!mysqli_query($conn,$sql)){
                echo "Cannot cancel: AppointmentID does not exist"; 
            }
            echo "hello";
            
                                while($row3 = $result->fetch_assoc()){    
                                    $date=$row3['appointmentDate'];
                                    $time=$row3['availableSlotFrom'];
                                    $user_id=$row3['customerID'];
                                }
                    $sql2 = "INSERT INTO notification (`type`, `user_id`,`admin_id`,`description`,`status`) VALUES ('booking appointment has been cancelled',$user_id,'44','booking appointment  on date $date and time $time has been cancelled','false')";
                    if ($conn->query($sql2) === TRUE ) {
                        echo "Success";
                    } else {
                      echo "Error: " . $sql2 . "<br>" . $conn->error;
                    }
                        ?>
                    <script>
                    flag=true;
                    data='booking appointment have been cancelled'
                    conn.onopen = function(e)
                    {
                    console.log("Connection established!");
                    conn.send(JSON.stringify({type:'booking appointment have been cancelled',user_id:<?php echo $user_id;?>,admin_id:'44',description:'booking appointment on'+ new Date('<?php echo $date.'T'.$time; ?>')+'has been cancelled',status:'false'}));   
                        window.location="05 CancelSuccessful_Customer.php"
                    };
    </script>
<?php
            

            //  =====================================================
               // header('location: 05 CancelSuccessful_Customer.php'); 
            //  =====================================================
        }
    }
}

if(isset($_POST['admin_choose_date'])){

    echo "$_POST[admin_choose_date]";

    $sql = "SELECT * FROM `userlogindb`.`currentselection`";
    $result = mysqli_query($conn, $sql);

    $currentselectedTime = "";

    if(mysqli_num_rows($result)>0){
        $sql = "UPDATE `userlogindb`.`currentselection` SET `appointmentDate` = '$_POST[admin_choose_date]' WHERE id=1";
        if(!mysqli_query($conn, $sql)){
            echo "Error";
        }
    }else{
        $sql = "INSERT INTO `userlogindb`.`currentselection` (
            `id`,`appointmentDate`)
            VALUES ('1','$_POST[PreLogInBook_Customer_date]')";
        if(!mysqli_query($conn, $sql)){
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
    }

    // //  =====================================================
        header('location: A0_Redo CreateDeleteSlots_Admin.php'); 
    // //  =====================================================
}

?>


