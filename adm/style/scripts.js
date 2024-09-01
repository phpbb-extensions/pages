document.addEventListener('DOMContentLoaded', function() {

	'use strict';

	// Helper function to get elements by selector
	const $ = selector => document.querySelectorAll(selector);

	// Function to toggle checkboxes
	function toggleBoxes(elements, target) {
		elements.forEach(element => {
			element.addEventListener('click', () => {
				if (element.checked) {
					$(target).forEach(box => {
						box.checked = false;
					});
				}
			});
		});
	}

	// Call toggleBoxes for .html-on and .html-off elements
	toggleBoxes($('.html-on'), '.html-off');
	toggleBoxes($('.html-off'), '.html-on');

	// Page route autofill when empty using Page title
	const pageTitle = document.getElementById('page_title');
	const pageRoute = document.getElementById('page_route');

	pageTitle.addEventListener('blur', () => {
		const title = pageTitle.value;
		const route = pageRoute.value;

		pageRoute.value = route ? route : slugify(title);
	});

	// Slugify a string to be url friendly
	function slugify(title) {
		return title
			.toLowerCase()
			.replace(/[^a-z\d\-_\s]/g, '')
			.replace(/\s+/g, '-')
			.trim();
	}

	// Page Icon Previews
	const updateIconClass = (element, newClass) => {

		element.classList.forEach(className => {
			if (className.startsWith('fa-') && className !== 'fa-fw') {
				element.classList.remove(className);
			}
		});

		element.classList.add(`fa-${newClass}`);
	};

	const pageIconFont = document.getElementById('page_icon_font');

	pageIconFont.addEventListener('keyup', function() {
		updateIconClass(this.nextElementSibling, this.value);
	});

	pageIconFont.addEventListener('blur', function() {
		updateIconClass(this.nextElementSibling, this.value);
	});

});
