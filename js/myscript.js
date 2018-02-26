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

		$current_url = window.location.href;

		// Change Job Application Status ===========================
		$(document).on('click', '.app_statuses li a', function() {
			var app_status = $(this).data('status');
			$(this).closest('.btn-group').find('.app_status_btn').html(app_status + ' <span class="caret"></span>');			
			
			var application_id = $(this).closest('.app_statuses').data('job-id');
			var formData = {
				'application_id' 		: application_id,
				'application_status'	: app_status
			}
	        $.ajax({
	            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
	            url         : '../../wp-content/themes/brick-child/job_manager/update-job-application-status.php', // the url where we want to POST
	            data        : formData, // our data object
	            dataType    : 'json', // what type of data do we expect back from the server
	            encode      : true
	        }).done(function(data) {
	            console.log(data); 
	        });

		});

		// Change Job Status ===========================
		$('.job_status .btn').click(function(){
			// Toggle check mark
			if(!$(this).hasClass('pressed')) {
				$(this).addClass('pressed');
				$('.pressed').not(this).removeClass('pressed');
			}
			// Update Job Status in DB
			if($(this).data('job-status') > 0) {
				var job_status  = 1;
			} else {
				var job_status  = 0;
			}
			var formData = {
				'job_status' : job_status,
				'job_id'	 : $(this).data('job-id')
			}
			$.ajax({
	            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
	            url         : '../../wp-content/themes/brick-child/job_manager/update-job-status.php', // the url where we want to POST
	            data        : formData, // our data object
	            dataType    : 'json', // what type of data do we expect back from the server
	            encode      : true
	        }).done(function(data) {
	            console.log(data); 
	        });
		}); 


});