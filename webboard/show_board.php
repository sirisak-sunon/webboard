<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <title>ฟอร์มตั้งกระทู้</title>
    <link rel="stylesheet" href="../webboard/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../webboard/fontawesome/css/all.css">
    <style>
      .container
      {
        margin: auto;
      }
    </style>
  </head>

  <body>
    <?php
      session_start();
      include('connectdb.php');

      $_SESSION['show_board_id_q'] = $_GET['q_no'];
      $id_q = $_GET['q_no'];
      if (isset($_GET['r_no'])) {
        $id_r = $_GET['r_no'];
      }
      if (isset($_GET['n'])) {
        $num2 = $_GET['n'];
      }

      if (isset($_GET['a_no']))
      {
        $id_a = $_GET['a_no'];
        $a_no = $_GET['a_no'];
      }

      if (isset($_GET['num']))
      {
        $num = $_GET['num'];
      }

      if (!isset($_GET['status']))
      {
        $status = "com";
      } else if (isset($_GET['status']))
      {
        $status = $_GET['status'];
      }

      $query_q = "select * from question where q_no = $id_q";
      $result_q = mysqli_query($con, $query_q);

      if (!isset($_GET['page']))
      {
        $page = 0;
        $_SESSION['show_board_page'] = $page;
      }
      else
      {
        $page = $_GET['page'];
        $_SESSION['show_board_page'] = $page;
      }
      $rows = 6;
      $sql = "select * from answer where q_no = $id_q";
      $query = mysqli_query($con, $sql);
      $total_data = mysqli_num_rows($query);
      $total_page = ceil($total_data / $rows);

      $strat = (($page - 1) * $rows);
      $page_count = $strat;

      $query_a = "select * from answer where q_no = $id_q Limit $strat,6";
      $result_a = mysqli_query($con, $query_a);

      if (isset($id_a))
      {
        $query_a = "select * from answer where a_no = $id_a";
        $detail_a = mysqli_query($con, $query_a);
        $row_detail_a = mysqli_fetch_array($detail_a);
      }

      $query_count = "select count(a_no) as count from answer where q_no = $id_q";
      $result_count = mysqli_query($con, $query_count);

      $q_row = mysqli_fetch_array($result_q);
      $row_count = mysqli_fetch_array($result_count);
      $view = $q_row['q_view'];

      if (!isset($_SESSION['re']))
      {
        $_SESSION['re'] = true;
        $view = $view + 1;
      }
      $query_view = "update question set q_view = $view where q_no = $id_q";
      $row_view = mysqli_query($con, $query_view);
      $result_q = mysqli_query($con, $query_q);
      $q_detail = $q_row['q_detail'];
      $q_detail = nl2br($q_detail);
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <a class="navbar-brand" href="form_board_user.php?user=<?php echo $_SESSION['user'] ?>&&page=1">
        <span style="font-size: 20px;">
          <i class="fas fa-user"></i>
        </span>
        <?= $_SESSION['user'] ?>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="form_add_board.php?page=<?php echo $page ?>">ตั้งกระทู้ <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
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

    <p>

      <div class="container">
        <div class="alert alert-secondary border" role="alert">
          <div class="card">
            <img src="<?php echo $q_row['q_picture'] ?>" class="card-img-top" alt="..." height="500px">
            <div class="card-body">
              <h3 class="card-title"><?php echo $q_row['q_topic'] ?></h3>
                <p class="font-weight-lighter">
                  <?php echo $q_detail ?>
                  <label>
                    <center>
                      <a href="form_board_user.php?user=<?php echo $q_row['q_user'] ?>&&page=1"> <span style="font-size: 15px; color: CadetBlue;"><i class="fas fa-user"></i><?php echo $q_row['q_user'] ?></span></a><br>
                      <span style="font-size: 15px; color: GoldenRod;"><i class="fas fa-eye"></i> <?php echo $q_row['q_view'] ?></span>
                      <span style="font-size: 15px; color: ForestGreen;"><i class="fas fa-comment-dots"></i> <?php echo $row_count['count'] ?></span><br>
                      <span style="font-size: 15px; color: Black;"><i class="fas fa-calendar-alt "></i> <?php echo $q_row['q_date'] ?></span>
                    </center>
                  </label>
                </p>
            </div>
          </div>
        </div>

         <p>

          <?php
            while ($a_row = mysqli_fetch_array($result_a))
            {
              $page_count = $page_count + 1;
              $id_a = $a_row['a_no'];
              $d_a = $a_row['a_detail'];
              $d_a = nl2br($d_a);
              $i = $page_count;
          ?>
            <div class="alert alert-light " role="alert">
              ความคิดเห็นที่ <?php echo $i ?><br>
              <div class="alert alert-light border" role="alert">
                <a class="font-weight-lighter">
                  <a href="form_board_user.php?user=<?php echo $a_row['a_user'] ?>&&page=1"><span style="font-size: 15px; color: CadetBlue;"><i class="fas fa-user"></i><?php echo $a_row['a_user'] ?></span></a><br>
                  <label><?php echo $d_a ?></label><br>
                  <!-- -------------------ตอบกลับ ลบ แก้ไข หลัก------------------------------ -->
                  <div class="accordion" id="accordionExample">
                    <button id="headingreply<?php echo $i ?>" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsereply<?php echo $i ?>" aria-expanded="false" aria-controls="collapsereply<?php echo $i ?>">ตอบกลับ</button>
                    <a class="float-right"><span style="font-size: 15px; color: Black;"><i class="fas fa-calendar-alt "></i> <?php echo $a_row['a_date'] ?></span></a>
                    <?php
                      if ($a_row['a_user'] == $_SESSION['user'])
                      {
                    ?>
                    <!-- <a <span style="font-size: 15px; color: Dodgerblue;"><i class="fas fa-edit"></i> id="headingreply<?php echo $i ?>" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsereply<?php echo $i ?>" aria-expanded="false" aria-controls="collapsereply<?php echo $i ?>">แก้ไข</a> -->
                    <span style="font-size: 15px; color: Dodgerblue;"><i class="fas fa-edit"></i><a href="http://localhost/webboard/show_board.php?q_no=<?php echo $id_q ?>&&num=<?php echo $i ?>&&a_no=<?php echo $a_row['a_no'] ?>&&status=edit&&page=<?php echo $page ?>#edit">แก้ไข</span>
                    <span style="font-size: 15px; color: Tomato;"><i class="fas fa-trash-alt"></i><a href="" data-toggle="modal" data-target="#staticBackdrop<?php echo $i ?>" class="text-danger">ลบ</span></a>
                    <?php
                      }
                    ?>
                  </div>
                    <!-- ---------------------------------modal ลบ หลัก------------------------------------------------------ -->
                    <div class="modal fade" id="staticBackdrop<?php echo $i ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel<?php echo $i ?>" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel<?php echo $i ?>">แจ้งเตือนการลบความเห็นที่ <?php echo $i ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            คุณต้องการลบความคิดเห็น <strong><?php echo $d_a ?></strong> ใช่ หรือ ไม่?่
                          </div>
                          <div class="modal-footer">
                            <a href="delete_comment.php?id_a=<?php echo $id_a ?>&&id_q=<?php echo $id_q ?>&&page=<?php echo $page ?>" <button type="button" class="btn btn-primary">ยืนยัน</button></a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ---------------------------------------------สิ้นสุด modal ลบ หลัก---------------------------------------------------- -->
                    <div id="collapsereply<?php echo $i ?>" class="collapse" aria-labelledby="headingreply<?php echo $i ?>" data-parent="#accordionExample">
                      <div class="card-body">
                        <form method="post" action="insert_reply.php">
                          <div class="alert alert-secondary" role="alert">
                            <label for="exampleFormControlTextarea1">ตอบกลับความคิดเห็นที่ <?php echo $i ?></label>
                            <a name="answer"><textarea name="r_detail" class="form-control" id="exampleFormControlTextarea1" rows="15" required></textarea></a><br>
                            <button type="submit" name="a_no" value="<?php echo $id_a ?>" type="button" class="btn btn-success">ส่งความคิดเห็น</button>
                            <button type="button" class="btn btn-secondary collapsed" data-toggle="collapse" data-target="#collapsereply<?php echo $i ?>" aria-expanded="false" aria-controls="collapsereply<?php echo $i ?>">ยกเลิก</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- -------------------สิ้นสุดการตอบกลับ ลบ แก้ไข หลัก------------------ -->
                </a>
              </div>

              <div>
                <?php
                  // $cont = $cont+$i;
                  $i++;

                  $check = 0;
                  $sum_r = 0;
                  $n = 1;
                  $query = "select * from reply where a_no = $id_a";
                  $result_r = mysqli_query($con, $query);
                  while ($row_r = mysqli_fetch_array($result_r))
                  {
                    if ($row_r['a_no'] == $id_a && $row_r['a_no'] != $check)
                    {
                      $check = $row_r['a_no'];
                      $query = "select * from reply where a_no = $id_a";
                      $result_count_r = mysqli_query($con, $query);
                      while (mysqli_fetch_array($result_count_r))
                      {
                        $sum_r = $sum_r + 1;
                      }
                ?>
                    <div class="alert alert-light" role="alert">
                      <button style="width:100%" class="btn btn-primary btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo $i ?>" aria-expanded="false" aria-controls="collapseExample<?php echo $i ?>">
                        มี <?php echo $sum_r ?> การตอบกลับ
                      </button>
                      <div class="collapse" id="collapseExample<?php echo $i ?>">
                        <div class="card card-body alert alert-secondary">
                          <!-- -----------------------ลูปดูข้อความย่อย-------------------------- -->
                          <?php
                            $query_r = "select * from reply where a_no = $id_a";
                            $result_reply = mysqli_query($con, $query_r);
                            while ($row_r = mysqli_fetch_array($result_reply))
                            {
                          ?>
                          <!-- -----------------------ลิ้นสุดลูปดูข้อความย่อย-------------------------- -->
                            ความเห็นที่ <?php echo ($i - 1) ?>-<?php echo $n ?>
                            <div class="alert alert-light border" role="alert">
                              <a href="form_board_user.php?user=<?php echo $a_row['a_user'] ?>&&page=1"><span style="font-size: 15px; color: CadetBlue;"><i class="fas fa-user"></i><?php echo $row_r['r_user'] ?></span></a><br>
                              <?php
                                if(isset($row_r['r_user_reply']))
                                {
                                  echo "<strong class=font-italic>$row_r[r_user_reply]</strong>";
                                }
                              ?>
                              <?php echo $row_r['r_detail']; ?>
                              <!-- -------------------------------ตอบกลับ ลบ แก้ไข ย่อย------------------------------ -->
                              <div class="accordion text-info" id="accordionExample">
                                <button id="headingreply<?php echo ($i - 1) ?>-<?php echo $n ?>" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsereply<?php echo ($i - 1) ?>-<?php echo $n ?>" aria-expanded="false" aria-controls="collapsereply<?php echo ($i - 1) ?>-<?php echo $n ?>">
                                  ตอบกลับ
                                </button>
                                <a class="float-right"><span style="font-size: 15px; color: Black;"><i class="fas fa-calendar-alt "></i> <?php echo $row_r['r_date'] ?></span></a>
                              <?php
                              if ($row_r['r_user'] == $_SESSION['user']) {
                              ?>
                                <span style="font-size: 15px; color: Dodgerblue;"><i class="fas fa-edit"></i><a href="http://localhost/webboard/show_board.php?q_no=<?php echo $id_q ?>&&num=<?php echo ($i - 1) ?>&&n=<?php echo $n ?>&&r_no=<?php echo $row_r['r_no'] ?>&&a_no=<?php echo $id_a ?>&&status=editreply&&page=<?php echo $page ?>#editreply">แก้ไข</span></a>
                                <span style="font-size: 15px; color: Tomato;"><i class="fas fa-trash-alt"></i><a href="" data-toggle="modal" data-target="#staticBackdrop_reply<?php echo ($i - 1) ?>-<?php echo $n ?>" class="text-danger">ลบ</span></a>
                              <?php
                              }
                              ?>
                            </div>
                              <!-- ---------------------------------------------modal ลบ ย่อย---------------------------------------------------- -->
                                <div class="modal fade" id="staticBackdrop_reply<?php echo ($i - 1) ?>-<?php echo $n ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel_reply<?php echo ($i - 1) ?>-<?php echo $n ?>" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel_reply<?php echo ($i - 1) ?>-<?php echo $n ?>">แจ้งเตือนการลบความเห็นที่ <?php echo ($i - 1) ?>-<?php echo $n ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        คุณต้องการลบความคิดเห็น <strong><?php echo $row_r['r_detail']?></strong>  ใช่ หรือ ไม่?่
                                      </div>
                                      <div class="modal-footer">
                                        <a href="delete_reply.php?id_r=<?php echo $row_r['r_no'] ?>" <button type="button" class="btn btn-primary">ยืนยัน</button></a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- ---------------------------------------------สิ้นสุด modal ลบ ย่อย---------------------------------------------------- -->
                                <div id="collapsereply<?php echo ($i - 1) ?>-<?php echo $n ?>" class="collapse" aria-labelledby="headingreply<?php echo ($i - 1) ?>-<?php echo $n ?>" data-parent="#accordionExample">
                                  <div class="card-body">
                                    <form method="post" action="insert_reply.php">
                                      <div class="alert alert-light" role="alert">
                                        <label for="exampleFormControlTextarea1">ตอบกลับความคิดเห็นที่ <?php echo ($i - 1) ?>-<?php echo $n ?></label>
                                        <a name="answer"><textarea name="r_detail" class="form-control" id="exampleFormControlTextarea1" rows="15" required></textarea></a><br>
                                        <input type="text" name="r_user_reply" value="@<?php echo $row_r['r_user']?>" hidden>
                                        <button type="submit" name="a_no" value="<?php echo $id_a ?>" type="button" class="btn btn-success">ส่งความคิดเห็น</button>
                                        <button type="button" class="btn btn-secondary collapsed" data-toggle="collapse" data-target="#collapsereply<?php echo ($i - 1) ?>-<?php echo $n ?>" aria-expanded="false" aria-controls="collapsereply<?php echo ($i - 1) ?>-<?php echo $n ?>">ยกเลิก</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <!-- ----------------------------------------สิ้นสุดการตอบกลับ ลบ แก้ไข ย่อย---------------------------------- -->
                            </div>
                        <?php
                          $n = $n + 1;
                          }
                        ?>
                          <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#collapseExample<?php echo $i ?>" aria-expanded="false" aria-controls="collapseExample<?php echo $i ?>">ปิด</button>
                        </div>
                      </div>
                    </div>
                    <?php
                    }
                    ?>
                  <?php
                  }
                  ?>
              </div>
            </div>
          <?php
          }
          ?>
            <!-- -----------------------ตัวแบ่งหน้า--------------------------------------------- -->
          <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <?php
                if ($page > 1)
                {
                ?>
                  <li class="page-item">
                    <a class="page-link" href="show_board.php?page=<?php echo ($page - 1) ?>&&q_no=<?php echo $q_row['q_no'] ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php
                }
                ?>
                <?php
                for ($i = 1; $i <= $total_page; $i++)
                {
                ?>
                  <li <?php if ($page == $i) {?> class="page-item active" <?php }else {?> class="page-item" <?php }?>>
                    <a class="page-link" href="show_board.php?page=<?php echo $i ?>&&q_no=<?php echo $q_row['q_no'] ?>"><?php echo $i ?></a></li>
                <?php
                }
                if ($page_count < $total_data)
                {
                ?>
                <li class="page-item">
                  <a class="page-link" href="show_board.php?page=<?php echo ($page + 1) ?>&&q_no=<?php echo $q_row['q_no'] ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              <?php
                }
              ?>
              </ul>
            </nav>
          </div>
        <!--  ---------------------สิ้นสุดตัวแบ่งหน้า--------------------------------------------- -->

        <?php
          if (isset($_GET['r_no']))
          {
            $id_r = $_GET['r_no'];
            $query_r = "select * from reply where r_no = $id_r";
            $result_r = mysqli_query($con, $query_r);
            $row_r = mysqli_fetch_array($result_r);
          }
        ?>

          <?php
            if ($status == "com")
            {
          ?>
            <form method="post" action="insert_comment.php">
              <div class="alert alert-secondary" role="alert">
                <label for="exampleFormControlTextarea1">แสดงความคิดเห็น</label>
                <textarea name="conment" class="form-control" id="exampleFormControlTextarea1" rows="15" required></textarea><br>
                <button type="submit" name="id" value="<?php echo $id_q ?>" type="button" class="btn btn-success">ส่งความคิดเห็น</button>
              </div>
            </form>
          <?php
            }
            elseif ($status == "answer")
            {
          ?>
            <form method="post" action="insert_comment.php">
              <div class="alert alert-secondary" role="alert">
                <label for="exampleFormControlTextarea1">ตอบกลับความคิดเห็น</label>
                <a name="answer"><textarea name="conment" class="form-control" id="exampleFormControlTextarea1" rows="15" required>ตอบกลับความเห็นที่ <?php echo $num ?> </textarea></a><br>
                <button type="submit" name="id" value="<?php echo $id_q ?>" type="button" class="btn btn-success">ส่งความคิดเห็น</button> <a href="http://localhost/webboard/show_board.php?q_no=<?php echo $id_q ?>&&page=<?php echo $page ?>"><button type="button" type="button" class="btn btn-secondary">ยกเลิก</button></a>
              </div>
            </form>
          <?php
            }
            elseif ($status == "edit")
            {
          ?>
          <!-- -----------------------------ฟอร์มแก้ไขความคิดเห็นหลัก------------------------------------------ -->
            <form method="post" action="update_comment.php">
              <div class="alert alert-secondary" role="alert">
                <label for="exampleFormControlTextarea1">แก้ไขความคิดเห็นที่ <?php echo $num ?></label>
                <input name="q_no" value="<?php echo $id_q ?>" hidden>
                <input name="a_no" value="<?php echo $a_no ?>" hidden>
                <input name="page" value="<?php echo $page ?>" hidden>
                <center><a name="edit"><textarea name="detail" class="form-control" id="exampleFormControlTextarea1" rows="15" required><?php echo $row_detail_a['a_detail'] ?></textarea></a></center><br>
                <button type="submit" name="id" value="<?php echo $id_q ?>" type="button" class="btn btn-success">ยืนยันการเปลี่ยนแปลง</button> <a href="http://localhost/webboard/show_board.php?q_no=<?php echo $id_q ?>&&page=<?php echo $page ?>"><button type="button" type="button" class="btn btn-secondary">ยกเลิก</button></a>
              </div>
            </form>
          <?php
            }
            elseif ($status == "editreply")
            {
          ?>
          <!-- -----------------------------ฟอร์มแก้ไขความคิดเห็นย่อย------------------------------------------ -->
            <form method="post" action="update_reply.php">
              <div class="alert alert-secondary" role="alert">
                <label for="exampleFormControlTextarea1">แก้ไขความคิดเห็นที่ <?php echo $num ?>-<?php echo $num2 ?></label>
                <input name="q_no" value="<?php echo $id_q ?>" hidden>
                <input name="a_no" value="<?php echo $a_no ?>" hidden>
                <input name="page" value="<?php echo $page ?>" hidden>
                <input name="r_no" value="<?php echo $id_r ?>" hidden>
                <center><a name="editreply"><textarea name="r_detail" class="form-control" id="exampleFormControlTextarea1" rows="15" required><?php echo $row_r['r_detail'] ?></textarea></a></center><br>
                <button type="submit" name="id" value="<?php echo $id_q ?>" type="button" class="btn btn-success">ยืนยันการเปลี่ยนแปลง</button> <a href="http://localhost/webboard/show_board.php?q_no=<?php echo $id_q ?>&&page=<?php echo $page ?>"><button type="button" type="button" class="btn btn-secondary">ยกเลิก</button></a>
              </div>
            </form>
          <?php
            }
          ?>
      </div>
      <script src="../webboard/bootstrap/jquery/jquery-3.4.1.slim.min.js"></script>
      <script src="../webboard/bootstrap/popper/popper.min.js"></script>
      <script src="../webboard/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
