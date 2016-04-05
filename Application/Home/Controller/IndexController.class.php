<?php
namespace Home\Controller;

use Common\Page;
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
<<<<<<< HEAD

                // $arr = $_COOKIE['PHPSESSID'];

                $time=time()+rand(0,99);
                $yaoshi=sha1(md5($time));
                //$_SESSION['remember']=$yaoshi;
                setcookie('remember',$yaoshi,time()+86400*7);
=======
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
>>>>>>> 59b93c03937eb9c4360d9b7542d0e2c16cddbf14
                $tables=M('user_remember');
                $tables->user_id=$result['id'];
                $tables->remember=$yaoshi;
                $date=date('Y-m-d H:i:s');
                $tables->created_at=$date;
                $tables->add();
<<<<<<< HEAD
=======
                exit;

>>>>>>> 59b93c03937eb9c4360d9b7542d0e2c16cddbf14
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
<<<<<<< HEAD

=======

    public function updateuser()
    {

        $this->display();
    }
>>>>>>> 59b93c03937eb9c4360d9b7542d0e2c16cddbf14

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

<<<<<<< HEAD
    public function mengpailist()
=======
    public function updateusersave()
>>>>>>> 59b93c03937eb9c4360d9b7542d0e2c16cddbf14
    {
        $table=M("content");
        $count=$table->count();
        $this->pager=new Page($count,20);
        if(isset($_GET["m"]))
        {
            $m=$_GET["m"];
        } else {
            $m=1;
        }
        if(isset($_GET["p"]))
        {
            $p=$_GET["p"];
        } else
        {
            $p=0;
        }
        $this->p=$m;

       $result= $table->field("lt_user.username,lt_content.id,lt_content.title,lt_content.created_at")->join('LEFT JOIN lt_user ON lt_user.id = lt_content.user_id')->limit($p,20)->where("mokuai=$m")->order("lt_content.created_at desc")->select();
         $this->result=$result;

        $this->display();

    }
<<<<<<< HEAD
    public function fatie()
=======

    public function mengpailisy()
>>>>>>> 59b93c03937eb9c4360d9b7542d0e2c16cddbf14
    {
    $this->display();
    }
    public function fatiesave()
    {
      $table=M("content");
        $table->create();
        $table->created_at=date("Y-m-d H:i:s");
        $table->add();
    }
    public function updateuser()
    {
        $id= $_SESSION["auth"]["id"];
        $table=M("problem");
        $problem=M("user_problem");
        $problem->create();
        $table->create();
        $xx=$this->result=$problem->where("user_id=$id")->select();
        $pro=[];
        foreach($xx as $items ) {
            $pid= $items["problem_id"];
            $pro[]=$table->where("id = $pid")->find();
        }
        $this->pro=$pro;
        $this->display();

    }
    public function updateusersave()
    {
        $id= $_SESSION["auth"]["id"];
        $data = I('data');
        $problem=M("user_problem");
        $problem->create();
        $xx=$this->result=$problem->where("user_id=$id")->select();
        $daan=[];
        foreach ($xx as $items){
            $daan[]=$items['problems'];
        }
        if ($data[0]==$daan[0]&&$data[1]==$daan[1]&&$data[2]==$daan[2]) {
            header("location:/home/index/updatecode");
        } else {
            $this->error("错误","/home/index/updateuser");
        }
    }
    public  function  updatecodesave(){
        $table = M('user');
        $table->create();
        $id =$_SESSION['auth']['id'];
        $arr=$table->where("id = $id")->find();
        $newpassword = md5(I('newpassword'));
        if ($newpassword ){
            $table->id=$id;
            $table->username= $_SESSION["auth"]["username"];
            $table->password=$newpassword;
            $table->save();
            $this->success('成功','/home/index/index');
        } else {
            $this->error('原始密码输入错误','/home/index/updatecode');
        }
    }
    public function tiezi()
    {
        $id=I("id");
       if($id)
       {
           $table=M("content");
          $result= $table->find($id);
           $this->result=$result;


       }
        if(isset($_GET["m"]))
        {
            $m=$_GET["m"];
        } else {
            $m=1;
        }
        $this->p=$m;
        $this->display();
    }



}