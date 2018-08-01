<?php
    include_once '../function.php';
    //接收参数page
    $page = $_GET['page'];
    //链接数据库
    $link = connect();
    //编写sql语句
    $pageSize = 10;
    $offset = ($page-1)*$pageSize;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
    $sql = "select * from comments limit $offset,$pageSiz";
    //执行sql语句 获取结果
    $result = query($link,$sql);
    
    //执行查询总数的sql 获取出评论的总数 进而算出页码数
    $sql2 = "select count(*) as count from comments";
    $result2 = query($link,$sql2);
    $pageCount = ceil($result2[0]['count']);
    

?>