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
				success: function(data) {
					console.log(data);
					parent.remove();
				}
			});
		});

		// Submit button for image upload form
		$('#imgUploadFormSub').on('click', function() {
			$('#imgUploadForm').submit();
		});

		// Upload club image(s), admin mode
		$('#imgUploadForm').on('submit', function(e) {

				// Prevent default form submission
				e.preventDefault();

				var formData = new FormData();

				formData.append("club_id", document.getElementById('club_id').value);

				// For each entry, add to formdata to later access via $_FILES["file" + i]
				for (var i = 0, len = document.getElementById('file').files.length; i < len; i++) {
					formData.append("file" + i, document.getElementById('file').files[i]);
				}

				$.ajax({
					url: '/inc/php/processImages.php', // php file
					type: 'post',
					data: formData,
					dataType: 'html', // return html from php file
					async: true,
					processData: false,  // tell jQuery not to process the data
					contentType: false,   // tell jQuery not to set contentType
					success: function(data) {
						console.log(data);
					}
				});
			});

});
