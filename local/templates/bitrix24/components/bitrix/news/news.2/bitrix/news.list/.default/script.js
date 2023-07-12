$(document).ready(function () {
    $(document).on('click', '.publications__btn.btn', function (e) {
        e.preventDefault();
        var url = $(this).data('page');
        $.ajax({
            method: 'GET',
            dataType: 'HTML',
            url: url,
            data: {
                'AJAX': 'Y',
            },
            success: function (response) {
                var rows = $(response).find('.publications__row');
                var button = $(response).find('.publications__btn.btn').closest('.publications__button');
                $(document).find('.publications__button').remove();
                $(document).find('.publications__wrapper').append(rows);
                if (button.length > 0) {
                    $(document).find('.publications__wrapper').append(button);
                }

            }
        })
    });
});