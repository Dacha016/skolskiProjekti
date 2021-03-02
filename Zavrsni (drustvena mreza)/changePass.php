<?php
require_once "connection.php";
require_once "helloBar.php";
require_once "header.php";

$id = $_SESSION['id'];
$oldPass=$password=$rPassword=$success="";
$oPassErr=$passErr=$rPassErr=$error="";
//get pass from base
$sql="SELECT pass FROM users";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$pass=($row['pass']);

//get values from form
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $oldPass=md5($_POST['password']);
    $password=$_POST['nPassword'];
    $rPassword=$_POST['rPassword'];
//old password
    if($pass !=$oldPass){
        $oPassErr="Incorrect password";
    }
//new password
    if(empty($_POST['nPassword'])){
        $passErr="Insert password";
    }
    elseif(strpos($_POST["nPassword"], ' ')){
        $passErr="Password can not contain spaces";
    }
    elseif(strlen($_POST["nPassword"])<5 || strlen($_POST["nPassword"])>25){
        $passErr="Inappropriate length";
    }
    else{
        $password=$_POST['nPassword'];
    }
//retype password
    if(empty($_POST['rPassword'])){
        $rPassErr="Enter password";
    }
    elseif($_POST["rPassword"]===$_POST["nPassword"] ){
        $rPassword=$_POST['rPassword'];
    }
    else{
        $rPassErr="Passwords don't match ";
    }
    if($password!="" && $rPassword!=""){
        $sql="UPDATE users
            SET pass=md5('$password')
            WHERE id=$id";
            $result=$conn->query($sql);
            $success="The password has been changed";
    }
    else{
        $error="Password not changed";
    }
}
$oldPass=$password=$rPassword="";
?>
<div class ="container-fluid wrapper register row">
    <div class="col-12 text-center">
        <h3>Change password</h3>
    </div>
    <form  class="form col-12 change" action="" method="POST">
        <p>
            <label for="">Old password: </label>
            <input type="passwors" name="password" id="" >
            <span class="error">&nbsp *<?php echo $oPassErr;?></span>
        </p>
        <p>
            <label for="">New password: </label>
            <input type="password" name="nPassword" id=""  placeholder=" max 25 characters">
            <span class="error">&nbsp *<?php echo$passErr;?></span>
        </p>
        <p>
            <label for="">Retype new password: </label>
            <input type="password" name="rPassword"  >
            <span class="error">&nbsp *<?php echo$rPassErr;?></span>
            
        </p>
        <p>
        <input type="submit" name="Submit" value="Submit">
        </p>
    </form>
    <div>
        <p class="success"><?php echo $success;?></p>
        <p class="error"><?php echo $error;?></p>
    </div>
</div>
</body>
</html>