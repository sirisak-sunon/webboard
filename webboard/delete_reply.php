<?php
  include('connectdb.php');
  session_start();
  $id_q = $_SESSION['show_board_id_q'];
  $page = $_SESSION['show_board_page'];
  $id_r = $_GET['id_r'];
  echo"$id_r";
  $a = "delete from reply where r_no = $id_r";
  $result_r = mysqli_query($con , $a);

  if($result_r){
    echo"<Meta http-equiv='refresh'content='0;URL=show_board.php?q_no=$id_q&&page=$page'>";
  }
  else
  {
    echo"ไม่สามารถลบได้".mysqli_error($con);
  }

?>
