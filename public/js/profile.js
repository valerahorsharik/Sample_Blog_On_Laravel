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
        data['year'] = $('select[name="b-year"] option:selected').attr('value');
        data['month'] = $('select[name="b-month"] option:selected').attr('value');
        data['day'] = $('select[name="b-day"] option:selected').attr('value');
        var days = new Date().daysInMonth(data['year'], data['month']);
        $('select[name="b-day"] option').remove();
        for (var i = 1; i <= days; i++) {
            if (i == data['day']) {
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
     * Send ajax request for update user profile
     */

    function update() {
        console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: "/profile/update/",
            data: data,
            success: function () {
                $('#message-profile').html('Success');
            }
        });
    }

});
