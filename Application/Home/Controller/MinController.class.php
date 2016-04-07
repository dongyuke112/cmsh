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
}