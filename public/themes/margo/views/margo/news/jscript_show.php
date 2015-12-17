<?php
Theme::asset()->add('style', 'public/themes/margo/assets/css/style.css');
Theme::asset()->add('dataTables-bootstrap', 'public/themes/margo/assets/plugins/datatables/dataTables.bootstrap.css');
//Theme::asset()->add('animate', 'public/themes/demo/adminlte2_demo/bootstrap/css/bootstrap.min.css');
Theme::asset()->add('recaptcha', 'https://www.google.com/recaptcha/api.js');
Theme::asset()->add('validate', 'public/themes/margo/assets/plugins/jQuery/jquery.validate.min.js');
?>

<script type="text/javascript">
/* ----------------- Start JS Document ----------------- */

<?php $id = array_get($news, 'id', '');?>
var $ = jQuery.noConflict();
var likes_news_<?php echo $id;?> = '';

// Page Loader
$(window).load(function () {
    "use strict";
	$('#loader').fadeOut();

	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": true,
	  "positionClass": "toast-bottom-center",
	  "preventDuplicates": true,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	<?php checkAlertMessageFlash();?>

	$.ajax({
		type: "GET",
		url: "<?php echo URL::to('news/update/stat');?>",
		data: "type=views&id=<?php echo $id;?>&action=1",
		dataType: "json",
		success: function(data) {
			console.log(data);
			//var obj = jQuery.parseJSON(data);
			//if the dataType is not specified as json uncomment this
			// do what ever you want with the server response
			if(data.status_code=='0')
			{
				likes_news_<?php echo $id;?> = data.cookies;
				updateStat(data);
				console.log(data.data);
			}else{
				console.log(data);
			}
		},
		error: function(data){
			console.log(data);
		}
	});

<?php 	if (isset($_COOKIE['likes_news_'.$id])) :
			if ($_COOKIE['likes_news_'.$id] == 'likes') : ?>
				$(".disp_likes").css( "color", "#428bca" );
				$("#btn_likes i").css( "color", "#428bca" );
				$("#btn_likes i").attr( "class", "fa fa-thumbs-up");

				$("#btn_likes").addClass("active");
				//$("#btn_likes").addClass("disabled");
				// $("#btn_unlikes").removeClass("disabled");
<?php		elseif ($_COOKIE['likes_news_'.$id] == 'unlikes') : ?>
				$(".btn_unlikes").css( "color", "#428bca" );
				$("#btn_unlikes i").css( "color", "#428bca" );
				$("#btn_unlikes i").attr( "class", "fa fa-thumbs-down");

				$("#btn_unlikes").addClass("active");
				// $("#btn_likes").removeClass("disabled");
				//$("#btn_unlikes").addClass("disabled");
<?php 		endif;
		endif; ?>
});

$(document).ready(function ($) {
	"use strict";
	
	/*----------------------------------------------------*/
	/*	Hidder Header
	/*----------------------------------------------------*/
	var headerEle = function(){
		var $headerHeight = $('header').height();
		$('.hidden-header').css({ 'height' : $headerHeight  + "px" });
	};
	
	$(window).load(function () {
	  headerEle();
	});
	
	$(window).resize(function () {
	   headerEle();
	});
	
	$("#frm_main").validate({
		ignore: [],
		errorElement: 'span',
		errorClass: 'text-red',
		focusInvalid: true,
		rules: {
			name: "required",
			email: "required",
			message: "required",
			"g-recaptcha-response": "required"
		},
		messages: {
			name: "This field is required",
			email: "This field is required",
			message: "This field is required",
			"g-recaptcha-response": "This field is required"
		}
	});

	/*$("#btn_likes").click(function() {
		$("#btn_likes").addClass("disabled");

		if (likes_news_<?php echo $id;?> == 'likes') {
			var param_likes = "type=likes&id=<?php echo $id;?>&action=3";
		} else if (likes_news_<?php echo $id;?> == 'unlikes') {
			var param_likes = "type=likes&id=<?php echo $id;?>&action=3";
		} else {
			var param_likes = "type=likes&id=<?php echo $id;?>&action=1";
		}

		$.ajax({
			type: "GET",
			url: "<?php echo URL::to('news/update/stat');?>",
			data: param_likes,
			dataType: "json",
			success: function(data) {
				console.log(data);
				//var obj = jQuery.parseJSON(data);
				//if the dataType is not specified as json uncomment this
				// do what ever you want with the server response
				if(data.status_code=='0')
				{
					likes_news_<?php echo $id;?> = 'likes';
					$("#btn_likes").addClass("disabled");
					$("#btn_unlikes").removeClass("disabled");
					updateStat(data);
					console.log(data.data);
				}else{
					console.log(data);
				}
			},
			error: function(data){
				console.log(data);
			}
		});
	});*/
	$("#btn_likes").click(function() {
		$("#btn_likes").addClass("disabled");

		if (likes_news_<?php echo $id;?> == 'likes') {
			var param_likes = "type=likes&id=<?php echo $id;?>&action=2";
		} else if (likes_news_<?php echo $id;?> == 'unlikes') {
			var param_likes = "type=likes&id=<?php echo $id;?>&action=3";
		} else {
			var param_likes = "type=likes&id=<?php echo $id;?>&action=1";
		}

		$.ajax({
			type: "GET",
			url: "<?php echo URL::to('news/update/stat');?>",
			data: param_likes,
			dataType: "json",
			success: function(data) {
				console.log(data);
				//var obj = jQuery.parseJSON(data);
				//if the dataType is not specified as json uncomment this
				// do what ever you want with the server response
				if(data.status_code=='0')
				{

					if (likes_news_<?php echo $id;?> == 'likes') {
						likes_news_<?php echo $id;?> = '';
						$(".disp_likes").css( "color", "" );
						$("#btn_likes i").css( "color", "" );
						$("#btn_likes i").attr( "class", "fa fa-thumbs-o-up");
						$("#btn_likes").removeClass("active");
					} else if (likes_news_<?php echo $id;?> == 'unlikes') {
						likes_news_<?php echo $id;?> = 'likes';
						$(".disp_likes").css( "color", "#428bca" );
						$("#btn_likes i").css( "color", "#428bca" );
						$("#btn_likes i").attr( "class", "fa fa-thumbs-up");
						$("#btn_likes").addClass("active");

						$(".disp_unlikes").css( "color", "" );
						$("#btn_unlikes i").css( "color", "" );
						$("#btn_unlikes i").attr( "class", "fa fa-thumbs-o-up");
						$("#btn_unlikes").removeClass("active");
					} else {
						likes_news_<?php echo $id;?> = 'likes';
						$(".disp_likes").css( "color", "#428bca" );
						$("#btn_likes i").css( "color", "#428bca" );
						$("#btn_likes i").attr( "class", "fa fa-thumbs-up");
						$("#btn_likes").addClass("active");
					}

					updateStat(data);
					console.log(data.data);
				}else{
					console.log(data);
				}
				$("#btn_likes").removeClass("disabled");
			},
			error: function(data){
				$("#btn_likes").removeClass("disabled");
				console.log(data);
			}
		});
		
	});

	$("#btn_unlikes").click(function() {
		$("#btn_unlikes").addClass("disabled");

		if (likes_news_<?php echo $id;?> == 'likes') {
			var param_likes = "type=unlikes&id=<?php echo $id;?>&action=3";
		} else if (likes_news_<?php echo $id;?> == 'unlikes') {
			var param_likes = "type=unlikes&id=<?php echo $id;?>&action=2";
		} else {
			var param_likes = "type=unlikes&id=<?php echo $id;?>&action=1";
		}

		$.ajax({
			type: "GET",
			url: "<?php echo URL::to('news/update/stat');?>",
			data: param_likes,
			dataType: "json",
			success: function(data) {
				console.log(data);
				//var obj = jQuery.parseJSON(data);
				//if the dataType is not specified as json uncomment this
				// do what ever you want with the server response
				if(data.status_code=='0')
				{

					if (likes_news_<?php echo $id;?> == 'unlikes') {
						likes_news_<?php echo $id;?> = '';
						$(".disp_unlikes").css( "color", "" );
						$("#btn_unlikes i").css( "color", "" );
						$("#btn_unlikes i").attr( "class", "fa fa-thumbs-o-up");
						$("#btn_unlikes").removeClass("active");
					} else if (likes_news_<?php echo $id;?> == 'likes') {
						likes_news_<?php echo $id;?> = 'unlikes';
						$(".disp_unlikes").css( "color", "#428bca" );
						$("#btn_unlikes i").css( "color", "#428bca" );
						$("#btn_unlikes i").attr( "class", "fa fa-thumbs-up");
						$("#btn_unlikes").addClass("active");

						$(".disp_likes").css( "color", "" );
						$("#btn_likes i").css( "color", "" );
						$("#btn_likes i").attr( "class", "fa fa-thumbs-o-up");
						$("#btn_likes").removeClass("active");
					} else {
						likes_news_<?php echo $id;?> = 'unlikes';
						$(".disp_unlikes").css( "color", "#428bca" );
						$("#btn_unlikes i").css( "color", "#428bca" );
						$("#btn_unlikes i").attr( "class", "fa fa-thumbs-up");
						$("#btn_unlikes").addClass("active");
					}
					
					updateStat(data);
					console.log(data.data);
				}else{
					console.log(data);
				}
				$("#btn_unlikes").removeClass("disabled");
			},
			error: function(data){
				$("#btn_unlikes").removeClass("disabled");
				console.log(data);
			}
		});
	});
	
    /*---------------------------------------------------*/
    /* Progress Bar
    /*---------------------------------------------------*/  
    $('.skill-shortcode').appear(function() {
  		$('.progress').each(function(){ 
    		$('.progress-bar').css('width',  function(){ return ($(this).attr('data-percentage')+'%')});
  		});
	},{accY: -100});

    /*--------------------------------------------------*/
    /* Counter
    /*--------------------------------------------------*/

    $('.timer').countTo();

    $('.counter-item').appear(function() {
        $('.timer').countTo();
    },{accY: -100});
    
	/*----------------------------------------------------*/
	/*	Nice-Scroll
	/*----------------------------------------------------*/
	$("html").niceScroll({
		scrollspeed: 100,
		mousescrollstep: 38,
		cursorwidth: 5,
		cursorborder: 0,
		cursorcolor: '#333',
		autohidemode: true,
		zindex: 999999999,
		horizrailenabled: false,
		cursorborderradius: 0,
	});
		
	/*----------------------------------------------------*/
	/*	Nav Menu & Search
	/*----------------------------------------------------*/
	$(".nav > li:has(ul)").addClass("drop");
	$(".nav > li.drop > ul").addClass("dropdown");
	$(".nav > li.drop > ul.dropdown ul").addClass("sup-dropdown");
	
	$('.show-search').click(function() {
		$('.search-form').fadeIn(300);
		$('.search-form input').focus();
	});
	$('.search-form input').blur(function() {
		$('.search-form').fadeOut(300);
	});
	
	/*----------------------------------------------------*/
	/*	Back Top Link
	/*----------------------------------------------------*/
    var offset = 200;
    var duration = 500;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(400);
        } else {
            $('.back-to-top').fadeOut(400);
        }
    });
    $('.back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 600);
        return false;
    })

	/*----------------------------------------------------*/
	/*	Sliders & Carousel
	/*----------------------------------------------------*/
	////------- Touch Slider
	var time = 4.4,
		$progressBar,
		$bar,
		$elem,
		isPause,
		tick,
		percentTime;
	$('.touch-slider').each(function(){
		var owl = jQuery(this),
			sliderNav = $(this).attr('data-slider-navigation'),
			sliderPag = $(this).attr('data-slider-pagination'),
			sliderProgressBar = $(this).attr('data-slider-progress-bar');
			
		if ( sliderNav == 'false' || sliderNav == '0' ) {
			var returnSliderNav = false
		}else {
			var returnSliderNav = true
		}
		
		if ( sliderPag == 'true' || sliderPag == '1' ) {
			var returnSliderPag = true
		}else {
			var returnSliderPag = false
		}
		
		if ( sliderProgressBar == 'true' || sliderProgressBar == '1' ) {
			var returnSliderProgressBar = progressBar
			var returnAutoPlay = false
		}else {
			var returnSliderProgressBar = false
			var returnAutoPlay = true
		}
		
		owl.owlCarousel({
			navigation : returnSliderNav,
			pagination: returnSliderPag,
			slideSpeed : 400,
			paginationSpeed : 400,
			lazyLoad : true,
			singleItem: true,
			autoHeight : false,
			autoPlay: returnAutoPlay,
			stopOnHover: returnAutoPlay,
			transitionStyle : "fade",
			afterInit : returnSliderProgressBar,
			afterMove : moved,
			startDragging : pauseOnDragging
		});
		
	});

    function progressBar(elem){
		$elem = elem;
		buildProgressBar();
		start();
    }
	
    function buildProgressBar(){
		$progressBar = $("<div>",{
			id:"progressBar"
		});
		$bar = $("<div>",{
			id:"bar"
		});
		$progressBar.append($bar).prependTo($elem);
    }
	
	function start() {
		percentTime = 0;
		isPause = false;
		tick = setInterval(interval, 10);
    };
 
    function interval() {
		if(isPause === false){
			percentTime += 1 / time;
			// $bar.css({
			// 	width: percentTime+"%"
			// });
			// if(percentTime >= 100){
			// 	$elem.trigger('owl.next')
			// }
		}
    }
	
    function pauseOnDragging(){
      isPause = true;
    }
	
    function moved(){
      clearTimeout(tick);
      start();
    }

	////------- Projects Carousel
	$(".projects-carousel").owlCarousel({
		navigation : true,
		pagination: false,
		slideSpeed : 400,
		stopOnHover: true,
    	autoPlay: 3000,
    	items : 4,
    	itemsDesktopSmall : [900,3],
		itemsTablet: [600,2],
		itemsMobile : [479, 1]
	});

	////------- Testimonials Carousel
	$(".testimonials-carousel").owlCarousel({
		navigation : true,
		pagination: false,
		slideSpeed : 2500,
		stopOnHover: true,
    	autoPlay: 3000,
    	singleItem:true,
		autoHeight : true,
		transitionStyle : "fade"
	});

	////------- Custom Carousel
	$('.custom-carousel').each(function(){
		var owl = jQuery(this),
			itemsNum = $(this).attr('data-appeared-items'),
			sliderNavigation = $(this).attr('data-navigation');
			
		if ( sliderNavigation == 'false' || sliderNavigation == '0' ) {
			var returnSliderNavigation = false
		}else {
			var returnSliderNavigation = true
		}
		if( itemsNum == 1) {
			var deskitemsNum = 1;
			var desksmallitemsNum = 1;
			var tabletitemsNum = 1;
		} 
		else if (itemsNum >= 2 && itemsNum < 4) {
			var deskitemsNum = itemsNum;
			var desksmallitemsNum = itemsNum - 1;
			var tabletitemsNum = itemsNum - 1;
		} 
		else if (itemsNum >= 4 && itemsNum < 8) {
			var deskitemsNum = itemsNum -1;
			var desksmallitemsNum = itemsNum - 2;
			var tabletitemsNum = itemsNum - 3;
		} 
		else {
			var deskitemsNum = itemsNum -3;
			var desksmallitemsNum = itemsNum - 6;
			var tabletitemsNum = itemsNum - 8;
		}
		owl.owlCarousel({
			slideSpeed : 300,
			stopOnHover: true,
			autoPlay: false,
			navigation : returnSliderNavigation,
			pagination: false,
			lazyLoad : true,
			items : itemsNum,
			itemsDesktop : [1000,deskitemsNum],
			itemsDesktopSmall : [900,desksmallitemsNum],
			itemsTablet: [600,tabletitemsNum],
			itemsMobile : false,
			transitionStyle : "goDown",
		});
	});
 
    ////------- Testimonials Carousel
	$(".fullwidth-projects-carousel").owlCarousel({
		navigation : false,
		pagination: false,
		slideSpeed : 400,
		stopOnHover: true,
    	autoPlay: 3000,
    	items : 5,
    	itemsDesktopSmall : [900,3],
		itemsTablet: [600,2],
		itemsMobile : [479, 1]
	});

	/*----------------------------------------------------*/
	/*	Tabs
	/*----------------------------------------------------*/
	$('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	})

	/*----------------------------------------------------*/
	/*	Css3 Transition
	/*----------------------------------------------------*/
	$('*').each(function(){
		if($(this).attr('data-animation')) {
			var $animationName = $(this).attr('data-animation'),
				$animationDelay = "delay-"+$(this).attr('data-animation-delay');
			$(this).appear(function() {
				$(this).addClass('animated').addClass($animationName);
				$(this).addClass('animated').addClass($animationDelay);
			});
		}
	});

	/*----------------------------------------------------*/
	/*	Pie Charts
	/*----------------------------------------------------*/
	var pieChartClass = 'pieChart',
        pieChartLoadedClass = 'pie-chart-loaded';
		
	function initPieCharts() {
		var chart = $('.' + pieChartClass);
		chart.each(function() {
			$(this).appear(function() {
				var $this = $(this),
					chartBarColor = ($this.data('bar-color')) ? $this.data('bar-color') : "#F54F36",
					chartBarWidth = ($this.data('bar-width')) ? ($this.data('bar-width')) : 150
				if( !$this.hasClass(pieChartLoadedClass) ) {
					$this.easyPieChart({
						animate: 2000,
						size: chartBarWidth,
						lineWidth: 2,
						scaleColor: false,
						trackColor: "#eee",
						barColor: chartBarColor,
					}).addClass(pieChartLoadedClass);
				}
			});
		});
	}
	initPieCharts();

	/*----------------------------------------------------*/
	/*	Animation Progress Bars
	/*----------------------------------------------------*/
	$("[data-progress-animation]").each(function() {
		
		var $this = $(this);
		
		$this.appear(function() {
			
			var delay = ($this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1);
			
			if(delay > 1) $this.css("animation-delay", delay + "ms");
			
			setTimeout(function() { $this.animate({width: $this.attr("data-progress-animation")}, 800);}, delay);

		}, {accX: 0, accY: -50});

	});

	/*----------------------------------------------------*/
	/*	Milestone Counter
	/*----------------------------------------------------*/
	jQuery('.milestone-block').each(function() {
		jQuery(this).appear(function() {
			var $endNum = parseInt(jQuery(this).find('.milestone-number').text());
			jQuery(this).find('.milestone-number').countTo({
				from: 0,
				to: $endNum,
				speed: 4000,
				refreshInterval: 60,
			});
		},{accX: 0, accY: 0});
	});

	/*----------------------------------------------------*/
	/*	Nivo Lightbox
	/*----------------------------------------------------*/
	$('.lightbox').nivoLightbox({
		effect: 'fadeScale',
		keyboardNav: true,
		errorMessage: 'The requested content cannot be loaded. Please try again later.'
	});

	/*----------------------------------------------------*/
	/*	Change Slider Nav Icons
	/*----------------------------------------------------*/
	$('.touch-slider').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
	$('.touch-slider').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
	$('.touch-carousel, .testimonials-carousel').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
	$('.touch-carousel, .testimonials-carousel').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
	$('.read-more').append('<i class="fa fa-angle-right"></i>');

	/*----------------------------------------------------*/
	/*	Tooltips & Fit Vids & Parallax & Text Animations
	/*----------------------------------------------------*/
	$("body").fitVids();
	
	$('.itl-tooltip').tooltip();
	
	$('.bg-parallax').each(function() {
		$(this).parallax("30%", 0.2);
	});
	
	$('.tlt').textillate({
		loop: true,
		in: {
			effect: 'fadeInUp',
			delayScale: 2,
			delay: 50,
			sync: false,
			shuffle: false,
			reverse: true,
		},
		out: {
			effect: 'fadeOutUp',
			delayScale: 2,
			delay: 50,
			sync: false,
			shuffle: false,
			reverse: true,
		},
	});

	/*----------------------------------------------------*/
	/*	Sticky Header
	/*----------------------------------------------------*/
	(function() {
		
		var docElem = document.documentElement,
			didScroll = false,
			changeHeaderOn = 100;
			document.querySelector( 'header' );
			
		function init() {
			window.addEventListener( 'scroll', function() {
				if( !didScroll ) {
					didScroll = true;
					setTimeout( scrollPage, 250 );
				}
			}, false );
		}
		
		function scrollPage() {
			var sy = scrollY();
			if ( sy >= changeHeaderOn ) {
				$('.top-bar').slideUp(300);
				$("header").addClass("fixed-header");
				$('.navbar-brand').css({ 'padding-top' : 19 + "px", 'padding-bottom' : 19 + "px" });
				
				if (/iPhone|iPod|BlackBerry/i.test(navigator.userAgent) || $(window).width() < 479 ){
					$('.navbar-default .navbar-nav > li > a').css({ 'padding-top' : 0 + "px", 'padding-bottom' : 0 + "px" })
				}else{
					$('.navbar-default .navbar-nav > li > a').css({ 'padding-top' : 20 + "px", 'padding-bottom' : 20 + "px" })
					$('.search-side').css({ 'margin-top' : -7 + "px" });
				};
				
			}
			else {
				$('.top-bar').slideDown(300);
				$("header").removeClass("fixed-header");
				$('.navbar-brand').css({ 'padding-top' : 27 + "px", 'padding-bottom' : 27 + "px" });
				
				if (/iPhone|iPod|BlackBerry/i.test(navigator.userAgent) || $(window).width() < 479 ){
					$('.navbar-default .navbar-nav > li > a').css({ 'padding-top' : 0 + "px", 'padding-bottom' : 0 + "px" })
				}else{
					$('.navbar-default .navbar-nav > li > a').css({ 'padding-top' : 28 + "px", 'padding-bottom' : 28 + "px" })
					$('.search-side').css({ 'margin-top' : 0  + "px" });
				};
				
			}
			didScroll = false;
		}
		
		function scrollY() {
			return window.pageYOffset || docElem.scrollTop;
		}
		
		init();	
	})();
});

/*----------------------------------------------------*/
/*	Portfolio Isotope
/*----------------------------------------------------*/
jQuery(window).load(function(){
	
	var $container = $('#portfolio');
	$container.isotope({
		layoutMode : 'masonry',
		filter: '*',
		animationOptions: {
			duration: 750,
			easing: 'linear',
			queue: false,
		}
	});

	$('.portfolio-filter ul a').click(function(){
		var selector = $(this).attr('data-filter');
		$container.isotope({
			filter: selector,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false,
			}
		});
	  return false;
	});

	var $optionSets = $('.portfolio-filter ul'),
	    $optionLinks = $optionSets.find('a');
	$optionLinks.click(function(){
		var $this = $(this);
		if ( $this.hasClass('selected') ) { return false; }
		var $optionSet = $this.parents('.portfolio-filter ul');
		$optionSet.find('.selected').removeClass('selected');
		$this.addClass('selected'); 
	});
	
});

function updateStat(data){
	$(".disp_views").html(data.data.views);
	$(".disp_likes").html(data.data.likes);
	$(".disp_unlikes").html(data.data.unlikes);
}
/* ----------------- End JS Document ----------------- */

</script>