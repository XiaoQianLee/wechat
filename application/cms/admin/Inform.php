<?php
// +----------------------------------------------------------------------
// | 海豚PHP框架 [ DolphinPHP ]
// +----------------------------------------------------------------------
// | 版权所有 2016~2017 河源市卓锐科技有限公司 [ http://www.zrthink.com ]
// +----------------------------------------------------------------------
// | 官方网站: http://dolphinphp.com
// +----------------------------------------------------------------------
// | 开源协议 ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

namespace app\cms\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\cms\model\Inform as InformModel;
use think\Validate;

/**
 * 广告控制器
 * @package app\cms\admin
 */
class Inform extends Admin
{
    /**
     * 广告列表
     * @author 蔡伟明 <314013107@qq.com>
     * @return mixed
     */
    public function index()
    {
        // 查询
        $map = $this->getMap();
        // 排序
        $order = $this->getOrder('update_time desc');
        // 数据列表
        $data_list = InformModel::where($map)->order($order)->paginate();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setSearch(['title' => '标题']) // 设置搜索框
            ->addColumns([ // 批量添加数据列
                ['id', 'ID'],
                ['title', '标题名称', 'text.edit'],
                ['logo','Logo','picture'],
                ['start_time', '开始时间', 'text'],
                ['end_time', '结束时间', 'text'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons('add,delete') // 批量添加顶部按钮
            ->addRightButtons(['edit', 'delete' => ['data-tips' => '删除后无法恢复。']]) // 批量添加右侧按钮
            ->addOrder('id,title,start_time,end_time,update_time')
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
            if ($inform = InformModel::create($data)) {
                $this->success('添加通知消息成功', 'index');
            } else {
                $this->error('添加通知消息失败');
            }
        }

        // 显示添加页面
        return ZBuilder::make('form')
            ->addFormItems([
                ['text', 'title', '通知标题'],
                ['daterange', 'start_time,end_time', '开始时间-结束时间'],
            ])
            ->addImage('logo','图片')
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
            if (InformModel::update($data)) {
                $this->success('编辑通知成功', 'index');
            } else {
                $this->error('编辑通知失败');
            }
        }
        $info = InformModel::get($id);
        // 显示添加页面
        return ZBuilder::make('form')
            ->addFormItems([
                ['hidden', 'id'],
                ['text', 'title', '通知标题'],
                ['daterange', 'start_time,end_time', '开始时间-结束时间'],
            ])
            ->addImage('logo','图片')
            ->addUeditor('content', '内容')
            ->setFormData($info)
            ->fetch();
    }




}