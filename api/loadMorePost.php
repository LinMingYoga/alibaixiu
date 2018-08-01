<?php
include_once "../conn.php";
$cat_id = $_GET['cat_id'];
$lastPostId = $_GET['lastPostId'];
$sql = "
select p.*,c.cat_name,u.nickname ,
(select count(*) from comments where post_id = p.post_id) commentCount
from posts  p
left join category c on p.cat_id = c.cat_id
left join users u on p.user_id = u.user_id
where c.cat_id = $cat_id and p.post_id < $lastPostId
order by p.post_id desc
limit 5
";
$morePostsData = conn($sql);
if ($morePostsData) {
    //成功
    $res = ['code'=>200,'message'=>'加载数据成功','data'=>$morePostsData];
}else{
    //失败
    $res = ['code'=>-1,'message'=>'无数据','data'=>[]];
}
echo json_encode($res);


?>