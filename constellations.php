<?php

include_once 'simple_html_dom.php';

$mysqli = new mysqli('localhost', 'root', 'Tr!f0rce', 'zodiac');

$zodiac = array("Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", "Libra", "Scorpio", "Sagittarius", "Capricorn", "Aquarius", "Pisces");

$url = "http://en.wikipedia.org/wiki/List_of_stars_in_Taurus";

$html = file_get_html($url);

$data = $html->find('table[class=wikitable]');

if (isset($data[0])) {
	//echo $data[0];
	
	foreach ($data[0]->find('tr') as $row) {
		echo $row->children(0)->plaintext . "<br>";
		$name = $row->children(0)->plaintext;
		$henry_draper = $row->children(3);
		$hipparcos = $row->children(4);
		$right_ascension = $row->children(5);
		$declination = $row->children(6);
		$magnitude = $row->children(7);
		$distance = $row->children(9);
		$spectral_class = $row->children(10);
		
		if ($name == 'Table Legend:') {
			echo "name is empty string";
			break;
		}
		
		$mysqli->query("INSERT INTO stars SET name='$name', 
			henry_draper='$henry_draper', 
			hipparcos='$hipparcos', 
			right_ascension='$right_ascension', 
			declination='$declination',
			magnidute='$magnitude',
			distance='$distance',
			spectral_class='$spectral_class'")
	}
} else {
	echo "borked";
}

?>