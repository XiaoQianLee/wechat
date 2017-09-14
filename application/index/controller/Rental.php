<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 19:04
 */

namespace app\index\controller;


class Rental extends Home
{
    public function index()
    {
        $rents = \app\cms\model\Rental::all(['status'=>0]);
        $sells = \app\cms\model\Rental::all(['status'=>1]);
        $this->assign('rents',$rents);
        $this->assign('sells',$sells);
        return $this->fetch('index');
    }

    public function particulars($id)
    {
        $pental = \app\cms\model\Rental::get($id);
        $this->assign('pental',$pental);
        return $this->fetch('particulars');
    }
}