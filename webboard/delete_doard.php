<?php
  include('connectdb.php');
  $id = $_GET['id'];
  $page = $_GET['page'];
  $q = "delete from question where q_no = $id";
  $result_q = mysqli_query($con , $q);
  $a = "delete from answer where q_no = $id";
  $result_a = mysqli_query($con , $a);

  if($result_a){
    echo"<Meta http-equiv='refresh'content='0;URL=form_board.php?page=$page'>";
  }
  else
  {
    echo"ไม่สามารถลบได้".mysqli_error($con);
  }

?>
