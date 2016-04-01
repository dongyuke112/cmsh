<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/31
 * Time: 14:40
 */
namespace Home\Model;

use Think\Model;
use Think\Verify;

class UserModel extends  Model
{
    protected $patchValidate = true;
    const MODEL_MINE=4;
    protected $_auto=[
        ["created_at","getDate",Model::MODEL_INSERT,"callback"],
    ];
    public function getDate()
    {
        return date("Y-m-d H:i:s");
    }
    protected $_validate=[
        ["username","require","用户名不能为空",Model::MUST_VALIDATE,"",Model::MODEL_BOTH],
        ["password","repassword","两次密码不一致",Model::MUST_VALIDATE,"confirm",Model::MODEL_BOTH],
      ["image_check","checkimage","验证码错误",Model::MUST_VALIDATE,"callback",Model::MODEL_BOTH],

    ];
   public function checkimage($xx)
    {
        $image=new Verify();
       return $image->check($xx);
    }

}