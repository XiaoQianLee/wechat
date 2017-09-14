<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 15:01
 */

namespace app\index\controller;


class Service extends Home
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function find()
    {
        return $this->fetch('find');
    }

    public function withmy()
    {
        return $this->fetch('withmy');
    }
}