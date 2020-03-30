<?php
$con = mysqli_connect("localhost", "root", "", "board");
mysqli_set_charset($con, "utf8");

if ($con) 
{
  //echo "เชื่อมต่อเดต้าเบสสำเร็จ";
} 
else 
{
  echo "ไม่สามารถเชื่อมต่อเดต้าเบสได้" . mysqli_error($con);
}
