<?php
include_once "../conn.php";
//接收参数cat_id
$cat_id = $_GET['cat_id'];
//sql语句
$sql = "delete from category where cat_id = '$cat_id'";
$conn = mysqli_connect('127.0.0.1','root','root','bx');
$res = mysqli_query($conn,$sql);

if (mysqli_affected_rows($conn)) {
    //删除成功
    $response = ['code'=>200,'message'=>'删除成功'];
}else{
    $response = ['code'=>-1,'message'=>'删除失败'];
}
//响应json格式数据
echo json_encode($response);



?>