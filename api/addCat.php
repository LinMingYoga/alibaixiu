<?php
/**
 * @Author: LinMing
 * @Date:   2018-07-12
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-07-16
 */
$cat_name = $_POST['cat_name'];
$classname = $_POST['classname'];
include_once "../conn.php";
$sql = "select * from category where cat_name = '$cat_name'";
$res = conn($sql);
if ($res) {
    $response = ['code'=>-1,'message'=>'该分类名已存在'];
    echo json_encode($response);
    exit();
};


//入库操作
$sql2 = "insert into category(cat_name,classname) values('$cat_name','$classname')";
//执行入库的sql语句
$conn = mysqli_connect('127.0.0.1','root','root','bx');
$res =mysqli_query($conn,$sql2);
//判断是否成功
if ($res) {
    //入库成功，还需要返回给一个新增成功的记录id
    $response = ['code'=>200,'message'=>'添加分类成功','insert_id'=>mysqli_insert_id($conn)];
}else{
    $response = ['code'=>-2,'message'=>'添加分类失败'];
}
echo json_encode($response);


?>