<?php

class ActivityOptionsAction extends BaseAction
{
    public function index()
    {
        $activity_id = I('id');

        $model = D('ActivityOptions');
        $map['activity_id'] = $activity_id;

        $list = $model->_list($map, 0, 0);

        $this->assign('list', $list);
        $this->display();
    }
}
