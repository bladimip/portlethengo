// Delete club image, admin mode
$('.ImgDeleteBtn').on('click', function() {

  var confirmed = confirm("Delete this image?");

  if (confirmed) {
    var parent = $(this).parent();
    // Get id of the clicked image
    var imgId = parent.attr('id').replace( /^\D+/g, '');

    var formData = new FormData();
    formData.append('imgId', imgId);

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
        Materialize.toast(data, 3000, 'rounded');
      }
    });
  }

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

        // New images (response from a server - in HTML format)
        var newImgs = $(data);

        // Add uploaded images to screen
        newImgs.appendTo('#clubImgContainer');

        // Add event listeners to new images
        newImgs.find('.materialboxed').materialbox();

        newImgs.find('.ImgDeleteBtn').on('click', function() {
          var confirmed = confirm("Delete this image?");

          if (confirmed) {
            var parent = $(this).parent();
            // Get id of the clicked image
            var imgId = parent.attr('id').replace( /^\D+/g, '');

            var formData = new FormData();
            formData.append('imgId', imgId);
            formData.append('command', 'delete');

            // Send form data object to server-side
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
                Materialize.toast(data, 3000, 'rounded');
              }
            });
          }
        });

        // Clear the input field - file path
        $('input.file-path.validate.valid').val("");

        // Toast
        Materialize.toast("Uploaded", 3000, 'rounded');
      }
    });
  });

// Save Club Content changes
$('#saveClubBtn').on('click', function() {

  // Get current values
  var clubID = $('#club_id').val();
  var title = $('[name=cTitle]').val();
  var genre = $('select').val();
  var descr = $('#textarea1').val();
  var phone = $('[name=cPhone]').val();
  var email = $('[name=cEmail]').val();
  var addr = $('[name=cAddress]').val();

  // Create a form data object and add values to it
  var formData = new FormData();
  formData.append('clubID', clubID);
  formData.append('title', title);
  formData.append('genre', genre);
  formData.append('description', descr);
  formData.append('phone', phone);
  formData.append('email', email);
  formData.append('address', addr);

  // Send form data object to server-side
  $.ajax({
    url: '/inc/php/saveClubInfo.php', // php file
    type: 'post',
    data: formData,
    dataType: 'html', // return html from php file
    async: true,
    processData: false,  // tell jQuery not to process the data
    contentType: false,   // tell jQuery not to set contentType
    success: function(data) {
      console.log(data);
      Materialize.toast(data, 3000, 'rounded');
    }
  });
});
