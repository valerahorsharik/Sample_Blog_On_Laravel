$(document).ready(function () {
    /*
     * Setup CSRF token for all ajax requests
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*
     * Download comments using ajax by postId
     */
    $('.download-comments').on('click', function () {
        if ($(this).parent().find('.comments').length === 0) {
            var postId = $(this).data('post-id');
            $.ajax({
                type: 'POST',
                url: '/comments',
                data: {id: postId},
                context: $(this),
                success: function (data) {
                    $(this).parent().append(data);
                },
                error: function (error) {
                    $(this).parent().html('Something broken...');
                    console.log(error);
                }
            });
        }
        $(this).removeClass('download-comments');
    });
    /*
     * Show/hide comments if they are already downloaded
     */
    $('.toggle-comments').on('click', function () {
        if (!$(this).hasClass('download-comments')) {
            $(this).toggleClass('active');
        }
    });

});

/*
 * Save comment from FORM with class .comments-form
 */
$(document).on('submit', '.comments-form', function () {
    var postId = $(this).closest('.comments').siblings('.toggle-comments').data('post-id');
    var comment = $(this).children('textarea').val();
    $.ajax({
        type: "POST",
        url: "/comment/save",
        context: $(this),
        data:{
            id:postId,
            comment:comment
        },
        error:function(error){
            console.log(error.responseJSON);
        },
        success:function(){
            $(this).siblings('.comments-list').prepend(
                    '<li data-comment-id="' + postId +'">' +
                    comment +
                    "<span class='glyphicon glyphicon-remove delete-comment'></span></li>"
                    );
            $(this).children('textarea').val('');
        }

    });
    return false;
});

/*
 * Delete "clicked" comment from .comments-list by comment-id
 */
$(document).on('click','.comments-list .delete-comment',function(){
    var commentId = $(this).parent().data('comment-id');
    $.ajax({
        type: "post",
        url: "/comment/delete",
        context:$(this).parent(),
        data:{
            _method: 'delete',
            id:commentId
        },
        error:function(error){
            console.log(error.responseText);
        },
        success:function(){
            $(this).html("Deleted");
        }
    });
});