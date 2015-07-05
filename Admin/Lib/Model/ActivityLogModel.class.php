<?php

class ActivityLogModel extends BaseModel
{
    public function lists($activity_id)
    {
        $model = D('ActivityLog');
        //查询抽奖记录
        $activity_id = $activity_id;
        $map['activity_id'] = $activity_id;
        $field = 'id as log_id,options_id,joiner_id,psize_id,create_time';
        $list = $this->_list($map, 0, 0, 'options_id desc', $field);

        if (empty($list)) {
            return array();
        }

        //查询抽奖人信息
        $joiner_id = array_column($list, 'joiner_id');
        $joiner_map['id'] = array('in', $joiner_id);
        $joiner_field = 'id as joiner_id,activity_id,openid,mobile';
        $joiner_list = D('Joiner')->_list($joiner_map, 0, 0, '', $joiner_field);

        $joiner_list = array_column($joiner_list, null, 'joiner_id');

        //查询奖项
        $psize_id = array_column($list, 'psize_id');
        $psize_map['id'] = array('in', $psize_id);
        $psize_field = 'id as psize_id,name as psize_name,thumb as psize_thumb';
        $psize_list = D('ActivityPsize')->_list($psize_map, 0, 0, '', $psize_field);
        $psize_list = array_column($psize_list, null, 'psize_id');

        //合并数据
        foreach ($list as $_k => $_v) {
            if ($joiner_list[$_v['joiner_id']]) {
                $_v = array_merge($_v, $joiner_list[$_v['joiner_id']]);
            }
            if ($psize_list[$_v['psize_id']]) {
                $_v = array_merge($_v, $psize_list[$_v['psize_id']]);
            }

            $list[$_k] = $_v;
        }

        return $list;
    }
}
