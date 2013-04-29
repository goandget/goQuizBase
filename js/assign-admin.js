$(document).ready(function() {
	// Initialise Plugin
	var options = {
		additionalFilterTriggers: [$('#quickfind')],
		clearFiltersControls: [$('#cleanfilters')],         
	};
	$('#users').tableFilter(options);
	$('.filters').toggle();
});