<?php echo '
<footer class="footer_box">
    <div class="footer_container">
        <div class="footer_row">
            <div class="footer_content">
                <div class="col_1">
                    <h6>Address</h6>
                    <p>95, Lor Bayan 6<br> 93250 Kuching<br> Sarawak</p>
                    <a class="direction" href="https://maps.app.goo.gl/JXMutwafoKVtamcq9">
                    <i class="fa fa-location-arrow"></i>    
                    Get Direction</a>
                </div>

                <div class="col_2">
                    <h6>Contact Us</h6>
                    <ul>
                        <li><a href="https://api.whatsapp.com/send?phone=%2B60198182834&data=AWCbc55HVcSvs7D_GWeXZru5bdto8S7DLRGrJgJZKdfV1M_hhZNU4zrXHRUNEJvvMk3DjaqgNCf2XDKMWrw7wQ5l6Wnxz9yaEtkN7KLOFo8YqaoHy_6NjiD0UPqXO1ToyA07WeOFc2PFUTGZmZt5RS6ejpeKL0QAcqiHHWdktbu8lkTxEk8IaiILqcn30To0vHEUSqd1TiL4GQqdX9q2-juR5p5B59J1gUHnrsfjEBz_JvjE6CuwSQuYIiLnRiJhoVYpCehZVdNl6wH6inmJ_l9Zmj_76iJslTfr-5l-r_rEQFvbaRlX9z5yCOj0koaATOY&source=FB_Page&app=facebook&entry_point=page_cta&fbclid=IwAR33mahylqr6Kk0gq9jYYqK2ypnNvphzAQDC-0bY4h7H9kiMYNaIzEaDKjw">
                        <i class="fa fa-whatsapp"></i>    
                        019-818 2834</a>
                        </li>
                        <li><a href="mailto:anniepeksf@gmail.com">
                        <i class="fa fa-envelope-o"></i>
                        anniepeksf@gmail.com</a></li>
                        <li><a href="https://www.facebook.com/cactisucculentkch/">
                        <i class="fa fa-facebook"></i>
                        Cacti-Succulent-KCH</a></li>
                        
                    </ul>
                </div>

                <div class="col_3">
                    <ul>
                        
                    </ul>';
                // session_start();
                if(isset($_SESSION['username'])){
                    echo '
                    <script>
                        document.getElementById("showloginfooter").style.display = "none"; 
                        document.getElementById("showlogoutfooter").style.display = "block"; 
                    </script>
                    ';
        
                }
                else{
                    echo '
                    <script>
                        document.getElementById("showloginfooter").style.display = "block"; 
                        document.getElementById("showlogoutfooter").style.display = "none"; 
                    </script>
                    ';
        
                }
                echo '
                </div>
            </div>
            
            <hr>

            <div class="footer_container">
                <div class="footer_row">
                    <div>
                        <p>Copyright &copy; 2022 All rights reserved by
                        <a href="home.php">Cacti Succulent</a>.            
                        </p>
                    </div>
                </div>
            </div>
<!-- 
            <div>
                <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a class="whatsapp" href="#"><i class="fa fa-whatsapp"></i></a></li>   
                </ul>
            </div> -->
        </div>
    </div>
</footer>
';?>