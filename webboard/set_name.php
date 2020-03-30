<?php
  session_start();
  if(!isset($_SESSION['user'])){
    $_SESSION['user'] = $_POST['user'];
    // echo $_SESSION['user'];
    echo"<Meta http-equiv='refresh'content='0;URL=form_board.php?page=1'>";
  }
  else{
    echo"เงื่อนไขไม่ถูกต้อง";
  }
?>
