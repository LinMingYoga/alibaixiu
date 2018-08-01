<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap">
      <img class="avatar" src="../assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display: none;">
        <strong>错误！</strong> 用户名或密码错误！
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码">
      </div>
      <a class="btn btn-primary btn-block" id="login">登 录</a>
    </form>
  </div>




<script type="text/javascript" src="../assets/vendors/jquery/jquery.min.js"></script>
<script type="text/javascript">
$("#login").on("click",function(){
 var email = $("#email").val();
 var password = $("#password").val();
 // console.log(email,password);
 //正则验证
 var  reg = /^\w+@(?:[0-9a-zA-Z]+\.)+[a-zA-Z]{2,5}$/;
 if (email==''||password =='') {
  $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("邮箱或密码不能为空");
  return false;
 };
 if (reg.test(email)==false) {
  $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("邮箱格式不正确");
  return false;
 };
 $.post("../api/checkUser.php",
  {
    "email":email,
    "password":password
  },
  function(res){
  if (res.code==200) {
    alert("登录成功");
    location.href = "./index.php";
  }else{
    $(".alert-danger").slideDown(500).delay(1000).slideUp(500).html("<strong>"+res.message+"</strong>");
  }
 },'json');
})
</script>


</body>
</html>
