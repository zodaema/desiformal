/* Add here all your JS customizations */

$(function(){
	var url = window.location.pathname;  
	var activePage = url.substring(url.lastIndexOf('/')+1);
	if(activePage == ''){
		activePage = 'index.php';
	}
	$('#menu li a').each(function(){  
		var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);

		if (activePage == currentPage) {
			$(this).parent().addClass('nav-active');
			if($(this).closest('li.nav-parent')){
				$(this).closest('li.nav-parent').addClass('nav-expanded nav-active');
			}
		}
	});
});

