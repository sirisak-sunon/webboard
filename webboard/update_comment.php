<?php
  include('connectdb.php');
  session_start();
  $q_no = $_POST['q_no'];
  $a_no = $_POST['a_no'];
  $a_detail = $_POST['detail'];
  $a_user = $_SESSION['user'];
  $page = $_POST['page'];

  $query = "update answer set a_no=$a_no , q_no=$q_no , a_detail='$a_detail' , a_user='$a_user' , a_date=null where a_no = $a_no";
  $result = mysqli_query($con , $query);
  if($result){
    echo"<Meta http-equiv='refresh'content='0;URL=show_board.php?q_no=$q_no&&page=$page'>";
  }
  else{
    echo"ไม่สำเร็จ";
  }
?>
