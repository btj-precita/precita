function customHomeSlider() {
	slider = jQuery("#home-slider");
	navigation = slider.data('navigation');
	pagination = slider.data('pagination');
	slideSpeed = slider.data('speed');
	navigation ? navigation = true : navigation = false;
	pagination ? pagination = true : pagination = false;
	slider.owlCarousel({
		items : 1,
		navigation : navigation,
		slideSpeed : slideSpeed,
		pagination: pagination,
		paginationSpeed : 400,
		singleItem: true
	});
}

function pageNotFound() {
	if(jQuery('.not-found-bg').data('bgimg')){
		var bgImg = jQuery('.not-found-bg').data('bgimg');
		jQuery('.not-found-bg').attr('style', bgImg);
	}
}

function accordionNav(){
	if(jQuery('.block.filter').length){
		jQuery('.filter-options-title').on('click', function(){
			jQuery(this).parents('.filter-options-item').toggleClass('active').children('.filter-options-content').slideToggle();
		});
		if(jQuery(document.body).width() < 767 && jQuery('body').hasClass('page-layout-1column')){
			jQuery('#layered-filter-block .filter-title').on('click', function(){
				if(!jQuery('#layered-filter-block').hasClass('active')) {
					jQuery('#layered-filter-block').addClass('active');
				} else {
					jQuery('#layered-filter-block').removeClass('active');
				}
			});
			
		}
	}
}

function backgroundWrapper(){
	if(jQuery('.background-wrapper').length){
		jQuery('.background-wrapper').each(function(){
			var thisBg = jQuery(this);
			if(jQuery(document.body).width() < 768){
				thisBg.attr('style', '');
				if(thisBg.parent().hasClass('text-banner') || thisBg.find('.text-banner').length){
					bgHeight = thisBg.parent().outerHeight();
					thisBg.parent().css('height', bgHeight - 2);
				}
				if(jQuery('body').hasClass('boxed-layout')){
					bodyWidth = thisBg.parents('.container').outerWidth();
					bgLeft = (bodyWidth - thisBg.parents('.container').width())/2;
				} else {
					bgLeft = thisBg.parent().offset().left;
					bodyWidth = jQuery(document.body).width();
				}
				if(thisBg.data('bgColor')){
					bgColor = thisBg.data('bgColor');
					thisBg.css('background-color', bgColor);
				}
				setTimeout(function(){
					thisBg.css({
						'position' : 'absolute',
						'left' : -bgLeft,
						'width' : bodyWidth
					}).parent().css('position', 'relative');
				}, 300);
			} else {
				thisBg.attr('style', '');
				if(jQuery('body').hasClass('boxed-layout')){
					bodyWidth = thisBg.parents('.container').outerWidth();
					bgLeft = (bodyWidth - thisBg.parents('.container').width())/2;
				} else {
					bgLeft = thisBg.parent().offset().left;
					bodyWidth = jQuery(document.body).width();
				}
				thisBg.css({
					'position' : 'absolute',
					'left' : -bgLeft,
					'width' : bodyWidth
				}).parent().css('position', 'relative');
				if(thisBg.data('bgColor')){
					bgColor = thisBg.data('bgColor');
					thisBg.css('background-color', bgColor);
				}
				if(thisBg.parent().hasClass('text-banner') || thisBg.find('.text-banner').length){
					bgHeight = thisBg.children().innerHeight();
					thisBg.parent().css('height', bgHeight - 2);
				}
			}
			thisBg.animate({'opacity': 1}, 200)
		});
	}
}

function hoverImage(){
	jQuery('.product-image-photo').each(function(){
		if(jQuery(this).data('hoverImage') && (jQuery(this).data('hoverImage').indexOf('placeholder') == -1)){
			hover_img = jQuery('<img />');
			hover_img.addClass('hover-image');
			hover_img.attr('src', jQuery(this).data('hoverImage'));
			hover_img.appendTo(jQuery(this).parent());
			jQuery(this).parents('.image-wrapper').addClass('hover-image');
		}
	});
}

var bsModal;
require(['jquery'], function ($)
{
    require(['MeigeeBootstrap', 'MeigeeCarousel'], function(mb,mc)
    {
       bsModal = $.fn.modal.noConflict();
		backgroundWrapper();
		jQuery(document).ready(function(){
			customHomeSlider();
			/* Mobile Devices */
			if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))){
			/* Mobile Devices Class */
			jQuery('body').addClass('mobile-device');
				var mobileDevice = true;
			}else if(!navigator.userAgent.match(/Android/i)){
				var mobileDevice = false;
			}

			/* Responsive */
			var responsiveflag = false;
			var topSelectFlag = false;
			var menu_type = jQuery('#nav').attr('class');
			
			
			
			
			jQuery('#sticky-header .search-button').on('click', function(){
				jQuery(this).toggleClass('active');
				jQuery('#sticky-header .block-search form.minisearch').slideToggle();
			});
			
			
			
			var isApple = false;
		/* apple position fixed fix */
		if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))){
			isApple = true;
			function stickyPosition(clear){
				items = jQuery('.header, .backstretch');
				if(clear == false){
					topIndent = jQuery(window).scrollTop();
					items.css({
						'position': 'absolute',
						'top': topIndent
					});
				}else{
					items.css({
						'position': 'fixed',
						'top': '0'
					});
				}
			}
			jQuery('#sticky-header .form-search input').on('focusin focusout', function(){
				jQuery(this).toggleClass('focus');
				if(jQuery('header.header').hasClass('floating')){
					if(jQuery(this).hasClass('focus')){
						setTimeout(function(){
							stickyPosition(false);
						}, 500);
					}else{
						stickyPosition(true);
					}
				}
			});
		}
			
			
			/* sticky header */
			if(jQuery('#sticky-header').length){
				var headerHeight = jQuery('.page-header').height();
				sticky = jQuery('#sticky-header');
				jQuery(window).on('scroll', function(){
					if(jQuery(document.body).width() > 977){
						if(!isApple){
							heightParam = headerHeight;
						}else{
							heightParam = headerHeight*2;
						}
						if(jQuery(this).scrollTop() >= heightParam){
							sticky.stop().slideDown(250);
						}
						if(jQuery(this).scrollTop() < headerHeight ){
							sticky.stop().hide();
						}
						// 
						
					} /* else {
						jQuery('#sticky-header').appendTo('html');
					} */
				});
			}
			pageNotFound();
			accordionNav();
			hoverImage();
			jQuery(window).resize(function(){
				pageNotFound();
				accordionNav();
				backgroundWrapper();
			});
			
			if(document.URL.indexOf("#product_tabs_reviews") != -1) {
				$('#tabs a[href="#product_tabs_reviews"]').tab('show')
			}
			$.fn.scrollTo = function (speed) {
				if (typeof(speed) === 'undefined')
					speed = 1000;
				$('html, body').animate({
					// scrollTop: parseInt($(this).offset().top)
					scrollTop: parseInt($('#tabs').offset().top - 100)
				}, speed);
			};
			$('.add-review').on('click', function(){
				$(this).scrollTo('#tabs');
				$('#tabs a[href="#product_tabs_reviews"]').tab('show');
			});
			
		});
	});
	
    require(['jquery/ui', 'MeigeeBootstrap', 'lightBox'], function(ui, lb)
    {
        $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) 
        {
            event.preventDefault();
            $(this).ekkoLightbox();
            return false;
        }); 
    });
	
	
});










