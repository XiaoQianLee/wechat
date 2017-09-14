<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/11
 * Time: 15:21
 */

namespace app\cms\admin;


use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\cms\model\Conven as ConvenModel;

class Conven extends Admin
{
    public function index()
    {
        // 查询
        $map = $this->getMap();
        // 排序
        $order = $this->getOrder('update_time desc');
        // 数据列表
        $data_list = ConvenModel::where($map)->order($order)->paginate();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setSearch(['title' => '标题']) // 设置搜索框
            ->addColumns([ // 批量添加数据列
                ['id', 'ID'],
                ['title', '便民标题', 'text.edit'],
                ['logo','Logo','picture'],
                ['update_time', '发布时间', 'text'],
                ['start_time','有效时间-始','text'],
                ['end_time','有效时间-终','text'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons('add,delete') // 批量添加顶部按钮
            ->addRightButtons(['edit', 'delete' => ['data-tips' => '删除后无法恢复。']]) // 批量添加右侧按钮
            ->addOrder('id,title,logo,update_time,start_time,end_time')
            ->setRowList($data_list) // 设置表格数据
            //->addValidate('Inform', 'name')
            ->fetch(); // 渲染模板
    }

    /*
     * 添加
     * */
    public function add()
    {
        //保存数据
        if ($this->request->isPost()) {
            // 表单数据
            $data = $this->request->post();
            if ($inform = ConvenModel::create($data)) {
                $this->success('添加服务消息成功', 'index');
            } else {
                $this->error('添加服务消息失败');
            }
        }

        // 显示添加页面
        return ZBuilder::make('form')
            ->addFormItems([
                ['text', 'title', '便民标题'],
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
            if (ConvenModel::update($data)) {
                $this->success('编辑通知成功', 'index');
            } else {
                $this->error('编辑通知失败');
            }
        }
        $info = ConvenModel::get($id);
        // 显示添加页面
        return ZBuilder::make('form')
            ->addFormItems([
                ['hidden', 'id'],
                ['text', 'title', '便民标题'],
                ['daterange', 'start_time,end_time', '有效时间'],
            ])
            ->addImage('logo','Logo图片')
            ->addUeditor('content', '内容')
            ->setFormData($info)
            ->fetch();
    }
}