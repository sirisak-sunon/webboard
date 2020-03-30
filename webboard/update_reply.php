<?php
  include('connectdb.php');
  session_start();
  $q_no = $_POST['q_no'];
  $r_no = $_POST['r_no'];
  $a_no = $_POST['a_no'];
  $r_detail = $_POST['r_detail'];
  $r_user = $_SESSION['user'];
  $page = $_POST['page'];

  $query = "update reply set a_no=$a_no,r_no=$r_no,r_detail='$r_detail',r_user='$r_user',r_date=null where r_no = $r_no";
  $result = mysqli_query($con , $query);
  if($result){
    echo"<Meta http-equiv='refresh'content='0;URL=show_board.php?q_no=$q_no&&page=$page'>";
  }
  else{
    echo"ไม่สำเร็จ".mysqli_error($con);
  }
?>
