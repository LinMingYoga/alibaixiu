<?php

include_once "../conn.php";
//检查是否登录
isLogin();
session_start();
$visitor = 'index';

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
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.php" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">

              <!-- <li class="list-group-item">10</strong>篇文章（<strong>2</strong>篇草稿）</li>
              <li class="list-group-item"><strong>6</strong>个分类</li>
              <li class="list-group-item"><strong>5</strong>条评论（<strong>1</strong>条待审核）</li> -->

            </ul>
          </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>

  <?php include_once "./menu.php"?>


  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>

  <script> 

 $.get(
   '../api/getPosts.php',
   '',
   function(res){
   if(res.code==200){
    // console.log(res.data);    
    // var data = res.data[0][0];  
    // console.log(111);
      var lis = "<li class='list-group-item'><strong>"+res.data[0][0].alls+"</strong>篇文章（<strong>"+res.data[1][0].dra+"</strong>篇草稿）</li>\
              <li class='list-group-item'><strong>"+res.data[2][0].all_cat+"</strong>个分类</li>\
              <li class='list-group-item'><strong>"+res.data[3][0].all_comm+"</strong>条评论（<strong>"+res.data[4][0].held+"</strong>条待审核）</li>";
      $(".list-group").append(lis);
   }else{
     alert(111);
   }
   
     
  },'json');
  
  </script>
</body>
</html>
