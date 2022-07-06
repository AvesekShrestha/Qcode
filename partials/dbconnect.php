<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qcode";
$connect = mysqli_connect($servername ,$username , $password ,$database);
if(!$connect){
    die("Sorry cannot connect to database.");
}


?>