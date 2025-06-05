
    var $document = $(document);
    var  header = $('header');

    $document.scroll(function () {

            if ($document.scrollTop() >= 1) {

                // do stuff

                header.addClass('scrolled');
                header.removeClass('fixed');

            } else {
                header.removeClass('scrolled');
                header.addClass('fixed');
            }

    });
