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
        
            // verify if data exists
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

    $loc = get_geocode($location);





    

    // //temporary array to get geocode of specified location (starbucks) (to save money)
    // function temp_arr(){
    //     $data_arr = array();
    //     $data_arr['latitude'] = 32.9153341;
    //     $data_arr['longitude'] = -117.1208223;
    //     $data_arr['formatted_address'] = "10720 Westview Pkwy, San Diego, CA 92126, USA";

    //     return $data_arr;
    // }
    // $loc = temp_arr();

    // //temporary json of starbucks's nearby places (to save money)
    // function temp_nearby(){
    //     $file = '/Users/alexr/Desktop/starbucks_places.json';
    //     $contents = file_get_contents($file);
    //     return $contents;
    // }





    //converts array to a string as: "[latitude],[longitude]"
    function coord_str($coordinates){
        $coord = $coordinates['latitude'].",".$coordinates['longitude'];
        return $coord;
    }

    $coords = coord_str($loc);

    function get_nearby($coords){
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$coords.'&radius=1500&key=AIzaSyAISncWGWJBn3bSM0O8AxyW2hJjkmtbx6o';
        $contents = file_get_contents($url);
        // $contents = temp_nearby();

        //decode json response
        $resp = json_decode($contents, true);
        //response status is 'OK'
        if($resp['status']=='OK'){
            $data_arr = array(array());
            //loop through data and transfer to array
            for($i = 0; $i < 10; $i++){
                $j = $i + 1;
                $data_arr[$i]['name'] = isset($resp['results'][$j]['name']) ? $resp['results'][$j]['name'] : '';
                $data_arr[$i]['location']['lat'] = isset($resp['results'][$j]['geometry']['location']['lat']) ? $resp['results'][$j]['geometry']['location']['lat'] : '';
                $data_arr[$i]['location']['lng'] = isset($resp['results'][$j]['geometry']['location']['lng']) ? $resp['results'][$j]['geometry']['location']['lng'] : '';
                $data_arr[$i]['status'] = isset($resp['results'][$j]['opening_hours']['open_now']) ? $resp['results'][$j]['opening_hours']['open_now'] : '';
                $data_arr[$i]['rating'] = isset($resp['results'][$j]['rating']) ? $resp['results'][$j]['rating'] : '';
            }
            return $data_arr;
        }
        else{   //status of api call is something other than 'OK'
            return false;
        }
    }

    $nearby_array = get_nearby($coords);



    //print out array from get_nearby
    function display_array($nearby_array){
        for($i = 0; $i < count($nearby_array); $i++){
            echo "<br>";
            echo $nearby_array[$i]['name']; echo "<br>";
            echo $nearby_array[$i]['location']['lat']; echo "<br>";
            echo $nearby_array[$i]['location']['lng']; echo "<br>";
            if($nearby_array[$i]['status'] == 1){
                echo "Open <br>";
            }
            else    echo "Closed <br>";
            // echo $nearby_array[$i]['status']; echo "<br>";
            echo $nearby_array[$i]['rating']; echo "<br>";
        }
    }
    display_array($nearby_array);


    echo '<a href="map.html">Display these on a map</a>';
?>