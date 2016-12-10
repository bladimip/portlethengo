/* Materialize */

$(document).ready(function() {

	$('.searchBtn').on("click", function() {
		$('.searchInput').slideToggle('fast', function() {
			$('.searchInput input').focus();
		});
	});

	$('.slider').slider({full_width: true});
	$('.slider').slider('start');

  $('select').material_select();

	$('.modal').modal();

	$('.logBtn').on('click', function() {
		var condition = $(this).bind('span eq(1)').text();

		if ($.trim(condition) == "Login") {
			$('#modal2').modal('open');
		}

		if ($.trim(condition) == "Logout") {
			$.post('logout', {'toLogout' : true}, function(data) {
				if (data == "success") {
					window.location = '/';
				} else {
					console.log(data);
				}
			});
		}

	});

	$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });

	// Add event
	$('#saveNewEventBtn').on('click', function() {
		var form = document.getElementById('addNewEventForm');
		var formData = new FormData(form);
		formData.append('event', 'add');

		//send formdata to server-side
    $.ajax({
      url: '/inc/php/controlEvent.php', // php file
      type: 'post',
      data: formData,
      dataType: 'html', // return html from php file
      async: true,
      processData: false,  // tell jQuery not to process the data
      contentType: false,   // tell jQuery not to set contentType
      success: function(data) {
        console.log(data);
        Materialize.toast(data, 30000, 'rounded');
      }
    });
	});

	//searching function
	//sends entered values from #searchfield text-box to search.php on every key press
	//works only when 3 or more characters entered
	$("#searchField").keyup(function() {
		var val = $(this).val();
		var formData = new FormData();
		formData.append("search", val);

		if (val.length >= 3) {
			$.ajax({
				type:"post",
				data:formData,
				dataType:"html",
				async: true,
				processData: false,
				contentType: false,
				success: function(data) {
					$("#searchResults").html(data);
				}
			})
		} else {
			$("#searchResults").html("");
		}
	});

});
