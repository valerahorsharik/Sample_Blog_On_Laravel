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
     * Download comments by postId
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
                    console.log(error.responseText);
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
            $(this).html($(this).html() == "Hide comments." ? "Show comments." : "Hide comments.");
        }
    });
    
    /*
     * Delete post by postId
     */
    $('.delete-post').on('click', function () {
        var postId = $(this).closest('.post').data('post-id');
        $.ajax({
            type: 'POST',
            url: '/post',
            data: {
                _method: 'delete',
                id: postId
            },
            context:$(this).closest('.post'),
            success: function (data) {
                $(this).html(data);
                deleteElement($(this),2);
            },
            error: function (error) {
                $(this).parent().html('Something broken...');
                console.log(error.responseText);
            }
        });
    });

});

/**
 * Delete an element after the specified time(in seconds).
 * 
 * @param {object} element
 * @param {int} seconds
 * @returns {void}
 */
function deleteElement(element,seconds){
   setTimeout(function(){
       element.remove();}
   ,seconds*1000);
}

/*
 * Save comment from FORM with class .comments-form
 * 
 */
$(document).on('submit', '.comments-form', function () {
    var postId = $(this).closest('.comments').siblings('.toggle-comments').data('post-id');
    var comment = $(this).children('textarea').val();
    $.ajax({
        type: "POST",
        url: "/comment/save",
        context: $(this),
        data: {
            id: postId,
            comment: comment
        },
        error: function (error) {
            console.log(error.responseJSON);
        },
        success: function (data) {
            /*
             * Displays saved comment in the top of the .comment-list
             */
            $(this).parent().siblings(".toggle-comments").html('Hide comments.')
            $(this).siblings('.comments-list').prepend(
                    '<li data-comment-id="' + data.comment_id + '">\n\
                        <div class="comment-info">\n\
                            <div class="info">' + data.author + ' ' + data.created_at + '</div>\n\
                            <div class="actions">\n\
                                <span class=\'glyphicon glyphicon-remove delete-comment\'></span>\n\
                            </div>\n\
                        </div>\n\
                        <div class="comment-text">'
                    + data.comment +
                    '</div>\n\
                    </li>'
                    );
            $(this).children('textarea').val('');
        }

    });
    return false;
});

/*
 * Delete "clicked" comment from .comments-list by comment-id
 */
$(document).on('click', '.comments-list .delete-comment', function () {
    var commentId = $(this).closest('li').data('comment-id');
    $.ajax({
        type: "post",
        url: "/comment/delete",
        context: $(this).parent(),
        data: {
            _method: 'delete',
            id: commentId
        },
        error: function (error) {
            console.log(error.responseText);
        },
        success: function () {
            $(this).html("Deleted");
        }
    });
});