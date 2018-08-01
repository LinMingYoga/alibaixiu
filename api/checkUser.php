<?php

$conn = mysqli_connect('127.0.0.1','root','root','bx');
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "select * from users where email = '$email' and password = '$password'";
$res = mysqli_query($conn,$sql);
if (mysqli_num_rows($res)) {
    $userInfo = mysqli_fetch_assoc($res);
    // print_r($userInfo);
    $response = ['code'=>200,'message'=>'登录成功'];
    session_start();
    $_SESSION['user_id'] = $userInfo['user_id'];
    $_SESSION['nickname'] = $userInfo['nickname'];
    $_SESSION['avatar'] = $userInfo['avatar'];
}else{
    $response = ['code'=>-1,'message'=>'用户名或密码错误！'];
}
echo json_encode($response);
?>