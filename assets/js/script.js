/* Materialize */

$(document).ready(function() {
	$('.searchBtn').on("click", function() {
		$('.searchInput').slideToggle('fast', function() {
			$('.searchInput form input').focus();
		});
	});
});