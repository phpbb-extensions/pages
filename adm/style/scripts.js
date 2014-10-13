(function($) { // Avoid conflicts with other libraries

'use strict';

$(function() {
	var editor_id = $("#page_content").attr('id');
	var init = init_tinymce;
	$.fn.toggleBoxes = function(target) {
		$(this).on('click', function () {
			if ($(this).is(':checked')) {
				$(target).prop('checked', false);
				
				$('#text_holder').css("margin-left","0px");
				$('#text_holder').css("border-color","#fff");
				$('#color_palette_placeholder').hide();
				$('#format-buttons').hide();
				tinymce.get(editor_id).show();
  			} else
			{
				$('#text_holder').css("margin-left","90px");
				$('#text_holder').css("border-color","#ccc");
				$('#color_palette_placeholder').show();
				$('#format-buttons').show();
				tinymce.get(editor_id).hide();
			}
		});
	};

	$('.html-on').toggleBoxes('.html-off');
	$('.html-off').toggleBoxes('.html-on');

	tinymce.init({
		selector: "textarea.mceEditor",
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen","pagebreak",
			"insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image",
	});	
	if (init)
	{
		$('#text_holder').css("margin-left","0px");
		$('#text_holder').css("border-color","#fff");
		$('#color_palette_placeholder').hide();
		$('#format-buttons').hide();
	}
});

})(jQuery); // Avoid conflicts with other libraries
