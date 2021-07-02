jQuery(document).ready(function ($) {
	$("a[href^='#']").click(function (e) {
		e.preventDefault();
		$("body, html").animate({
			scrollTop: $(this.hash).offset().top,
		});
	});
});
