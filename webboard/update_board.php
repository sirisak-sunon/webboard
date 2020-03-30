<?php
  session_start();
  include('connectdb.php');
  $id = $_POST['q_no'];
  $topic = $_POST['topic'];
  $detail = $_POST['detail'];
  $category = $_POST['category'];
  $pic = $_FILES['pic']['name'];
  $tag = $_POST['tag'];
  $page = $_POST['page'];
  $user = $_SESSION['user'];

  $query = "select * from question where q_no = $id";
  $result = mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $view = $row['q_view'];

  if($pic != ''){
    $pic = "../webboard/img/".$_FILES['pic']['name'];
    move_uploaded_file($_FILES['pic']['tmp_name'],$pic);
  }
  else {
    $pic = $row['q_picture'];
  }

  $query_update = "update question set q_no = $id, q_topic = '$topic' , q_detail = '$detail' , q_category = '$category' , q_picture = '$pic' , q_date = null , q_tag = '$tag', q_user = '$user', q_view = $view where q_no = $id";
  $result_update = mysqli_query($con , $query_update);
  if($result_update){
    echo"<Meta http-equiv='refresh'content='0;URL=form_board.php?page=$page'>";
  }
  else{
    echo"อัพไม่ได้".mysqli_error($con);
  }
?>
