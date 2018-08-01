<?php
// include_once '../api/linkSql.php';
$conn = mysqli_connect('127.0.0.1','root','root','bx');
session_start();
$user_id = $_SESSION['user_id'];
$nickname = $_POST['nickname'];
$bio = $_POST['bio'];
$avatar = $_POST['avatar'];
echo $avatar;
$sql ="update users set nickname= '$nickname',bio = '$bio',avatar='$avatar' where user_id = $user_id";
$res = mysqli_query($conn,$sql);


if (mysqli_affected_rows($conn)) {
    $response = ['code'=>200,'message'=>'修改信息成功'];
}else{
    $response = ['code'=>-1,'message'=>'修改信息失败,未修改过'];
}
echo json_encode($response);

?>