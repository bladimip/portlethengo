/* Materialize */

$(document).ready(function() {

	$('.searchBtn').on("click", function() {
		$('.searchInput').slideToggle('fast', function() {
			$('.searchInput form input').focus();
		});
	});

	$('.slider').slider({full_width: true});
	$('.slider').slider('start');

  $('select').material_select();

	$('.modal').modal();


});
