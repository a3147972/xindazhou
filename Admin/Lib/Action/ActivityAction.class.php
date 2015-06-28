<?php 
/**
 * 活动管理
 * 
 * @author molei <2387813033@qq.com>
 */

class ActivityAction extends BaseAction{
	function insert(){
		$model = D('Activity');

		if(!$model->create()){
			$this->error($model->getError());
		}

		$options = I('post.options');
		if(empty($options)){
			$this->error('请上传选项图片');
		}
		$options = explode('|',$options);
		$options = array_filter($options);
		$options = array_slice($options, 0,9);
		
		$model->startTrans();
		//写入活动表
		$insert_result = $model->add();
		//写入选项表
		$OptionsData = array();
		foreach($options as $_k=>$_v){
			$_data['id'] = NULL;
			$_data['activity_id'] = $insert_result;
			$_data['options'] = $_v;
			array_push($OptionsData,$_data);
		}

		$insert_options = D('ActivityOptions')->addAll($OptionsData);

		if($insert_result && $insert_options){
			$model->commit();
			$this->success('新增成功',U('index'));
		}else{
			$model->rollback();
			$this->error('新增失败');
		}
	}

	function update(){
		$model = D('Activity');

		if(!$model->create()){
			$this->error($model->getError());
		}

		$options = I('post.options','');
		$id = I('post.id');

		$map['id'] = $id;
		$model->startTrans();

		$save_result = $model->where($map)->save();

		$save_options = true;
		if(!empty($options)){
			//删除原来的所有选项
			$where['activity_id'] = $id;

			D('ActivityOptions')->where($where)->delete();

			$options = explode('|',$options);
			$options = array_filter($options);
			$options = array_slice($options, 0,9);
			//写入选项表
			$OptionsData = array();
			foreach($options as $_k=>$_v){
				$_data['id'] = NULL;
				$_data['activity_id'] = $id;
				$_data['options'] = $_v;
				array_push($OptionsData,$_data);
			}

			$save_options = D('ActivityOptions')->addAll($OptionsData);
		}

		if($save_result !== false && $save_options){
			$model->commit();
			$this->success('修改成功',U('index'));
		}else{
			$model->rollback();
			$this->error('修改失败');
		}
	}
}