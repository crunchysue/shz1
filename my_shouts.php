
<?php 

	$url = 'https://v0.api.shizzow.com/';
	
	
	// Search for crunchysue if user has not submitted form yet - for debugging easily
	if ($_POST['person_submit']) {
		$person_to_search_for = $_POST['person'];
	} else {
		$person_to_search_for = "crunchysue";
	}

	$url .= 'people/' . $person_to_search_for . '/shouts?limit=100';

	// Do the cURL call to the shizzow api, just like in the Shizzow API example
	require_once $_SERVER["DOCUMENT_ROOT"] ."/shz/shizzow_get.php" ;
	
	// Apply the secret json decoder ring to get data in usable format
	$data = json_decode($curl_response);
	
	
	// Build some variables just to make the code shorter
	$person = $data->results->people;
	$person_name = $person->profiles_name;	
	$shouts = $data->results->shouts;
	$num_shouts = $data->results->count;
	
	// Loop through all the shouts and create a GoogleMapsAPI call to add a marker for each	
	$markers = '';
	$point = '';
	foreach ($shouts as $shout) {
		$point = $shout->latitude . ',' . $shout->longitude;
		$markers .= 'map.addOverlay(new GMarker(new GLatLng(' . $point . '), markerOptions));';
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>


<script src="http://maps.google.com/maps?
file=api&amp;v=2&amp;
key=ABQIAAAAuSk6tknea5d2PYq_BMKwlBSRZhFSvxtHgBENWmlM6Gf3MCyB2xQ2qPQfr7Q1gqx0SgArAtu3KLuE3g&sensor=false"
type="text/javascript"></script>
<script type="text/javascript" src="/js/jquery/jquery-1.3.min.js"></script>
<script type="text/javascript" src="/js/jquery/plugins/json2.js"></script>
<script type="text/javascript">

// shouts will be a JSON object
var thejson = <?php echo $curl_response ?>;
var page = thejson.request.page;
var shouts = thejson.results.shouts;

// latlng is a string, comma separated of lat and lng
function getShoutInfo( latlng ) {
	
	var lat = latlng.lat();
	var lng = latlng.lng();
	var retval = "";
	
	$.each(shouts, function(i) {
		if (this.latitude == lat && this.longitude == lng) {
			// This is the shout we're looking for
			retval = "Shout #" + i + "<br />" + this.places_name;
			retval += "<br />" + this.address1;
			if (this.website != ""){
				retval += '<br /><a href="' + this.website + '">' + this.website + '</a>';	
			}
						
			retval += '<br/><br /><input type="submit" id="doShout" value="Shout From Here" />';
						
			
			retval += '<script type="text/javascript">';			
			
			retval += '$("#doShout").click(function(){';
			retval += '$.post("shizzow_post.php", {places_key:' + this.places_key + '"} );});';

			retval += '<\/script>';


	
		}	 
	}); 
	
	// kludge because we have a marker at green dragon, but it's not necessarily a shout
	if (retval == "") {
		retval = "Green Dragon";
	}
	
	return retval;
	
} // end getShoutInfo




$(document).ready(function(){
   setupMap();  
 });
 
$(window).unload( function () { GUnload(); } );


function setupMap() {
	if (GBrowserIsCompatible()) {
	
		// Create our "tiny" marker icon & the marker options
		var shzIcon = new GIcon(G_DEFAULT_ICON);
		shzIcon.image = "http://www.houseofcrunchy.com/shz/images/shz-dot.png";
		markerOptions = { icon:shzIcon };

		// Init the map
		var map = new GMap2(document.getElementById("map"));
		var green_dragon = new GLatLng(45.51604400000000, -122.65669600000000);
		map.setCenter(green_dragon, 13);
		map.addOverlay(new GMarker(green_dragon, markerOptions));
		map.openInfoWindowHtml(green_dragon, "Green Dragon");
		map.addControl(new GMapTypeControl());
		map.addControl(new GLargeMapControl());
		
		// Add Shizzouts as markers on the map
		<?php echo $markers ?>
	
		// Listen for clickage on our markers
		// If marker is true, they clicked on a marker; if point, they clicked on the map	
		GEvent.addListener(map, "click", function(marker,point){
		if (marker) {
			handleOverlayClick(marker);
		} else if (point) {
			handlePointClick(point);
		} else {
			// never happens
		}
		
		});
		 
	} // end if GBrowserIsCompatible
} // end function setupMap


// User clicked on a marker
function handleOverlayClick( marker ) {
	var info = getShoutInfo(marker.getLatLng());
	marker.openInfoWindowHtml(
		"Thanks for clicking the marker at<br />" + info
	);
} // end function handleOverlayClick()


// User clicked on a naked spot on the map
function handlePointClick( point ) {

	// this here's where we'll make a shout. w00t!
}



</script> 


<title>My Shouts</title>  </head>


<body>

<!-- ! The Form -->
<form action="<?php echo $_SCRIPT_FILENAME ?>" method="post">
	<fieldset>
	<label for="person">Shizzow ID: </label><input type="text" name="person" id="person" value="crunchysue" />
	<input type="submit" value="Show Me" name="person_submit" id="person_submit" />
	</fieldset>
</form>


<h2><?php echo $num_shouts ?> Shouts from <?php echo $person_name; ?>:</h2>


<!-- ! The Map -->
<div id="map" style="width:600px;height:400px"></div>



<!-- ! Print out the JSON object -->
<?php echo ("<pre>" . print_r($data, true) . "</pre>"); ?>

</body>
</html>