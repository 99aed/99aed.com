jQuery.fn.exists = function() {
	return jQuery(this).length > 0;
}
jQuery.fn.center = function() {
	this.css({
		"position": "absolute"});
	this.css({		
		"top": (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px",
		"left": (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px"
	});
	return this;
};

jQuery.fn.UnseenLightboxShow = function() {
	if (!$('#UnseenBackgroundDiv').exists()) {
		$('body').append('<div id="UnseenBackgroundDiv" />');
		$('#' + 'UnseenBackgroundDiv').click(function() {
			$(this).UnseenLightboxHide();
		});
	}
	$('#' + 'UnseenBackgroundDiv').hide();
	$('#' + 'UnseenBackgroundDiv').css({
		"top": 0,
		"left": 0,
		"height": $(document).height() + "px",
		"width": $(document).width() + "px",
		"background-color":"black",
		"z-index": "9000"
	});
	$(this).css("z-index", '9100');
	$('#' + 'UnseenBackgroundDiv').fadeTo('slow', .7, function() {});
	$(this).fadeIn('slow', function() {}).center();

};
jQuery.fn.UnseenLightboxHide = function() {
	$('#' + 'UnseenBackgroundDiv').fadeOut('slow', function() {});
	$('.Unseenlightbox-content').fadeOut('slow', function() {});
}

$(function() {

	$('.UnseenLightbox').each(function(index) {
		$(this).click(function() {
			targetDivID = null;
			$.each($(this).attr('class').split(' '), function(index, item) {
				if (this.indexOf("UnseenTarget-") === 0) {
					targetDivID = item.replace('UnseenTarget-', '');
					//alert(targetDivID);
				}
			});
			if (targetDivID != null) {
				$('#' + targetDivID).UnseenLightboxShow();
			}

		});

	});

});