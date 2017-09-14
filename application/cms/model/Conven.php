<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/11
 * Time: 15:35
 */

namespace app\cms\model;

use app\user\model\User;
use think\Model as ThinkModel;

class Conven extends ThinkModel
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_CONVEN__';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    // 定义修改器
    public function setStartTimeAttr($value)
    {
        return $value != '' ? strtotime($value) : 0;
    }
    public function setEndTimeAttr($value)
    {
        return $value != '' ? strtotime($value) : 0;
    }
    public function getStartTimeAttr($value)
    {
        return $value != 0 ? date('Y-m-d', $value) : '';
    }
    public function getEndTimeAttr($value)
    {
        return $value != 0 ? date('Y-m-d', $value) : '';
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