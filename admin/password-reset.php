<?php

include_once '../conn.php';
isLogin();
session_start();

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Password reset &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>


  <div class="main">
    <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="login.php"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改密码</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display:none;">
        <strong>错误！</strong>发生XXX错误
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-success" style="display:none;">
        <strong>错误！</strong>发生XXX错误
      </div>
      <form class="form-horizontal">
        <div class="form-group">
          <label for="old" class="col-sm-3 control-label">旧密码</label>
          <div class="col-sm-7">
            <input id="old" class="form-control" type="password" placeholder="旧密码">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">新密码</label>
          <div class="col-sm-7">
            <input id="password" class="form-control" type="password" placeholder="新密码">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm123" class="col-sm-3 control-label">确认新密码</label>
          <div class="col-sm-7">
            <input id="confirm123" class="form-control" type="password" placeholder="确认新密码">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-7">
            <span id="ediPwd"  class="btn btn-primary">修改密码</span>
          </div>
        </div>
      </form>
    </div>
  </div>


<!-- 引入目录 -->

<?php include_once '../admin/menu.php'; ?>

<!-- 引入目录 -->
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>



  <script type="text/javascript">
  $("#ediPwd").on('click',function(){
    var oldPwd = $("#old").val();
    var pwd = $("#password").val();
    var confirm123 = $("#confirm123").val();


    if ($.trim(oldPwd)=='') {
      $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("<strong>请输入密码...</strong>");
      return false;
    };
    if ($.trim(pwd)=='') {
      $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("<strong>请输入新密码...</strong>");
      return false;
    };
    if ($.trim(confirm123)=='') {
      $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("<strong>请再次输入新密码...</strong>");
      return false;
    };
    if ($.trim(pwd)!=$.trim(confirm123)) {
      $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("<strong>两次输入的新密码不一致...</strong>");
      return false;
    };



    $.post(
      '../api/ediPwd.php',
      {
        "old":oldPwd,
        "pwd":pwd,
        "confirm123":confirm123
      },
      function(res) {
        console.log(res);
        if (res.code == 200) {
          // alert(111);
          $(".alert-success").slideDown(500).delay(1000).slideUp(500).html("<strong>"+res.message+"</strong>");
          $("#old").val("");
          $("#password").val("");
          $("#confirm123").val("");
        }else{
          $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("<strong>"+res.message+"</strong>");
        }
      },'json');

  })
  </script>
</body>
</html>
