/* Materialize */

$(document).ready(function() {
	$('.searchBtn').on("click", function() {
		$('.searchInput').slideToggle('fast', function() {
			$('.searchInput input').focus();
		});
	});
	
	$("#searchField").keyup(function() {
		var val = $(this).val();
		var formData = new FormData();
		formData.append("search", val);
		
		
		if (val.length >= 3) {
			$.ajax({
				url:"/inc/search.php",
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