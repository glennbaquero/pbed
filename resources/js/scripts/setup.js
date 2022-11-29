export const setup = {
	init() {

		// login show/hide password
		$('.showPass').on('click', function() {
			var x = $(this).siblings('input');

			if (x.attr("type") == "password") {
				x.attr("type", "text");
				$(this).removeClass('fa-eye-slash');
				$(this).addClass('fa-eye');
			} else {
				x.attr("type", "password");
				$(this).addClass('fa-eye-slash');
				$(this).removeClass('fa-eye');
			}
		});

		$('.ythwrk-frm2__btn').on('click', function() {
			$('.ythwrk-frm2__cntnr').slideToggle(400);
		});

		$('.events-modal').on('show.bs.modal', function () {
			$.scrollify.disable();
		});

		$('.events-modal').on('hide.bs.modal', function () {
			// $.scrollify.disable();
		    $.scrollify.enable();
		});


		let closeBtn = $('.user-profile-sidebar-close-btn');
		let sidebar = $('.user-profile-sidebar');
		$('.user-profile-sidebar-btn').on('click', () => {
			sidebar.addClass('active');
			closeBtn.addClass('active');
		});

		closeBtn.on('click', () => {
			sidebar.removeClass('active');
			closeBtn.removeClass('active');
		});

		var mblnav = $('.navbar-toggler');
		mblnav.on('click',function(){
			$('.header__mbl-con').toggleClass("is-show");
			// console.log('ss')
		});


		// 
		// TABBING
		// 

		// SETS ID TO ALL SIDE TAB
		var tabTarNum = 0;
		$('.gen__tabNav li').each( function() {
			tabTarNum++;
			$(this).attr( 'data-tab-target', tabTarNum )
		});

		var tabListNum = 0;
		$('.gen__tabList').each( function() {
			tabListNum++;
			$(this).attr( 'data-tab-list', tabListNum )
		});

		// // Initialize tabbing
		$(".gen__tabList:first-child").fadeOut(200);

		// Tabbing on click
		$(".gen__tabNav li").click(function () {
			var tab_target = $(this).data("tab-target");
			if ($(this).hasClass("active")) {
				selectTab(this);
			} else {
				// Resets tabs
				$(".gen__tabNav li").removeClass("active");
				setTimeout(function () {
					$(".gen__tabList").fadeOut(200);
				}, 300);

				selectTab(this, tab_target);
			}
		});

		// Select tab
		function selectTab(e, tab_target) {
			$(e).addClass("active");
			setTimeout(function () {
				$(".gen__tabCon *[data-tab-list='" + tab_target + "']").fadeIn(300);
				$('.gen__tabList > div ').slick("setPosition", 0);
			}, 500);
		}


		// //////////////////////
		// Home
		// //////////////////////

		var width = $(window).width();
		if (width <= 1140) {
			$.scrollify.destroy();
  			$.scrollify.disable();
		} else {
			var $window = $(window);
			$window.scroll(function () {
				if ($window.scrollTop() > 70) {
					$('.header__con').removeClass('changeHeader');
				} else {
					$('.header__con').addClass('changeHeader');
				}
			});
    		$.scrollify.enable();
		}

		// scrollify
		$(function() {
			$.scrollify({
			    section: ".full--scroll",
			    interstitialSection : ".frm-body__hm .scrllfy-ftr-frame",
				sectionName: false,
				scrollSpeed: 1000,
				offset: 0,
				scrollbars: false,
				standardScrollElements: "",
				overflowScroll: false,
				updateHash: true,
				touchScroll: true,
				before:function(i,panels) {

					var ref = panels[i].attr("data-section-name");

					$(".hm-pagination .active").removeClass("active");

					$(".hm-pagination").find("a[href=\"#" + ref + "\"]").parent().addClass("active");
				},
				afterRender:function() {
					var pagination = "<ul class=\"hm-pagination\">";
					var activeClass = "";
					$(".full--scroll").each(function(i) {
						activeClass = "";
						if(i===0) {
							activeClass = "active";
						}
						pagination += "<li class=\"" + activeClass + " side-navLink" + "\"><a href=\"#" + $(this).attr("data-section-name") + "\"><div class=\"" + "side-bulletCon" + "\"></div><span>" + $(this).attr("data-section-name").charAt(0).toUpperCase() + $(this).attr("data-section-name").slice(1) + "</span></a></li>";
					});

					pagination += "</ul>";

					$(".nav-side").append(pagination);
					$(".hm-pagination a").on("click",$.scrollify.move);
				}
			});
		});

		// SCROLL MAGIC
		// init controller
		var controller = new ScrollMagic.Controller({globalSceneOptions: {duration: 300, offset: 100}});

		// build scenes
		new ScrollMagic.Scene({triggerElement: ".hm-fr1"})
			.setClassToggle(".nav-side", "invert")
			// .addIndicators()
			.addTo(controller);
		new ScrollMagic.Scene({triggerElement: ".hm-fr3"})
			.setClassToggle(".nav-side", "invert")
			// .addIndicators()
			.addTo(controller);
		new ScrollMagic.Scene({triggerElement: ".hm-fr5"})
			.setClassToggle(".nav-side", "invert")
			// .addIndicators()
			.addTo(controller);
		new ScrollMagic.Scene({triggerElement: ".hm-fr8"})
			.setClassToggle(".nav-side", "invert")
			// .addIndicators()
			.addTo(controller);
		new ScrollMagic.Scene({triggerElement: ".hm-fr10"})
			.setClassToggle(".nav-side", "invert")
			// .addIndicators()
			.addTo(controller);


		$(".frm__sliderCon").slick({
			infinite: true,
			arrows: false,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: true,
		});

		// SETS ID TO ALL SIDE TAB
		var numDetails = 0;
		$('.frm-slider-bullets .item span').each( function() {
			numDetails++;
			$(this).attr( 'data-slick-index', numDetails - 1 )
		});

		//ticking machine
		var percentTime;
		var tick;
		var time = .1;
		var progressBarIndex = 0;

		$('.progressBarContainer .progressBar').each(function(index) {
			var progress = "<div class='inProgress inProgress" + index + "'></div>";
			$(this).html(progress);
		});

		function startProgressbar() {
			resetProgressbar();
			percentTime = 0;
			tick = setInterval(interval, 10);
		}

		function interval() {
			if (($('.frm__sliderCon .slick-track div[data-slick-index="' + progressBarIndex + '"]').attr("aria-hidden")) === "true") {
				progressBarIndex = $('.frm__sliderCon .slick-track div[aria-hidden="false"]').data("slickIndex");
				startProgressbar();
			} else {
				percentTime += 1 / (time + 5);
				$('.inProgress' + progressBarIndex).css({
					width: percentTime + "%"
				});
				if (percentTime >= 100) {
					$('.frm__sliderCon').slick('slickNext');
					progressBarIndex++;
					if (progressBarIndex > 2) {
						progressBarIndex = 0;
					}
					startProgressbar();
				}
			}
		}

		function resetProgressbar() {
			$('.inProgress').css({
				width: 0 + '%'
			});
			clearInterval(tick);
		}
		startProgressbar();
		// End ticking machine

		var numDetails = 0;
		$('.frm-slider-bullets .item span').each( function() {
			numDetails++;
			$(this).attr( 'data-slick-index', numDetails - 1 )
		});

		$('.item').click(function () {
			clearInterval(tick);
			var goToThisIndex = $(this).find("span").data("slickIndex");
			$('.frm__sliderCon').slick('slickGoTo', goToThisIndex, false);
			startProgressbar();
		});


		$(".hmfr2__sliderCon").slick({
			infinite: true,
			arrows: true,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true,
			asNavFor: '.hmfr2__sliderThumbCon',
			responsive: [
	        {
	          	breakpoint: 1141,
	          	settings: {
					adaptiveHeight: false,
	          	}
	        }]
		});

		$(".hmfr2__sliderThumbCon").slick({
			infinite: true,
			arrows: false,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			asNavFor: '.hmfr2__sliderCon'
		});

		$('.hmfr2__sliderCon .slick-prev').addClass('cstm__cardArrow').html('<div class="cstm-slick-prev"></div>');
		$('.hmfr2__sliderCon .slick-next').addClass('cstm__cardArrow').html('<div class="cstm-slick-next"></div>');

		$(".hmfr2__innerCard .cstm__cardArrowCon").appendTo(".hmfr2__sliderCon");
		$(".hmfr2__sliderCon .slick-prev").appendTo(".cstm__cardArrowCon");
		$(".hmfr2__sliderCon .slick-next").appendTo(".cstm__cardArrowCon");

		$(".hmfr4__sliderCon").slick({
			infinite: true,
			arrows: true,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			asNavFor: '.hmfr4__sliderThumbCon',
		});

		$(".hmfr4__sliderThumbCon").slick({
			infinite: true,
			arrows: false,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			asNavFor: '.hmfr4__sliderCon'
		});

		$('.hmfr4__sliderCon .slick-prev').addClass('cstm__cardArrow').html('<div class="cstm-slick-prev"></div>');
		$('.hmfr4__sliderCon .slick-next').addClass('cstm__cardArrow').html('<div class="cstm-slick-next"></div>');

		$(".hmfr4__innerCard .cstm__cardArrowCon4").appendTo(".hmfr4__sliderCon");
		$(".hmfr4__sliderCon .slick-prev").appendTo(".cstm__cardArrowCon4");
		$(".hmfr4__sliderCon .slick-next").appendTo(".cstm__cardArrowCon4");

		$(".hmfr5__sliderCon").slick({
			infinite: true,
			arrows: false,
			dots: true,
			autoplay: false,
			speed: 800,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [
	        {
	          	breakpoint: 769,
	          	settings: {
					slidesToShow: 2,
	          	}
	        },
	        {
	          	breakpoint: 569,
	          	settings: {
					slidesToShow: 1,
	          	}   
	        }]
		});

		$(".hmfr8__sliderCon").slick({
			infinite: true,
			arrows: true,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			centerMode: true,
		});
		
		$(".hmfr8__sliderCon2").slick({
			infinite: true,
			arrows: true,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			centerMode: true
		});

		$('.click-here').on('click', function(e) {
			// console.log("asas");
			$('.hmfr8__sliderCon').slick("refresh");
			$('.hmfr8__sliderCon2').slick("refresh");
		});

		// $('.hmfr8__sliderCon2 .slick-prev').addClass('cstm__cardArrow').html('<div class="cstm-slick-prev"></div>');
		// $('.hmfr8__sliderCon2 .slick-next').addClass('cstm__cardArrow').html('<div class="cstm-slick-next"></div>');

		// $(".hmfr4__innerCard .cstm__cardArrowCon8").appendTo(".hmfr8__sliderCon2");
		// $(".hmfr8__sliderCon2 .slick-prev").appendTo(".cstm__cardArrowCon8");
		// $(".hmfr8__sliderCon2 .slick-next").appendTo(".cstm__cardArrowCon8");

		$(".hmfr9__sliderCon").slick({
			infinite: true,
			arrows: true,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 2,
			slidesToScroll: 1,
			responsive: [
	        {
	          	breakpoint: 769,
	          	settings: {
					slidesToShow: 2,
	          	}   
	        },
	        {
	          	breakpoint: 569,
	          	settings: {
					slidesToShow: 1,
	          	}   
	        }]
		});

		// Areas of work
		$(".aow-frm6__slider").slick({
			infinite: true,
			arrows: false,
			dots: true,
			autoplay: false,
			speed: 800,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [
	        {
	          	breakpoint: 569,
	          	settings: {
					slidesToShow: 1,
	          	}   
	        }]
		});

		// organization
		$(".org-frm2__slider").slick({
			infinite: true,
			arrows: true,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 5,
			slidesToScroll: 1,
			variableWidth: true,
		});

		$('.org-frm2__slider .slick-prev').addClass('cstm__cardArrow').html('<div class="cstm-slick-prev"></div>');
		$('.org-frm2__slider .slick-next').addClass('cstm__cardArrow').html('<div class="cstm-slick-next"></div>');

		$(".org-frm2__sub-cntnr .cstm__cardArrowConOrg").appendTo(".org-frm2__slider")
		$(".org-frm2__slider .slick-prev").appendTo(".cstm__cardArrowConOrg")
		$(".org-frm2__slider .slick-next").appendTo(".cstm__cardArrowConOrg")

		// youthworks ph
		// $(".ythwrk-frm1__slider").slick({
		// 	infinite: true,
		// 	arrows: false,
		// 	dots: false,
		// 	autoplay: false,
		// 	speed: 800,
		// 	slidesToShow: 1,
		// 	slidesToScroll: 1,
		// });

		$(".ythwrk-frm2__slider").slick({
			infinite: true,
			arrows: false,
			dots: false,
			autoplay: false,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			centerMode: true,
		});

		// projects
		// $(".prjcts-frm1__slider").slick({
		// 	infinite: true,
		// 	arrows: false,
		// 	dots: false,
		// 	autoplay: false,
		// 	speed: 800,
		// 	slidesToShow: 1,
		// 	slidesToScroll: 1,
		// });

	},
}