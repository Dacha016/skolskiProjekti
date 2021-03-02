<?php
require_once "connection.php";
$sql="ALTER TABLE profiles
ADD bio TEXT";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
?>