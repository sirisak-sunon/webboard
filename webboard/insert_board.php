<?php
  session_start();
  include("connectdb.php");
  $topic = $_POST['topic'];
  $detail = $_POST['detail'];
  $category = $_POST['category'];
  $pic = $_FILES['pic']['name'];
  $tag = $_POST['tag'];
  $user = $_SESSION['user'];

  if($pic != ''){
    $pic = "../webboard/img/".$_FILES['pic']['name'];
    move_uploaded_file($_FILES['pic']['tmp_name'],$pic);
  }
  else{
    $pic = "../webboard/img/default.jpg";
    move_uploaded_file($_FILES['pic']['tmp_name'],$pic);
  }

  $query = "insert into question values (null,'$topic','$detail','$category','$pic',null,'$tag','$user',0)";
  $result = mysqli_query($con , $query);

  if($result){
    echo"<Meta http-equiv='refresh'content='0;URL=form_board.php?page=1'>";
  }
  else{
    echo"ไม่สามารถเพิ่มข้อมูลได้".mysqli_error($con);
  }
?>
