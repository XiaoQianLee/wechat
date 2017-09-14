<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/14
 * Time: 15:02
 */

namespace app\cms\model;


class User extends \think\Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_USER__';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
}