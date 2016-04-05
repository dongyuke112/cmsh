<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/1
 * Time: 14:45
 */
function auth()
{
    if($_SESSION["auth"] || $_COOKIE['remember']){
      echo  $arr=$_COOKIE['remember'];
        $yaoshi=$_SESSION["$arr"];
        ?>
      <div class="col-md-3" style="color:white;line-height: 50px">欢迎<?=$_SESSION["auth"]["username"]?><a href="/home/index/logout">退出</a></div>
         <div class="col-md-1"><button type="button" class="btn" id="morebox">更多</button></div>
        <?php
    } else {
        ?>
        <div class="col-md-2  "><a href="/home/index/login">登录</a> &nbsp;<a href="/home/index/regiest">注册</a></div>
        <?php
    }
}
function lt_id()
{
    if(isset($_SESSION["auth"])){
        echo $_SESSION["auth"]["id"];
    }
}