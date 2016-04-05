<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/5
 * Time: 10:35
 */
namespace Home\Model;

use Think\Model;
class User_remember extends Model
{
    protected $_auto=[
        ["created_at","getDate",Model::MODEL_INSERT,"callback"],
    ];
    public function getDate()
    {
        return date("Y-m-d H:i:s");
    }
}