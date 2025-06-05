/*******************************************************************************
 * Boundless Journeys - Custom Javascript
 ******************************************************************************/
var bLazy;

/*******************************************************************************
 * Misc/helper functions
 ******************************************************************************/
/**
 * Get query string parameter by name.
 */
function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

/*******************************************************************************
 * Initalize functions
 ******************************************************************************/
/**
 * Initialize custom select boxes.
 */
function _initCustomSelects() {
  // Check that selectize JS has loaded
  if (typeof $.fn.selectize == "function") {
    $('select.field').selectize();
  }
}

/**
 * Initialize print page.
 */
function _printPage() {
  if ($('a').hasClass('print')) {
    $('a.print').click(function(evt){
      evt.preventDefault();
      window.print();
    });
  }
}


/**
 * Initalize flickity sliders (hero images, quotes, etc)
 */
function _initFlickitySliders() {
  // Check that flickty JS has loaded
  if (typeof jQuery.fn.flickity == "function") {
    /**
     * Hero images
     */
    // Cache jQuery object
    _slider = jQuery("ul.slideshowheader");
    // Check if we have more than 1 slide
    if (jQuery("li.slide", _slider).length > 1) {
      // Initialize sldier
      $flkcy = _slider.flickity({
        cellSelector:       'li.big-slide',
        selectedAttraction: 0.025,
        friction:           0.38,
        prevNextButtons:    true,
        autoPlay:           4500,
        wrapAround:         true,
        arrowShape: {
          x0: 10,
          x1: 60,
          y1: 50,
          x2: 70,
          y2: 40,
          x3: 30
        }
      });

      $flkcydata = $flkcy.data('flickity');

      $sliderparent = jQuery("div.flickity-slider");
    }
    /**
     * Quote sliders
     */
    // Cache jQuery object
    _quoteSlider = jQuery('.quote-slider');
    // Main Quotes
    jQuery('.quotes', _quoteSlider).flickity({
      pageDots:   false,
      wrapAround: true,
      autoPlay: false,
    });

    // Quote Cites Nav
    jQuery('.cites', _quoteSlider).flickity({
      asNavFor:         '.quote-slider .quotes',
      contain:          true,
      prevNextButtons:  false,
      pageDots:         false
    });
  }
}

/**
 * Initialize Header Search validation.
 */
function _initHeaderSearchValidate() {
	_headerSearch = $(".site-search form");
	_headerSearch.submit(function() {

		var keyword = $("#s", _headerSearch).val();
		if(keyword.length === 0){
			return false;
		}

	});
}

/**
 * Initialize footer email opt-in validation.
 */
function _initFooterEmailValidate() {
  // Cache jQuery object
  _emailOptin = $("#email_optin_footer");
  // Bind submit function
  _emailOptin.submit(function() {
    var strEmailAddress = $("#email", _emailOptin).val();
    strEmailAddress = strEmailAddress.replace(/\s/g,'');
    // create the regular expression test
    var objRegExp  = /(^[a-z0-9-_\.]{2,})@([a-z0-9]{1,})((\.|-)?[a-z0-9])*(\.[a-z]{2,4})+(\.[a-z]{2,4})*$/i;
    // check for valid email syntax
    if (objRegExp.test(strEmailAddress) === false) {
      // Cache jQuery object
      _errorMsg = $(".errorMsg", _emailOptin);
      if (_errorMsg.length === 0) {
        // Prepend error message
        $("> div", _emailOptin).prepend('<div class="errorMsg" style="opacity: 0;"><div>It looks like the email you entered wasn\'t an email. Please try again!</div><span class="arrow"></span></div>');
        // Cache jQuery object that was just prepended above
        _errorMsg = $(".errorMsg", _emailOptin);
        var cbot = parseInt(_errorMsg.css('bottom'));
        var nbot = cbot - 20;
        _errorMsg.css('bottom', nbot).animate({
          opacity:  1.0,
          bottom:   cbot
        }, 800);
      }
      return false;
    }
    else {
      // Address validates, return true
      return true;
    }
  });
}


/**
 * Add class to body tag to indicate that JS is enabled.
 */
function _initJSLoaded() {
  // Cache jQuery object
  _body = $("body");
  if (!_body.hasClass("js-loaded")) {
    _body.addClass("js-loaded");
  }
}


/**
 * Initalize magnific popups.
 */
function _initMagnificPopups() {

  // Check that magnificPopup JS has loaded
  if (typeof $.fn.magnificPopup == "function") {

    /**
     * Image enlargements
     */
    $('.enlarge').magnificPopup({type: 'image'});
    /**
     * Inline popups (forms, etc)
     */
    $('.inline-item').magnificPopup({
        type:         "inline",
        midClick:     true,
        removalDelay: 300,
        mainClass:    "mfp-slide-in"
    });
    /**
     * Gallery Items
     */
    $gallery = $('.zoom-gallery, .gallery');
    $gallery.magnificPopup({
      delegate : 'a',
      type: 'image',
      closeOnContentClick: false,
      closeBtnInside: false,
      image: {
        verticalFit: true,
        titleSrc : function(item) {
          if (item.el.attr('data-link')) {
            return "<a class='custom-url' href='" + item.el.attr('data-link') + "' target='_blank'>"+ item.el.attr('title') +"</a>";
          }else{
            return item.el.attr('title');
          }
        }
      },
      gallery: {
        enabled: true
      },
      zoom: {
        enabled: true,
        duration: 300,
        opener: function(ele) {
          return ele.find('img');
        }
      }
    });

    $gallery.imagesLoaded(
      function() {
        $gallery.masonry({
          itemSelector: '.gallery-item',
       //   columnWidth: '.sizer',
       //   percentPosition: true,
        });
      }
    );
  }
}


/**
 * Initalize masonry grid.
 */
function _initMasonryGrid() {
  // Check that masonry JS has loaded
  if (typeof $.fn.masonry == "function") {
    $(".cta-boxes .clearfix").masonry({
      itemSelector:     '.cta',
      percentPosition:  true,
      columnWidth: '.ctasizer'
    });
  }
}


/**
 * Initialize trip accommodation details.
 */
function _initTripAccommodationDetails() {
    $(".tour-itinerary .tour-itinerary .itinerary").each(function() {
        $(this).find(".wrap").prepend('<span class="expand">Hide Details</span>');
        // Bind click events to each itinerary item
        $(this).find(".expand").on('click', function() {
            // Check that slideToggle JS has loaded
            if (typeof $.fn.slideToggle == "function") {
                $(this).siblings(".details").slideToggle();
            }
            // Cache jQuery object
            _closest = $(this).closest(".itinerary");
            _closest.toggleClass("itin-expanded");
            // Update text based on state
            _text = _closest.hasClass("itin-expanded") ? "View Details" : "Hide Details";
            $(this).text(_text);
        });
    });


    $(".custom-itinerary .itinerary-itinerary .itinerary").each(function() {
        // $(this).find(".wrap").prepend('<span class="expand">Show Details</span>');
    // Bind click events to each itinerary item
        // $(this).addClass("itin-expanded");
    $(this).find(".expand").on('click', function() {
      // Check that slideToggle JS has loaded
      if (typeof $.fn.slideToggle == "function") {
        // $(this).siblings(".details").slideToggle();
      }
      // Cache jQuery object
      _closest = $(this).closest(".itinerary");
      _closest.toggleClass("itin-expanded");
      // Update text based on state
            _text = _closest.hasClass("itin-expanded") ? "Show Details" : "Hide Details";
      $(this).text(_text);
    });
  });
}


function _initTripAccommodationAllDetails() {
  $button   = jQuery("a.button.expand");
    $button.addClass("expanded");
  $itins    = jQuery("div.itinerary");
  $details  = jQuery("div.itinerary .details");
  $text     = jQuery("span.expand");
  $button.on('click touch', function(evt) {
    evt.preventDefault();
    if (typeof $.fn.slideToggle == "function") {
      if ($(this).hasClass("expanded")) {
        $details.slideUp();
                $itins.addClass('itin-expanded');
        $text.each(function() {
          $(this).text("View Details");
        });
        $(this).removeClass("expanded");
        $(this).text("View All");
      } else {
        $details.slideDown();
                $itins.removeClass('itin-expanded');
        $text.each(function() {
          $(this).text("Hide Details");
        });
        $(this).addClass("expanded");
        $(this).text("Hide All");
    }
  }
  });
}



/**
 * Initialize trip dates "view all dates".
 */
function _initTripDatesViewAll() {
  // Bind click event
  $(".tour-details .view-all").click(function() {
	  _scheduled = $(".tour-details li.scheduled");
	  if ($(this).hasClass("view-all-active")) {
		  _scheduled.stop(true, true).slideUp();
		  $(this).removeClass("view-all-active");
      } else {
		  _scheduled.stop(true, true).slideDown();
		  $(this).addClass("view-all-active");
	  }
  });
}


/**
 * Initialize trip extensions.
 */
function _initTripExtensions() {
  _extensions = $(".extensions");
  _extend     = $(".extend-tour");


  jQuery('html').on('click', function(){
    closeTripExt(_extend.find('.toggle'), _extensions);
  });

  _extensions.on('click',function(evt){
    evt.stopPropagation();
  });

  _extend.on('click', function(evt){
    evt.stopPropagation();
  });

  $(".extend-tour .toggle").click(function() {
    // Cache jQuery object
    if (!$(this).hasClass("extension-open")) {
      openTripExt($(this), _extensions);
    }
    else {
      closeTripExt($(this), _extensions);
    }
  });
}


function openTripExt(n,ext) {
  if (jQuery(window).innerWidth() < 768){
    n.addClass("extension-open");
    ext.stop(true, true).slideDown();
  } else {
    n.addClass("extension-open");
    ext.stop(true, true).fadeIn();
  }
}


function closeTripExt(n,ext) {

  if (jQuery(window).innerWidth() < 768){
    n.removeClass("extension-open");
    ext.stop(true, true).slideUp();
  } else {
    n.removeClass("extension-open");
    ext.stop(true, true).fadeOut();
  }
}



/**
 * Initialize trip featured highlights slider.
 */
function _initTripFeaturedHighlightSlider() {
  // Check that flexslider JS has loaded
  if (typeof $.fn.flexslider == "function") {
    // Cache jQuery object
    _slider = $('.featured-highlights .slider');
    // Confirm we have more than 1 slide
    if ($('.slides li', _slider).length > 1) {
      // Instantiate flex slider
      _slider.flexslider({
        animation:      "slide",
        smoothHeight:   true,
        controlNav:     false,
        startAt:        0,
        animationLoop:  false,
        touch: true,
      });
    }
  }
}


/**
 * Initialize trip search calendar.
 */
function _initTripSearchCalendar() {
  // Check that flickity JS has loaded
  if (typeof $.fn.flickity == "function") {
    // Cache jQuery object
    _calendar = $('.tours-calendar');
    /**
     * Months
     */
    $('.months-holder', _calendar).flickity({
      asNavFor:         '.tours-calendar .years-holder',
      draggable:        true,
      pageDots:         false,
      prevNextButtons:  false,
      wrapAround:       false
    });
    /**
     * Years
     */
    $('.years-holder', _calendar).flickity({
      draggable:  true,
      pageDots:   false
    });
  }
}


/**
 * Initialize trip search filters.
 */
function _initTripSearchFilters() {
  // Check if slideToggle JS has loaded
  if (typeof $.fn.slideToggle == "function") {
    // Cache jQuery object
    _tourListing = $(".tour-listing");


    $(".tour-filters h5", _tourListing).click(function() {
      if ($(window).innerWidth() < 768) {
        $(".filters", _tourListing).slideToggle(100,function(){
          $('.months-holder', _calendar).flickity('resize');
          $('.years-holder', _calendar).flickity('resize');
        });
      }
    });
  }
}

function _initTripShowTerms() {
  jQuery(".specialoffer a").on('click',function(evt){
    evt.preventDefault();
    jQuery(".hideterms").addClass('open');
  });
}

// ########################################
//############### this block is commented out and rewritten underneath###############

/**
 * Initialize site search widget.
 */
// function _initSiteSearch() {
//   // Cache jQuery object
//   _snuggle = $('#snuggle');
//   // Expand search widget
//   $('#li_search a').click(function(e) {
//       e.preventDefault();
//     // Add active class
//       $(this).toggleClass("active");
//     // Default margin
//     //_marginTop = '0px';
//     // if (_snuggle.css('margin-top') == '0px' || _snuggle.css('margin-top') === 0) {
//     //   // Calculate margin top
//     //   _marginTop = (_snuggle.outerHeight() * -1)+ 'px';
//     // }
//     // Animate the thing
//
//     //_snuggle.animate({'margin-top': _marginTop});
//     //return false;
//
//     _snuggle.slideToggle('slow');
//   });
//
// //
// //   // Close search widget
// //   $('.site-search .close').on('click'function() {
// //     // Calculate margin top
// //     _marginTop = (_snuggle.outerHeight() * -1) + 'px';
// //     // Animate
// //     _snuggle.animate({'marginTop': _marginTop});
// //     // Remove active class
// //     $('#li_search > a').removeClass("active");
// //   });
//
//
//     $('.site-search .close').click(function(e) {
//         e.preventDefault();
//         _snuggle.slideToggle('slow');
//     });
//
//  }


//##############    here       #########

function _initSiteSearch() {
  // Cache jQuery object
  _snuggle = $('#snuggle');
    $('#li_search a').click(function(e) {
        e.preventDefault();
        _snuggle.slideToggle('slow');
  });

    $('.site-search .close').click(function(e) {
        e.preventDefault();
        _snuggle.slideToggle('slow');
  });
}


function _initAccordion() {


    var accordiontabs = "accordion";

    // push the tabs to a single object.
    var accordtabs = $(".accordion-tabs");

    // set js on body if it has not been set already.
    if(!$("body").hasClass("js")) $("body").addClass("js");

    accordtabs.each(function() {

      var tab     = getParameterByName('tab');
      var numTabs = $(".heading", this).length;

      var heading = $(".heading", this);
      var content = $(".content", this);
      var side    = $(".side", this);

      if(tab.length > 0 && tab > 0 && tab <= numTabs) {
        heading.eq((tab)-1).addClass("active-heading");
        content.eq((tab)-1).addClass("active-content").css('display','block');
      } else {
        heading.first().addClass("active-heading");
        content.first().addClass("active-content").css('display','block');
      }

      if($(window).innerWidth() > 767) {
        $(this).prepend('<div class="tab-content"><div class="wrapper clearfix"></div></div>');
        content.appendTo($(".tab-content .wrapper", this));
        side.appendTo($(".tab-content > .wrapper", this));
        $(this).prepend('<div class="tab-headings"><div class="wrapper clearfix"></div></div>');
        heading.appendTo($(".tab-headings .wrapper", this));
        accordiontabs = "tabs";
      }
    });
    $(".heading", accordtabs).click(function() {

      var activeh = $(".active-heading");
      var activec = $(".active-content");

      if($(window).innerWidth() < 768) {

        if(!$(this).hasClass("active-heading")) {
          activeh.removeClass("active-heading");
          $(this).addClass("active-heading");
          activec.css('display','none').removeClass("active-content");
          $(this).next(".content").addClass("active-content").slideToggle();
		  $('html,body').scrollTop($(".active-heading").offset().top -20);


        } else {
          activeh.removeClass("active-heading");
          $(this).next(".content").removeClass("active-content").slideToggle();
        }
      } else {
        if(!$(this).hasClass("active-heading")) {
          activeh.removeClass("active-heading");
          $(this).addClass("active-heading");
          activec.css('display','none').removeClass("active-content");
          var tab = $(this).attr('id').replace("heading-","");
          $("#content-"+tab).addClass("active-content").fadeIn();
        }
      }
    });
}


function _initMobile() {
  $("#mobile-menu").verbMobileMenu({
    site    : $("#page"),
    button  : $("#mobile-menu-button")
  });
}


function _initAccordionTabs() {


  $( window ).resize(function() {

    if($(window).innerWidth() < 768) {
      accordiontabs = "accordion";
      if(accordiontabs != "accordion") {
        $(".accordion-tabs").each(function() {

          $(this).find(".content").appendTo(".accordion-tabs");
          $(this).find(".side").appendTo(".accordion-tabs");
          $(this).find(".heading").each(function() {
            var tab = $(this).attr('id').replace("heading-","");
            $(this).insertBefore("#content-"+tab);

          });
          $(this).find(".tab-headings").remove();
          $(this).find(".tab-content").remove();

        });
      }
    } else {
      accordiontabs = "tabs";
      if(accordiontabs != "tabs") {
        $(".accordion-tabs").each(function() {
          $(this).prepend('<div class="tab-content"><div class="wrapper clearfix"></div></div>');
          $(this).find(".content").appendTo($(this).find(".tab-content .wrapper"));
          $(this).find(".side").appendTo($(this).find(".tab-content .wrapper"));

          $(this).prepend('<div class="tab-headings"><div class="wrapper clearfix"></div></div>');
          $(this).find(".heading").appendTo($(this).find(".tab-headings .wrapper"));
          if($(this).find(".active-heading").length < 1) {
            $(this).find(".heading").first().addClass("active-heading");
            $(this).find(".content").first().addClass("active-content").css('display','block');
          }
        });
      }
    }
  });

}

function _initTourToolTip() {
  $button = jQuery("span.departures");
  $button.each(function() {
    $content = $(this).next('.departuredates').find("ul");
    $(this).tooltipster({
      animation   : 'fade',
      content     : $content
    });
  });
}

function megaOpenWindow(n){
  return;
  var mmheader = n.parent();
  if (!mmheader.hasClass("active-hdr")) {


    n.find(".hlight").fadeIn();
    $allmenus = $(".megamenu-hdr>div").removeClass('active-menu').css({"display":"none", "opacity": 0});
    n.next("div").addClass('active-menu').css({"display":"block"}).animate({opacity:1}, 300, function(evt){
        bLazy.revalidate();
    });
  }
}

function megaHideWindow(n){
  return;
  n.removeClass("active-menu").removeClass('active-menu').css({"display":"none", "opacity": 0});
}

function _initMegaMenu() {
  $primary_links = $("#megamenu .megamenu-hdr > a");
  $primary_links.on('touch mouseenter', function(evt){
    evt.preventDefault();
    megaOpenWindow($(this));
  });
  $wrappers = $(".megamenu_wrapper");
  $wrappers.on("mouseleave", function(){
    megaHideWindow($(this));
  });

  $wrappers.find('a').on('touch click',function(evt){
    evt.stopPropagation();
  });
  $wrappers.prev('a').on('touch click',function(evt){
    evt.stopPropagation();
  });

  $("#page").on('touch click', function(){
    megaHideWindow($(".active-menu"));
  });

}



function _addClasstoWufooSubmits(){
  if($('.wufoo li').length > 0){
    $('#saveForm').addClass('button gray');
  }
}





/**
 * Initialize accordion extension.
 */
function _initAccordionExtensions() {
  $(".accordion-extension .accordion-item").each(function() {
    $(this).find(".wrap").prepend('<span class="expand">View Details</span>');
    // Bind click events to each itinerary item
    $(this).find(".expand").on('click', function() {
      // Check that slideToggle JS has loaded
      if (typeof $.fn.slideToggle == "function") {
        $(this).siblings(".extend").slideToggle();
      }
      // Cache jQuery object
      _closest = $(this).closest(".accordion-item");
      _closest.toggleClass("accordion-item-extended");
      // Update text based on state
      _text = _closest.hasClass("accordion-item-extended") ? "Hide Details" : "View Details";
      $(this).text(_text);
    });
  });
}

function _initContentTabs(){

  var contenttabs = $(".content-tabs");
  contenttabs.each(function() {

    var heading = $(".content-tab-heading", this);
    var content = $(".content-tab-content", this);
    $(this).prepend('<div class="content-tab-headings"><div class="wrapper clearfix"></div></div>');
    heading.appendTo($(".content-tab-headings .wrapper", this));

    heading.first().addClass("active-content-tab-heading");
    content.first().addClass("active-content-tab-content").css('display','block');

  });

  $(".content-tab-heading", contenttabs).click(function() {

    var activeh = $(".active-content-tab-heading");
    var activec = $(".active-content-tab-content");

    if(!$(this).hasClass("active-content-tab-heading")) {
      activeh.removeClass("active-content-tab-heading");
      $(this).addClass("active-content-tab-heading");
      activec.css('display','none').removeClass("active-content-tab-content");
      //var tab = $(this).attr('id').replace("heading-","");
    var tab = $(this).index();
      $(".content-tabs .content-tab-content").eq(tab).addClass("active-content-tab-content").fadeIn();
    }
  });
}

function _guideCompact() {
  var guides = jQuery(".guides .guide");
  if(guides.length > 0) {
    // hide all extra paragraphs.
    guides.each(function(key, val) {
      var hidden = jQuery(this).find(".tourlinks+p").nextAll().hide().addClass("others hide");
      var current = jQuery(this).find(".tourlinks+p");
      if(hidden.length > 0) {
        jQuery("<span>", {
          "class" : "guidemore",
          text: " Read More +"
        }).on("click", function(){
          var others = jQuery(this).parent("p").siblings(".others");
          var sibs = jQuery(this).siblings(".others");
          var button;
          if (sibs.is(":visible")){
            sibs.addClass("hide").removeClass("visible").hide();
            this.textContent = " Read More +";
            button = jQuery(this).detach();
            button.appendTo(current);
          } else {
            others.addClass("visible").show();
            this.textContent = " Hide -";
            button = jQuery(this).detach();
            button.appendTo(current.parent('div'));
          }
        }).appendTo(current);
      }
    });
  }
}



/* need to kill the cookies on links before these are fired */
function _initCookieKillLinks() {
  $scheduled  = jQuery("a[href*='/tours/scheduled'],a[href*='/tours/custom'],a[href*='/tours/special'], #menu-mega-activities a");
  $scheduled.on('click touch', function(evt){
    evt.preventDefault();
    eraseAll();
    location.href = jQuery(this).attr('href');
  });
}


/* thanks quirksmode */
function createCookie(name,value,days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}
function eraseCookie(name) {
  createCookie(name,"",-1);
}
function eraseAll(){
  eraseCookie("destination_id");
  eraseCookie("activity_id");
  eraseCookie("difficulty_id");
  eraseCookie("departure");
  eraseCookie("duration");
  eraseCookie("trip_type");
  eraseCookie("pagecurrent");
}
function _initBlazy() {
  bLazy = new Blazy({
    'selector' : 'div.img, section.img, li.slide.show'
  });
}



function _smoothScroll(){
	/* Smooth Scroll
	=====================================================*/
	$('a[href*=#]:not([href=#],.ui-tabs-anchor, .read-reviews-link)').bind("click touchstart", function(evt) {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
      evt.preventDefault();
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			   if (target.length) {
				 $('html,body').animate({
					 scrollTop: target.offset().top -60
				}, 1000);
			}
		}
	});

}

/*******************************************************************************
 * Window load
 ******************************************************************************/
$(window).load(function() {
  _initJSLoaded();
});





/*******************************************************************************
 * Window resize
 ******************************************************************************/
$(window).resize(function() {
 // _initAccordion();
});






/*******************************************************************************
 * Rich Reviews customizations
 ******************************************************************************/


function _richReviewsCustomizations() {
//        show reviews three at a time RM18214
    var totalReviewGroups = jQuery('.testimonial_group');
    var totalReviewGroupsCount = totalReviewGroups.length;

    // alert(totalReviewGroupsCount);
//    reviews are grouped in threes in the markup; hide them all to start and then show the first three
    totalReviewGroups.hide();
    totalReviewGroups.eq(0).show();
    var shownReviewGroups = 0;
//    add "show more reviews" button
  if (totalReviewGroupsCount > 1) {
    jQuery('.quote').append('<a class="button gray"  id="showmorereviewsbutton">show more reviews</a>');
  }
    jQuery('#showmorereviewsbutton').click(function () {
      // show the next three reviews
      shownReviewGroups = shownReviewGroups + 1;
      totalReviewGroups.eq(shownReviewGroups).show();
      // alert("shownreviewgroups=" +shownReviewGroups+ ", totalreviewgroups=" +totalReviewGroups);
      if (shownReviewGroups == totalReviewGroupsCount - 1) {
        jQuery(this).hide();
      }
    });


//        show/hide for review form RM18214
  $('#review-form-toggle').css('cursor', 'pointer');
  $("#review-form").hide();
  $("#review-form-toggle").click(function () {
    $("#review-form").toggle("blind");
    $("#review-form-toggle-icon").toggleClass("ui-icon-plusthick ui-icon-minusthick");
  });


// add non-drop-capped opening quote to rich reviews RM18214
    $('span[itemprop="reviewBody"]').prepend("“");




// show the review form and scroll to it if the validation returns an error
  if($.trim($("span.form-err").text())!=='') {
    $("#review-form").show();
    $("#review-form").addClass('rr_custom_modal');
    $.magnificPopup.open({
      items: {
        src: '#review-form'
      },
      type: 'inline',
      midClick: true,
      //closeMarkup: '<button title="%title%" type="button" class="mfp-close">CLOSE <span>&#215;</span></button>',
      mainClass: 'mfp-fade',
      removalDelay: 300
    });
  }
  if ($("div.rr_successful").length) {
    // if review form submission is successful, display a modal with the success message
    $("#review-form").show();
    $("div.rr_successful").addClass('rr_custom_modal');
    $.magnificPopup.open({
      items: {
        src: '.rr_successful'
      },
      type: 'inline',
      midClick: true,
      //closeMarkup: '<button title="%title%" type="button" class="mfp-close">CLOSE <span>&#215;</span></button>',
      mainClass: 'mfp-fade',
      removalDelay: 300
    });
  }


  /* display reviewer names as first initial + last name, RM18214 */
  $(".rr_review_name [itemprop='name']").each(function () {
    var theFullName = $(this).text().trim();
    var allTheNames = theFullName.split(' ');

    var last_name = '';
    if( allTheNames[ 1 ] ) {
      last_name = allTheNames[ 1 ].substring( 0, 1 ) + '.';
    }

    $(this).text(allTheNames[ 0 ] + ' ' + last_name);
  });


// switch the individual reviews' stars to fontawesome for consistency RM18214
  $('.full-testimonial').each(function () {

    var emptystar = '&#xf006;';
    var fullstar = '&#xf005;';
    var indivReviews = {
      ratingContainer: null,
      totalStars: null
    };
    indivReviews.ratingContainer = $(this).find('.stars').html('');
    indivReviews.totalStars = parseInt($(this).find('span[itemprop="ratingValue"]').text());

    for (var z = 1; z <= indivReviews.totalStars; z++) {
      indivReviews.ratingContainer.append(fullstar);
    }

    for (var q = 1; q <= (5 - indivReviews.totalStars); q++) {
      indivReviews.ratingContainer.append(emptystar);
    }
  });

}

function _specialDeparturesHeader() {
  var getHeaderTop = function() {
    return header.css('top');
  };

  var getSiteWrapperPadding = function() {
    var padding = siteWrapper.css('paddingTop').replace('px', '');
    return parseInt(padding);
  };

  var closed = readCookie('closed');
  var body = $('body');

  var header = $('header.header'),
      headerTopOrig = getHeaderTop(),
      headerTop;

  var special = $("section.specialheader"),
      specialHeight;

  var button = $("section.specialheader a.button");
  var close = $("span.close");

  var siteWrapper = $('.site-wrapper'),
      siteWrapperPadding,
      siteWrapperPaddingOrig = getSiteWrapperPadding(),
      siteWrapperPaddingInt,
      siteWrapperOffset;

  special.removeClass('loading');


  if (!closed) {
    special.removeClass('closed');
    addHeader();
  }

  close.on('click', function(evt){
    removeHeader();
  });

  function addHeader() {
    specialHeight = special.outerHeight();
    headerTop = getHeaderTop();

    siteWrapperPaddingInt = getSiteWrapperPadding();

    if (body.hasClass('logged-in') && body.hasClass('admin-bar')) {
      siteWrapperPaddingInt = siteWrapperPaddingInt - 32;
    }

    siteWrapperOffset = siteWrapperPaddingInt + specialHeight;

    header.css('top', specialHeight);
    siteWrapper.css('paddingTop', siteWrapperOffset);
  }

  function removeHeader() {
    // minimize special header and set header.
    special.addClass('closed');
    createCookie("closed", true);

    header.removeAttr('style');
    siteWrapper.css('paddingTop', siteWrapperPaddingOrig);
  }

  var resizeTimer;

  $(window).on('resize', function(e) {
    if (!readCookie('closed')) {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {

        // Reset padding top
        siteWrapper.removeAttr('style');
        siteWrapperPaddingOrig = getSiteWrapperPadding();
        header.removeAttr('style');

        setTimeout(function(e) {
          addHeader();
        }, 500);
      }, 250);
    }
  });
}


function _cookieBanner() {
    var bannerSelector = '.cookie-banner';

    var cookieSeen = localStorage.getItem( 'cookie-seen' );
    var date = new Date();

    if(cookieSeen == null) {
      initCookieBanner();
      $(bannerSelector).css({'display':'block'});
      localStorage.setItem( 'cookie-seen', date.setDate( date.getDate() + 7 ) ); // + seven days (sets for 1 week)
    } else if (date > cookieSeen) {
      initCookieBanner();
      $(bannerSelector).css({'display':'block'});
      localStorage.setItem( 'cookie-seen', date.setDate( date.getDate() + 7 ) ); // + seven days (sets for 1 week)
    }
}

function initCookieBanner() {
  var bannerSelector = '.cookie-banner';
  var bannerClose = bannerSelector + ' .close';
  var bannerButton = bannerSelector + ' .button';
  $(bannerClose + ', ' + bannerButton).on('click', function() {
    $(bannerSelector).remove();
  });
}



// change Rich Reviews confirmation message
function changeRRConfMessage($name) {
  var messageBox = $('div.rr_successful ');
  if (messageBox.length) {
    messageText = messageBox.find('strong').text();
    rName = messageText.split(',')[0];
    messageBox.find('strong').text(rName + ', your review has been submitted. Thanks!');
    //alert(rName);
  }
}


//rName


// implement half-star ratings
function swapStars() {
    $('div.tour span[itemprop="aggregateRating"]').each(function () {
        //$(this).css('border','1px solid red');

        var emptystar = '&#xf006;';
        var fullstar = '&#xf005;';
        var halfstar = '&#xf123;';

        var ratingContainer = $(this),
            //starsContainer = $('.stars', ratingContainer),
            starsContainer = $(this).find('.stars'),
            totalStars = Math.round(parseFloat($('.rating', ratingContainer).text()) * 2) / 2,
            wholeStars = Math.floor(totalStars),
            emptyStars = 5 - Math.ceil(totalStars);

        // empty the stars container element
        starsContainer.html('');

        // add whole stars
        for (var j = 1; j <= wholeStars; j++) {
            starsContainer.append(fullstar);
        }

        // add a half star if applicable
        if (totalStars - wholeStars !== 0) {
            starsContainer.append(halfstar);
        }

        // add remaining empty stars
        for (var i = 1; i <= emptyStars; i++) {
            starsContainer.append(emptystar);
        }

    });
}


function _stopTabScroll() {

    jQuery('a.ui-tabs-anchor').click(function(e) {
             e.preventDefault();
});
}

function _mobileItinDropdown() {
  // hide the menu if the document is clicked on anywhere else but on a dropdown item
    jQuery(document).click(function() {
        if (jQuery(window).width() < 1400) {
            var target = jQuery(event.target);
            console.log(target);
            if (!target.hasClass("ui-tabs-anchor")) {
                jQuery("li.ui-tab:not(.ui-tabs-active)").hide();
            }
        }
           });

    jQuery(document).on("click", "section.tour-itinerary div.ui-tabs li.ui-tab a.ui-tabs-anchor", function (e) {

            if (jQuery(window).width() < 1400) {
                // var hiddenlistitems = jQuery(this).parent().parent().find('li.ui-tab:hidden');
                var hiddenlistitems = jQuery(this).parent().siblings('li.ui-tab:not(:visible)');
                if (hiddenlistitems.length == 0) {
                    jQuery(this).parent().siblings().hide();
                } else if (hiddenlistitems.length > 0) {
                    jQuery(hiddenlistitems).show();
                    // need to explicitly set this display property or the first list item falsely detects as hidden on the first click only
                    jQuery(this).parent().css('display', 'list-item');
                }
            }

             });


        jQuery( window ).resize(function() {
            if (jQuery(window).width() >= 1400) {
                jQuery('section.tour-itinerary div.ui-tabs li.ui-tab').show();
            } else {
                jQuery('section.tour-itinerary div.ui-tabs li.ui-tab:not(.ui-tabs-active)').hide();

            }

        });
    }


/*******************************************************************************
 * Document ready
 ******************************************************************************/
$(function() {
  /* Call initialize functions */
  _initCustomSelects();
  _initFlickitySliders();
  _initHeaderSearchValidate();
  _initFooterEmailValidate();
  _initMagnificPopups();
  _initMasonryGrid();
  _initSiteSearch();
  _initTripAccommodationDetails();
  _initTripAccommodationAllDetails();
  _initTripDatesViewAll();
  _initTripExtensions();
  _initTripFeaturedHighlightSlider();
  _initTripSearchCalendar();
  _initTripSearchFilters();
  _initTripShowTerms();
  _initMobile();
  _initContentTabs();
  _initAccordion();
  _initBlazy();
  _initMegaMenu();
  _initCookieKillLinks();
  _initTourToolTip();
  _addClasstoWufooSubmits();
  _printPage();
  _initAccordionExtensions();
  _smoothScroll();
  _guideCompact();
  _richReviewsCustomizations();
  _stopTabScroll();
  _mobileItinDropdown();
  //swapStars needs to fire on pageload in some - but not all - cases.
  swapStars();
  //changeRRConfMessage();
});

$(window).on('load', function() {
  _specialDeparturesHeader();
  _cookieBanner();
});

jQuery( document ).ajaxComplete(function() {
  // swapstars needs to fire on ajax complete in some - but not all - cases.
     swapStars();

});

