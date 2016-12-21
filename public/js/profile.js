$(document).ready(function () {
    /*
     * int year
     * int month
     * return int
     * function return number of days in current month in current Year
     */
    Date.prototype.daysInMonth = function (year, month) {
        return 32 - new Date(year, month - 1, 32).getDate();
    };
    var data = {};

    /*
     * generate amout of days depends on current month/year on document load
     */
    var years = $('select[name="b-year"] option:selected').attr('value');
    var month = $('select[name="b-month"] option:selected').attr('value');
    var days = new Date().daysInMonth(years, month);
    var selectedDay = $('select[name="b-day"] option').val();
    $('select[name="b-day"] option').remove();
    for (var i = 1; i <= days; i++) {
        if (i == selectedDay) {
            $('select[name="b-day"]').append('<option value="' + i + '" selected>' + i + '</option>');
        } else {
            $('select[name="b-day"]').append('<option value="' + i + '">' + i + '</option>');
        }
    }

    /*
     * generate amout of days depends on current month/year on date change
     */
    $('#b-date').on('change', function () {
        var year = $('select[name="b-year"] option:selected').attr('value');
        var month = $('select[name="b-month"] option:selected').attr('value');
        var day = $('select[name="b-day"] option:selected').attr('value');
        data['birth_date'] = year + "-" + month + "-" + day;
        var days = new Date().daysInMonth(year, month);
        $('select[name="b-day"] option').remove();
        for (var i = 1; i <= days; i++) {
            if (i == day) {
                $('select[name="b-day"]').append('<option value="' + i + '" selected>' + i + '</option>');
            } else {
                $('select[name="b-day"]').append('<option value="' + i + '">' + i + '</option>');
            }
        }
    });
    /*
     * set timer for auto update on any .data change
     * and add to the data current changed value
     */
    var timerId = 0;
    $('.data').on('change', function () {
        data[$(this).parent().attr('id')] = $(this).val();
        clearTimeout(timerId);
        timerId = setTimeout(update, 5000);
    });


        /*
         * uploading image
         */
//    $('form').on('submit', function () {
////        $('form').submit();
//        var avatar = new FormData($('form'));
//        console.log(avatar);
//         $.ajaxSetup({
//            headers: {
//                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//            }
//        });
//        $.ajax({
//            type: "POST",
//            url: "/profile/update/",
//            data: avatar,
//            processData: false,
////            contentType: false,
//            success: function (data) {
//                $('#message-profile').html(data);
//            }
//        })
//        return false;
//    })

    /*
     * Send ajax request for update user profile
     */
    var elementsWithError = {};
    function update() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: "/profile/update/",
            data: data,
            
//            statusCode: {
//                200: function (data) {
//                    $('#message-profile').html(data);
//                    for (var element in elementsWithError) {
//                        $("#" + element + ">input").removeClass("error");
//                    }
//                },
//                422: function (data) {
//                    elementsWithError = JSON.parse(data.responseText);
//                    console.log(data);
//                    var erros = '';
//                    for (var element in elementsWithError) {
//                        $("#" + element + ">input").addClass("error");
//
//                    }
//                    $('#message-profile').html(erros);
//                },
//                404: function (data) {
//                    console.log(data);
//                    $('#message-profile').html(data);
//                }
//            },
            error: function (data) {
                elementsWithError = JSON.parse(data.responseText);
//                var erros = '';
                for (var element in elementsWithError) {
                    $("#" + element + ">input").addClass("error");

                }
//                $('#message-profile').html(erros);
            },
            success: function (data) {
                for (var element in elementsWithError) {
                    $("#" + element + ">input").removeClass("error");
                }
                $('#message-profile').html(data);
            }
        });
    }

});
