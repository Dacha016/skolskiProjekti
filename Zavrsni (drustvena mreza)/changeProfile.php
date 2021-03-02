<?php
require_once "connection.php";
require_once "helloBar.php";
require_once "header.php";
$id = $_SESSION["id"];
//Postavljanje početnih vrednosti
$name = $surname = $gender = $date = $bio = "";
$nameErr = $surnameErr = $dateErr = $bioErr =  "";
$q = "SELECT * FROM profiles WHERE users_id = $id";
$result = $conn->query($q);
$row = $result->fetch_assoc();
$name = $row['name'];
$surname = $row['surname'];
$gender = $row['gender'];
$dob = $row['dob'];
$bio = $row['bio'];
if($_SERVER["REQUEST_METHOD"]=="POST"){ 
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
        if(empty($bio)){
            $bio=$_POST['bio'];
        }
        else{
            $bio=$_POST['bio'];
        }

        
    if($name!="" || $surname!=""){
        $sql="UPDATE profiles 
            SET name ='$name',  
            surname ='$surname',  
            gender='$gender',  
            dob='$date',
            bio='$bio'
            WHERE users_id=$id";
            $result=$conn->query($sql);

        $sql1="SELECT CONCAT(name,' ',surname) AS 'imePrezime', users_id FROM profiles INNER JOIN users ON profiles.users_id=users.id WHERE users_id=$id";
            $result1=$conn->query($sql1);
            $row1=$result1->fetch_assoc();
            $_SESSION['imePrezime']=$row1['imePrezime'];
            header('Location: changeProfile.php');
            if($conn->query($sql)) { 
                $success= "The user has been added to the database"; 
            }
            else { 
                $error="Error " . $conn->error; 
            }
    } 
    else { 
        $error="Error " . $conn->error; 
    }
}
?>
<div class="wrapper container-fluid row register">
    <div class="col-12 text-center"> 
        <h3>Change profiles info</h3>
    </div>
    <form action="#" method="post">
        <div class="form change">
            <p>
                Name:
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
            </p>
            <p>
                Surname:
                <input type="text" name="surname" value="<?php echo $surname; ?>">
                <span class="error">* <?php echo $surnameErr; ?></span>
            </p>
            <p>
                Gender:
                <input type="radio" name="gender" value="M" <?php if($gender=="M"){echo 'checked';} ?>>Male
                <input type="radio" name="gender" value="F" <?php if($gender=="F"){echo 'checked';} ?>>Female
                <input type="radio" name="gender" value="O" <?php if($gender!="M" && $gender!="F"){echo 'checked';} ?>>Other
            </p>
            <p>
                Data of birth:
                <input type="date" name="date" value="<?php echo $dob; ?>">
                <span class="error"><?php echo $dateErr; ?></span>
            </p>
            <p>
                Bio:
                <textarea type="text" name="bio" value="<?php echo $bio; ?>"><?php echo $bio; ?></textarea>
                <span class="error"><?php echo $bioErr; ?></span>
                
            </p>
            <p>
                <input type="submit" value="Submit">
            </p>
        </div>
    </form>
</body>
