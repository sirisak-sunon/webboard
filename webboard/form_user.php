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
        .card{
          margin-top: 100px;
          margin-left: 50px;
          margin-right: 50px;

        }
    </style>
  </head>
  <body>
    <?php
      session_start();
      session_destroy();
    ?>
<form action="set_name.php" method="post">
   <div class="container th">
      <div class="card">
        <div class="card-header">
          <center><strong>ตั้งชื่อผู้ใช้งาน</strong></center>
        </div>
        <div class="card-body">
          <form id="myform1" name="form1" method="post" action="" novalidate>
            <div class="form-group row">
                <div class="col">
                    <label for="exampleFormControlInput1"><strong>ชื่อผู้ใช้งาน</strong></label>
                  <div class="form-group">
                    <div class="alert alert-light" role="alert">
                      <input type="text" class="form-control" name="user" id="input_name"
                      value="" pattern="[ก-๏a-zA-Z\s]+"  required>
                    </div>
                  </div>
                  <div class="form-group font-weight-lighter">
                    ชื่อผู้ใช้งานนี้จะถูกใช้ในการอ้างอิงถึงการเป็นเจ้าของกระทู้ในการตั้งกระทู้ และอ้างอิงถึงความคิดเห็นที่ผู้ใช้งานได้แสดงความคิดเห็น
                  </div>
                  <div class="form-group">
                    จะต้องตั้งเป็นตัวอักษรภาษาอังกฤษ(ได้ทั้งตัวพิมพ์เล็กและใหญ่) และภาษาไทยเท่านั้น
                  </div>
                  <div class="invalid-feedback">
                    กรุณากรอกชื่อ นามสกุล ภาษาไทย
                  </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 offset-sm-4 text-right pt-4">
                     <button type="submit" name="btn_submit" id="btn_submit" value="1" class="btn btn-success btn-block">ยืนยันชื่อผู้ใช้งาน</button>
                </div>
            </div>
          </form>
        </div>
      </div>
   </div>
 </form>

 <script src="../webboard/bootstrap/jquery/jquery-3.4.1.slim.min.js"></script>
 <script src="../webboard/bootstrap/popper/popper.min.js"></script>
 <script src="../webboard/bootstrap/js/bootstrap.min.js"></script>
 <script src="../webboard/bootstrap/js/popper.min_va.js"></script>
<script type="text/javascript">
$(function(){
     $("#myform1").on("submit",function(){
         var form = $(this)[0];
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
     });
});
</script>
</body>
</html>
