<?php

include_once 'simple_html_dom.php';

$mysqli = new mysqli('localhost', 'root', 'Tr!f0rce', 'zodiac');
/*if ($mysqli->query('DELETE FROM stars')) {
	if ($mysqli->query('ALTER TABLE stars AUTO_INCREMENT = 1')) {
		echo "<p>table stars reset</p>";
	} else {
		die("error resetting stars auto increment");
	}
} else {
	die("error deleting info in stars");
}*/

$zodiac = array("Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", "Libra", "Scorpio", "Sagittarius", "Capricorn", "Aquarius", "Pisces");

$url = "http://en.wikipedia.org/wiki/List_of_stars_in_Cancer";

$html = file_get_html($url);

$data = $html->find('table[class=wikitable]');

if (isset($data[0])) {
	//echo $data[0];
	
	$counter = 0;
	foreach ($data[0]->find('tr') as $row) {
		if ($counter++ == 0) continue;
		
		$name = $row->children(0)->plaintext;
		$henry_draper = $row->children(3)->plaintext;
		$hipparcos = $row->children(4)->plaintext;
		$right_ascension = str_replace('&#160;', ' ', $row->children(5)->plaintext);
		$declination = str_replace('&#160;', ' ',$row->children(6)->plaintext);
		$magnitude = $row->children(7)->plaintext;
		$distance = $row->children(9)->plaintext;
		$spectral_class = $row->children(10)->plaintext;
		echo $name;
		echo "<br>";
		
		if ($name == '') continue;
		
		$mysqli->query("INSERT INTO stars SET name='$name', henry_draper='$henry_draper', hipparcos='$hipparcos', right_ascension='$right_ascension', declination='$declination', magnitude='$magnitude', distance='$distance',	spectral_class='$spectral_class', constellation='cancer'");
			
		if ($name == "DX Cnc") {
			echo "name is empty string";
			break 1;
		}
	}
} else {
	echo "borked";
}

?>