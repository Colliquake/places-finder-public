<?php
    $location = $_POST["location"];

    function get_geocode($address){
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyAISncWGWJBn3bSM0O8AxyW2hJjkmtbx6o";
        $content = file_get_contents($url);

        // decode the json response
        $resp = json_decode($content, true);
        // response status will be 'OK', if able to geocode given address
        if($resp['status']=='OK'){
    	    //define empty array
 		    $data_arr = array(); 
            // get the important data
            $data_arr['latitude'] = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : '';
            $data_arr['longitude'] = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : '';
            $data_arr['formatted_address'] = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : '';
        
            // verify if data is exist
            if(!empty($data_arr) && !empty($data_arr['latitude']) && !empty($data_arr['longitude'])){
                return $data_arr;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    $coords = json_encode(get_geocode($location));

    //Starbucks coordinates: Latitude:	32.9153341, Longitude:	-117.1208223
    

    // $contents = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=32.865857,-117.233742&radius=1500&key=AIzaSyAISncWGWJBn3bSM0O8AxyW2hJjkmtbx6o');

    // echo $contents;
?>