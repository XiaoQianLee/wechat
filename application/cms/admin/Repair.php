<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 16:22
 */

namespace app\cms\admin;


use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use think\Db;

class Repair extends Admin
{
    public function index()
    {
        // 查询
        $map = $this->getMap();
        // 排序
        $order = $this->getOrder('create_time desc');
        // 数据列表
        $data_list = \app\cms\model\Repair::where($map)->order($order)->paginate();


        //return $this->fetch();
        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setSearch(['name' => '报修姓名']) // 设置搜索框
            ->addColumns([ // 批量添加数据列
                ['id', 'ID'],
                ['name', '报修人', 'text'],
                ['address','报修地址','text'],
                ['content','报修内容','text'],
                ['telephone','联系电话','text'],
                ['create_time', '时间', 'date'],
                ['status', '报修状态','html'],
            ])
            ->addTopButtons('delete') // 批量添加顶部按钮
            ->addOrder('id,name,address,content,card_num,create_time','status')
            ->setRowList($data_list) // 设置表格数据
            //->addValidate('Inform', 'name')
            ->fetch(); // 渲染模板
    }

    public function cl($id)
    {
        $result = Db::name('cms_repair')->where(['id'=>$id])->setInc('status');
        if ($result) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
}