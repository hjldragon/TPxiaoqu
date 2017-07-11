<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/8 0008
 * Time: 16:23
 */

namespace Wechat\Controller;


class ActivityController extends WechatController
{

    public function index($p=1){
        if(IS_AJAX){
            $map=array('category_id'=>41);
            $model =M('Document')->where($map);
            $pagesize = 1;
            $start=($p-1)*$pagesize;
            $list=$model->join('onethink_picture ON onethink_document.cover_id=onethink_picture.id ')
                ->join('onethink_document_article ON onethink_document.id=onethink_document_article.id')
                ->limit($start,$pagesize)->select();
            //var_dump($list);exit;
            $this->ajaxReturn($list);

        }else{
            /* 获取通知列表 */
            $map=array('category_id'=>41);
            $model =M('Document')->where($map);
            $pagesize = 1;
            $start=($p-1)*$pagesize;
            $list=$model->join('onethink_picture ON onethink_document.cover_id=onethink_picture.id ')
                ->join('onethink_document_article ON onethink_document.id=onethink_document_article.id')
                ->limit($start,$pagesize)->select();
            $this->assign('list', $list);
            $this->meta_title = '小区活动';
            //var_dump($list);exit;
            $this->display();
        }
    }
    //获取点击的详细信息
    public function detail($id = 0){

        //var_dump($id);exit;
        $map=array('category_id'=>41);
        $model =M('Document')->where($map)->where(array('onethink_document.id'=>$id));
        $model->setInc('view',1); // 用户的浏览加1//返回bool值
        //$model->add();
        //var_dump($model);exit;
//        $model->save();
//        exit;
        //这里不能直接用Model连贯操作，因为上传的model返回的布尔值
        $list=M('Document')->where($map)->where(array('onethink_document.id'=>$id))->join('onethink_picture ON onethink_document.cover_id=onethink_picture.id ')
            ->join('onethink_document_article ON onethink_document.id=onethink_document_article.id')
           ->find();
        //var_dump($list);exit;
        $this->assign('list',$list);
        $this->display('notice-detail');
}
public function apply($id = 0){
        //var_dump($id);
        $this->login();
        //获取用户名
    //var_dump(session('user_auth'));
    $user=session('user_auth');
    $uid=$user['uid'];
    //var_dump($this->user);exit;
    //$user=$this->user;
//var_dump($uid);exit;

    //获取所有活动内容
    //var_dump($user['uid']);exit;
    //var_dump($list);exit;
    //实例化要显示后台的数据库
    $data = M('Jion_activity')->where(array('u_id'=>$uid ,'a_id'=>$id))->find();
    //var_dump($user['nickname']);exit;
    if(count($data)){
        $this->error('你已经参加过该活动了',U('Activity/index'));
    }else{
        $model=M('Jion_activity');
        $data=[];
        $data['u_id']=$uid;
        $data['a_id']=$id;
        $data['jiont_time']=time();
        $data['status']=0;
        $model->add($data);
        $this->success('恭喜你参加本活动成功',U('Activity/index'));
    }
    //var_dump($model);exit;
       // echo 1;exit;
}
}