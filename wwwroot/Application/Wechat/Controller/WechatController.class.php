<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/8 0008
 * Time: 11:48
 */

namespace Wechat\Controller;
use Think\Controller;

class WechatController extends Controller
{
    /* 空操作，用于输出404页面 */
    public function _empty(){
        $this->redirect('Index/index');
    }

    protected function _initialize(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置

        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
    }
    /* 用户登录检测 */
    protected function login(){
        /* 用户登录检测 */
        //echo 1;exit;
        is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
    }

}