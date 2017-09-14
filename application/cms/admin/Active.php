<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/11
 * Time: 18:06
 */

namespace app\cms\admin;


use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\cms\model\Active as ActiveModel;

class Active extends Admin
{
    public function index()
    {
        // 查询
        $map = $this->getMap();
        // 排序
        $order = $this->getOrder('update_time desc');
        // 数据列表
        $data_list = ActiveModel::where($map)->order($order)->paginate();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setSearch(['title' => '标题']) // 设置搜索框
            ->addColumns([ // 批量添加数据列
                ['id', 'ID'],
                ['title', '活动标题', 'text.edit'],
                ['shop_name','活动店铺','text'],
                ['logo','活动Logo','picture'],
                ['start_time','开始时间','text'],
                ['end_time','结束时间','text'],
                ['update_time', '发布时间', 'text'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons('add,delete') // 批量添加顶部按钮
            ->addRightButtons(['edit', 'delete' => ['data-tips' => '删除后无法恢复。']]) // 批量添加右侧按钮
            ->addOrder('id,title,logo,update_time,start_time,end_time')
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
            if ($inform = ActiveModel::create($data)) {
                $this->success('添加服务消息成功', 'index');
            } else {
                $this->error('添加服务消息失败');
            }
        }

        // 显示添加页面
        return ZBuilder::make('form')
            ->addFormItems([
                ['text', 'title', '活动标题'],
                ['text','shop_name','活动店铺'],
                ['daterange', 'start_time,end_time', '有效时间'],
            ])
            ->addImage('logo','Logo图片')
            ->addUeditor('content', '内容')
            ->fetch();

    }

    public function edit($id = null)
    {
        if ($id === null) $this->error('缺少参数');
        // 保存数据
        if ($this->request->isPost()) {
            // 表单数据
            $data = $this->request->post();
            if (ActiveModel::update($data)) {
                $this->success('编辑通知成功', 'index');
            } else {
                $this->error('编辑通知失败');
            }
        }
        $info = ActiveModel::get($id);
        // 显示添加页面
        // 显示添加页面
        return ZBuilder::make('form')
            ->addFormItems([
                ['hidden', 'id'],
                ['text', 'title', '活动标题'],
                ['text','shop_name','活动店铺'],
                ['daterange', 'start_time,end_time', '有效时间'],
            ])
            ->addImage('logo','Logo图片')
            ->addUeditor('content', '内容')
            ->setFormData($info)
            ->fetch();

    }
}