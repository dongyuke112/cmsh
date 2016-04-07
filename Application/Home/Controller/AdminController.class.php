<?php

namespace Home\Controller;

use Think\Controller;
use Common\Page;

class AdminController extends Controller
{
   public function index()
   {

      $this->display();
   }
    public function logincheck()
    {
         $table=M("user");
        $username=I("username");
        $password=I("password");
        $password=md5("$password");
      $arr=[
          "username"=>$username,
          "password"=>$password,
          "softdelete"=>0
      ];
        $find=$table->where($arr)->find();

        if($find){
            $_SESSION["admin"]["username"]=$find["username"];
            $_SESSION["admin"]["user_id"]=$find["id"];

            $id=$find["id"];

             if($find["perm"]==1){
                 $_SESSION["admin"]["root"]=1;
                 $this->success("","/home/admin/alllist");
             } else {
              $perm=M("perm");
               $perms=  $perm->field("perm")->join("left join lt_user_perm on lt_perm.id=lt_user_perm.perm_id ")->where("lt_user_perm.user_id=$id")->select();
             if($perms){

                 foreach ($perms as $items)
                 {
                     $_SESSION["admin"]["perm"][]=$items["perm"];
                 }
                 $this->success("","/home/admin/alllist");
             } else {
                 $this->error("","/home/admin/index");
             }

             }
        }else {
            $this->error("","/home/admin/index");
        }
    }
    public function alllist()
    {
       $this->name= $_SESSION["admin"]["username"];
        $id=$_SESSION["admin"]["user_id"];
        $table=M("user_info");
      $info=$table->where("user_id=$id")->find();
        $arr=[
            "id"=>"",
            "name"=>"没有用户名，请完善用户信息！",
            "gender"=>"M",
            "birthday"=>"0000-00-00",
            "mobile"=>"没有填写手机号码！",
            "email"=>"没有填写E_mial",
            "sign"=>"没有填写个性签名",
            "imagepath"=>"/public/image/defimg.gif"

        ];
        if($info){
            $this->info=$info;
        } else {
            $this->info=$arr;
        }
        $this->display();

    }
    public function logout()
    {
        unset($_SESSION["admin"]);
        $this->success("欢迎下次使用","/home/admin/index");
    }
    public function userlist()
    {
        $this->name= $_SESSION["admin"]["username"];
        $table=M("user");

        if(isset($_GET["p"]))
        {
            $p=$_GET["p"];
        } else {
            $p=1;
        }
        $keyword=I("keyword");
        $condition=[
            "username"=>["like","%$keyword%"]
        ];
        $result=$table->where($condition)->page($p,10)->select();
       $count= $table->where($condition)->count();
        $page=new Page($count,10);

        if($keyword){
            $page->parameter.="&keyword=$keyword";
        }
        $this->page=$page;
        $this->result=$result;
        $this->display();
    }
    public function mk()
    {
        $this->name= $_SESSION["admin"]["username"];
        $this->display();
        if(isset($_GET["m"])){
          $this->m=  $m=$_GET["m"];

        }
    }
    public function softdel()
    {
         $id=I("id");
        $table=M("user");
       $table->softdelete='1';
      $xx=  $table->where("id=$id")->save();
        if($xx)
        {
         $this->success("操作成功","/home/admin/userlist");
        } else {
            $this->error("","/home/admin/userlist");
        }
    }
    public function recover()
    {
        $id=I("id");
        $table=M("user");
        $table->softdelete='0';
        $xx=  $table->where("id=$id")->save();
        if($xx)
        {
            $this->success("操作成功","/home/admin/userlist");
        } else {
            $this->error("","/home/admin/userlist");
        }
    }
    public function addperm()
    {
        $this->name= $_SESSION["admin"]["username"];
        $table=M("user");
        $username=I("username");
        $conction=[
            "username"=>["like","%$username%"]
        ];
        if(isset($_GET["p"])){
            $p=$_GET["p"];
        } else {
            $p=1;
        }
        $count=$table->where($conction)->count();
        $result=$table->where($conction)->page($p,2)->select();
        $this->result=$result;
        $page=new Page($count,2);
        if($username)
        {
            $page->parameter.=$_GET["username"];
        }

        $this->page=$page;


        $this->display();

    }

}