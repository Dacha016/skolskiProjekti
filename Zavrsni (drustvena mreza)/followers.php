<?php
require_once "connection.php";
require_once "helloBar.php";
require_once "header.php";
?>
<div class="container-fluid wrapper register row">
<?php
////Log in user
$logId=$_SESSION['id'];
//follow
if(!empty($_GET['follow'])){
    $fId=$conn->real_escape_string($_GET['follow']);
    $sql="SELECT * FROM followers WHERE sender_id=$logId AND receiver_id=$fId";
    $result=$conn->query($sql);
    if($result->num_rows==0){
        $sql="INSERT INTO followers(sender_id,receiver_id) VALUE($logId,$fId)";
        $result1=$conn->query($sql);
        if(!$result){
           echo "<div>Error!".$conn->error."</div>";
        }
    }
}
//unfolow
if(!empty($_GET['unfollow'])){
    $fId=$conn->real_escape_string($_GET['unfollow']);
    $sql="DELETE FROM followers WHERE sender_id=$logId AND receiver_id=$fId";
    $result=$conn->query($sql);
    if(!$result){
        echo "<div>Error!".$conn->error."</div>";
    }
}
if(!empty($_GET['users_id'])){
    $fId=$conn->real_escape_string($_GET['users_id']);
    
}
//table of users
$sql="SELECT profiles.name,profiles.surname ,users.username,users.id  FROM profiles
INNER JOIN users
ON  profiles.users_id=users.id
WHERE users.id!=$logId";
$result=$conn->query($sql);
if($result->num_rows){
    foreach($result as $row){
        echo "<h3 id='followers-headline' class='col-12 m-3'>Followers</h3>";
        echo "<table class='col-12 table table-hover table-dark'>";
            echo"<tr>
                <th>Ime i prezime</th>
                <th>Username</th>
                <th>Akcije</th>
            </tr>";
        foreach($result as $row){
            echo "<tr>";
            $fId=$row['id'];
                echo "<td><a href='profile.php?users_id=$fId'>". $row['name']." ".$row['surname']. "</a></td>";
                echo "<td>". $row['username']. "</td>";
                



//upit da li pratimo korisnika                
                $sql="SELECT * FROM followers WHERE sender_id=$logId AND receiver_id=$fId";
                    $result1=$conn->query($sql);
                    $f1=$result1->num_rows;
//upit da li korisnik prati nas
                $sql2="SELECT * FROM followers WHERE sender_id=$fId AND receiver_id=$logId";
                    $result2=$conn->query($sql2);
                    $f2=$result2->num_rows;
                if($f1==0){
                    if($f2==0){
                        $text ="Follow";
                    }
                    else{
                        $text="Follow back";
                    }
                    echo "<td><a href='followers.php?follow=$fId'>".$text."</a></td>";
                }
                else{
                    echo "<td><a href='followers.php?unfollow=$fId'>Unfollow</a></td>";
                }
               
            echo "</tr>";
        } 
        echo "</table>";   
    }
}
else{
    echo"No users into base!";
}
?>
</div>
</body>
</html>