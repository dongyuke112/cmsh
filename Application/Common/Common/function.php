<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/1
 * Time: 14:45
 */
function auth()
{
    $res=false;
    if (isset($_COOKIE['remember'])) {
        $xxx = $_COOKIE['remember'];//
        $tables = M('user_remember');//
        $tables->create();
        $condition=[
            'remember'=>"$xxx",
        ];
        $reslut=$tables->where($condition)->find();
        $id=$reslut["user_id"];
        $user=M("user");
        $userin=  $user->where("id=$id")->find();
        if($reslut){
            $_SESSION["auth"]["username"]=$userin["username"];
            $res=true;
        }
    }
    if($_SESSION["auth"]||$res){
        ?>
      <div class="col-md-3" style="color:white;line-height: 50px">欢迎<a href="#" style="color:white;"><?=$_SESSION["auth"]["username"]?></a><a href="/home/index/logout">退出</a></div>
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
function auuth()
{
    if(!$_SESSION["auth"]){
       header("location:/home/index/login");
        exit;
    }
}
function mengpai()
{
    if(isset($_GET["m"]))
    {
        $m=$_GET["m"];
        if($m==1)
        {
           echo "新手上路 ";
        } else if ($m==2){
            echo "天下一统 ";
        } else if ($m==3){
            echo "翰墨承云";
        } else if ($m==4){
            echo "大荒布告";
        } else if ($m==5){
            echo "大荒本纪";
        } else if ($m==6){
            echo "荒火教";
        } else if ($m==7){
            echo "天机营";
        } else if ($m==8){
            echo "魍魉";
        } else if ($m==9){
            echo "翎羽山庄";
        } else if ($m==10){
            echo "云麓仙居";
        } else if ($m==11){
            echo "太虚观";
        } else if ($m==12){
            echo "弈剑听雨阁";
        } else if ($m==13){
            echo "冰心堂";
        } else if ($m==14){
            echo "天下之路";
        } else if ($m==15){
            echo "虎印节堂";
        } else if ($m==16){
            echo "映世宝鉴";
        }else if ($m==17){
            echo "浮生若梦";
        }
    }
}
function is_perm($xx="")
{


        if(isset($_SESSION["admin"])){
            if($_SESSION["admin"]["root"]==1){
                return true;
            } else {
                if(in_array($xx, $_SESSION["admin"]["perm"])){
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            exit("403 forbidden");
        }

}
function zengjia()
{
   if(isset($_SESSION["auth"]["wanshan"])){
       if($_SESSION["auth"]["wanshan"]==1){
           return true;
       } else {
           return false;
       }
   }



}