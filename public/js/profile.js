$(document).ready(function () {
    /*
     * int year,month
     * return int
     * function return number of days in current month in current Year
     */
    Date.prototype.daysInMonth = function (year, month) {
        return 32 - new Date(year, month - 1, 32).getDate();
    };
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

    $('#b-date').on('change', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        var year = $('select[name="b-year"] option:selected').attr('value');
        var month = $('select[name="b-month"] option:selected').attr('value');
        var day = $('select[name="b-day"] option:selected').attr('value');
        var days = new Date().daysInMonth(years, month);
        $('select[name="b-day"] option').remove();
        for (var i = 1; i <= days; i++) {
            if (i == day) {
                $('select[name="b-day"]').append('<option value="' + i + '" selected>' + i + '</option>');
            } else {
                $('select[name="b-day"]').append('<option value="' + i + '">' + i + '</option>');
            }
        }
        $.ajax({
            type: "PUT",
            url: "/profile/bdate/",
            data: {
                year: year,
                month: month,
                day: day
            },
            success: function (data) {
                $('#b-date').append('<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3 success">' + data + '</div>');
            }
        });
    });
});
