<?php 
session_start();
if(isset($_SESSION['imePrezime'])){
    $imePrezime=$_SESSION['imePrezime'];
}
else{
    $imePrezime="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Place</title>
</head>
<body>
    <div class="container-fluid wrapper header">
        <h3 id="headline" class="d-inline" >
            <a  href="index.php">Place</a>
        </h3>
        <h3 id="loged-user" >Hello <?php echo $imePrezime;?><h3>
        </div>
    </div>