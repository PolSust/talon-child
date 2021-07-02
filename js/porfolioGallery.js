jQuery(document).ready(function ($) {
	$("#btn-all").click(() => {
		showAll($);
	});
	$("#btn-hollowKnight").click(() => {
		showAll($);
		hide("2");
		hide("3");
		hide("4");
	});
	$("#btn-silksong").click(() => {
		showAll($);
		hide("0");
		hide("1");
		hide("5");
	});
});
function showAll($) {
	$(".ngg-gallery-thumbnail-box").stop().fadeIn();
}
function hide(id) {
	jQuery("#ngg-image-" + id)
		.stop()
		.fadeOut();
}
