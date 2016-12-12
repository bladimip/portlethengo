
/**
 * Created by PhpStorm.
 * User: scott
 * Date: 05/12/2016
 * Time: 23:44
 */


function addMarker(location, map) {
    // Add the marker at the clicked location,
    var
    marker = new google . maps . Marker({
                position: location,
                map: map
            });
    }


google.maps.event.addListener(map, 'click', function(event) {
    addMarker(event.latLng, map);


//Make a marker draggable

var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
var mapOptions = {
zoom: 4,
center: myLatlng
}
var map = new google.maps.Map(document.getElementById("map"), mapOptions);

// Place a draggable marker on the map
var marker = new google.maps.Marker({
position: myLatlng,
map: map,
draggable:true,
title:"Drag me!"
});