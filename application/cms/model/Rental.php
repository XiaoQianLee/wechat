<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 18:39
 */

namespace app\cms\model;


use app\user\model\User;

class Rental extends \think\Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_RENTAL__';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    public function getStatusAttr($value)
    {
        if ($value == 0) {
            $result = '出租';
        }else{
            $result = '在售';
        }
        return $result;
    }

    public function getPostedIdAttr($value)
    {
        if ($value != 0) {
            $result = User::get($value)->value('username');
        }else{
            $result = "小区物业管理";
        }
        return $result;
    }
}