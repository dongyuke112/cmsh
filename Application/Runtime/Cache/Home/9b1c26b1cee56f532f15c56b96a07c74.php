<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>超卖商城</title>
    <script src="/public/bootstrap/js/jquery.min.js"></script>
   <link href="/public/css/index.css" rel="stylesheet" type="text/css" />
    <script src="/public/myfocus/myfocus-2.0.4.min.js"></script>
</head>
<body class="ye_body">
  <div class="ye_first_div">
   <div class="ye_left " ><a href="#" class="ye_col" >家用电器</a>></div>
    <div class="ye_left "><a href="#" class="ye_col">手机、数码、京东通信</a>></div>
    <div class="ye_left "><a href="#" class="ye_col">电脑、办公</a>></div>
    <div class="ye_left "><a href="#" class="ye_col">家居、家具、家装、厨具</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">男装、女装、内衣、珠宝</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">个护化妆、清洁用品</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">鞋靴、箱包、钟表、奢侈品</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">运动户外</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">汽车、汽车用品</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">母婴、玩具乐器</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">食品、酒类、生鲜、特产</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">营养保健</a>></div>
    <div class="ye_left"><a href="#" class="ye_col">图书、音像、电子书</a>></div>
</div>
<div class="ye_image_show"></div>
<script type="text/javascript">
    $(".ye_left").mouseover(function(){
        $(this).css("background-color","whitesmoke");

    })
    $(".ye_col").mouseover(function(){
        $(this).css("color","#DC1623")
    });
    $(".ye_left").mouseout(function(){
        $(this).css("background-color","#DC1623");

    })
    $(".ye_col").mouseout(function(){
        $(this).css("color","whitesmoke")
    });

</script>
</body>
</html>