
<?php

include_once "../function.php"  ;
//检测是否有登录
isLogin();
//session_start(); //开启session会话
//用一个变量存储当前访问的页面
$visitor = 'posts-add';
//获取分类
//1.链接数据库
$link = connect();
//2.编写sql语句
$sql = "select * from category";
//3.执行sql语句，获取数据
$catDatas = query($link,$sql);
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">标题</label>
            
            <!-- <script id="editor" type="text/plain" style="width:1024px;height:500px;"></script> -->
            <!-- <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"> -->
            
            <!-- </textarea> -->
            
          </div>
          <!-- 加载编辑器的容器 -->
          <script id="container" class="col-xd-11" style="height:300px;" name="content" type="text/plain"></script>
            <!-- 配置文件 -->
            <script src="ueditor/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script src="ueditor/ueditor.all.min.js"></script>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
					        var ue = UE.getEditor('container');
					    </script>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="url" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
            <?php  foreach($catDatas as $cat): ?>
                <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="text">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <span class="btn btn-primary" id='addPost' >保存</span>
          </div>
        </div>
      </form>
    </div>
  </div>


  <?php include_once "./menu.php" ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../static/plugins/laydate/laydate.js"></script>
  <script type="text/javascript" charset="utf-8" src="../static/plugins/layer/layer.js"></script>
  <script>
    var url = '';
    $("#feature").change(function() {
      var file = this.files[0];
      if (!file) {
        return false;
      }
      //插入一个表单对象
      var formObj = new FormData();
      formObj.append('file',file);
      //发送ajax
      $.ajax({
        "type":"post",
        "url":"../api/uploadImg.php",
        "data":formObj,
        "contentType":false,
        "processData":false,
        "dataType":'json',
        "success":function(res){
          console.log(res);
          if (res.code == 200) {
            url = res.url;
            $(".help-block").show().attr('src',res.url);
          }
        }
      });
    });
    laydate.render({
      elem:"#created",
      type:'datetime'
    });
    // var ue = UE.getEditor("content");

    var index ;
    //ajax实现文章添加
    $("#addPost").on("click",function (){
      var param = $("#form").serialize();
      //拼接图片的地址
      param += "&url="+url;
      console.log(param);
      index = layer.msg('入库中...',{
        shade:[0.5,'#000'],
        shadeClose:false
      })
      $.get("../api/addPostData.php",param,function (res) {
        layer.close(index);
        if (res.code==200) {
         layer.msg(res.message);
         location.href = "./posts.php"; 
        }else{
          layer.msg(res.message);
        }
      },'json');
    })
  </script>


</body>
</html>
