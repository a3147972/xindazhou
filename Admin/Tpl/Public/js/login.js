/**
 * Created by zhibo on 15-6-6.
 */
$(function(){
    $('.btn-inverse').click(function(){
        $.ajax({
            url: ThinkPHP['Login'],
            type:'POST',
            data:{
                username:$('input[name=username]').val(),
                password:$('input[name=password]').val()
            },
            success:function(i){
                if (i.status == 1) {
                    window.location.href = i.url
                } else {
                    alert(i.info);
                }
            }
        })
    })
})