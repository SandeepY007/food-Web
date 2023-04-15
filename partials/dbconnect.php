<?php
$username="root";
$password="";
$database="user2";
$server="localhost";

$conn=mysqli_connect($server,$username,$password,$database);

if(!$conn){
    echo"Not-successful";
}

?>