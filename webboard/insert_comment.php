<?php
  session_start();
  include('connectdb.php');
  $q_no = $_POST['id'];
  $a_detail = $_POST['conment'];
  $a_user = $_SESSION['user'];

  $query = "insert into answer values (null,'$q_no','$a_detail','$a_user',null)";
  $result = mysqli_query($con , $query);
  if($result){
    echo"<Meta http-equiv='refresh'content='0;URL=show_board.php?q_no=$q_no&&page=1'>";
  }
  else {
    echo"เพิ่มไม่ได้".mysqli_error($con);
  }
?>
