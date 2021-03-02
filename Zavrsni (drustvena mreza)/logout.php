<?php
session_start();
if(isset($_SESSION['id'])){
    //brisanje sesije
    $_SESSION=array();//session_unset() (ugradjena funkcija koja menja isset )
    session_destroy();
    $_SESSION['imePrezime']="";
}
header('Location:index.php');
?>