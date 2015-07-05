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
            case Wechat::MSGTYPE_TEXT:      //关键词
                $this->keywords();
                break;
            case Wechat::EVENT_SUBSCRIBE:   //关注回复
                $this->subscribe();
                break;
        }
    }

    /**
     * 设置关键词回复
     */
    private function keywords()
    {
        $content = $this->wechat->getRev()->getRevContent();
        $from = $this->wechat->getRev()->getRevFrom();

        $model = D('Keyword');
        $map['keywords'] = $content;

        $info = $model->where($map)->find();

        switch ($content) {
            case '猜新车':
                //判断活动是否开始
                $activity_info = $this->getActivity();
                if (!$activity_info) {
                    $return_msg = '活动还未开始';
                    $this->wechat->text($return_msg)->reply();
                    exit();
                }
                //判断是否中奖
                $log_info = $this->checkWin($from, $activity_info['id']);
                if ($log_info === -1) {
                    $return_msg = '您已参加过活动,请等待开奖';
                    $this->wechat->text($return_msg)->reply();
                    exit();
                }
                if (is_array($log_info) && count($log_info) >0) {
                    $return_msg = '恭喜您中'.$log_info['name'].',奖品是'.$log_info['prize'];
                    $this->wechat->text($return_msg)->reply();
                    exit();
                }
                //回复参与活动的图文
                break;
        }
        $return_msg[0]['Title'] = $info['title'];
        $return_msg[0]['Description'] = $info['descption'];
        $return_msg[0]['PicUrl'] = $info['thumb'];
        $return_msg[0]['Url'] = $info['link'];

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
        $map['psize_id'] = array('exp','is not null');

        $log_info = $LogModel->where($map)->find();
        if (empty($log_info)) {
            return -1;      //参加过记录但是还没有开奖
        }
        //获取奖项
        unset($map);
        $PsizeModel = D('ActivityPsize');
        $map['activity_id'] = $activity_id;
        $map['psize_id'] = $log_info['psize_id'];

        $psize_info = $PsizeModel->where($map)->find();

        return $psize_info;
    }

    /**
     * 获取当前活动信息
     */
    private function getActivity()
    {
        $model = D('Activity');
        $map['is_lottery'] = 0;
        $map['status'] = 1;
        
        $info = $model->order('id desc')->find();

        return $info;
        
    }
}
