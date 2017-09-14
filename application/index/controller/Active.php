<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:36
 */

namespace app\index\controller;


class Active extends Home
{
    public function index()
    {
        $actives = \app\cms\model\Active::all();
        $this->assign('actives',$actives);
        return $this->fetch('index');
    }

    public function check($id)
    {
        $active =  \app\cms\model\Active::get($id);
        $this->assign('active',$active);
        return $this->fetch('check');
    }
}