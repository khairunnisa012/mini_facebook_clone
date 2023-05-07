<?php
session_start();
$_SESSION['addr']=$_POST['url'];
header("Location:cmpg.php");
?>