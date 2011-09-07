<?php

$mysqli = new mysqli('localhost', 'root', 'Tr!f0rce', 'zodiac');

header('Content-Type: application/json');

$constellations = array();

if ($result = $mysqli->query('SELECT * FROM stars WHERE constellation ="aries" AND NOT distance ="0"')) {
	// do stuff
	while ($row = $result->fetch_object()) {
		$star = array();
		$star['name'] = $row->name;
		$star['ra'] = $row->right_ascension;
		$star['dec'] = $row->declination;
		$star['dist'] = $row->distance;
		$constellations[] = $star;
	}
	print json_encode($constellations);
} else {
	echo $mysqli->error;
}

$mysqli->close();

?>