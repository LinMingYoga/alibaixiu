<?php

include_once __DIR__.'/conn.php';
$cat_id = $_GET['cat_id'];
$cat_data = conn("SELECT t1.*,t2.cat_name,t3.nickname,(select count(*) from comments where post_id = t1.post_id) commentCount FROM
posts t1
LEFT JOIN category t2 ON t1.cat_id = t2.cat_id
left join users t3 on t1.user_id = t3.user_id
where t1.cat_id =$cat_id
order by t1.post_id desc
limit 5");
include_once __DIR__.'/conn.php';
$nav_data = conn('select * from category where cat_id>1');
?>





<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <div class="header">
      <h1 class="logo"><a href="index.html"><img src="assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">


      <?php foreach ($nav_data as $value) { ?>
        <li><a href="list.php?cat_id=<?php echo $value['cat_id'];?>">
       <i class='fa <?php echo $value["classname"] ?>'></i>
        <?php echo $value['cat_name']; ?></a></li>
      <?php } ?>


      </ul>
    </div>
    <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random">
          <li>
            <a href="javascript:;">
              <p class="title">废灯泡的14种玩法 妹子见了都会心动</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_1.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">可爱卡通造型 iPhone 6防水手机套</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_2.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">变废为宝！将手机旧电池变为充电宝的Better</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_3.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">老外偷拍桂林芦笛岩洞 美如“地下彩虹”</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_4.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">doge神烦狗打底南瓜裤 就是如此魔性</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_5.jpg" alt="">
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content">
      <div class="panel new">
        <h3><?php echo isset($cat_data[0]['cat_name'])?$cat_data[0]['cat_name']:''; ?></h3>


        <?php foreach ($cat_data as $value) {?>
        <div class="entry">
          <div class="head">
            <a href="detail.php?post_id=<?php echo $value['post_id'] ?>"><?php echo $value['title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $value['nickname']; ?> 发表于 <?php echo $value['created']; ?></p>
            <p class="brief"><?php echo $value['content']; ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $value['commentCount']; ?>)</span>
              <span class="comment">评论(<?php echo $value['views']; ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $value['likes']; ?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $value['cat_name']; ?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
        <?php $lastPostId = $value['post_id'] ?>
        <?php } ?>
        <div class="loadmore">
          <button type="button" class="btn btn-default" id="moreBtn">加载更多</button>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>




  <script type="text/javascript" src="./assets/vendors/jquery/jquery.js"></script>
  <script type="text/javascript">
  //获取最后一遍文章的post_id
    var lastPostId = "<?php echo isset($lastPostId)?$lastPostId:0; ?>";
      //ajax实现点击加载更多文章
    $(".loadmore").on("click",function(){
          //获取当前分类的cat_id
        var cat_id = "<?php echo $_GET['cat_id'];?>";
        var _self = $(this);
        //防止用户频繁点击，可以让按钮禁用 且给加载提示
        _self.children('button').prop('disabled',true).html('...loading...');
        $.get("./api/loadMorePost.php",{
          "cat_id":cat_id,
          "lastPostId":lastPostId
        },function(res){
          console.log(res);
          //判断是否有数据
          if (res.code==200) {
            var data = res.data;
            //动态构造数据
            var html = "";//用于后面拼接
            $.each(data,function(){
              html += '<div class="entry">\
              <div class="head">\
                <a href="detail.php?post_id=<?php echo $value['post_id'] ?>">'+this.title+'</a>\
              </div>\
              <div class="main">\
                <p class="info">'+this.nickname+' 发表于 '+this.created+'</p>\
                <p class="brief">'+this.content+'</p>\
                <p class="extra">\
                  <span class="reading">阅读('+this.views+')</span>\
                  <span class="comment">评论('+this.commentCount+')</span>\
                  <a href="javascript:;" class="like">\
                    <i class="fa fa-thumbs-up"></i>\
                    <span>赞('+this.likes+')</span>\
                  </a>\
                  <a href="javascript:;" class="tags">\
                    分类：<span>'+this.cat_name+'</span>\
                  </a>\
                </p>\
                <a href="javascript:;" class="thumb">\
                  <img src="uploads/hots_2.jpg" alt="">\
                </a>\
              </div>\
            </div>';
            lastPostId = this.post_id;
            console.log(lastPostId);
            });
            $(".loadmore").before(html);
          };
          //回复按钮可以点击
          _self.children('button').prop('disabled',false).html('加载更多');},'json');
  });
  </script>
</body>
</html>