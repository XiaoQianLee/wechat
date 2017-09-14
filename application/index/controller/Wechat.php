<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/14
 * Time: 14:36
 */

namespace app\index\controller;


use app\cms\model\User;
use EasyWeChat\Foundation\Application;
use think\Controller;
use think\Db;

class Wechat extends Controller
{
    public function wx()
    {
        $app = new Application(config('options'));
        $response = $app->server->serve();
        // 将响应输出
        $response->send();
    }
    public function access()
    {
        $app = new Application(config('options'));
        $oauth = $app->oauth;
        // 未登录
        if (empty(session('wechat_user'))) {
            return $oauth->redirect();
        }
        // 已经登录过
        $user= session('wechat_user');
    }

    public function callback(){
        $app = new Application(config('options'));
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        $userArr= $user->toArray();//转化为数组
        $row=User::get(['openid'=>$userArr['id']]);
        if ($row){

        }else{
            $data = [
                'name'=>$userArr['name'],
                'openid'=>$userArr['id'],
                'photo'=>$userArr['avatar']
            ];
            //不存在则插入数据
            User::create($data);
        }
        session('wechat_user',$userArr);//写入session
        $this->redirect(url('index/index/index'));//跳转
    }


    public function addmenu()
    {
        $app = new Application(config('options'));
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "view",
                "name" => "物业管理",
                "url"  => "http://bm.tzhe.xin/"
            ],

        ];
        $menu->add($buttons);
    }
}