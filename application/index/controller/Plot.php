<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:49
 */

namespace app\index\controller;


class Plot extends Home
{
    public function index()
    {
        $plots = \app\cms\model\Plot::all();
        $this->assign('plots',$plots);
        return $this->fetch('index');
    }

    public function check($id)
    {
        $plot =  \app\cms\model\Plot::get($id);
        $this->assign('plot',$plot);
        return $this->fetch('check');
    }
}