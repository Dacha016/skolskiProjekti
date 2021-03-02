<?php
require_once "connection.php";
require_once "helloBar.php";
if(isset($_SESSION['id'])){
    header("Location:followers.php");
}
?>
    </div>
    <div id="info-div" class="container-fluid wrapper row ">
        <div id="info" class="col-12 col-sm-5">
            <h1 >Welcome to Place</h1>
            <h3 >Create a profile and start having fun!</h3>
            <img id="index-img" src="../images/conn.jpeg">
        </div>
        <div id="log"class="col-12 col-sm-7">
            <div id="loging-div"class="m-3">
                <div class=" d-flex justify-content-center align-items-center">
                    <h3>Log in</h3>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
                    <button class="button"><a href="login.php">Log in</a></button>
                </div>
            </div>
            <div id="registration-div" class="m-3">
                <div class=" d-flex justify-content-center align-items-center">
                    <h3>If you have not registered yet?</h3>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
                    <button class="button"><a href="register.php">Sign up</a></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    
        
 