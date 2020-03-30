<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ฟอร์มกระทู้</title>
    <link rel="stylesheet" href="../webboard/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../webboard/fontawesome/css/all.css" >
    <style>
      .container{
        /* border: 1px solid black; */
        width: 100%;
        margin: auto;
      }
      header{
        margin-bottom: 20px;
      }
      .th{
        text-align: center;

      }
      .h{
        padding: 30px
      }
    </style>



  </head>
  <body>
    <?php
      session_start();
      unset($_SESSION['re']);
      include("connectdb.php");

      if(!isset($_GET['page'])){
        $page = 0;
      }
      else{
        $page = $_GET['page'];
      }
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <a class="navbar-brand" href="form_board_user.php?user=<?php echo $_SESSION['user'] ?>&&page=1">
        <span style="font-size: 20px;"><i class="fas fa-user"></i></span>
        <?= $_SESSION['user']?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="form_add_board.php?page=<?php echo $page?>">ตั้งกระทู้ <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="form_board.php?page=1">กระทู้ทั้งหมด <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form_board_Popular.php?page=1">ยอดนิยม</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">เลือกประเภทกระทู้</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=เกม">เกม</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=หนัง">หนัง</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=อาหาร">อาหาร</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=กีฬา สุขภาพ">กีฬา สุขภาพ</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=ความรัก">ความรัก</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=ที่กินที่เที่ยว">ที่กินที่เที่ยว</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=ความรัก">ความรัก</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=เทคโนโลยี">เทคโนโลยี</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=การเมือง ประวัติศาสตร์">การเมือง ประวัติศาสตร์</a>
              <a class="dropdown-item" href="form_board_category.php?page=1&&category=ธรรมมะ">ธรรมมะ</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form_user.php">ออกจากการใช้ชื่อนี้</a>
          </li>
        </ul>
        <form action="form_search.php" method="get" class="form-inline my-2 my-lg-0">
          <input name="search" class="form-control mr-sm-2" type="search" placeholder="ค้นหาจากหัวข้อกระทู้">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">ค้นหา</button>
        </form>
      </div>
    </nav>

    <div class="container">

      <div class="alert alert-light d-flex justify-content-center" role="alert">
          รวมกระทู้ทั้งหมด
      </div>

    <table class="table table-hover">
      <thead class="th">
        <tr class="table-secondary">
          <th scope="col" colspan="2" width="40%"><span class="glyphicon glyphicon-search font-weight-lighter" aria-hidden="true">หัวข้อกระทู้</span></th>
          <th scope="col" width="10%" class="font-weight-lighter">ผู้ตั้งกระทู้</th>
          <th scope="col" width="10%" class="font-weight-lighter">เยี่ยมชม</th>
          <th scope="col" width="10%" class="font-weight-lighter">ความคิดเห็น</th>
          <th scope="col" colspan="2" width="20%" class="font-weight-lighter">โพสต์เมื่อ</th>
        </tr>
      </thead>
      <!-- ------------------------------------------------------------------------------ -->
      <?php

      $rows = 6;
      $sql = "select * from question";
      $query = mysqli_query($con , $sql);
      $total_data = mysqli_num_rows($query);
      $total_page = ceil($total_data/$rows);

      $strat = (($page-1) * $rows);
      $page_count = $strat;

      $selection = "select * from question ORDER BY q_no DESC Limit $strat,6";
      $query = mysqli_query($con,$selection);
      while($row = mysqli_fetch_array($query)){
        $page_count = $page_count + 1;
        $id = $row['q_no'];
        $query_count = "select count(a_no) as count from answer where q_no = $id";
        $result = mysqli_query($con,$query_count);

        $row_count = mysqli_fetch_array($result)
        ?>
        <!-- ------------------------------------------------------------------------------ -->
      <tbody>
        <tr class="font-weight-lighter">
          <th scope="row" width="10%"><a href="show_board.php?q_no=<?php echo $row['q_no'] ?>&&page=1"><img class="rounded-sm" src="<?php echo $row['q_picture'] ?>" width="150px" height="100px"></a></th>
          <td width="30%" class="text-dark">ประเภท <?php echo $row['q_category'] ?><br><a href="show_board.php?q_no=<?php echo $row['q_no'] ?>&&page=1"><?php echo $row['q_topic'] ?></a><br>
            <?php
            if($row['q_user'] == $_SESSION['user']){
            ?>
            <a href="form_update_board.php?id=<?php echo $row['q_no']?>&&page=<?php echo $page?>"><span style="font-size: 15px; color: Dodgerblue;"><i class="fas fa-edit"></i></span> แก้ไขกระทู้</a>
            <a href="" data-toggle="modal" data-target="#staticBackdrop<?php echo $id?>" class="text-danger"><span style="font-size: 15px; color: Tomato;"><i class="fas fa-trash-alt"></i></span> ลบกระทู้</a>
            <?php
            }
            ?>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop<?php echo $id?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel<?php echo $id?>" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel<?php echo $id?>">แจ้งเตือนการลบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    คุณต้องการลบกระทู้ <?php echo $row['q_topic']?> ใช่ หรือ ไม่?่
                  </div>
                  <div class="modal-footer">
                    <a href="delete_doard.php?id=<?php echo $row['q_no']?>&&page=<?php echo $page?>"<button type="button" class="btn btn-primary">ยืนยัน</button></a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td class="th" width="10%">
            <a href="form_board_user.php?user=<?php echo $row['q_user'] ?>&&page=1">
              <div class="">
                <span style="font-size: 15px; color: CadetBlue;">
                  <i class="fas fa-user"></i>
                  <?php echo $row['q_user'] ?>
                </span>
              </div>
              </a>
            </td>
          <td width="10%"><div class="th"><span style="font-size: 15px; color: GoldenRod;"><i class="fas fa-eye"></i> <?php echo $row['q_view']?></span></div></td>
          <td class="th" width="10%"><span style="font-size: 15px; color: ForestGreen;"><i class="fas fa-comment-dots"></i> <?php echo $row_count['count']?></span></td>
          <td class="th" width="20%"><span style="font-size: 15px; color: Black;"><i class="fas fa-calendar-alt"></i> <?php echo $row['q_date'] ?></span></td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
      <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php
              if($page > 1){
            ?>
            <li class="page-item">
              <a class="page-link" href="form_board.php?page=<?php echo ($page-1)?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <?php
              }
            ?>
            <?php
              for ($i=1; $i <=$total_page ; $i++) {
            ?>
            <li
            <?php
              if($page == $i){
            ?>
              class="page-item active"
            <?php
              }
              else{
            ?>
              class="page-item"
            <?php
              }
            ?>>
              <a class="page-link" href="form_board.php?page=<?php echo $i?>" ><?php echo $i?></a></li>
            <?php
              }
              if($page_count < $total_data){
            ?>

            <li class="page-item">
              <a class="page-link" href="form_board.php?page=<?php echo ($page+1)?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <?php
              }
            ?>
          </ul>
        </nav>
      </div>
    </div>
    <script src="../webboard/bootstrap/jquery/jquery-3.4.1.slim.min.js"></script>
    <script src="../webboard/bootstrap/popper/popper.min.js"></script>
    <script src="../webboard/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
