<?php
namespace Home\Controller;

use Common\Page;
use Think\Controller;
use Think\Image;
use Think\Verify;
use Think\Upload;


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
        $inf = M("user_info");
        $password = I("psaaword");
        $password = md5("$password");
        $arr = [
            "username" => I("username"),
            "password" => $password,
            "softdelete" => 0
        ];
        $result = $table->where($arr)->find();
        if ($result["id"]) {
            $_SESSION["auth"]["perm"] = $result["perm"];
            $id = $_SESSION["auth"]["id"] = $result["id"];
            $_SESSION["auth"]["username"] = $result["username"];
            $wansahan = $inf->where("user_id=$id")->find();
            if ($wansahan) {
                $_SESSION["auth"]["wanshan"] = 1;
            } else {
                $_SESSION["auth"]["wanshan"] = 0;
            }

            if (isset($_POST['checkbox'])) {
                $time = time() + rand(0, 99);
                $yaoshi = sha1(md5($time));
                setcookie('remember', $yaoshi, time() + 86400 * 7);
                $tables = M('user_remember');
                $tables->user_id = $result['id'];
                $tables->remember = $yaoshi;
                $date = date('Y-m-d H:i:s');
                $tables->created_at = $date;
                $tables->add();
            }
            $this->success("登录成功", "/home/index/index");
        } else {
            $this->error("用户名或密码错误", "/home/index/login");
        }

    }

    /* public function xx ()
     {
         $this->display();
     }*/
    public function logout()
    {
        $_SESSION["auth"] = [];
        $this->success("成功退出！", "/home/index/index");
        setcookie("remember", null);
    }

    public function userinfo()
    {
        $table = M("problem");
        $this->result = $table->select();
        $this->display();
    }


    public function userinfosave()
    {
        $image = new Upload();
        $image->mimes = [
            "image/jpeg", "image/png", "image/gif", "image/bmp"
        ];
        $image->exts = [
            "jpg", "jpeg", "png", "bmp"
        ];
        $e = $image->uploadone($_FILES["name"]);
        $savename = $e['savename'];
        $savepath = $e['savepath'];
      $thumb = new Image();
        $thumb->open("Uploads/$savepath$savename");
        $thumb->thumb(120, 120, \Think\Image::IMAGE_THUMB_FILLED)->save("Uploads/{$savepath}s$savename");
        $user_path = "/Uploads/{$savepath}s$savename";


        $table = M("User_info");
        $table->create();
        $table->imagepath = $user_path;
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

        if ($a && $b && $c && $d && $e) {
            $this->success("成功保存", "/home/index/index");
        } else {
            $this->error("错误", "/home/index/userinfo");
        }


    }


    public function mengpailist()
    {

        $table = M("content");

        if (isset($_GET["m"])) {
            $m = $_GET["m"];
        } else {
            $m = 1;
        }
        $count = $table->where("mokuai=$m")->count();
        $this->pager = new Page($count, 20);

        if (isset($_GET["p"])) {
            $p = $_GET["p"];
        } else {
            $p = 1;
        }
        $this->p = $m;
        $st = ($p - 1) * 20;

        $result = $table->field("lt_user.username,lt_content.id,lt_content.title,lt_content.created_at")->join('LEFT JOIN lt_user ON lt_user.id = lt_content.user_id')->limit($st, 20)->where("mokuai=$m")->order("lt_content.created_at desc")->select();
        $this->result = $result;
        $this->pager->setConfig("theme", "%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%");
        $this->display();

    }

    public function fatie()
    {
        $this->display();
    }

    public function fatiesave()
    {
        $table = M("content");
        $table->create();
        $table->created_at = date("Y-m-d H:i:s");
        $xx = $table->add();
        if ($xx) {
            $this->success("", "/home/index/index");
        } else {
            $this->error("", "/home/index/index");
        }
    }

    public function updateuser()
    {
        $id = $_SESSION["auth"]["id"];
        $table = M("problem");
        $problem = M("user_problem");
        $problem->create();
        $table->create();
        $xx = $this->result = $problem->where("user_id=$id")->select();
        $pro = [];
        foreach ($xx as $items) {
            $pid = $items["problem_id"];
            $pro[] = $table->where("id = $pid")->find();
        }
        $this->pro = $pro;
        $this->display();

    }

    public function updateusersave()
    {
        $id = $_SESSION["auth"]["id"];
        $data = I('data');
        $problem = M("user_problem");
        $problem->create();
        $xx = $this->result = $problem->where("user_id=$id")->select();
        $daan = [];
        foreach ($xx as $items) {
            $daan[] = $items['problems'];
        }
        if ($data[0] == $daan[0] && $data[1] == $daan[1] && $data[2] == $daan[2]) {
            header("location:/home/index/updatecode");
        } else {
            $this->error("错误", "/home/index/updateuser");
        }
    }

    public function  updatecodesave()
    {
        $table = M('user');
        $table->create();
        $id = $_SESSION['auth']['id'];
        $arr = $table->where("id = $id")->find();
        $newpassword = md5(I('newpassword'));
        if ($newpassword) {
            $table->id = $id;
            $table->username = $_SESSION["auth"]["username"];
            $table->password = $newpassword;
            $table->save();
            $this->success('成功', '/home/index/index');
        } else {
            $this->error('原始密码输入错误', '/home/index/updatecode');
        }
    }

    public function  infoview()
    {
        $id = $_SESSION['auth']['id'];
        $table = M('user_info');
        $problem = M('user_problem');
        $this->pro = $problem->join('LEFT JOIN lt_problem ON lt_user_problem.problem_id = lt_problem.id')->
        where("user_id=$id")->select();
        $this->show = $table->getByUserId($id);
        $this->display();
    }

    public function tiezi()
    {
        $id = I("id");
        if ($id) {
            $table = M("content");
            $result = $table->find($id);
            $this->ids = $result;
            $this->content = html_entity_decode($result["content"]);
            $user_id = $result["user_id"];
            $res = M("user");
            $this->user = $res->field("username")->where("id=$user_id")->find();
            $image = M("user_info");
            $path = $image->field("imagepath")->where("user_id=$user_id")->find();

            if ($path = null) {
                $this->imagepath = $path["imagepath"];
            } else {
                $this->imagepath = "/public/image/defimg.gif";


                if ($path == 0) {

                    $this->imagepath = $path["imagepath"];


                } else {
                    $this->imagepath = "/public/image/defimg.gif";

                }


            }
            if (isset($_GET["m"])) {
                $m = $_GET["m"];
            } else {
                $m = 1;
            }
            if (isset($_GET["p"])) {
                $p = $_GET["p"];
            } else {
                $p = 1;
            }
            $start = ($p - 1) * 5;


            $disucss = M("discuss");
            $count = $disucss->where("content_id=$id")->count();
            $this->pager = new Page($count, 5);
            $this->p = $m;
            $sql = "select lt_discuss.*,lt_user_info.imagepath,lt_user.username from lt_discuss left join lt_content on lt_discuss.content_id=lt_content.id left join lt_user on lt_discuss.user_id=lt_user.id left join lt_user_info on lt_discuss.user_id=lt_user_info.user_id where lt_discuss.content_id=$id  order by lt_discuss.created_at  desc  limit $start,5 ";
            $result = $disucss->query($sql);
            $xx = [];
            foreach ($result as $items) {

                if ($items["imagepath"] == null) {
                    $items["imagepath"] = "/public/image/defimg.gif";
                }
                $items["content"] = html_entity_decode($items["content"]);
                $xx[] = $items;
            }

            $this->result = $xx;
            $this->display();
        }
    }

    public
    function discuss()
    {
        $id = I("id");
        $user_id = $_SESSION["auth"]["id"];
        $this->content_id = $id;
        $this->user_id = $user_id;

        $this->display();
    }

    public
    function search()
    {
        $this->display();
    }

    public
    function searchcheck()
    {
        $keyword = I('keyword');
        $writer = I("writer");
        $time = I("time");
        if ($keyword || $writer || $time) {
            $table = M('content');
            $condition = [
                "title" => ["like", "%$keyword%"],
                "username" => ["like", "%$writer%"],
                "lt_content.created_at" => ["like", "%$time%"],
            ];
            if (isset($_GET["p"])) {
                $p = $_GET["p"];
            } else {
                $p = 1;
            }

            $total = ceil($table->where($condition)->count());
            $pro = $table->where($condition)->field("lt_content.id as ctid,lt_content.title,lt_content.mokuai,lt_content
       .created_at,lt_user.username,lt_user.id")
                ->join("left join lt_user on lt_content.user_id = lt_user.id")
                ->order("lt_content.created_at desc")->page($p, 10)->select();
            $res = [];
            foreach ($pro as $item) {
                $p = $item["mokuai"];
                $item["p"] = $p;
                $m = $item["mokuai"];
                if ($m == 1) {
                    $xx = "新手上路 ";
                } else if ($m == 2) {
                    $xx = "天下一统 ";
                } else if ($m == 3) {
                    $xx = "翰墨承云";
                } else if ($m == 4) {
                    $xx = "大荒布告";
                } else if ($m == 5) {
                    $xx = "大荒本纪";
                } else if ($m == 6) {
                    $xx = "荒火教";
                } else if ($m == 7) {
                    $xx = "天机营";
                } else if ($m == 8) {
                    $xx = "魍魉";
                } else if ($m == 9) {
                    $xx = "翎羽山庄";
                } else if ($m == 10) {
                    $xx = "云麓仙居";
                } else if ($m == 11) {
                    $xx = "太虚观";
                } else if ($m == 12) {
                    $xx = "弈剑听雨阁";
                } else if ($m == 13) {
                    $xx = "冰心堂";
                } else if ($m == 14) {
                    $xx = "天下之路";
                } else if ($m == 15) {
                    $xx = "虎印节堂";
                } else if ($m == 16) {
                    $xx = "映世宝鉴";
                } else if ($m == 17) {
                    $xx = "浮生若梦";
                }
                $item["mokuai"] = $xx;
                $res[] = $item;
            }

            $this->pro = $res;
            $this->page = $page = new Page($total, 10);


            } else {
                $this->error("请输入搜索内容", "/home/index/search");
            }

    }


    public function dissave()
    {
        $table = M("discuss");
        $content = M("content");
        $id = I("content_id");
        if ($table->create()) {
            $table->created_at = date("Y-m-d H:i:s");
            $content->where("id= $id")->setInc('count', 1);
            $table->add();
            $this->success("", "/home/index/tiezi/id/$id");
        } else {
            $this->error("error", "/home/index/discuss");
        }
    }

    public function medal()
    {
        $user = M('user');
        $content = M('content');
        $info = M('user_info');
        if (isset($_GET["p"])) {
            $p = $_GET["p"];
        } else {
            $p = 1;
        }

        $results = $user->join("left join lt_content on lt_user.id=lt_content.user_id left join lt_user_info on lt_user.id=lt_user_info.user_id")->page($p, 3)->select();
        $count = $user->join("left join lt_content on lt_user.id=lt_content.user_id left join lt_user_info on lt_user.id=lt_user_info.user_id")->count();
        $page = new Page($count, 3);
        $re = [];

        foreach ($results as $result) {
            $result['content'] = html_entity_decode($result['content']);
            $image = $result['imagepath'];
            $gender = $result['gender'];

            if ($gender == 'M') { //判断男女
                $gender = '男';
            } else {
                $gender = '女';
            }
            $result['gender'] = $gender;

            if ($image != '') { //默认图片存储

            } else {
                $this->head = ('/public/image/defimg.gif');
            }
            $re[] = $result;
        }

        $this->assign("pages", $page);
        $this->assign('res', $re);
        $this->display();
    }

    public function medal_user_show($id)
    {

        $info = M('user_info');
        $condition = [
            'id' => $id
        ];
        $results = $info->where($condition)->select();
        $this->assign('res', $results);
        $this->display();
    }
}
