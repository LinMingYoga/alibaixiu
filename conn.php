<?php
/**
 * @Author: LinMing
 * @Date:   2018-07-11
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-07-11
 */

function conn($sql){
    $conn = mysqli_connect('127.0.0.1','root','root','bx');
    if ((!$conn)) {
        die('数据库连接失败');
    }
    mysqli_set_charset($conn,'utf8');
    $res = mysqli_query($conn,$sql);
    // print_r($res);
    $arr = [];
    while ($data = mysqli_fetch_assoc($res)) {
        $arr[] = $data;
    }
    mysqli_close($conn);
    return $arr;
}
//判断用户是否登录
function isLogin(){
    session_start();
    if(!isset($_SESSION['user_id'])){
        //说明没有session信息，跳转到登录页
        echo '请先登录';
        header("refresh:2;url='login.php'");exit;
    }
}
?>