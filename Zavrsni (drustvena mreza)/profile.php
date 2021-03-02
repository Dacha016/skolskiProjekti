<?php
require_once "connection.php";
require_once "helloBar.php";
require_once "header.php";
?>
<div class=" wrapper container-fluid register">
<?php

    $id = $_GET['users_id'];
    //$id=1;
    $name=$surname=$username=$dob=$gender=$bio="";
    if(empty($id)){
       echo $error="User doesn't exist in base";
    }
    else{
        $sql = "SELECT id FROM users WHERE id = $id";
        $rezultat = $conn->query($sql);
        if(!$rezultat->num_rows)
        {
            echo "<p>There's no user with that ID on Place...</p>";
        }
        else{
            $sql="SELECT * FROM profiles 
                INNER JOIN users 
                ON profiles.users_id=users.id
                WHERE users_id=$id";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $name=$row['name'];
            $surname=$row['surname'];
            $username=$row['username'];
            $dob=$row['dob'];
            if($gender=$row['gender']=="M"){
                $gender=$row['gender'];
                $color="blue";
            }
            elseif($gender=$row['gender']==="O"){
                $gender=$row['gender'];
                $color="grey";
            }
            else{
                $gender=$row['gender'];
                $color="red";
            }
            $bio=$row['bio'];

            echo "<h3 id='followers-headline' class='col-12'>Profiles</h3>";
            echo "<table  class='col-12 table table-hover table-dark'>";
                echo"<tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Username</th>
                    <th>Date of birth</th>
                    <th>Gender</th>
                    <th>About me</th>
                </tr>";
                echo "<tr>";
                    echo "<td style='color:$color'>". $name. "</td>";
                    echo "<td style='color:$color'>". $surname. "</td>";
                    echo "<td style='color:$color'>". $username. "</td>";
                    echo "<td style='color:$color'>". $dob. "</td>";
                    echo "<td style='color:$color'>". $gender. "</td>";
                    echo "<td style='color:$color'>". $bio. "</td>";
                echo "</tr>";
            echo "</table>"; 
            $color="";  
        }
    }

?>
<a href="followers.php">Followers</a>

</div>