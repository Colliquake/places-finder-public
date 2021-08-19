function initMap(){
    gMap = new google.maps.maps(document.getElementById('map'));
    gMap.setCenter(new google.maps.LatLng(39.8097343, -98.5556199));
    gMap.setZoom(3);
}