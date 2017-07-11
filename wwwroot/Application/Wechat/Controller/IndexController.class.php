<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/7 0007
 * Time: 15:12
 */

namespace Wechat\Controller;
class IndexController extends WechatController
{
    public function index(){
//        phpinfo();
//        echo 222;exit;
       $this->display();
    }
    public function my(){

        //$User = new UserApi();
        //var_dump(1);exit;
        $this->login();
        //$user=D('Member');
        //var_dump(session('user_auth')['username']);exit;
       $list = session('user_auth');
      //var_dump($list['username']);exit;
       $this->assign('list',$list);
                $this->display('my');

//        var_dump(is_login());exit;

    }
}