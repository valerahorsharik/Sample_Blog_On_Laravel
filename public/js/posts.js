$(document).ready(function(){
    $('.download-comments').on('click',function(){
           // download comments using ajax
        if($(this).parent().find('.comments').length === 0){
//            $.ajax({
//                url:
//            });
            $(this).parent().append('<ul class="comments">\n\
                                        <li>first comment</li>\n\
                                        <li>second comment</li>\n\
                                    </ul>');
        }
        $(this).removeClass('download-comments');
    });
    
    $('.toggle-comments').on('click',function(){
        if(!$(this).hasClass('download-comments')){
            $(this).toggleClass('active');
        }
    });
});