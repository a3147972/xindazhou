/**
 * Created by zhibo on 15-6-6.
 */
$(function(){
    $('.btn-inverse').click(function(){
        $.ajax({
            type:'POST',
            data:{
                username:$('input[name=username]').val(),
                password:$('input[name=password]').val()
            },
            url: ThinkPHP['Login'],
            success:function(data){
                if (data > 0) {
                    location.href = ThinkPHP['INDEX'];
                } else {
                    alert('密码或用户名不正确');
                }
            }

        })
    })
})