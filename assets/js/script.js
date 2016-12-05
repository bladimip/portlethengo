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

	$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });

	// Add event
	$('#addNewEventBtn').on('click', function() {

	});

});
