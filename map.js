function getCookie(cname){
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i < ca.length; i++){
    let c = ca[i];
    while(c.charAt(0) == ' '){
      c = c.substring(1);
    }
    if(c.indexOf(name) == 0){
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


let map;
let infoWindow;

function initMap(){
    map = new google.maps.Map(document.getElementById('map'), {
        center: {   //centers onto USA
            lat: 39.8097343,
            lng: -98.5556199
        },
        zoom: 3
    });

    var json_string = getCookie("nearby_arr");
    var arr = JSON.parse(json_string);
    // for(var i = 0; i < arr.length; i++){
    //   console.log(arr[i]);
    // }

    for(let i = 0; i < arr.length; i++){
      new google.maps.Marker({
        position: {
          lat: arr[i].lat,
          lng: arr[i].lng
        },
        map: map,
      });
    }
    
    //prompt to go to user's location
    infoWindow = new google.maps.InfoWindow();
    const locationButton = document.createElement("button");
    locationButton.textContent = "Pan to Current Location";
    locationButton.classList.add("custom-map-control-button");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
    locationButton.addEventListener("click", () => {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent("Current location found.");
            infoWindow.open(map);
            map.setCenter(pos);

            const marker = new google.maps.Marker({
              position: {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              },
              map: map,
            });
          },
          () => {
            handleLocationError(true, infoWindow, map.getCenter());
          }
        );
      } else {
        handleLocationError(false, infoWindow, map.getCenter());
      }
    });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
      browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
  }
  