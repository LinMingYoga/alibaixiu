<?php

include_once '../conn.php';
$sql ="select * from category";
$res = conn($sql);
$visitor = 'posts-add';

?>





<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
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
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display: none">
        <strong>错误！</strong>发生XXX错误
      </div>
      <!-- 成功时展示 -->
      <div class="alert alert-success" style="display: none">
        <strong>成功！</strong>发生XXX错误
      </div>
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="cat_name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">类名</label>
              <input id="slug" class="form-control" name="classname" type="text" placeholder="classname">
            </div>
            <div class="form-group">
              <span class="btn btn-primary" id="addBtn" type="submit">添加</span>
              <span class="btn btn-primary" id="upd" style="display:none">提交编辑</span>
              <span class="btn btn-primary" id="cancelUpd" style="display:none">取消编辑</span>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" id="batchDelButton" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input id="batchDel" type="checkbox"></th>
                <th>名称</th>
                <th>类名</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>

            <?php foreach ($res as $value) { ?>

              <tr>
                <td class="text-center"><input type="checkbox" value="<?php echo $value['cat_id'];?>"></td>
                <td><?php echo $value['cat_name']; ?></td>
                <td><?php echo $value['classname']; ?></td>
                <td class="text-center">
                  <a href="javascript:;" class="updCat btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="delCat btn btn-danger btn-xs">删除</a>
                </td>
              </tr>


            <?php } ?>

            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <div class="profile">
      <img class="avatar" src="../uploads/avatar.jpg">
      <h3 class="name">布头儿</h3>
    </div>
    <ul class="nav">
      <li>
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li class="active">
        <a href="#menu-posts" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse in">
          <li><a href="posts.php">所有文章</a></li>
          <li><a href="post-add.php">写文章</a></li>
          <li class="active"><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.php">导航菜单</a></li>
          <li><a href="slides.php">图片轮播</a></li>

        </ul>
      </li>
    </ul>
  </div>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript">


//添加
$("#addBtn").on("click",function(){
    event.preventDefault();
    var cat_name = $("#name").val();
    var classname = $("#slug").val();


    if ($.trim(cat_name)==''||$.trim(classname)=='') {
      $(".alert-danger").fadeIn(1000).delay(2000).slideUp(1000).val("分类名称或类名不能为空");
      return false;
    };
    //发送ajax请求
    $.post(
      '../api/addCat.php',
      {'cat_name': cat_name,'classname':classname},
      function(res){
        if(res.code == 200){
          console.log(res);
          //提示成功
          // $(".alert-success").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
          $("#name").val("");
          $("#slug").val("");
          var tr = '<tr>\
                  <td class="text-center"><input type="checkbox" value="'+res.insert_id+'"></td>\
                  <td>'+cat_name+'</td>\
                  <td>'+classname+'</td>\
                  <td class="text-center">\
                    <a href="javascript:;" class="updCat btn btn-info btn-xs">编辑</a>\
                    <a href="javascript:;" class="delCat btn btn-danger btn-xs">删除</a>\
                  </td>\
                </tr>';
            $("tbody").append(tr);
          $(".alert-success").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
        }else{
          //失败提示
          $(".alert-danger").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
        }
    },'json');
});
//删除
$("tbody").on('click', '.delCat', function() {
    var _self = $(this);
    //获取当前id
    var cat_id = _self.parents("tr").find("input").val();
    //判断用户是否要删除防止误删除
    if (confirm('确认删除?')) {
      //发送ajax请求进行删除
      $.get('../api/delCat.php',{"cat_id":cat_id},function(res) {
        console.log(res);
        if(res.code==200){
          //删除当前所在的tr行
          _self.parents("tr").remove();
          $(".alert-success").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
        }else{
          //失败提示错误信息
          $(".alert-danger").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
        }
      },'json');
    }
});
//批量删除
$("#batchDelButton").on('click', function() {
  var checked = $("tbody input:checked");
  // $("tbody input").prop("checked",checked);
  var cat_ids = [];
  $("#batchDelButton").toggle(this.checked);
  $.each(checked, function(k, v) {
    cat_ids.push($(v).val());
  });
  cat_ids = cat_ids.join();
  //发送ajax请求
  $.get('../api/batchDel.php',{'cat_ids':cat_ids},function(res){
    console.log(res);
    if (res.code==200) {
      //删除成功
      checked.parents("tr").remove();
      //提示成功的信息
      $(".alert-success").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
    }else{
      //失败提示失败信息
      $(".alert-danger").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
    }
  },'json');
});
$("tbody").on('click', 'input', function() {
  var checked = $("tbody input:checked");
  // console.log(checked.length);
  if (checked.length>0) {
    // console.log(checked.length);
    $("#batchDelButton").show();
  }else{
    $("#batchDelButton").hide();
  }
});
//完成全选反选操作
$("#batchDel").on('click', function(event) {
  $("tbody input").prop('checked',this.checked);
  $("#batchDelButton").toggle(this.checked);
});
//编辑
var cat_id;
var tr ;
$("tbody").on('click', '.updCat', function() {
  //获取当前分类的类名喝分类名称
  tr = $(this).parents("tr");
  //获取tr中的分类的cat_id
  cat_id = tr.find('input').val();
  //获取分类名称
  var cat_name = tr.children('td').eq(1).html();
  //获取类名
  var classname = tr.children('td').eq(2).html();
  // console.log(cat_name,classname);
  //把获取的数据放到input表单中
  $("input[name='cat_name']").val(cat_name);
  $("input[name='classname']").val(classname);
  //让确定编辑和取消编辑的按钮显示
  $("#upd").show();
  $("#cancelUpd").show();
  //让添加隐藏
  $("#addBtn").hide();
});
//取消编辑
$("#cancelUpd").on('click',function(){
  $("#cancelUpd").hide();
  $("#upd").hide();
  $("#addBtn").show();
  $("input[name = 'cat_name']").val("");
  $("input[name = 'classname']").val("");
})
//确认编辑
$("#upd").on('click',function(){
  var cat_name = $("input[name = 'cat_name']").val();
  var classname = $("input[name = 'classname']").val();
  if ($.trim(cat_name)==''||$.trim(classname)=='') {
    $(".alert-danger").slideDown(1000).delay(2000).slideUp(1000).html("<strong>分类名称或类名不能为空</strong>");
    return;
  };
  //发送ajax请求
  $.post("../api/updCat.php",{"cat_id":cat_id,"classname":classname,"cat_name":cat_name},function(res){
    if (res.code == 200) {
      //让编辑的数据回显在之前的tr的td中
      tr.children('td').eq(1).html(cat_name);
      tr.children('td').eq(2).html(classname);
      $("#cancelUpd").click();
      $(".alert-success").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
    }else{
      $("#cancelUpd").click();
      $(".alert-danger").slideDown(1000).delay(2000).slideUp(1000).html("<strong>"+res.message+"</strong>");
    }
  },'json');

})
</script>
</body>
</html>
