$(document).ready(function () {
	$('.l-credits').on('click', function () {
		var $credits = $('.b-credits');
		if ($credits.hasClass('open')) {
			$credits.removeClass('open');
		} else 
			$credits.addClass('open');
	});

	$('.b-credits__close').on('click', function () {
		var $credits = $('.b-credits');
		$credits.removeClass('open');
	});

	$('.b-services-categories a').on('click', function () {
		var $slug = $(this).data('slug');
		if ($('.b-services-items[data-slug=' + $slug + ']').is(':hidden')) {
			$('.b-services-categories a').removeClass('active');
			$(this).addClass('active');
			$('.b-services-items').fadeOut();
			$('.b-services-items[data-slug=' + $slug + ']').fadeIn();
		}
	});

	if ($('.c-container_scroll').length > 0) {
		$('.l-btn').hover(
		  	function() {
		    	$( this ).css('color', $(this).parents('.b-scroll-section').css('background-color'));
		  	}, function() {
		    	$( this ).css('color', '#fff');
		  	}
		);
	} else {
		$('.l-btn').hover(
		  	function() {
		    	$( this ).css('color', $(this).parents('.c-container').css('background-color'));
		  	}, function() {
		    	$( this ).css('color', '#fff');
		  	}
		);
	}

	$('.b-our-team__image-contaner-main, .b-our-team__title-container').on('click', function () {
		$('.b-our-team').removeClass('open');
		$(this).parents('.b-our-team').addClass('open');
	});

	$('.b-our-team__close-description-btn').on('click', function () {
		$('.b-our-team').removeClass('open');
	});

	$(window).on('resize', function () {
		if ($('.b-scroll-section__vertical-align').height() > $('.b-scroll-section__scroll-pane').height() && $(window).width() > 768) {
			$('.b-scroll-section__scroll-pane').jScrollPane({
				'autoReinitialise' : true
			});
		} else {
			$('.b-scroll-section__scroll-pane').each(function(index) {
				var api = $(this).data('jsp');
				if (api) api.destroy();
			});
			
		}
	}).trigger('resize');

	$(window).on('load', function () {
		$('section').addClass('current-page');
		$('.b-image-container').fadeIn();
	});

	/* Beauty Resosurces */

	$('.b-site-item_beauty-resources').hover(
  		function() {
    		$( this ).addClass( "active" );
    		$( this ).siblings('.b-site-item_beauty-resources').addClass( "not-active" );
  		}, function() {
    		$( this ).removeClass( "active" );
    		$( this ).siblings('.b-site-item_beauty-resources').removeClass( "not-active" );
  		}
	);

	/* Scroll Feature */

	if ($('.c-container_scroll').length > 0) {
		var $sections_count = $('.b-left-side .b-scroll-section').length,
			$current_section_index = 0
			$is_animate = false;

		$('.b-scroll-section-container').fadeIn();

		$(window).on('resize', function () {
			$('.b-left-side .b-scroll-section-container').css('margin-top', -1 * ($sections_count - $current_section_index - 1) * $('.b-left-side').height());
			$('.b-right-side .b-scroll-section-container').css('margin-top', -1 * ($current_section_index) * $('.b-right-side').height());
		}).trigger('resize');

		$(window).on('load', function () {
			$('.b-left-side .b-scroll-section').eq($sections_count - $current_section_index - 1).addClass('active-section');
    		$('.b-right-side .b-scroll-section').eq($current_section_index).addClass('active-section');
		});

		$('.c-wrapper').on('mousewheel', function(event, delta, deltaX, deltaY) {
			//event.preventDefault();
    		if ($is_animate == false) {
    			if (deltaY < 0) { 
    				$current_section_index++;
    			} else {
    				$current_section_index--;
    			}

    			if ($current_section_index < 0) {
    				$current_section_index = 0;
    				return;
    			}

    			if ($current_section_index > $sections_count - 1) {
    				$current_section_index = $sections_count - 1;
    				return;
    			}

    			$is_animate = true;

    			$('.b-left-side .b-scroll-section-container').animate({
    				'margin-top' : -1 * ($sections_count - $current_section_index - 1) * $('.b-left-side').height()
    			}, 500);
    			$('.b-right-side .b-scroll-section-container').animate({
    				'margin-top' : -1 * ($current_section_index) * $('.b-right-side').height()
    			}, 500, function () {
    				$is_animate = false;
    			});

    			$('.b-left-side .b-scroll-section').removeClass('active-section');
    			$('.b-right-side .b-scroll-section').removeClass('active-section');
    			$('.b-left-side .b-scroll-section').eq($sections_count - $current_section_index - 1).addClass('active-section');
    			$('.b-right-side .b-scroll-section').eq($current_section_index).addClass('active-section');
    		}
		});

	}
	$(window).on('mousewheel', function(event, delta, deltaX, deltaY) {
		//event.preventDefault();
	});

	$('.l-open-menu').on('click', function () {
		if ($('.c-menu-mobile').is(':hidden'))
			$('.c-menu-mobile').fadeIn();
		else
			$('.c-menu-mobile').fadeOut();
	})
});
