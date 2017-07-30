<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/11 0011
 * Time: 15:04
 */

namespace Admin\Controller;


class BxController extends AdminController
{
    public function index()
    {

        $model = M('Baoxiu')->select();
        //var_dump($model);exit;
        $this->assign('list', $model);
        $this->display();
    }

    public function status($id = 0)
    {
        //var_dump($id);exit;
        $model = M('Baoxiu');
        $data=$model->where(array('id' => $id))->find();
        //var_dump($model);exit;
        $data['status'] = 1;
        if ($model->save($data)) {
            //记录行为
            $this->success('已处理完成', U('index'));
        } else {
            $this->error('处理失败');
        }
    }
    public function del(){
        $id = array_unique((array)I('id',0));
        //var_dump($id);exit;
        if (empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Baoxiu')->where($map)->delete()){
            //记录行为
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}