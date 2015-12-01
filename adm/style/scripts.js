(function($) { // Avoid conflicts with other libraries

'use strict';

$(function() {

	$.fn.toggleBoxes = function(target) {
		$(this).on('click', function () {
			if ($(this).is(':checked')) {
				$(target).prop('checked', false);
			}
		});
	};

	$('.html-on').toggleBoxes('.html-off');
	$('.html-off').toggleBoxes('.html-on');

	$('#page_title').on('blur', function() {
		var title = $(this).val();
		$('#page_route').val(function(event, route) {
			return (route) ? route : title.toLowerCase().replace(/[^a-z0-9-_\s]/gi, '').replace(/[\s]/g, '-');
		});
	});

});

})(jQuery); // Avoid conflicts with other libraries
