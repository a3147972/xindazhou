/**
 * Created by zhibo on 15-6-6.
 */
$(function(){

    $('.btn-inverse').click(function(){
        $.ajax({
            type:'POST',
            data:{
                username:$('input[placeholder=Username]').val(),
                password:$('input[placeholder=Password]').val()
            },
            url: ThinkPHP['Login'],
            success:function(data){
                alert(data)
            }

        })
    })
})