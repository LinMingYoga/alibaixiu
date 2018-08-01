<?php
include_once "../conn.php";
$cat_id = $_POST['cat_id'];
$cat_name = $_POST['cat_name'];
$classname = $_POST['classname'];

$sql = "select * from category where cat_name = '$cat_name' and cat_id = '$cat_id'";
$result = conn($sql);


if ($result) {
    $response = ['code'=>-1,'message'=>'分类名称重复'];
    echo json_encode($response);
}



$conn = mysqli_connect('127.0.0.1','root','root','bx');
$sql2 = "update category set cat_name = '$cat_name',classname = '$classname' where cat_id = $cat_id";
$res = mysqli_query($conn,$sql2);
if($res){
    $response = ['code'=>200,'message'=>'编辑成功'];
}else {
    $response = ['code'=>-2,'message'=>'编辑失败或是没有改数据'];
}

echo json_encode($response);

 ?>