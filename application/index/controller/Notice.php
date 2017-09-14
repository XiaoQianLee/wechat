<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 11:16
 */

namespace app\index\controller;


use app\cms\model\Inform;

class Notice extends Home
{
    public function index()
    {
        $notices = Inform::all();
        $this->assign('notices',$notices);
        return $this->fetch('index');
    }

    public function check($id)
    {
        $notice = Inform::get($id);
        $this->assign('notice',$notice);
        return $this->fetch('check');
    }
}