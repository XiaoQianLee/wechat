<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 11:16
 */

namespace app\index\controller;


use app\cms\model\Inform;

class Conven extends Home
{
    public function index()
    {
        $convens = \app\cms\model\Conven::all();
        $this->assign('convens',$convens);
        return $this->fetch('index');
    }

    public function check($id)
    {
        $conven =  \app\cms\model\Conven::get($id);
        $this->assign('conven',$conven);
        return $this->fetch('check');
    }
}