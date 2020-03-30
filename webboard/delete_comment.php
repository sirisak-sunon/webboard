<?php
  include('connectdb.php');
  session_start();
  $id_q = $_SESSION['show_board_id_q'];
  $page = $_SESSION['show_board_page'];
  $a_no = $_GET['id_a'];
  echo"$a_no";
  $a = "delete from answer where a_no = $a_no";
  $result_a = mysqli_query($con , $a);

  $r = "delete from reply where a_no = $a_no";
  mysqli_query($con , $r);

  if($result_a){
    echo"<Meta http-equiv='refresh'content='0;URL=show_board.php?q_no=$id_q&&page=$page'>";
  }
  else
  {
    echo"ไม่สามารถลบได้".mysqli_error($con);
  }
