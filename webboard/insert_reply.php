<?php
  session_start();
  include('connectdb.php');
  if(isset($_POST['r_user_reply']))
  {
    $r_user_reply = $_POST['r_user_reply'];
  }
  else
  {
    $r_user_reply = "";
  }
  $id_q = $_SESSION['show_board_id_q'];
  $page = $_SESSION['show_board_page'];
  $a_no = $_POST['a_no'];
  $r_detail = $_POST['r_detail'];
  $r_user = $_SESSION['user'];

  // echo"id_q = $id_q , page = $page , a_no = $a_no , r_detail = $r_detail , r_user_reply = $r_user_reply";

  $q = "insert into reply values (null,$a_no,'$r_detail','$r_user_reply','$r_user',null)";
  $result_r = mysqli_query($con , $q);
  if($result_r){
    echo"<Meta http-equiv='refresh'content='0;URL=show_board.php?q_no=$id_q&&page=$page'>";
  }
  else {
    echo"ไม่สามารถบันทึกข้อมูลได้".mysqli_error($con);
  }
?>
