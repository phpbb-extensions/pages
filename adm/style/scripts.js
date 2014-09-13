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

});

})(jQuery); // Avoid conflicts with other libraries
