function ajaxForm(dom){
	var url = $(dom).attr('action');
	var data = $(dom).serialize();

	$.ajax({
		url:url,
		data:data,
		type:'post',
		dataType:'json',
		success:function(i){
			if(i.status == 1){
				window.location.href = i.url;
			}else{
				alert(i.info);
			}
		}
	})
	return false;
}

function ajaxBtn(dom){
	var url = $(dom).attr('url');
	$.ajax({
		url:url,
		type:'get',
		dataType:'json',
		success:function(i){
			if(i.status == 1){
				window.location.href = i.url;
			}else{
				alert(i.info);
			}
		}
	})
	return false;
}
$(function(){
	//表单验证
	$('.require').blur(function(){
		var value = $(this).val();
		if(value == ''){
			alert('此字段不可为空');
			return false;
		}
	})
})