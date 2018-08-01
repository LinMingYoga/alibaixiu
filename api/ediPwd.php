<?php
    // echo "123";

// include_once './linkSql.php';
include_once '../function.php';
session_start();
$user_id = $_SESSION['user_id'];
$old = $_POST['old'];
$confirm = $_POST['confirm123'];


$link = connect();

$sql = "select * from users where user_id = '$user_id' and password = '$old' ";
$result = query($link,$sql);
if (!$result) {
    $response = ['code'=>-1,'message'=>'旧密码输入错误...'];
    echo json_encode($response);
}

$sql2 = "update users set password = '$confirm' where user_id=$user_id";
$res= mysqli_query($link,$sql2);
if (mysqli_affected_rows($link)) {
    $response = ['code'=>200,'message'=>'密码修改成功'];
}else{
    $response = ['code'=>-2,'message'=>'密码修改失败或未修改'];
}
echo json_encode($response);


?>