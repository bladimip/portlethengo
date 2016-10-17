<? top('Map') ?>

<script>
    <div id="map"></div>
        <script>

    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }

</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=r6H8oL-lra0lgTmkg6d7pR5Assg=&callback=initMap"
            async defer></script>
</script>

<? bottom() ?>