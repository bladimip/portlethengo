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

	// Delete club image, admin mode
	$('.ImgDeleteBtn').on('click', function() {
			var parent = $(this).parent();
			// Get id of the clicked image
			var imgId = parent.attr('id').replace( /^\D+/g, '');

			var formData = new FormData();
			formData.append('imgId', imgId);
			formData.append('command', 'delete');

			//send formdata to server-side
			$.ajax({
				url: '/inc/php/processImages.php', // php file
				type: 'post',
				data: formData,
				dataType: 'html', // return html from php file
				async: true,
				processData: false,  // tell jQuery not to process the data
				contentType: false,   // tell jQuery not to set contentType
				success : function(data) {
					console.log(data);
					parent.remove();
				}
			});
		});

});
