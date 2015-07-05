<?php

class ActivityLogAction extends BaseAction
{
    public function index()
    {
        $activity_id = I('get.id');

        $list = D('ActivityLog')->lists($activity_id);

        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 开奖
     */
    public function lottery()
    {
        $activity_id = I('activity_id');

        $map['activity_id'] = $activity_id;
        //获取活动信息
        $activity_info = D('Activity')->_get($map);
        if ($activity_info['is_lottery'] == 1) {
            $this->error('此活动已开奖');
        }
        //获取奖项
        $psize_list = D('ActivityPsize')->_list($map);

        //获取所有中奖记录id
        $map['psize_id'] = array('exp', 'is null');
        $map['answer'] = $activity_info['answer'];
        $log_list = D('ActivityLog')->_list($map);
        if (empty($log_list)) {
            $this->error('没有未中奖记录');
        }
        //开始抽奖,先抽一等奖
        $win_log = array();
        foreach ($psize_list as $_k => $_v) {
            $people = $_v['people'];
            if (count($log_list) <= $people) {        //抽奖人数<=中奖人数，则所有人都中奖
                foreach ($log_list as $_i => $_j) {
                    $_win_log = $_j;
                    $_win_log['psize_id'] = $_v['id'];
                    array_push($win_log, $_win_log);
                }
                break;
            } else {          //抽奖人数> 中奖人数时,随机选取
                $log_list_key = array_rand($log_list, $people);
                foreach ($log_list_key as $_i => $_j) {
                    $_win_log = $log_list[$_j];
                    $_win_log['psize_id'] = $_v['id'];
                    array_push($win_log, $_win_log);
                    unset($log_list[$_j]);
                }
            }
        }

        $save_log_result = D('ActivityLog')->allAll($win_log, array(), true);
        if ($save_log_result) {
            $this->success('开奖成功');
        } else {
            $this->error('开奖失败');
        }
    }
}
