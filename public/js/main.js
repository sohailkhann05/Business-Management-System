(function ($) {
    "use strict";
   
    
    new WOW().init();  

    /*--
        Menu Sticky
    -----------------------------------*/
    var windows = $(window);
    var sticky = $('.header-sticky');

    windows.on('scroll', function() {
        var scroll = windows.scrollTop();
        if (scroll < 300) {
            sticky.removeClass('is-sticky');
        }else{
            sticky.addClass('is-sticky');
        }
    });

    /*--
        Header Search 
    -----------------------------------*/
    var $headerSearchToggle = $('.header-search-toggle');
    var $headerSearchForm = $('.header-search-form');

    $headerSearchToggle.on('click', function() {
        var $this = $(this);
        if(!$this.hasClass('open')) {
            $this.addClass('open').find('i').removeClass('ti-search').addClass('ti-close');
            $headerSearchForm.slideDown();
        } else {
            $this.removeClass('open').find('i').removeClass('ti-close').addClass('ti-search');
            $headerSearchForm.slideUp();
        }
    });

    /*-----
    jQuery MeanMenu
    ------------------------------ */
    $('.mobile-menu nav').meanmenu({
        meanScreenWidth: "9901",
        meanMenuContainer: ".mobile-menu",
        onePage: true,
    });
    

    /* slider activation */
    $('.slider_area').owlCarousel({
        animateOut: 'fadeOut',
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        dots:true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    });
    
    
    
    /* bestseller colimn3 activation */
    $('.bestseller_column3').slick({
        centerMode: true,
        centerPadding: '0',
        slidesToShow: 3,
        arrows:true,
        prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',
        nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',
        vertical: true,

    });
    
    /* bestseller column2 activation */
    $('.bestseller_column2').slick({
        centerMode: true,
        centerPadding: '0',
        slidesToShow: 2,
        arrows:true,
        prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',
        nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',
        vertical: true,

    });
    
    /* bestseller column2 activation */
    $('.bestseller_row2').slick({
        centerMode: true,
        centerPadding: '0',
        slidesToShow: 2,
        arrows:true,
        prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',
        nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',
        rows: 3,
        responsive:[
            {
              breakpoint: 768,
              settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
              }
            },
         
        ]

    });
    
     /* bestseller column2 activation */
    $('.product_row4').slick({
        centerMode: true,
        centerPadding: '0',
        slidesToShow: 4,
        arrows:true,
        rows: 2,
        prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',
        nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>', 
        responsive:[
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                  slidesToScroll: 1,
              }
            },
            {
              breakpoint: 768,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 3,
                  slidesToScroll: 3,
              }
            },
            {
              breakpoint: 1920,
              settings: {
                slidesToShow: 4,
                  slidesToScroll: 4,
              }
            },
        ]
    });
    
    
    
     /* deals product activation */
    $('.deals_product_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        dots:true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    });
    
    
    /* product_column4 activation */
    $('.product_column4').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 4,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            576:{
				items:2,
			},
            992:{
				items:3,
			},
            1200:{
				items:4,
			},
		  
        }
    });
    
    
    /* blog activation */
    $('.blog_column2').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 2,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
            0:{
				items:1,
			},
            768:{
				items:1,
			},
            992:{
				items:2,
			},
		  
        }
    });
    
    
    
    
    /* brand column3 activation */
    $('.brand_column3').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
            0:{
				items:1,
			},
            576:{
				items:2,
			},
            992:{
				items:3,
			},
		  
        }
    });

    
    /* testimonial area activation */
    $('.testimonial_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    });
    
    
    
    
      /* single product activation */
    $('.single-product-active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            320:{
				items:2,
			},
            992:{
				items:2,
			},
            1200:{
				items:3,
			},


		  }
    });
    
    
    
    /* blog active activation */
    $('.blog_thumb_active').owlCarousel({
        autoplay: true,
		loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 1,
        dots:false,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    });
    
    
    
    
     
       /* product navactive activation */
    $('.product_navactive').owlCarousel({
        autoplay: true,
		loop: true,
        nav: false,
        autoplay: false,
        autoplayTimeout: 8000,
        items: 3,
        dots:true,
        responsiveClass:true,
		responsive:{
				0:{
				items:1,
			},
            250:{
				items:2,
			},
            480:{
				items:3,
			},
		  
        }
    });

    $('.modal').on('shown.bs.modal', function (e) {
        $('.product_navactive').resize();
    })

    $('.product_navactive a').on('click',function(e){
      e.preventDefault();

      var $href = $(this).attr('href');

      $('.product_navactive a').removeClass('active');
      $(this).addClass('active');

      $('.product-details-large .tab-pane').removeClass('active show');
      $('.product-details-large '+ $href ).addClass('active show');

    })
    
    
    
    /*--
        Magnific Popup
    ------------------------*/
    $('.img-popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    // Magnific Popup Video
    $('.video_popup').magnificPopup({
        type: 'iframe',
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });

    // Magnific Popup Video
    $('.port_popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
    
    /*--
        Nice Select
    ------------------------- */	
    $('.nice-select').niceSelect(); 

     /*--
    Accordion
    -------------------------*/
    $(".faequently-accordion").collapse({
        accordion:true,
        open: function() {
        this.slideDown(300);
      },
      close: function() {
        this.slideUp(300);
      }		
    });	  

    /* --
        counterUp 
    -----------------------------*/
    $('.counter-active').counterUp({
        delay: 10,
        time: 1000
    });

    /*--
        ScrollUp Active
    -----------------------------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-double-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });   
    

 
    
      /*------addClass/removeClass -------*/
    $(".language > a,.categorie_toggle,.shipping_cart > a").on("click", function() {
        $(this).removeAttr('href');
        $(this).toggleClass('open').next('.dropdown_language,.dropdown_categorie,.mini_cart').toggleClass('open');
        $(this).parents().siblings().find('.dropdown_language,.dropdown_categorie,.mini_cart').removeClass('open');
    });
    
    
     /*------addClass/removeClass categories-------*/
   $(".categories_menu_inner > ul > li > a, #cat_toggle.has-sub > a").on("click", function() {
        $(this).removeAttr('href');
        $(this).toggleClass('open').next('.categories_mega_menu,.categorie_sub').toggleClass('open');
        $(this).parents().siblings().find('.categories_mega_menu,.categorie_sub').removeClass('open');
    });
    

    $('body').on('click', function (e) {
        var target = e.target;
        if (!$(target).is('.language > a') ) {
            $('.dropdown_language').removeClass('open');
        }
    });
    
    
    
    
    
     /*categories slideToggle*/
    $(".categories_title").on("click", function() {
        $(this).toggleClass('active');
        $('.categories_menu_inner').slideToggle('medium');
    }); 
    
    
    
     /*countdown activation*/
		
	 $('[data-countdown]').each(function() {
		var $this = $(this), finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function(event) {
		$this.html(event.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hrs</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'));     
               
       });
	});	
    

    
    /*----------------------------
    	slider-range here
    ------------------------------ */
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 0, 500 ],
        slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
       }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
       " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    

    /*niceSelect*/
     $('.niceselect_option').niceSelect();
    
    
     //tooltip
   $('[data-toggle="tooltip"]').tooltip()
    
    
     /*-------------------------------------------
    elevateZoom
    -------------------------------------------- */	
    $("#zoom1").elevateZoom({
        gallery:'gallery_01', 
        responsive : true,
        cursor: 'crosshair',
        zoomType : 'inner'
    
    });  
    
    
    
    /*portfolio Isotope activation*/
      $('.portfolio_gallery').imagesLoaded( function() {
        // init Isotope
        var $grid = $('.portfolio_gallery').isotope({
           itemSelector: '.gird_item',
            percentPosition: true,
            masonry: {
                columnWidth: '.gird_item'
            }
        });
            
        // filter items on button click
        $('.portfolio_button').on( 'click', 'button', function() {
           var filterValue = $(this).attr('data-filter');
           $grid.isotope({ filter: filterValue });
            
           $(this).siblings('.active').removeClass('active');
           $(this).addClass('active');
        });
       
    });
    
    
    
     // Newsletter Popup
    
    function newsLetterPopup(){
        $('.newsletter_popup').css({"opacity": "1", "visibility": "visible"});
        $('.popup_close').on('click', function(){
          $(".newsletter_popup").fadeOut(200);
        })    
    }
    newsLetterPopup();
    
    
    
})(jQuery);	
