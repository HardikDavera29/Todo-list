<?php
    $server = "localhost";
    $user = "root";
    $password="";
    $database = "todo";
    $con = mysqli_connect("localhost","root","","todo");
    if(!$con) die("not connected".mysqli_connect_error());
?>