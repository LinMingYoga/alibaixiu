<?php
include_once '../conn.php';
$tmp_name = $_FILES['file']['tmp_name'];

$ext = strrchr($_FILES["file"]["name"],'.');
$filename = time().$ext;
$uploadPath = "../uploads/".$filename;
if (move_uploaded_file($tmp_name,$uploadPath)) {
    $response = ['code'=>200,'message'=>'文件上传成功','url'=>$uploadPath];
}else{
    $response = ['code'=>-1,'message'=>'文件上传失败'];
}
echo json_encode($response);
?>