jQuery(document).ready(function($){
    // КОД ВЕРСТАЛЬЩИКА
	$('a[href^="#"], a[href^="."]').click( function(){ 
	    var scroll_el = $(this).attr('href');
        if ($(scroll_el).length != 0) { 
	    $('html, body').animate({ scrollTop: $(scroll_el).offset().top }, 500);
        }
	    return false;
    });
		
	$(".partners-slider").slick({
	  slidesToShow: 6,
	  variableWidth: true,
	  prevArrow: $(".pss-prev"),
	  nextArrow: $(".pss-next"),
	responsive: [
		{
		  breakpoint: 1200,
		  settings: {
			slidesToShow: 4,
		  }
		},{
		  breakpoint: 991,
		  settings: {
			slidesToShow: 3,
		  }
		},{
		  breakpoint: 767,
		  settings: {
			slidesToShow: 2,
		  }
		},{
		  breakpoint: 460,
		  settings: {
			slidesToShow: 1,
		  }
		}]	  
	});
	
	$('.menu-btn').click(function(){
		$(this).toggleClass('open');
		$('.menu').toggleClass('open');
	});
	
	$('.item,sub').click(function () {
		$(this).find(".sub-menu").toggleClass("on");
	});
	
	$('.tabs .tab').click( function(){ 		
	    $(".tab").removeClass("act");
		$(this).addClass("act");
		var tab = $(this).data("tab");		
		$(".tabbox").removeClass("act");
		$(".tabbox"+tab).addClass("act");
    });
	
	var sp = $('.scroll-pane').jScrollPane();
	
	$('.filter-btn').click(function(){	
		if ($('.filter').hasClass("show")) {
			$('.filter').removeClass('show');
			$('.filter-btn').text("ФИЛЬТР");
		} else {
			$('.filter').addClass('show');
			$('.filter-btn').text("Скрыть фильтр");
		}
		$('.scroll-pane').jScrollPane({autoReinitialise: true});		
	});
	
	
	
	// НИЖЕ МОЙ КОД
	
	$('.jwp-autocomplete').autocomplete({
		source: function(request, response) {
			var type = $( this.element ).attr( 'data-type' );
            $.getJSON(
                "/wp-admin/admin-ajax.php",
                { term:request.term, action:'jwp_street_autocomplete', type:type }, 
                response
            );
        },
		delay: 500,
		minLength: 3,
	});	
	
	$('.jwp-remont input[class="all"]').on('change', function() {
		if ( $(this).hasClass( 'all' ) && $(this).is( ":checked" ) ) {
			$('.jwp-remont input[class!="all"]').removeAttr( "checked" );
		}
	});
	$('.jwp-remont input[class!="all"]').on('change', function() {
		var all_selector = $('.jwp-remont input[class="all"]');
		var not_all_selector = $('.jwp-remont input[class!="all"]');
		if ( all_selector.is( ":checked" ) ) {
			all_selector.removeAttr( "checked" );
		}
		if ( ! not_all_selector.length ) {
			all_selector.attr( 'checked', 'checked' );
		}
	});
	
	$('.jwp-reset-filter').on('click', function() {
		$('#jwp-side-filter input[type="text"]').val( '' );
		$('#jwp-side-filter input[type="checkbox"]').removeAttr( "checked" );
		$('#jwp-side-filter input[class="all"]').attr( 'checked', 'checked' );
		jwp_filter();
	});
	
	var filter_timer_id;
	$('#jwp-side-filter input').on('change', function() {
		jwp_deferred_filtering();
	} );
	
	function jwp_deferred_filtering() {
		if ( $('#jwp-side-filter').hasClass( 'processing' ) ) {
			clearTimeout( filter_timer_id );
		} else {
			$('#jwp-side-filter').addClass( 'processing' );
		}
		
		filter_timer_id = setTimeout( function() {
			jwp_filter();
		}, 1000 );
	}
	
	function jwp_filter() {
		$('#jwp-side-filter').removeClass( 'processing' );
		$('.prods-list').html( '<p>Выполняется поиск...</p>' );
		var params = {
			'action' : 'jwp_organizations_filter',
			'street' : $('.jwp-autocomplete[data-type="street"]').val(),
			'metro' : $('.jwp-autocomplete[data-type="metro"]').val(),
			'remont' : [],
			'viezd' : [],
			'oplata' : [],
		};
		$('.jwp-remont input:checked').each( function() {
			var text = $(this).closest( 'label' ).text().trim();
			if ( 'Вся техника' == text ) {
				params.remont = [];
				return;
			}
			params.remont.push( text );
		});
		$('.jwp-viezd input:checked').each( function() {
			var text = $(this).closest( 'label' ).text().trim();
			params.viezd.push( text );
		});
		$('.jwp-oplata input:checked').each( function() {
			var text = $(this).closest( 'label' ).text().trim();
			if ( 'Все виды оплаты' == text ) {
				params.oplata = [];
				return;
			}
			params.oplata.push( text );
		});
		$.post( "/wp-admin/admin-ajax.php", params, function( responce ) {
			if ( responce.content ) {
				$('.prods-list').html( responce.content );
			} else {
				$('.prods-list').html( '<p>По вашему запросу органиаций не найдено.</p>' );
			}
		} );
	}
	
});
