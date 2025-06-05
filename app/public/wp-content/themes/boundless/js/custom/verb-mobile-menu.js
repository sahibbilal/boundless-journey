(function ($) {

  $.fn.verbMobileMenu = function(options) {


    var menu = this;

    // Settings and default options.
    var settings = $.extend({
      site: $('#page'),
      button: $('#mobile-menu-button'),
      menu_title: true
    }, options);

    // Mobile menu button.
    settings.button.on('click', openMenu);

    // Open the mobile menu.
    function openMenu() {

      if (settings.site.hasClass('open')) {
        closeMenu();
      } else {
        settings.site.addClass('open');
        menu.fadeIn();
        settings.button.fadeOut('fast', function() {
          settings.button.addClass('open');
          settings.button.fadeIn();
        });
      }
    }

    // Find sub menus.
    $('ul li', menu).each(function() {
      if ($(this).children('ul').length) {
        $('> a', this).addClass('has-children').append('<span class="expand">»</span>');
      }
    });

    // Click a menu expand button.
    $('ul li .expand', menu).on('click', function() {
      // Set section title.
      var section_title = $(this).parent().text().replace('»', '');
      // Expand next layer.
      $(this).parent().blur().parent().find('ul:first').addClass('open').find('.section-title .title').text(section_title);
      return false;
    });

    // Force equal height menus.
    var mobile_menu_height = 0;
    $('ul', menu).each(function() {
      if ($(this).height() > mobile_menu_height) {
        mobile_menu_height = $(this).height() + ($('li:first', this).height() * 2);
      }
    });
    // Section titles.
    $('ul', menu).each(function() {
      // Set height and add section title <li>.
      $(this).height(mobile_menu_height).prepend('<li class="section-title"><span class="title">Menu</span><span class="collapse">«</span></li>');
    });

    if (settings.menu_title) {
      $('ul .section-title .collapse:first', menu).addClass('close').text('✕');
    } else {
      $('ul .section-title:first', menu).hide();
    }

    // Click a menu collapse button.
    $('ul li .collapse', menu).on('click', function() {
      if ($(this).hasClass('close')) {
        closeMenu();
      } else {
        $(this).parent().parent().removeClass('open').find('ul').removeClass('open');
      }
    });

    // Hide after setup.
    menu.hide();

    // Close the mobile menu.
    function closeMenu() {
      settings.site.removeClass('open');
      $('ul', menu).removeClass('open');
      menu.fadeOut();
      settings.button.fadeOut('fast', function() {
        settings.button.removeClass('open');
        settings.button.fadeIn();
      });
    }

    return this;

  };

})(jQuery);