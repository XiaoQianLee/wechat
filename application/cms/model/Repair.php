<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 16:31
 */

namespace app\cms\model;


class Repair extends \think\Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_REPAIR__';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    public function getStatusAttr($value,$data)
    {
        if ($value == 0) {
            $result = '<a href="'.url('cl',['id'=>$data['id']]).'" class="btn btn-info ajax-get">审核处理</a>';
        }elseif ($value == 1) {
            $result = '<a href="'.url('cl',['id'=>$data['id']]).'" class="btn btn-info ajax-get">处理中</a>';
        }elseif ($value == 2) {
            $result = '维修完成';
        }
        return $result;
    }
}