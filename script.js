function post_query( url, name, data ) {


	var str = '';


	$.each( data.split('.'), function(k, v) {
		str += '&' + v + '=' + $('#' + v).val();
	} );


	$.ajax(

	{
		url : '/' + url,
		type: 'POST',
		data: name + '_f=1' + str,
		cache: false,
		success: function( result ) {

			obj = jQuery.parseJSON( result );

			if ( obj.go ) go( obj.go );
			else alert( obj.message );



	}





	}

	);

}



function go( url ) {
	window.location.href='/' + url;
}


