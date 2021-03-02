<?php
require_once "connection.php";
require_once "helloBar.php";
?>
    <div class="container-fluid wrapper register row">
        <div class="col-12 text-center">
            <h3>Registration</h3>
        </div>
<?php
//form validation
            $name=$surname=$gender=$date=$username=$pass=$rPass="";
            $nameErr=$surnameErr=$usernameErr=$dateErr=$passErr=$rPassErr=$success=$error="";
            if($_SERVER["REQUEST_METHOD"]=="POST"){
//name
                if(empty($_POST['name'])){
                $nameErr="Name field is empty";
                }
                elseif(!ctype_alpha($_POST["name"]) && preg_match("/\t|\s/",$_POST["name"])){
                    if(preg_match("/\t|\s{2,}/",$_POST["name"])){
                        $name=trim(preg_replace("/\t|\s{2,}/"," ",$_POST["name"]));
                    }
                    else{
                        $nameErr="Name can contain only letters";
                    }
                }
                elseif(preg_match("/\t|\s{2,}/",$_POST["name"])){
                    $name=trim(preg_replace("/\t|\s{2,}/"," ",$_POST["name"]));
                }
                elseif(!ctype_alpha($_POST["name"])){
                    $nameErr="Name can contain only letters";
                }
                elseif(strlen($_POST["name"])>50){
                    $nameErr="Too long entry";
                }
                else{
                    $name= trim($_POST['name']);
                }
//surname
                if(empty($_POST['surname'])){
                    $surnameErr="Surname field is empty";
                }
                elseif(!ctype_alpha($_POST["surname"]) && preg_match("/\t|\s/",$_POST["surname"])){
                    if(preg_match("/\t|\s{2,}/",$_POST["surname"])){
                        $surname=trim(preg_replace("/\t|\s{2,}/"," ",$_POST["surname"]));
                    }
                    else{
                        $surnameErr="Surname can contain only letters";
                    }
                }
                elseif(preg_match("/\t|\s{2,}/",$_POST["surname"])){
                    $surname=trim(preg_replace("/\t|\s{2,}/"," ",$_POST["surname"]));
                }
                elseif(!ctype_alpha($_POST["surname"])){
                    $surnameErr="Surname can contain only letters";
                }
                elseif(strlen($_POST["surname"])>50){
                    $surnameErr="Too long entry";
                }
                else{
                    $surname= trim($_POST['surname']);
                }
//gender
                $gender=$_POST["gender"];
//date of birth
                if($_POST["date"]==NULL){
                    $date="0000-00-00";
/*php validate*/}
/*min date not*/elseif($_POST["date"]<"1900-01-01"){
/*working if  */    $dateErr="Enter a valid date";
/*declare     */}
/*min-date in */else{
/*form        */    $date=$_POST["date"];
                }
//username
                if(empty($_POST["username"])){
                    $usernameErr="Username field is empty";
                }
                elseif(strpos($_POST["username"], ' ')){
                    $usernameErr="Username can not contain spaces";
                }
                elseif(strlen($_POST["username"])<5 || strlen($_POST["username"])>50){
                    $usernameErr="Inappropriate length";
                }
                else{
                    $username=$_POST['username'];
                }
//password
                if(empty($_POST["password"])){
                    $passErr="Password field is empty";
                }
                elseif(strpos($_POST["password"], ' ')){
                    $passErr="Password can not contain spaces";
                }
                elseif(strlen($_POST["password"])<5 || strlen($_POST["password"])>25){
                    $passErr="Inappropriate length";
                }
                else{
                    $pass=$_POST['password'];
                }
//retype password
                if(empty($_POST['rPassword'])){
                    $rPassErr="Enter password";
                }
                elseif($_POST["rPassword"]===$_POST["password"] ){
                    $rPass=$_POST['rPassword'];
                }
                else{
                    $rPassErr="Passwords don't match ";
                }
            }
            if($name!="" && $surname!="" &&$gender !="" && $username!="" && $pass!="" &&$rPass!="" && $pass==$rPass){
                $name=$conn->real_escape_string($_POST['name']);
                $surname=$conn->real_escape_string($_POST['surname']);
                $username=$conn->real_escape_string($_POST['username']);
                $name=$conn->real_escape_string($_POST['name']);
                $pass=md5($pass);
                $sql="SELECT username FROM users
                    WHERE username='$username'";
                $result=$conn->query($sql);
                if($result->num_rows!=0){
                    $error="Used username";
                }
                else{
                    $sql ="INSERT INTO users(username,pass)
                        VALUES
                        ('$username','$pass');";
                    $conn->query($sql);
                    $sql = "SELECT id 
                        FROM users
                        WHERE username = '$username'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $id = $row['id'];
                    $sql ="INSERT INTO profiles(name,surname,gender,dob,users_id)
                        VALUES
                        ('$name','$surname','$gender','$date','$id');";
                    if($conn->query($sql)) { 
                        $success= "The user has been added to the database"; 
                    }
                    else { 
                        $error="Error " . $conn->error; 
                    }
                }
                $name=$surname=$gender=$date=$username=$pass=$rPass="";
                $nameErr=$surnameErr=$usernameErr=$dateErr=$passErr=$rPassErr="";
            }
            ?>
            <form action="#" method="POST">
                <div class="form col-12 change">
                    <p>
                        <label for="">Name: </label>
                        <input type="text" name="name" id="" value="<?php echo $name;?>" placeholder=" max 50 characters">
                        <span class="error">&nbsp *<?php echo $nameErr;?></span>
                    </p>
                    <p>
                        <label for="">Surname: </label>
                        <input type="text" name="surname" id="" value="<?php echo $surname;?>" placeholder=" max 50 characters">
                        <span class="error">&nbsp *<?php echo $surnameErr;?></span>
                    </p>
                    <p>
                        <label for="">Gender: </label>
                        <input type="radio" name="gender"  value="M">Male
                        <input type="radio" name="gender"  value="F">Female
                        <input type="radio" name="gender"  value="O" checked>Other
                    
                    </p>
                    <p>
                        <label for="">Date of birth: </label>
                        <input type="date"  name="date" id="" value="<?php echo $date;?>">
                        <span class="error">&nbsp *<?php echo $dateErr;?></span>
                    </p>
                    <p>
                        <label for="">Username: </label>
                        <input type="text" name="username" id="" value="<?php echo $username;?>" placeholder="5-50 characters">
                        <span class="error">&nbsp *<?php echo $usernameErr;?></span>
                    </p>
                    <p>
                        <label for="">Password: </label>
                        <input type="password" name="password" id="" value="<?php echo $pass;?>" placeholder="5-25 characters">
                        <span class="error">&nbsp *<?php echo $passErr;?></span>
                    </p>
                    <p>
                        <label for="">Retype password: </label>
                        <input type="password" name="rPassword" id="" value="">
                    <span class="error">&nbsp *<?php echo $rPassErr;?></span>
                    </p>
                    <p>
                        <input type="submit" name="Submit" value="Submit">
                    </p>
                    <p class="success"><?php echo $success;?></p>
                    <p class="error"><?php echo $error;?></p>
                </div>
            </form>
        </div>
    </body>
</html>