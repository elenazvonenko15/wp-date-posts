jQuery(document).ready(function ($) {
    $('.article-item').on('click', function () {
        const articleId = $(this).attr('data-article-id');
        const articleTitle = $(this).find('h4').text();
        $('.popup-content .popup-img').remove();

        $.ajax({
            type: 'post',
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: 'get_post_data',
                data: articleId,
            },
            complete: function (response) {
                const data = JSON.parse(response.responseText).data;

                $('.popup-content .popup-title').text(articleTitle);
                $('.popup-content .popup-excerpt').text(data['excerpt']);
                $('.popup-content .popup-link').attr('href', data['link']);

                if(data['img']) {
                    $('.popup-content').prepend(`<img class="popup-img" src="${data['img']}" alt="${articleTitle}">`);
                }

                $('.popup').fadeIn();
            },
        });
    });

    $('.popup').on('click', function (e) {
        if ($(e.target).hasClass('popup')) {
            $(this).fadeOut();
        }
    });
});