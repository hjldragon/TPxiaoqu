<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/7 0007
 * Time: 18:04
 */

namespace Wechat\Controller;


class DocumentController extends WechatController
{
        public function index(){

            $Model = M('Document')->where(array('onethink_document.category_id'=>2));
            //var_dump($Model);EXIT;
           $list= $Model->join('onethink_picture ON onethink_document.cover_id = onethink_picture.id')
                ->join('onethink_document_article ON onethink_document.id = onethink_document_article.id')
//               ->join('onethink_category ON onethink_document.category_id = onethink_category.id')
                ->select();
            //var_dump($list);exit;
            $this->assign('list',$list);
            $this->display();
        }
        public function detail($id = 0){
            //var_dump($id);exit;
           // $map['id']=$id;

            //$Model = M('Document');
           // $Model->alias($id)->join('__DEPT__ b ON b.user_id= a.id')->select();
            //var_dump($Model);EXIT;
            $list= M('Document')->where(array('onethink_document.category_id'=>2))->where(array('onethink_document.id'=>$id))->join('onethink_picture ON onethink_document.cover_id = onethink_picture.id')
                ->join('onethink_document_article ON onethink_document.id = onethink_document_article.id')
                ->find();

            //var_dump($list);exit;
            $this->assign('list',$list);
            $this->display('notice-detail');
        }
}