function initMap(){
    // gMap = new google.maps.maps(document.getElementById('map'));
    // gMap.setCenter(new google.maps.LatLng(39.8097343, -98.5556199));
    // gMap.setZoom(3);

    var gMap = {lat: 39.8097343, lng: -98.5556199};
    var map = new google.maps.map(document.getElementById('map'), {
        zoom: 3,
        center: gMap,
    });
}