<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin View Feedback</title>
		<link rel="stylesheet" href="../LoginModule/login_css.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
    <a href="../HomeModule/adminfeedback.php"><button id="back">Admin Homepage</button></a>
    <h1 class="centertitle"><b>Admin View Feedback</b></h1>
    <?php
    
        include_once 'submitFeedback.php';
        //connection to DB
        $connection = mysqli_connect("localhost", "root", "", "userlogindb");
        if (!$connection) {
            die("Failed ". mysqli_connect_error());
        }
        //select whole feedback table
        $result = mysqli_query($connection,"SELECT * FROM `feedback`;");
        // echo mysqli_num_rows($result);
        if (mysqli_num_rows($result) == 0){
            echo'
            <div class="centerGray"> 
            Nothing to show.
            No feedback Yet.
            <button class=button onclick=history.back()>Go Back</button>
            </div>
            ';
        }
        while($row = mysqli_fetch_array($result)){
            // echo $row['replyfeedback'];
            $empty = 0;
            if ($row['replyfeedback'] == ''){
                $empty = 1;
                $oldfb = $row['replyfeedback'];
                // echo $empty;
            }
            else{
                $empty = 0;
                $oldfb = $row['replyfeedback'];
                // echo $oldfb;
                // echo $empty;
                // echo $row['replyfeedback'];
            }
            //rating
            $rating = 0;
            if($row['rating'] == "awful"){
                $rating = 1;
            }
            else if($row['rating'] == "poor"){
                $rating = 2;
            }
            else if($row['rating'] == "neutral"){
                $rating = 3;
            }
            else if($row['rating'] == "good"){
                $rating = 4;
            }
            else if($row['rating'] == "excellent"){
                $rating = 5;
            }
            else{
                $rating = 000000000;//error
            }
            echo '
            <div id="'.$row['id'].'" class="showFeedback">
                <p>'.$row['name'].'</p>    
                <div class="rating"> 
                    Rating: 
                    <span>'.$row['rating'].'</span>
                    <br>
                    <span id="star1'.$row['id'].'" class="fa fa-star"></span>
                    <span id="star2'.$row['id'].'" class="fa fa-star"></span>
                    <span id="star3'.$row['id'].'" class="fa fa-star"></span>
                    <span id="star4'.$row['id'].'" class="fa fa-star"></span>
                    <span id="star5'.$row['id'].'" class="fa fa-star"></span>
                    <span class="number">'.$rating.'/5</span>
                </div>
                <span class="datetimefb">'.$row['datetime'].'</span>
                <div class="feedbackBox">
                    <p class="fb">'.$row['feedback'].'</p> 
                </div>
                <div id="replyfeedback'.$row['id'].'">
                    <p style="margin-left: 20px"> Admin reply: </p>
                    <div style="margin-left: 20px" class="feedbackBox">
                        <p class="fb">'.$row['replyfeedback'].'</p> 
                    </div>
                </div>
                <br><br>

                
                <a id="replybtn'.$row['id'].'" href="javascript:void(0);" onclick="openForm'.$row['id'].'();">Reply</a>
                <div class="popup" id="POPreply'.$row['id'].'">
                <form action="submitfeedback.php" class="cmtpop" method="post">
                <input type="hidden" id="FBid" name="id" value="'.$row['id'].'">
                <input type="hidden" id="oldfb" name="oldfb" value="'.$oldfb.'">
                <br><br><br><br><br>
                <textarea class="replyfb" placeholder="Reply Feedback..." name="replyfb" required=""></textarea>
                <button class="submitfb" type="submit" name="reply_feedback">Submit</button>                        
                </form>
                <a id="closecmt'.$row['id'].'" style="background-color: red; display: none;" href="javascript:void(0);" onclick="closeForm'.$row['id'].'();">Close</a>
                </div>
            </div>
            <br>
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top ⇧</button>
            <script>
                
                if ('.$rating.'== 1){
                    document.getElementById("star1'.$row['id'].'").className = "fa fa-star checked";
                }
                else if('.$rating.'== 2){
                    document.getElementById("star1'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star2'.$row['id'].'").className = "fa fa-star checked";
                }
                else if('.$rating.'== 3){
                    document.getElementById("star1'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star2'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star3'.$row['id'].'").className = "fa fa-star checked";
                }
                else if('.$rating.'== 4){
                    document.getElementById("star1'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star2'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star3'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star4'.$row['id'].'").className = "fa fa-star checked";
                }
                else if('.$rating.'== 5){
                    document.getElementById("star1'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star2'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star3'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star4'.$row['id'].'").className = "fa fa-star checked";
                    document.getElementById("star5'.$row['id'].'").className = "fa fa-star checked";
                }
                var mt'.$row['id'].' = '.$empty.';
                if ( mt'.$row['id'].' == 1){
                    document.getElementById("replyfeedback'.$row['id'].'").style.display = "none";
                    
                }
                function openForm'.$row['id'].'() {
                    document.getElementById("POPreply'.$row['id'].'").style.display = "block";
                    document.getElementById("replybtn'.$row['id'].'").style.display = "none";
                    document.getElementById("closecmt'.$row['id'].'").style.display = "block";
                }
                function closeForm'.$row['id'].'() {
                    document.getElementById("POPreply'.$row['id'].'").style.display = "none";
                    document.getElementById("replybtn'.$row['id'].'").style.display = "block";
                    document.getElementById("closecmt'.$row['id'].'").style.display = "none";
                }
            </script>
            ';
            
        }
        mysqli_close($connection);
    ?>
    <script>
        // Get the button
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } 
            else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</html>

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>