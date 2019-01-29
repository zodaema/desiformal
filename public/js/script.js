// Parallax
var scene = document.getElementById('scene');
var parallax = new Parallax(scene);

// Scrolla
$('.scrolla-animate').scrolla();

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

// Portfolio
$(document).ready(function() {
	$('#portfolio-show').load('admincp-secure/fetch_pages.php'); //load initial records

	//executes code below when user click on pagination links
	$('#portfolio-show').on('click', '.pagination a', function (e){
		e.preventDefault();
		$(".loading-div").show(); //show loading element
		var page = $(this).attr("data-page"); //get page number from link
		$("#portfolio-show").load("admincp-secure/fetch_pages.php",{"page":page}, function(){ //get content from PHP page
			$(".loading-div").hide(); //once done, hide loading element
            $("html, body").animate({ scrollTop: ($('#portfolio').offset().top - 50) }, 600);
		});
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
jQuery(document).ready(function() {
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
});

// Facebook Like box
(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.4&appId=328021167405724";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
