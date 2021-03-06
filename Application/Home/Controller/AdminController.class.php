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

    public function loginCheck()
    {
        $table = M("user");
        $username = I("username");
        $password = I("password");
        $password = md5("$password");
        $arr = [
            "username" => $username,
            "password" => $password,
            "softdelete" => 0
        ];
        $find = $table->where($arr)->find();

        if ($find) {
            $_SESSION["admin"]["username"] = $find["username"];
            $_SESSION["admin"]["user_id"] = $find["id"];

            $id = $find["id"];

            if ($find["perm"] == 1) {
                $_SESSION["admin"]["root"] = 1;
                $this->success("", "/home/admin/alllist");
            } else {
                $perm = M("perm");
                $perms = $perm->field("perm")->join("left join lt_user_perm on lt_perm.id=lt_user_perm.perm_id ")->where("lt_user_perm.user_id=$id")->select();
                if ($perms) {

                    foreach ($perms as $items) {
                        $_SESSION["admin"]["perm"][] = $items["perm"];
                    }
                    $this->success("", "/home/admin/alllist");
                } else {
                    $this->error("", "/home/admin/index");
                }

            }
        } else {
            $this->error("", "/home/admin/index");
        }
    }

    public function allList()
    {
        $this->name = $_SESSION["admin"]["username"];
        $id = $_SESSION["admin"]["user_id"];
        $table = M("user_info");
        $info = $table->where("user_id=$id")->find();
        $arr = [
            "id" => "",
            "name" => "没有用户名，请完善用户信息！",
            "gender" => "M",
            "birthday" => "0000-00-00",
            "mobile" => "没有填写手机号码！",
            "email" => "没有填写E_mial",
            "sign" => "没有填写个性签名",
            "imagepath" => "/public/image/defimg.gif"

        ];
        if ($info) {
            $this->info = $info;
        } else {
            $this->info = $arr;
        }
        $this->display();

    }

    public function logOut()
    {
        unset($_SESSION["admin"]);
        $this->success("欢迎下次使用", "/home/admin/index");
    }

    public function userList()
    {
        $this->name = $_SESSION["admin"]["username"];
        $table = M("user");

        if (isset($_GET["p"])) {
            $p = $_GET["p"];
        } else {
            $p = 1;
        }
        $keyword = I("keyword");
        $condition = [
            "username" => ["like", "%$keyword%"]
        ];
        $result = $table->where($condition)->page($p, 10)->select();
        $count = $table->where($condition)->count();
        $page = new Page($count, 10);
        for ($i = 0; $i <= count($count); $i++) {
            if ($result[$i]["perm"] == 1) {
                unset($result[$i]);
            }
        }
        $this->page = $page;
        $this->result = $result;
        $this->display();
    }

    public function mk()
    {

        $this->name= $_SESSION["admin"]["username"];
        if(isset($_GET["m"])){
          $this->m= $m=$_GET["m"];


        }
        $table =M("content");
            $s = I("s","");
        $arr = [
            "mokuai" => $m,
        ];
            if ($s) {
                $arr["title"] = ["like", "%$s%"];
            }
        $this->result= $table->field("lt_content.id as tzid,lt_content.title,lt_content.created_at,lt_user.username")
            ->join("lt_user on lt_content.user_id =lt_user.id")->where
        ($arr)
            ->select();
        $this->display();
    }

    public function softDel()
    {
        $id = I("id");
        $table = M("user");
        $table->softdelete = '1';
        $xx = $table->where("id=$id")->save();
        if ($xx) {
            $this->success("操作成功", "/home/admin/userlist");
        } else {
            $this->error("", "/home/admin/userlist");
        }
    }

    public function recover()
    {
        $id = I("id");
        $table = M("user");
        $table->softdelete = '0';
        $xx = $table->where("id=$id")->save();
        if ($xx) {
            $this->success("操作成功", "/home/admin/userlist");
        } else {
            $this->error("", "/home/admin/userlist");
        }
    }

    public function addPerm()
    {
        $this->name = $_SESSION["admin"]["username"];
        $table = M("user");
        $username = I("username");
        $conction = [
            "username" => ["like", "%$username%"]
        ];
        if (isset($_GET["p"])) {
            $p = $_GET["p"];
        } else {
            $p = 1;
        }
        $count = $table->where($conction)->count();
        $result = $table->where($conction)->page($p, 10)->select();
        $this->result = $result;
        $page = new Page($count, 10);
        $this->page = $page;
        $this->display();

    }

    public function change()
    {
        $this->name = $_SESSION["admin"]["username"];
        $table = M("perm");
        $id = I("id");
        $this->id = $id;
        if ($id) {
            $res = $table->field("lt_user.username,lt_user.id as userid ,lt_perm.perm,lt_user.perm as userperm")->where("lt_user.id=$id")->join("left join lt_user_perm on lt_perm.id=lt_user_perm.perm_id left join lt_user on
             lt_user_perm.user_id=lt_user.id
             ")->select();

        }
        $premss = [];
        foreach ($res as $items) {
            $premss[] = $items["perm"];
        }
        $this->perm = $premss;
        $this->display();

    }
    public  function  deletetie(){
        if(isset($_GET["m"])){
            $this->m= $m=$_GET["m"];
        }
        if(isset($_GET["id"])){
            $this->id= $id=$_GET["id"];
        }
        $table =M("content");
        $table->where("mokuai=$m AND id =$id")->delete();
        $this->redirect("/home/admin/mk/m/$m");

    }


    public function changeSave()
    {
        $prem = I("perm");
        $id = I("id");
        $table = M("user_perm");
        $table->where("user_id=$id")->delete();
        if($prem){
            foreach ($prem as $items){
              $table->user_id=$id;
                $table->perm_id=$items;
                $table->add();

            }
        }
          $this->success("","/home/admin/addperm");

    }
    public function showperm ()
    {
        $table=M("perm");
       $perm= $table->select();

        $this->display();
    }



}