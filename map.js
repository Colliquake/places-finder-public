let map;

function initMap(){
    map = new google.maps.Map(document.getElementById('map'), {
        center: {   //centers onto USA
            lat: 39.8097343,
            lng: -98.5556199
        },
        zoom: 3
    });
}