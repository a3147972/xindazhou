<?php

class IndexAction extends BaseAction
{
    private $wechat = '';
    public function _initialize()
    {
        $options = array(
            'token'=>C('WEIXIN_OPTIONS.TOKEN'), //填写你设定的key
            'encodingaeskey'=>C('WEIXIN_OPTIONS.ENCODINGAESKEY'), //填写加密用的EncodingAESKey
            'appid'=>C('WEIXIN_OPTIONS.APPID'), //填写高级调用功能的app id
            'appsecret'=>C('WEIXIN_OPTIONS.APPSECRET') //填写高级调用功能的密钥
            );

        $this->wechat = new Wechat($options);
        $this->wechat->valid();

        $type = $this->wechat->getRev()->getRevType();

        switch ($type) {
            //关键词回复
            case Wechat::MSGTYPE_TEXT:
                $content = $this->wechat->getRev()->getRevContent();
                $this->keywords($content);
                break;
            //事件回复
            case Wechat::MSGTYPE_EVENT:
                $content = $this->wechat->getRev()->getRevEvent();
                if ($content['event'] == Wechat::EVENT_SUBSCRIBE) {
                    $this->subscribe();
                    return ;
                }
                $this->keywords($content['key']);
                break;
        }
    }

    /**
     * 设置关键词回复
     */
    private function keywords($content)
    {
        $from = $this->wechat->getRev()->getRevFrom();

        $model = D('Keyword');
        $map['keywords'] = $content;

        $info = $model->where($map)->find();

        switch ($content) {
            case '猜新车':
                //判断活动是否开始
                $activity_info = $this->getActivity();
                if (!$activity_info) {
                    $return_msg = '活动7月8日正式开始，期待您的参与！';
                    $this->wechat->text($return_msg)->reply();
                    exit();
                }

                //判断是否中奖
                $log_info = $this->checkWin($from, $activity_info['id']);
                if ($log_info === -1) {
                    if ($activity_info['is_lottery'] == 1) {
                        $return_msg = '很遗憾，您未中奖，敬请关注新大洲本田全新E影110！
';
                        $this->wechat->text($return_msg)->reply();
                        exit();
                    } else {
                        $return_msg = '您已参与，7月20日将公布中奖信息，敬请期待！';
                        $this->wechat->text($return_msg)->reply();
                        exit();
                    }
                }
                if (is_array($log_info) && count($log_info) >0) {
                    $return_msg = '恭喜您，获得'.$log_info['name'].',您将'.$log_info['prize'].'!稍后会有新大洲本田工作人员与您联系，或拨打咨询电话：021-69796827';
                    $this->wechat->text($return_msg)->reply();
                    exit();
                }
                //回复参与活动的图文
                break;
        }
        $return_msg[0]['Title'] = $info['title'];
        $return_msg[0]['Description'] = $info['descption'];
        $return_msg[0]['PicUrl'] = C('SITE_URL').ltrim($info['thumb'], '.');
        $return_msg[0]['Url'] = $info['link'].'?openid='.$from;

        $this->wechat->news($return_msg)->reply();
        exit();
    }

    /**
     * 关注回复
     */
    private function subscribe()
    {
        $return_msg = C('WELCOME_TEXT');
        $this->wechat->text($return_msg)->reply();
        return ;
    }

    /**
     * 判断是否参加过活动
     */
    private function checkWin($openid, $activity_id)
    {
        $model = D('Joiner');
        $map['openid'] = $openid;
        $map['activity_id'] = $activity_id;

        $info = $model->where($map)->find();

        if (empty($info)) {
            return 0;
        }
        //获取中奖记录
        unset($map);
        $LogModel = D('ActivityLog');

        $map['joiner_id'] = $info['id'];
        $map['activity_id'] = $activity_id;

        $log_info = $LogModel->where($map)->find();

        if (empty($log_info['psize_id'])) {
            return -1;      //参加过记录但是没有中奖
        }
        //获取奖项
        unset($map);
        $PsizeModel = D('ActivityPsize');
        $map['activity_id'] = $activity_id;
        $map['id'] = $log_info['psize_id'];

        $psize_info = $PsizeModel->where($map)->find();

        return $psize_info;
    }

    /**
     * 获取当前活动信息
     */
    private function getActivity()
    {
        $model = D('Activity');
        $map['status'] = 1;
        
        $info = $model->order('id desc')->find();
        if (empty($info)) {
            return false;
        }
        return $info;
    }
}
