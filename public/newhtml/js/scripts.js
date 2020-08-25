//

/*----------------------------------------------------*/
/* MOBILE DETECT FUNCTION
/*----------------------------------------------------*/
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};



/////////////////////// ready
$(document).ready(function() {

  // touchTouch
  var o = $('.thumb-isotope .thumbnail a');
  if (o.length > 0) {
    o.touchTouch();
  }

  // Select2.
  $('.select2').select2({
    // containerCss: ".eeeeeee",
    minimumResultsForSearch: Infinity,

  });

  // datapicker
  $( ".datepicker" ).datepicker({
     orientation: "top"
  });

  // Accordion.
  $( ".accordion" ).accordion({
    active: 1,
    heightStyle: "content"
  });

  // Tabs.
  $( ".tabs1" ).tabs();
  $( ".tabs2" ).tabs();

  // Slider range.
  $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 1500,
    values: [ 0, 1200 ],
    slide: function( event, ui ) {
      $( "#amount" ).val( "$" + ui.values[ 0 ]);
      $( "#amount2" ).val( "$" + ui.values[ 1 ] );
    }
  });
  $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) );
  $( "#amount2" ).val( "$" + $( "#slider-range" ).slider( "values", 1 ) );

  /*----------------------------------------------------*/
  // Camera slideshow
  /*----------------------------------------------------*/
  var o = $('#camera_wrap');
  if (o.length > 0) {
    o.camera({
      //thumbnails: true
      //alignment     : 'centerRight',
      autoAdvance     : true,
      mobileAutoAdvance : true,
      // fx          : 'scrollRight',
      height: '50%',
      hover: false,
      loader: 'none',
      navigation: false,
      navigationHover: false,
      mobileNavHover: false,
      playPause: false,
      pauseOnClick: false,
      pagination      : true,
      time: 5000,
      transPeriod: 1000,
      minHeight: '300px'
    });
  }


  /*----------------------------------------------------*/
  // carouFredSel.
  /*----------------------------------------------------*/
  var o = $('#hot .carousel.main ul');
  if (o.length > 0) {
    o.carouFredSel({
      auto: {
        timeoutDuration: 8000
      },
      responsive: true,
      prev: '.hot_prev',
      next: '.hot_next',
      width: '100%',
      scroll: {
        // fx : "crossfade",
        items: 1,
        duration: 1000,
        easing: "easeOutExpo"
      },
      items: {
            width: '1000',
        height: 'variable', //  optionally resize item-height
        visible: {
          min: 1,
          max: 1
        }
      },
      mousewheel: false,
      swipe: {
        onMouse: true,
        onTouch: true
        }
    });
  }

  var o = $('#say .carousel.main > ul');
  if (o.length > 0) {
    o.carouFredSel({
      auto: {
        timeoutDuration: 8000
      },
      responsive: true,
      prev: '.say_prev',
      next: '.say_next',
      width: '100%',
      scroll: {
        // fx : "crossfade",
        items: 1,
        duration: 1000,
        easing: "easeOutExpo"
      },
      items: {
            width: '1000',
        height: 'variable', //  optionally resize item-height
        visible: {
          min: 1,
          max: 1
        }
      },
      mousewheel: false,
      swipe: {
        onMouse: true,
        onTouch: true
        }
    });
  }

  var o = $('#sl1 .carousel.main ul');
  if (o.length > 0) {
    o.carouFredSel({
      auto: {
        timeoutDuration: 8000
      },
      responsive: true,
      prev: '.sl1_prev',
      next: '.sl1_next',
      pagination: '.sl1_pagination',
      width: '100%',
      scroll: {
        items: 1,
        duration: 1000,
        easing: "easeOutExpo"
      },
      items: {
            width: '2000',
        height: 'variable', //  optionally resize item-height
        visible: {
          min: 1,
          max: 1
        }
      },
      mousewheel: false,
      swipe: {
        onMouse: true,
        onTouch: true
        }
    });
  }

  var o = $('#sl2 .carousel.main ul');
  if (o.length > 0) {
    o.carouFredSel({
      auto: {
        timeoutDuration: 8000
      },
      responsive: true,
      prev: '.sl2_prev',
      next: '.sl2_next',
      pagination: '.sl2_pagination',
      width: '100%',
      scroll: {
        items: 1,
        duration: 1000,
        easing: "easeOutExpo"
      },
      items: {
            width: '2000',
        height: 'variable', //  optionally resize item-height
        visible: {
          min: 1,
          max: 1
        }
      },
      mousewheel: false,
      swipe: {
        onMouse: true,
        onTouch: true
        }
    });
  }

  var o = $('#sl3 .carousel.main ul');
  if (o.length > 0) {
    o.carouFredSel({
      auto: {
        timeoutDuration: 8000
      },
      responsive: true,
      prev: '.sl3_prev',
      next: '.sl3_next',
      pagination: '.sl3_pagination',
      width: '100%',
      scroll: {
        items: 1,
        duration: 1000,
        easing: "easeOutExpo"
      },
      items: {
            width: '2000',
        height: 'variable', //  optionally resize item-height
        visible: {
          min: 1,
          max: 1
        }
      },
      mousewheel: false,
      swipe: {
        onMouse: true,
        onTouch: true
        }
    });
  }



  $(window).bind("resize",updateSizes_vat).bind("load",updateSizes_vat);
  function updateSizes_vat(){
    $('#hot .carousel.main ul').trigger("updateSizes");
    $('#say .carousel.main ul').trigger("updateSizes");
    $('#sl1 .carousel.main ul').trigger("updateSizes");
    $('#sl2 .carousel.main ul').trigger("updateSizes");
    $('#sl3 .carousel.main ul').trigger("updateSizes");


  }
  updateSizes_vat();


  /*----------------------------------------------------*/
  // Sticky.
  /*----------------------------------------------------*/
  $("#top2").sticky({
    topSpacing:0,
    getWidthFrom: 'body',
    responsiveWidth: true
  });

    /*----------------------------------------------------*/
    // PRELOADER CALLING
    /*----------------------------------------------------*/
    $("body.onepage").queryLoader2({
        //barColor: "#fff",
        //backgroundColor: "#000",
        percentage: true,
        barHeight: 3,
        completeAnimation: "fade",
        minimumTime: 200
    });



	/*----------------------------------------------------*/
	// PARALLAX CALLING
	/*----------------------------------------------------*/
	$(window).bind('load', function () {
		parallaxInit();
	});
	function parallaxInit() {
		testMobile = isMobile.any();

		if (testMobile == null)
		{
			$('.parallax .bg1').addClass("bg-fixed").parallax("50%", 0.5);
      $('.parallax .bg2').addClass("bg-fixed").parallax("50%", 0.5);
      $('.parallax .bg3').addClass("bg-fixed").parallax("50%", 0.5);
      $('.parallax .bg4').addClass("bg-fixed").parallax("50%", 0.5);
		}
	}
	parallaxInit();




  /*----------------------------------------------------*/
  // prettyPhoto
  /*----------------------------------------------------*/
  //$("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'dark',social_tools:false,allow_resize: true,default_width: 500,default_height: 344});


  /*----------------------------------------------------*/
  // MENU SMOOTH SCROLLING
  /*----------------------------------------------------*/
  $(".navbar_ .nav a, .menu_bot a, .scroll-to").bind('click',function(event){

      //$(".navbar_ .nav a a").removeClass('active');
      //$(this).addClass('active');
      // var headerH = $('#top1').outerHeight();
      var headerH = $('#top2').outerHeight();

      if ($(this).attr("href")=="#home") {
        $("html, body").animate({
          scrollTop: 0 + 'px'
          // scrollTop: $($(this).attr("href")).offset().top + 'px'
        }, {
            duration: 1200,
            easing: "easeInOutExpo"
        });
      }
      else {
        $("html, body").animate({
          scrollTop: $($(this).attr("href")).offset().top - headerH + 'px'
          // scrollTop: $($(this).attr("href")).offset().top + 'px'
        }, {
            duration: 1200,
            easing: "easeInOutExpo"
        });
      }



      event.preventDefault();
  });

  /*----------------------------------------------------*/
  // Appear
  /*----------------------------------------------------*/
  $('.animated').appear(function() {
    // console.log("111111111111");
      var elem = $(this);
      var animation = elem.data('animation');
      if ( !elem.hasClass('visible') ) {
        var animationDelay = elem.data('animation-delay');
        if ( animationDelay ) {
          setTimeout(function(){
              elem.addClass( animation + " visible" );
          }, animationDelay);
        } else {
          elem.addClass( animation + " visible" );
        }
      }
  });

  // Animate number
  $('.animated-number').appear(function() {
    var elem = $(this);
    var b = elem.text();
    var d = elem.data('duration');
    var animationDelay = elem.data('animation-delay');
    if ( !animationDelay ) { animationDelay = 0; }
    elem.text("0");

    setTimeout(function(){
      elem.animate({ num: b }, {
        duration: d,
        step: function (num){
          this.innerHTML = (num).toFixed(0)
        }
      });
    }, animationDelay);
  });

  /*----------------------------------------------------*/
  // IZOTOPE
  /*----------------------------------------------------*/
  var o = $('#container');
  if (o.length > 0) {
    var $container = o;

    $container.isotope({
        itemSelector: '.element',
        // layoutMode: 'masonry',
        masonry: {
          columnWidth: '.grid-sizer',
          gutter: '.gutter-sizer'
        },
        percentPosition: true,
        transitionDuration: '0.8s'
    });

    // layout Isotope after each image loads
    $container.imagesLoaded().progress( function() {
      $container.isotope('layout');
    });

    refreshIsotope();

    var $optionSets = $('#options .option-set'),
        $optionLinks = $optionSets.find('a');

    $optionLinks.click(function(){
      var $this = $(this);
      // don't proceed if already selected
      if ( $this.hasClass('selected') ) {
        return false;
      }
      var $optionSet = $this.parents('.option-set');
      $optionSet.find('.selected').removeClass('selected');
      $this.addClass('selected');

      // make option object dynamically, i.e. { filter: '.my-filter-class' }
      var options = {},
          key = $optionSet.attr('data-option-key'),
          value = $this.attr('data-option-value');
      // parse 'false' as false boolean
      value = value === 'false' ? false : value;
      options[ key ] = value;
      if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
        // changes in layout modes need extra logic
        changeLayoutMode( $this, options )
      } else {
        // otherwise, apply new options
        $container.isotope( options );
      }

      return false;
    });

    function refreshIsotope() {
      $container.isotope('layout');
    }
  }







});

/////////////////////// load
$(window).load(function() {



    /*----------------------------------------------------*/
    // LOAD
    /*----------------------------------------------------*/
    //$('#load').fadeOut(2000).remove();
    $("#load").fadeOut( 200, function() {
        $(this).remove();
    });






});