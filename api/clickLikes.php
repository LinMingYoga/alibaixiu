<?php
/**
 * @Author: Marte
 * @Date:   2018-07-12 18:54:19
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-07-12 21:07:14
 */

include_once "../conn.php";
//接收文章的post_id参数
$post_id = $_POST['post_id'];
// echo $post_id;
//先获取到原来的点赞数量
//编写sql语句，获取数据
$sql = "select likes from posts where post_id = $post_id";
$res = conn($sql);
$oldLikes = $res[0]['likes'];


//把以前的数据库数量进行更新，加1
//更新数量的sql语句
$conn = mysqli_connect('127.0.0.1','root','root','bx');
//执行sql语句
$sql2 = "update posts set likes = likes + 1 where post_id = $post_id";
//执行sql语句
$res2 = mysqli_query($conn,$sql2);
if($res){
    //成功
    $response = ['code' => 200, 'message'=>'成功','newLikes'=>$oldLikes+1];
}else{
    //失败
    $response = ['code'=>-1,'message'=>'失败'];
}
mysqli_close($conn);
//响应json格式的数据
echo json_encode($response);
?>