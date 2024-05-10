<?php
   include "configuration.php";

   if($_GET['id'])
   {
        $n = $_GET['id'];
        $delete = "DELETE FROM `todo1` WHERE `id`=$n";
      
        $run = mysqli_query($con,$delete);
        header("location:index.php");
   }
  
?>