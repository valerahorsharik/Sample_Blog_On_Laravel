$(document).ready(function(){
    $('.download-comments').on('click',function(){
           // download comments using ajax
        if($(this).parent().find('.comments').length === 0){
            var postId = $(this).attr('data-post-id');
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/comments',
                data:{id:postId},
                context:$(this),
                success:function(data){
                    $(this).parent().append(data);
                },
                error:function(e){
                    $(this).parent().append('lose');
                    console.log(e);
                }
            });
        }
        $(this).removeClass('download-comments');
    });
    
    $('.toggle-comments').on('click',function(){
        if(!$(this).hasClass('download-comments')){
            $(this).toggleClass('active');
        }
    });
});