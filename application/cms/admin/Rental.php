<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 18:39
 */

namespace app\cms\admin;


use app\admin\controller\Admin;
use app\common\builder\ZBuilder;

class Rental extends Admin
{
    public function index()
    {
        // 查询
        $map = $this->getMap();
        // 排序
        $order = $this->getOrder('update_time desc');
        // 数据列表
        $data_list = \app\cms\model\Rental::where($map)->order($order)->paginate();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->addColumns([ // 批量添加数据列
                ['id', 'ID'],
                ['title', '租售标题', 'text'],
                ['price','租售价格','price'],
                ['telephone','联系电话','text'],
                ['status','类型','text'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons('add,delete') // 批量添加顶部按钮
            ->addRightButtons(['edit', 'delete' => ['data-tips' => '删除后无法恢复。']]) // 批量添加右侧按钮
            ->addOrder('id,title,price,telephone,status')
            ->setRowList($data_list) // 设置表格数据
            //->addValidate('Inform', 'name')
            ->fetch(); // 渲染模板
    }

    public function add()
    {
        //保存数据
        if ($this->request->isPost()) {
            // 表单数据
            $data = $this->request->post();
            if ($inform = \app\cms\model\Rental::create($data)) {
                $this->success('发布租售信息成功', 'index');
            } else {
                $this->error('发布租售信息失败');
            }
        }

        // 显示添加页面
        return ZBuilder::make('form')
            ->addFormItems([
                ['text', 'title', '租售标题'],
                ['text','intro','租售简介'],
                ['text','price','租售价格'],
                ['text','telephone','联系电话'],
            ])
            ->addRadio('status','类型','',[0=>'出租',1=>'出售'])
            ->addImage('logo','列表LOGO图片')
            ->addUeditor('content', '内容')
            ->fetch();

    }

    public function edit($id = null)
    {
        if ($id === null) $this->error('缺少参数');
        //保存数据
        if ($this->request->isPost()) {
            // 表单数据
            $data = $this->request->post();
            if ($inform = \app\cms\model\Rental::update($data)) {
                $this->success('修改租售信息成功', 'index');
            } else {
                $this->error('修改租售信息失败');
            }
        }
        $info = \app\cms\model\Rental::get($id);

        // 显示添加页面
        return ZBuilder::make('form')
            ->addFormItems([
                ['hidden','id'],
                ['text', 'title', '租售标题'],
                ['text','intro','租售简介'],
                ['text','price','租售价格'],
                ['text','telephone','联系电话'],
            ])
            ->addRadio('status','类型','',[0=>'出租',1=>'出售'])
            ->addImage('logo','列表LOGO图片')
            ->addUeditor('content', '内容')
            ->setFormData($info)
            ->fetch();

    }
}