<?php
require_once "connection.php";
require_once "helloBar.php";
$usernameErr=$passErr="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$conn->real_escape_string($_POST['username']);
    $pass=$conn->real_escape_string($_POST['password']);
    $val=true;
    if(!$username){
        $val=false;
        $usernameErr="Empty usernmae";
    }
    if(!$pass){
        $val=false;
        $passErr="Empty password";
    }
    if($val){
// pokusaj logovanja korisnika ako su sva polja forme nepraznma
        $sql="SELECT * FROM users WHERE username='$username'";
        $result=$conn->query($sql);
        if($result->num_rows==0){
            $usernameErr="Username doesn't exist";
        }
        else{
            $row=$result->fetch_assoc();
            $dbPass=$row['pass'];
            if($dbPass!=md5($pass)){
                $passErr="Incorrect password";
            }
            else{
// konkretno logovanje
                $sql1="SELECT CONCAT(name,' ',surname) AS 'imePrezime', users_id FROM profiles INNER JOIN users ON profiles.users_id=users.id WHERE username='$username'";
                $result1=$conn->query($sql1);
                $row1=$result1->fetch_assoc();
                $_SESSION['id']=$row1['users_id'];
                $_SESSION['imePrezime']=$row1['imePrezime'];
                header('Location: followers.php');
            }
        }
    }
}
?>
    <div class="register container-fluid wrapper row ">
        <div class="col-12 ">
            <h3 class=" d-flex justify-content-center align-items-center p-3">Log in:</h3>
            <p class="d-flex justify-content-center align-items-center">Log in and start the fun. The sky is the limit</p>
        <div>
        <form class="form col-12 " action="#" method="POST">
            <p>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
                <span class="error"><?php echo $usernameErr?></span>
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
                <span class="error"><?php echo $passErr?></span>
            </p>
            <p>
                <input type="submit" name="submit">
            </p>
           
        </form>
    </div>
</body>
</html>