<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 15:11
 */

namespace app\index\controller;


use app\cms\model\Repair;

class Member extends Home
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function Repair()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if (Repair::create($data)) {
                $this->success('报修成功', 'index/index');
            } else {
                $this->error('报修失败');
            }
        }else{
            return $this->fetch('repair');
//            if (empty(is_signin())) {
//                return $this->fetch('repair');
//            }else{
//                $this->error('您还没有登录');
//            }
        }
    }
}