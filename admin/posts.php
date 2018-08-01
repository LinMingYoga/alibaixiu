<?php

include_once "../function.php";
isLogin();
$visitor = 'posts';
$sql = "select * from category";

$link = connect();
$sql = "select * from category";
$catDatas = query($link,$sql);


?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
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
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示
      <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select name="cat_id" class="form-control input-sm">
          <option value="all">所有分类</option>
          <?php foreach($cat_datas as $val): ?>
            <option value="<?php echo $val["cat_id"] ?>"><?php echo $val["cat_name"] ?></option>
          <?php endforeach; ?>
            <!-- <option value="">未分类</option> -->
          </select>
          <select name="status" class="form-control input-sm">
            <option value="all">所有状态</option>
            <option value="drafted">草稿</option>
            <option value="published">已发布</option>
            <option value="trashed">已作废</option>
          </select>
          <button id="search" class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">

        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>

  <video autobuffer autoloop loop controls>
    <source src="/media/video.oga">
    <source src="/media/video.m4v">
    <object type="video/ogg" data="/media/video.oga" width="320" height="240">
    <param name="src" value="/media/video.oga">
    <param name="autoplay" value="false">
    <param name="autoStart" value="0">
    <p><a href="/media/video.oga">Download this video file.</a></p>
    </object>
  </video>

  <!-- 引入目录 -->
  <?php include_once './menu.php'; ?>
  <!-- 引入目录 -->

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/art-template/template-web.js"></script>
  <script src="../assets/plugins/jquery.twbsPagination.js"></script>
  <script type="text/javascript" charset="utf-8" src="../static/plugins/layer/layer.js"></script>
</body>

<script type="text/template" id="temp">
  {{each data value}}
    <tr>
      <td class="text-center"><input type="checkbox" value="{{value.post_id}}"></td>
      <td>{{value.title}}</td>
      <td>{{value.nickname}}</td>
      <td>{{value.cat_name}}</td>
      <td class="text-center">{{value.created}}</td>
      <td class="text-center">
        {{if value.status == 'drafted'}}
        草稿
        {{else if value.status == 'published'}}
        已发布
        {{else}}
        已作废
        {{/if}}
      </td>
      <td class="text-center">
        <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
        <a href="javascript:;" class="delPost btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
  {{/each}}
</script>

<script type="text/javascript">
  var pageCount = 0;//定义页码总数
  //ajax加载文章数据
  $.get(
    '../api/getPostsData.php',
    '',
    function(res) {
      console.log(res.data);
      console.log(res);
      if (res.code == 200) {
        var data = res.data;
        //把分页的总数赋值给pageCount
        pageCount = res.pageCount;
        //调用模板引擎
        var tbody = template('temp',{"data":data});
        $("tbody").html(tbody);
        pageList();
      };
  },'json');


  function pageList(){
    //把class = pagination 渲染出分页页码的html结构
    $(".pagination").twbsPagination({
      totalPages:pageCount,//分页页码的总页数
      visiblePages:7,//展示的页码数
      initiateStartPageClick:false,//取消默认点击
      onPageClick:function(event,page){
        //page 当前所点击的页码数
        //发送ajax请求，获取页码对应的数据
        var cat_id = $("select[name = 'cat_id']").val();
        var status = $("select[name = 'status']").val();
        $.get(
          '../api/getPostsData.php',
          {"page":page},
          function(res) {
            var data = res.data;
            //使用模板引擎进行渲染数据
            var tbody = template('temp',{"page":page,"cat_id":cat_id,"status":status});
            var data = res.data;
            //使用模板渲染页面
            var tbody = template('temp',{"data":data});
            $("tbody").html(tbody);
        },'json');
      }
    });
  }


  //ajax筛选文章数据
  $("#search").on('click',function(){
    //获取分类的id和状态
    var cat_id = $("select[name='cat_id']").val();
    var status = $("select[name='status']").val();
    //发送ajax请求，获取指定条件的筛选数据
    $.get("../api/getPostsData.php",{"cat_id":cat_id,"status":status},function(res){
        if(res.code == 200){
          //赋值给pageCount分页总数
          pageCount = res.pageCount;
          var data = res.data;
          //调用模板引擎渲染数据
          var tbody = template('temp',{"data":data});
          //把渲染好的数据写在tbody标签中
          $("tbody").html(tbody);
          //重置绘制筛选条件后的分页页码结构
          pageList();
        }else{
          $("tbody").empty();
          $(".pagination").empty();
          $(".pagination").removeData('twbs-pagintion');
          $(".pagination").unbind("page");
        }
    },'json');
    return false;
  })


//使用委托的方式给class=delepost绑定单击事件，发送Ajax请求，删除文章
$("tbody").on("click",'.delPost',function () {
  var _self = $(this);
  layer.confirm('确认删除？',{
    btn:['确定','取消']
  },function(){
    //确定删除的逻辑
    layer.closeAll();//关闭询问框
    var post_id = _self.parents("tr").find("input").val();
    //发送ajax请求进行删除
    //发送之前，loading提示
    layer.load(1,{shade:[0.5,'#000'],shadeClose:false});//0代表加载的风格，支持0-2
    $.post(
      "../api/delPost.php",
      {"post_id":post_id},
      function (res){
        console.log(res);
        //主要关闭loading层
        layer.closeAll();
        if(res.code == 200){
          _self.parents('tr').remove();
        }else{
          //提示错误信息
          layer.msg(res.message);
        }
      },'json');
  },function(){
    //取消删除逻辑
  });
})

</script>


</html>
