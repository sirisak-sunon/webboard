<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ฟอร์มตั้งกระทู้</title>
    <link rel="stylesheet" href="../webboard/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../webboard/fontawesome/css/all.css" >
    <style type="text/css">
        .container{
          margin: auto;
        }
    </style>
  </head>
  <body>
    <?php
      include('connectdb.php');
      $id = $_GET['id'];
      $page = $_GET['page'];
      $query = "select * from question where q_no = $id";
      $result = mysqli_query($con,$query);
      $row = mysqli_fetch_array($result);
    ?>

  <form action="update_board.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="container">
      <div class="card">
        <div class="card-header">
          <center>ฟอร์มแก้ไขกระทู้</center>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="exampleFormControlInput1">หัวข้อกระทู้</label>
            <input type="text" name="topic" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['q_topic']?>" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">เลือกประเภทกระทู้</label>
            <select class="form-control" id="exampleFormControlSelect1" name="category">
              <option><?php echo $row['q_category']?></option>
              <option>เกม</option>
              <option>หนัง</option>
              <option>อาหาร</option>
              <option>การ์ตูน</option>
              <option>กีฬา สุขภาพ</option>
              <option>ความรัก</option>
              <option>ที่กินที่เที่ยว</option>
              <option>เทคโนโลยี</option>
              <option>การเมือง ประวัติศาสตร์</option>
              <option>ธรรมมะ</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">รายละเอียดกระทู้</label>
            <textarea name="detail" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?php echo $row['q_detail']?></textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">เพิ่มแท็กที่เกี่ยวข้องกับกระทู้</label>
            <input type="text" name="tag" value="<?php echo $row['q_tag']?>" class="form-control" id="exampleFormControlInput1" >
            <label for="exampleFormControlInput1">จะใส่ หรือไม่ใส่ก็ได้ ถ้ามีมากกว่า 1 แท็ก ให้คั่นด้วยเครื่องหมาย comma (,) เช่น หมา, แมว, สัตว์เลี้ยง</label>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">รูปภาพหัวกระทู้</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="pic" accept="image/*">
          </div>
          <div class="form-group">
            <center>
              <input type="text" name="page" value="<?php echo $page?>" hidden>
              <button type="submit" class="btn btn-success" name="q_no" value="<?php echo $row['q_no']?>">ยืนยันการเปลี่ยนแปลง</button>
              <a href="form_board.php?page=<?php echo $page?>"><button type="button" class="btn btn-danger">ยกเลิก</button></a>
            </center>
          </div>
        </div>
      </div>
    </div>
    </form>
    <script src="../webboard/bootstrap/jquery/jquery-3.4.1.slim.min.js"></script>
    <script src="../webboard/bootstrap/popper/popper.min.js"></script>
    <script src="../webboard/bootstrap/js/bootstrap.min.js"></script>
    <script src="../webboard/bootstrap/js/popper.min_va.js"></script>
      <script>
        $(document).ready(function () {
          (function () {
            window.addEventListener('load', function () {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
        });
      </script>
  </body>
</html>
