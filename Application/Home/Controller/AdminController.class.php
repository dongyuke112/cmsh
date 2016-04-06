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
          "password"=>$password
      ];
        $find=$table->where($arr)->find();

        if($find){
            $_SESSION["admin"]["username"]=$find["username"];
            $_SESSION["admin"]["user_id"]=$find["id"];

            $id=$find["id"];
             if($find["perm"]==1){
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
        $table=M("user");
        $count=$table->count();
        $page=new Page(100,20);
        $this->page=$page;
       $result=$table->select();
        $this->display();
    }
}