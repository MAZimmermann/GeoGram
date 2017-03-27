<?php

if(!empty($_GET['location'])) {
	
	$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($GET_['location']);
	/* set maps URL variable to url string, concatenate the location / use the url encode function */
	
	$maps_json = file_get_contents($maps_url);
	/* pass URL to file_get_contents function */
	
	$maps_array = json_decode($maps_json, true);
	/* set second parameter to true, json decoded into array and not object */
	
	/* PHP array maintains same structure as JSON response */
	$lat = $maps_array['results'][0][]['geometry']['location']['lat'];
	/* traverse maps array for latitude */
	$lng = $maps_array['results'][0][]['geometry']['location']['lng'];
	/* traverse maps array for longitude */
	
	/* now pass the lat and lng variables to the Instagram API */
	$instagram_url = 'https://api.instagram.com/v1/media/search?lat=' . $lat . '&lng=' . $lng . '&client_id= ';
			/* Sorry, Can't Share my client_id */			// below is similar process to above
	$instagram_json = file_get_contents($instagram_url);
	$instagram_array = json_decode($insagram_json, true);
	
	}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8" />
<title>Geogram</title>

</head>

<body>

<form action="">
	
	<input type="text" name="location"/>
	<button type="submit">Submit</button>
	
</form>

<?php

// as the foreach loop goes through each instagram post...
// the image variable is set to a single instagram post
if (!empty($instagram_array)) {
	foreach($instagram_array['data'] as $image) {
		echo '<img src="'.$image['images']['low_resolution']['url'].'" alt="" />';
	}
}
?>

</body>
	
</html>