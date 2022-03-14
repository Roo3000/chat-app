<?php
   session_start();
   include_once "config.php";
   $sql = mysqli_query($conn, "SELECT * FROM users");
   $outputs = "";

   if(mysqli_num_rows($sql) == 1){
       $outputs .= "No users are available to chat"; 
   }elseif(mysqli_num_rows($sql)>0){
       include "data.php";
   }
   echo $outputs;
?>