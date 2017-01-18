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
            var postId = $(this).attr('data-post-id');
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