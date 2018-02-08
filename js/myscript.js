jQuery(document).ready(function($){
		var $img_src = $('.category-image-holder').find('img').attr('src');
		var $featured_img_src = $('.product-image-holder').find('img').attr('src');
//		$('.category-image-holder').css('background-image','url('+ $img_src + ')');
//		$('.category-image-holder img').hide();
//		console.log($img_source);
		
		$('.header-title').css('margin-top', '-' + ($('.header-title').height())/2 + 'px' );
		$('.header-title').delay(1000).fadeIn();

		var header = $('.header-title');
		var range = 200;

		$(window).on('scroll', function () {
		  
		    // var scrollTop = $(this).scrollTop();
		    // // var offset = header.offset().top;
		    // var height = header.outerHeight();
		    // offset = offset + height / 2;
		    // var calc = 1 - (scrollTop - offset + range) / range;
		  
		    // header.css({ 'opacity': calc });
		  
		    // if ( calc > '1' ) {
		    //   header.css({ 'opacity': 1 });
		    // } else if ( calc < '0' ) {
		    //   header.css({ 'opacity': 0 });
		    // }
		  
		});
		jQuery.fn.verticalAlign = function () {
		    return this
		            .css("margin-top",($(this).parents('.post-holder').height() - $(this).outerHeight())/2 + 'px' );
		};

		//Vertically align text
		$(window).load(function(){
			$('#news-loop h3').each(function(){
				$(this).verticalAlign();
			});
		});
		$(window).resize(function(){
			$('#news-loop h3').each(function(){
				$(this).verticalAlign();
			});
		});

		$('.multiple-items').slick({
		  infinite: true,
		  slidesToShow: 7,
		  slidesToScroll: 3,
		    responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 5,
		        slidesToScroll: 3,
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
		});
		$('.single-item').slick({
			dots: true,
			arrows: true
		});

		$('table.table-sort').tablesort();

		/******** JOBS *********/

		// $('.search_keywords, .search_btn').wrapAll('<div class="search_fields_holder clearfix"></div>');
		// $('.filter_wide filter_by_tag').html('FILTER BY <br>CATEGORY')


});