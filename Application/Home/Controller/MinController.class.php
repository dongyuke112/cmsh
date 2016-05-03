<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/7
 * Time: 9:42
 */
namespace Home\Controller;

use Think\Controller;

class MinController extends Controller{
    public function index(){
        layout(false);
        $this->display();
    }

    public function show_user()
    {

        $table=M('user');
        $user=$table->select();
        $this->assign('users',$user);
        $this->display();
    }

    public function user_delete($id)
    {
        $user=M('user');
        $user->create();
        if($user->delete($id)){
            $this->success('删除成功','/home/min/show_user');
        }else{
            $this->error('失败','/home/min/show_user');
        }
    }

    public function show()
    {
        layout(false);
        $this->display();
    }


}