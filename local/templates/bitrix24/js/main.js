$(document).ready(function () {
    const sidebarMenu = $('.menu')
    const sidebarButtonOpen = $('.menu-button')
    const bodyMain = $('body')

    $(document).on('click', '.menu-button, .main__btn', function (e) {
        e.preventDefault()
        bodyMain.toggleClass('menu-opened')
    })

    if ($('.album__grid').length > 0) {
        let gallery = new Masonry('.album__grid', {
            columnWidth: 260,
            gutter: 20,
        });
    }

    $('[data-fancybox="gallery"]').fancybox({
        infobar: false,
        buttons: ["close"]
    })

    const popups = $('.popup')
    const popupWrapper = $('.popup-wrapper')
    const popupCloseBtn = $('.popup-close-btn')

    $(document).on('click', '[data-form]', function (e) {
        e.preventDefault();
        let typeForm = $(this).data('form');
        let recipient = $(this).data('recipient');
        popups.removeClass('active');
        openPopup(typeForm, recipient);
    });

    popupCloseBtn.on('click', function (e) {
        e.preventDefault()
        bodyMain.removeClass('popup-opened')
        popupWrapper.removeClass('active')
    })

    const openPopup = (popupType, recipient) => {
        bodyMain.addClass('popup-opened');
        popupWrapper.addClass('active');
        $('[data-type="' + popupType + '"]').addClass('active');
        if (!recipient) {
            recipient = 'intranet@gctm.ru';
        }
        $('[data-type="' + popupType + '"]').find('input[data-name="RECIPIENT"]').val(recipient);
    }


    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) {
            return '0';
        } else {
            var k = 1024;
            var dm = decimals < 0 ? 0 : decimals;
            var sizes = ['Б', 'КБ', 'МБ', 'ГБ', 'ТБ'];
            var i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }
    }

    $(document).on('change', '[data-type] input[type="file"]', function (e) {
        let size = formatBytes(this.files[0].size);
        let name = this.files[0].name;
        let list = $(this).closest('.form__item').siblings('.files-list').empty();
        let html = '<li><span>' + name + '</span> / <span>' + size + '</span></li>';
        list.append(html);
    });

    $(".select").selectmenu({
        appendTo: "#someElem"
    });

    $(document).on('submit', '.form', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var data = new FormData(this);
        var formContainer = $(this).closest('.popup');
        $.ajax({
            url: '/ajax/form.php',
            data: data,
            method: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    formContainer.removeClass('active');
                    $('[data-type="accepted"]').addClass('active');
                }
            }
        })
    });
});