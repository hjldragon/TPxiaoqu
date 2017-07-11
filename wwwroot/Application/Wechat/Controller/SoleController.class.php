<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/7 0007
 * Time: 16:20
 */

namespace Wechat\Controller;


class SoleController extends WechatController
{
        public function index(){

            $map  = array('type'=>0);
            $list = M('Sole')->where($map)->select();
            //var_dump($list);exit;
            $this->assign('list', $list);
            $map2  = array('type'=>1);
            $list2 = M('Sole')->where($map2)->select();
            //var_dump($list2);exit;
            $this->assign('list2', $list2);
            $this->meta_title = '导航管理';
            $this->display();
        }
        public function content($id = 0){
        //dump($id);exit;
            $list=M('Sole')->find($id);
            //var_dump($list);exit;
            $this->assign('list',$list);
            $this->display('content');
        }
}