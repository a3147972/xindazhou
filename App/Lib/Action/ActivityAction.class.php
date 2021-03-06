<?php
class ActivityAction extends BaseAction
{

    public function index()
    {
        $openid = I('openid');

        $model = D('Activity');
        $map['is_lottery'] = 0;
        $map['status'] = 1;
        
        $info = $model->order('id desc')->find();

        $this->assign('vo', $info);
        //获取选项
        $options_map['activity_id'] = $info['id'];
        $options_list = D('ActivityOptions')->where($options_map)->limit(6)->select();
        $this->assign('options_list', $options_list);

        //获取奖项
        $psize_list = D('ActivityPsize')->where($options_map)->select();
        $this->assign('psize_list', $psize_list);
        $this->display();
    }
    
    //检测抽奖资格
    public function checkStatus()
    {
        $openid = I('openid');
        $activity_id = I('activity_id');
        $model = D('Joiner');

        $map['openid'] = $openid;
        $map['activity_id'] = $activity_id;

        $info = $model->where($map)->find();
        //已参加过活动
        if ($info) {
            $this->error('您已参与，7月20日将公布中奖信息，敬请期待！');
        }
        $this->success(1);
    }

    //提交抽奖记录
    public function insert()
    {
        $mobile = I('post.mobile');
        $openid = I('post.openid');
        $activity_id = I('activity_id');
        $answer = I('answer');

        if (empty($mobile)) {
            $this->error('请输入手机号');
        }
        if (empty($openid)) {
            $this->error('非法操作');
        }
        if (empty($activity_id)) {
            $this->error('非法操作');
        }
        //写入参与人表
        $model = D('Joiner');
        $data['mobile'] = $mobile;
        $data['openid'] = $openid;
        $data['activity_id'] = $activity_id;
        $data['create_time'] = date('Y-m-d H:i:s', time());
        $data['modification_time'] = date('Y-m-d H:i:s', time());

        $model->startTrans();
        $ins = $model->add($data);

        //写入参加比赛表
        $log_data['activity_id'] = $activity_id;
        $log_data['options_id'] = $answer;
        $log_data['joiner_id'] = $ins;
        $log_data['create_time'] = date('Y-m-d H:i:s', time());

        $log_inster = D('ActivityLog')->add($log_data);

        if ($ins && $log_inster) {
            $model->commit();
            $this->success('提交成功，感谢您参与活动，7月20日将公布中奖信息，敬请期待！');
        } else {
            $model->rollback();
            $this->error('系统错误,请稍后再试');
        }
    }

    private function alertError($error)
    {
        $str = '<script>alert("'.$error.'");WeixinJSBridge.call("closeWindow");</script>';
        die($str);
    }
}
