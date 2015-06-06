/**
 * Created by zhibo on 15-6-6.
 */
$(function(){

    $('.btn-inverse').click(function(){
        alert(111);
        $.ajax({
            type:'POST',
            data:{
                username:$('input[name=username]').val(),
                password:$('input[name=password]').val()
            },
            url: ThinkPHP['Login'],
            success:function(data){
                alert(data);
            }

        })
    })
})