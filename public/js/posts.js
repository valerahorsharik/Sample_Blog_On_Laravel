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
                error: function (e) {
                    $(this).parent().append('lose');
                    console.log(e);
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
    var postId = $(this).parent('.comments').sublings('.toggle-comments').data('post-id');
    var text = $(this).children('textarea').val();
    $.ajax({
        type: "POST",
        url: "/comment/save",
        data:{
            id:postId,
            text:text
        },
        success:function(){
            alert('123');
        }

    });
    return false;
});
