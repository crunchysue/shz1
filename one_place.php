
<?php 

$url = 'https://v0.api.shizzow.com/places?cities=Portland&states=OR&countries=US&limit=1';

if ($_POST['place_submit']) {
	$url .= '&places_name=' . $_POST['place'];
}

require_once $_SERVER["DOCUMENT_ROOT"] ."/shz/shizzow_get.php" ;

$data = json_decode($curl_response);

$place = $data->results->places[0];   
$lat = $place->latitude;
$lon = $place->longitude;
$places_name = $place->places_name;
$address1 = $place->address1;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google Maps JavaScript &amp; Shizzow JSON API Example</title>  </head>
<body onload="load()" onunload="GUnload()">

<!-- ! The Form -->
<form action="<?php echo $_SCRIPT_FILENAME ?>" method="post">
	<fieldset>
	<label for="place">Name Your Place: </label><input type="text" name="place" id="place" />
	<input type="submit" value="Show Me" name="place_submit" id="place_submit" />
	</fieldset>
</form>

<h2><?php echo "$places_name: $address1" ?></h2>


<!-- ! The Map -->
<div id="map" style="width:500px;height:300px"></div>



<?php echo ("<pre>" . print_r($data, true) . "</pre>"); ?>

</body>
</html>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAuSk6tknea5d2PYq_BMKwlBSRZhFSvxtHgBENWmlM6Gf3MCyB2xQ2qPQfr7Q1gqx0SgArAtu3KLuE3g&sensor=false"
type="text/javascript"></script>


<script type="text/javascript">
//<![CDATA[

function load() {
	if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("map"));
		var point = new GLatLng(<?php echo "$lat, $lon" ?>);
		map.setCenter(point, 17);
		map.addOverlay(new GMarker(point));

	}
}

//]]>
</script> 
