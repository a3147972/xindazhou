<?php
class IndexAction extends BaseAction {
	private $wechat = '';
    function _initialize(){
    	$options = array(
			'token'=>C('WEIXIN_OPTIONS.TOKEN'), //填写你设定的key
 			'encodingaeskey'=>C('WEIXIN_OPTIONS.ENCODINGAESKEY'), //填写加密用的EncodingAESKey
 			'appid'=>C('WEIXIN_OPTIONS.APPID'), //填写高级调用功能的app id
 			'appsecret'=>C('WEIXIN_OPTIONS.APPSECRET') //填写高级调用功能的密钥
		);
		$this->wechat = new Wechat($options);
		$this->wechat->valid();
    }

    function index(){

    }
}