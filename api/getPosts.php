<?php

include_once "../conn.php";

//总文章数
$sql = "select count(*) alls from posts";
$res = conn($sql);
// print_r($res);
//草稿
$sql2 = "select count(*) dra from posts where status = 'drafted'"; 
$res2 = conn($sql2);

//总分类数
$sql3 = "select count(*) all_cat from category";
$res3 = conn($sql3);

//总评论数
$sql4 = "select count(*) all_comm from comments";
$res4 = conn($sql4);



$sql5 = "select count(*) held from comments where status = 'held'";
$res5 = conn($sql5);
// print_r($data);
$data = [$res,$res2,$res3,$res4,$res5];
if($res){
    $response = ['code'=>200,'message'=>'获取文章总数成功','data'=>$data];
}else{
    $response = ['code'=>-1,'message'=>'获取文章总数失败'];
}

echo json_encode($response);
?>