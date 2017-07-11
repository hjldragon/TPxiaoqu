<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/10 0010
 * Time: 17:57
 */

namespace Admin\Controller;


class WactivityController extends AdminController
{
    public function index()
    {

        $model = M('Jion_activity')->alias('a')->field('a.id,c.nickname,b.title,b.description,b.deadline,a.jiont_time,a.status')->join('onethink_document b on b.id =a.a_id')
            ->join('onethink_member c on  c.uid = a.u_id')->select();
        //var_dump($model);exit;
        $this->assign('list', $model);
        $this->display();
    }

    public function status($id = 0)
    {
        //var_dump($id);exit;
        $model = M('Jion_activity');
          $data=$model->where(array('id' => $id))->find();
        //var_dump($model);exit;
        $data['status'] = 1;
        if ($model->save($data)) {
            //记录行为
            $this->success('审核成功', U('index'));
        } else {
            $this->error('审核失败');
        }
    }
    public function del(){
        $id = array_unique((array)I('id',0));
        //var_dump($id);exit;
        if (empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Jion_activity')->where($map)->delete()){
            //记录行为
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}