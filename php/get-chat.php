<?php
  session_start();
  if(isset($_SESSION['unique_id'])){
      include_once "config.php";
      $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
      $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
      $output = "";

      $sql = "SELECT  * FROM messages WHERE (outgoig_msg_id LIKE '$outgoing_id' AND incoming_msg_id LIKE '$incoming_id')
              OR (outgoig_msg_id LIKE'$incoming_id' AND incoming_msg_id LIKE '$outgoing_id') ORDER BY time ASC";
      $query = mysqli_query($conn, $sql);
      if(mysqli_num_rows($query)>0){
          while($row = mysqli_fetch_assoc($query)){
              if($row['outgoig_msg_id'] === $outgoing_id){
                  $output.='<div class="chat outgoing">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                            </div>';
              }else{//he is a message receiver
                $output = ' <div class="chat incoming">
                            <img src="img/06.JPG" alt="">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                            </div>';
              }
          }
          echo $output;
      }
  }else{
      header("../login.php");
  }
?>