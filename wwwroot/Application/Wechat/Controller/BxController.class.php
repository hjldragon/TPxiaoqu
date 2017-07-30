<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/11 0011
 * Time: 11:11
 */

namespace Wechat\Controller;


class BxController extends WechatController
{

    public function add(){
        //var_dump(session(user_auth));exit;
        if(IS_POST){
            $model = D('Baoxiu');
            $data = $model->create();
//var_dump($data);exit;
            if($data){
                $data['bx_time']=time();
                $data['uid']=session('user_auth')['uid'];
                $data['status']=0;
                $id = $model->add($data);
                if($id){
                    $this->success('报修成功', U('Index/index'));
                    //记录行为
                } else {
                    $this->error('报修失败');
                }
            } else {
                $this->error($model->getError());
            }
        } else {
            $this->assign('info',null);
            $this->meta_title = '在线报修';
            $this->display('add');
        }
    }
    public function index(){
        $list=M('Baoxiu')->where(session('user_auth')['uid'])->select();
        //var_dump($list);exit;
        $this->assign('list',$list);
            $this->display();
    }
}