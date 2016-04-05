<?php
namespace Home\Controller;

use Think\Controller;
use Think\Verify;


class IndexController extends Controller
{
    public function index()
    {
        $this->display();
    }

    public function regiest()
    {

        $this->display();
    }

    public function image()
    {
        $image = new Verify();
        $image->entry();
    }

    public function imageckeck()
    {
        if (isset($_GET["image_check"])) {
            $image_check = $_GET["image_check"];
        }
        $image = new Verify(['reset' => false]);
        $result = $image->check("$image_check");
        echo $result ? 'true' : 'false';

    }

    public function usernamecheck()
    {
        $table = M("User");
        if (isset($_GET["username"])) {
            $username = $_GET["username"];
        }
        $res = $table->where("username='$username'")->count();
        echo $res ? 'true' : 'false';
    }

    public function regiestsave()
    {
        $table = D("User");
        if ($table->create()) {
            $password = I("password");
            $table->password = md5("$password");
            $table->add();
            $this->success("注册成功", "/home/index/login");
        } else {
            $this->error(implode('-', $table->getError()));
        }

    }

    public function login()
    {

        $this->display();
    }

    public function loginckeck()
    {
        $table = M("user");
        $password = I("psaaword");
        $password = md5("$password");
        $arr = [
            "username" => I("username"),
            "password" => $password,
        ];
        $result = $table->where($arr)->find();
        if ($result["id"]) {
            $_SESSION["auth"]["perm"] = $result["perm"];
            $_SESSION["auth"]["id"] = $result["id"];
            $_SESSION["auth"]["username"] = $result["username"];

            if (isset($_POST['checkbox'])) {
                /*   $arr = $_COOKIE["PHPSESSID"];
                   setcookie("remember", $arr, time() + (7 * 24 * 3600));
                   $time = time() + mt_rand(0, 9999);
                   $yaoshi = sha1(md5("$time"));
                   $_SESSION["remember"] = $yaoshi;
                   $table = D("user_remember");
                   $table->user_id = $result["id"];
                   $table->remember = $yaoshi;
                   $dates = date("Y-m-d H:i:s");
                   $table->created_at = $dates;
                   $table->add();*/
                $arr = $_COOKIE['PHPSESSID'];
                setcookie('remember',$arr,time()+86400*7);
                $time=time()+rand(0,99);
                $yaoshi=sha1(md5($time));
                $_SESSION['remember']=$yaoshi;
                $tables=M('user_remember');
                $tables->user_id=$result['id'];
                $tables->remember=$yaoshi;
                $date=date('Y-m-d H:i:s');
                $tables->created_at=$date;
                $tables->add();
                exit;

            }
            $this->success("登录成功", "/home/index/index");
        } else {
            $this->error("用户名或密码错误", "/home/index/login");
        }

    }

    public function xx()
    {
        $this->display();
    }

    public function logout()
    {
        $_SESSION["auth"] = [];
        $this->success("成功退出！", "/home/index/index");
    }

    public function userinfo()
    {
        $table = M("problem");
        $this->result = $table->select();
        $this->display();
    }

    public function updateuser()
    {

        $this->display();
    }

    public function userinfosave()
    {

        $this->show(111);
        $table = M("User_info");
        $table->create();
        $a = $table->add();
        $problem1 = I("problem1");
        $problem_id1 = I("problem_id1");
        $problem2 = I("problem2");
        $problem_id2 = I("problem_id2");
        $problem3 = I("problem3");
        $problem_id3 = I("problem_id3");
        $user_id = I("user_id");
        $mysql = M("User_problem");
        $b = $mysql->execute("insert into lt_user_problem (problem_id,problems,user_id) values($problem_id1,'$problem1',$user_id)");
        $c = $mysql->execute("insert into lt_user_problem (problem_id,problems,user_id) values($problem_id2,'$problem2',$user_id)");
        $d = $mysql->execute("insert into lt_user_problem (problem_id,problems,user_id) values($problem_id3,'$problem3',$user_id)");

        if ($a && $b && $c && $d) {
            $this->success("成功保存", "/home/index/index");
        } else {
            $this->error("错误", "home/index/userinfo");
        }


    }

    public function updateusersave()
    {
        $this->display();
    }

    public function mengpailisy()
    {
        $this->display();
    }


}