<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/6 0006
 * Time: 12:44
 */

namespace Admin\Controller;


class CenterController extends AdminController
{
    public function index()
    {
        $pid = I('get.pid', 0);
        /* 获取频道列表 */
        $map = array('status' => array('gt', -1), 'pid' => $pid);
        $list = M('Channel')->where($map)->order('sort asc,id asc')->select();

        $this->assign('list', $list);
        $this->assign('pid', $pid);
        $this->meta_title = '保修管理';
        $this->display();

    }
    //设置新增报修方法
    public  function add(){

    }
}