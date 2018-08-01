<?php

include_once '../conn.php';
isLogin();
session_start();

?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
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
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
       <div class="alert alert-danger" style="display: none">
        <strong>错误！</strong>发生XXX错误
      </div>
      <div class="alert alert-success" style="display: none">
        <strong>错误！</strong>发生XXX错误
      </div>
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <!-- 定义一个隐藏域,存储图片路径 -->
          <input type="hidden" id='avatar_path' >
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file" >
              <img id="headImg" src="../assets/img/default.png">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="w@zce.me" placeholder="邮箱" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="" placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" class="form-control" placeholder="Bio" cols="30" rows="6"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <span id="updUser" class="btn btn-primary">更新</span>
            <a class="btn btn-link" href="password-reset.php">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

<!-- 引入菜单栏 -->
<?php include_once './menu.php'; ?>
<!-- 引入菜单栏 -->


  <script src="../assets/vendors/jquery/jquery.min.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript">
  $("#avatar").change(function () {
    //获取到上传文件的信息
    var file = this.files[0];
    //html5的一个特性，利用formData表单对象，可以用来传递二进制数据（文件流）和字符串数据
    var formdata = new FormData();
    formdata.append('file',file);
    if (file) {
      $.ajax({
        "type":"post",
        "url":"../api/uploadImg.php",
        "data":formdata,
        "contentType":false,
        "processData":false,
        "dataType":"json",
        "success":function(res){
          console.log(res);
          if (res.code == 200) {
            $("#headImg").attr('src',res.avatar);
            $("#avatar_path").val(res.url);
          };
        }
      })
    };
  });



  $("#updUser").on("click",function(){
    //获取数据
    var nickname = $("#nickname").val();
    var bio = $("#bio").val();
    var avatar = $("#avatar_path").val();
    console.log(avatar);
    if ($.trim($("#nickname").val())=='') {
      $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("<strong>昵称不能为空</strong>");
      return false;
    };
    $("#alert-danger").hide();
    //通过ajax发送到后台进行更新
    var param = {
      "nickname":nickname,
      "bio":bio,
      "avatar":avatar
    };
    $.post('../api/updUser.php',
     param,
     function(res) {
      // console.log(res);
      if (res.code == 200) {
        $("#alert-success").slideDown(500).delay(1000).hide(500).html("<strong>"+res.message+"</strong>");
        $("#nickName").html($("#nickname").val());
        $(".avatar").attr('src',res.url);
      }else{
        $("#alert-danger").slideDown(500).delay(1000).hide(500).html("<strong>"+res.message+"</strong>");
      }
    },'json');
  });

  // 更新图片和名字
 $.get("../api/getUser.php",'',function(res){
      console.log(res);
     //给表单赋值
     $("#headImg").attr('src',res.data.avatar);
     $("#nickname").val(res.data.nickname);
     $("#bio").val(res.data.bio);
     $("#email").val(res.data.email);
  },'json');



  </script>
</body>
</html>
