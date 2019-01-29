$(document).ready(function() {
	// Parallax
	var scene = document.getElementById('scene');
	var parallax = new Parallax(scene);

	// Scrolla
	$('.scrolla-animate').scrolla();

	// Portfolio
	$.ajax({
	    type: 'get',
	    url: '/showPortfolio/1',
	    dataType: 'json', // ** ensure you add this line **
	    success: function(data) {
	        $.each(data, function(index, item) {
						var html = '<div class="col-md-4 col-sm-6 portfolio-item"><a href="/portfolioDetail/'+ item.id +'" id="portfolioDetailButton" class="portfolio-link"><div class="portfolio-hover"><div class="portfolio-hover-content"><i class="fa fa-search-plus fa-3x"></i></div></div><img src="img/portfolio/'+ item.smallpic +'" class="img-responsive" alt=""></a><div class="portfolio-caption"><h4><b>'+ item.name +'</b></h4><p class="text-muted">Website Design</p></div></div>';
						$('section#portfolio div#append-portfolio').append(html);
	            console.log(data);
	        });
	    },
	    error: function(XMLHttpRequest, textStatus, errorThrown) {
	        alert("some error");
	    }
	});

	$(document).on('click','a#portfolioDetailButton', function(e){
			e.preventDefault();
			$.ajaxSetup({
					headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
			});
			$.ajax({
					url: $(this).attr("href"),
					method: 'get',
					dataType: 'json',
					success: function(result){
							$('#PortfolioModal').modal('show');
							$('#PortfolioModal span#name').html(result.name);
							$('#PortfolioModal span#client').html(result.client);
							$('#PortfolioModal span#link').html(result.link);
							$('#PortfolioModal img#show-fullpic').attr('src','/img/portfolio/' + result.fullpic);
							$('#PortfolioModal span#date').html(result.updated_at);
							console.log(result);
					}
			});
	});

	// Navigation
    $('.navbar-desiformal a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    $('body').scrollspy({
        target: '.navbar-desiformal',
        offset: 50
    });

    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

		// Back to top
    var offset = 250;
    var duration = 300;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            $('.back-to-top').css("visibility","visible");
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });

    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

	// Facebook Like box
	(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.4&appId=328021167405724";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
});
