<?php

class ProductAction extends BaseAction
{
    public function index()
    {
        $model = D('Product');
        $map['class_id'] = I('get.id');

        $page = I('p', 1);
        $page_size = I('page_size', 10);

        $count = $model->_count($map);
        $list = $model->_list($map, $page, $page_size);

        $Page       = new Page($count, $page_size);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('list', $list);
        $this->display();
    }

    public function insert()
    {
        $model = D('Product');

        if (!$model->create()) {
            $this->error($model->getError());
        }
        $class_id = I('class_id');

        $model->class_id = $class_id;

        $insert_result = $model->add();
        if ($insert_result) {
            $this->success('新增成功', U('Product/index', array('id'=>$class_id)));
        } else {
            $this->error('新增失败');
        }
    }

    /**
     * 默认更新数据
     */
    public function update()
    {
        $model = D('Product');

        if (!$model->create()) {
            $this->error($model->getError());
        }

        $class_id = I('class_id');

        $pk = $model->getPk();
        $map[$pk] = I($pk);

        $update_result = $model->where($map)->save();

        if ($update_result !== false) {
            $this->success('更新成功', U('Product/index', array('id'=>$class_id)));
        } else {
            $this->error('更新失败');
        }
    }
}
