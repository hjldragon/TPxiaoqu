<?php
/**
 * Created by PhpStorm.
 * User: machenike
 * Date: 2017/7/6 0006
 * Time: 15:34
 */

namespace Admin\Model;


use Think\Model;

class SoleModel extends Model
{
    protected $_validate = array(
        array('sole_name', 'require', '发布人不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_INSERT),
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,20', '标题长度不能超过20个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
        array('tel', 'require', '电话不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('price', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
    );

    /* 自动完成规则 */
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
//        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_INSERT, 'string'),
    );
}