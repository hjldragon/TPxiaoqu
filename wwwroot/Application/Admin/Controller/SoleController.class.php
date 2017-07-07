<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/6 0006
 * Time: 15:33
 */

namespace Admin\Controller;


class SoleController extends AdminController
{
        public  function index(){

            /* 获取频道列表 */

            $list = M('Sole')->select();
            $list = $this->parseDocumentList($list);
            $this->assign('list', $list);
            $this->meta_title = '小区租售';
            $this->display();
        }
        public function add(){
            if(IS_POST){
                $Sole = D('Sole');
                $data = $Sole->create();
//var_dump($data);exit;
                if($data){
                    $data['clone_time']=strtotime($data['clone_time']);
                    $id = $Sole->add($data);
                    if($id){
                        $this->success('新增成功', U('index'));
                        //记录行为
                    } else {
                        $this->error('新增失败');
                    }
                } else {
                    $this->error($Sole->getError());
                }
            } else {
                $this->assign('info',null);
                $this->meta_title = '小区租售';
                $this->display('edit');
            }
        }
    public function del(){
        $id = array_unique((array)I('id',0));

        if (empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Sole')->where($map)->delete()){
            //记录行为
            action_log('update_sole', 'sole', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
    public function edit($id = 0){
        //var_dump($id);exit;

        if(IS_POST){
            $Sole = D('Sole');
            $data = $Sole->create();
            //var_dump($data['clone_time']);exit;
            if($data){
                $data['clone_time']=strtotime($data['clone_time']);
                if($Sole->save($data)){
                    //记录行为
                    action_log('update_Sole', 'Sole', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Sole->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Sole')->find($id);

            $info['clone_time']=date('Y-m-d G:i:s',$info['clone_time']);
            if(false === $info){
                $this->error('获取租售信息错误');
            }
            //var_dump($info);exit;
            $this->assign('info', $info);
            $this->meta_title = '编辑租售';
            $this->display();
        }
    }

}