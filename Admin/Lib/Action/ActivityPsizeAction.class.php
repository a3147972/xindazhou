<?php

class ActivityPsizeAction extends BaseAction
{

    public function index()
    {
        $activity_id = I('id');

        $model = D('ActivityPsize');
        $map['activity_id'] = $activity_id;
        $list = $model->_list($map, 0, 0, 'id asc');

        $this->assign('list', $list);
        $this->display();
    }

    public function insert()
    {
        $name = array_filter(I('post.name'));
        $thumb = array_filter(I('post.thumb'));
        $people = array_filter(I('post.people'));
        $activity_id = I('post.activity_id');
        $id = array_filter(I('post.id'));
        if (empty($name)) {
            $this->error('至少设置一个奖项');
        }
        if (count($name) != count($thumb)) {
            $this->error('请设置奖项对应的图片');
        }

        $PsizeData = array();
        foreach ($name as $_k => $_v) {
            $_data['id'] = isset($id[$_k]) ? $id[$_k] : null;
            $_data['activity_id'] = $activity_id;
            $_data['name'] = $_v;
            $_data['thumb'] = $thumb[$_k];
            $_data['people'] = isset($people[$_k])?$people[$_k]:1;
            $_data['create_time'] = now();
            $_data['modification_time'] = now();
            array_push($PsizeData, $_data);
        }
        if (count($id) > 0) {
            $insert_result = D('ActivityPsize')->addAll($PsizeData, array(), true);
        } else {
            $insert_result = D('ActivityPsize')->addAll($PsizeData);
        }

        if ($insert_result) {
            $this->success('新增奖项成功', U('Activity/index'));
        } else {
            $this->error('新增奖项失败');
        }
    }
}
