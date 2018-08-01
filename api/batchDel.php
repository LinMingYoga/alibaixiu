<?php

$conn = mysqli_connect('127.0.0.1','root','root','bx');
//接收参数
$cat_ids = $_GET['cat_ids'];
//连接数据库
//sql语句
$sql = "delete from category where cat_id in ($cat_ids)";
//执行
$res = mysqli_query($conn,$sql);
if ($res) {
    $response = ['code'=>200,'message'=>'批量删除成功'];
}else{
    $response = ['code'=>-1,'message'=>'批量删除失败'];
}
echo json_encode($response);


 ?>