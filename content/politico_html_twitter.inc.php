<?php

// Date function (this could be included in a seperate script to keep it clean)
function dateteste($d1, $d2){
	$d1 = (is_string($d1) ? strtotime($d1) : $d1);
	$d2 = (is_string($d2) ? strtotime($d2) : $d2);

	$diff_secs = abs($d1 - $d2);
	$base_year = min(date("Y", $d1), date("Y", $d2));

	$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
	$diffArray = array(
		"years" => date("Y", $diff) - $base_year,
		"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
		"months" => date("n", $diff) - 1,
		"days_total" => floor($diff_secs / (3600 * 24)),
		"days" => date("j", $diff) - 1,
		"hours_total" => floor($diff_secs / 3600),
		"hours" => date("G", $diff),
		"minutes_total" => floor($diff_secs / 60),
		"minutes" => (int) date("i", $diff),
		"seconds_total" => $diff_secs,
		"seconds" => (int) date("s", $diff)
	);
	if($diffArray['days'] > 0){
		if($diffArray['days'] == 1){
			$days = '1 day';
		}else{
			$days = $diffArray['days'] . ' days';
		}
		return $days . ' and ' . $diffArray['hours'] . ' hours ago';
	}else if($diffArray['hours'] > 0){
		if($diffArray['hours'] == 1){
			$hours = '1 hour';
		}else{
			$hours = $diffArray['hours'] . ' hours';
		}
		return $hours . ' and ' . $diffArray['minutes'] . ' minutes ago';
	}else if($diffArray['minutes'] > 0){
		if($diffArray['minutes'] == 1){
			$minutes = '1 minute';
		}else{
			$minutes = $diffArray['minutes'] . ' minutes';
		}
		return $minutes . ' and ' . $diffArray['seconds'] . ' seconds ago';
	}else{
		return 'Less than a minute ago';
	}
}

// Work out the Date plus 8 hours
// get the current timestamp into an array
$timestamp = time();
$date_time_array = getdate($timestamp);

$hours = $date_time_array['hours'];
$minutes = $date_time_array['minutes'];
$seconds = $date_time_array['seconds'];
$month = $date_time_array['mon'];
$day = $date_time_array['mday'];
$year = $date_time_array['year'];

// use mktime to recreate the unix timestamp
// adding 19 hours to $hours
$timestamp = mktime($hours + 0,$minutes,$seconds,$month,$day,$year);
$theDate = strftime('%Y-%m-%d %H:%M:%S',$timestamp);	

// END DATE FUNCTION

//Search API Script

$search = "http://search.twitter.com/search.atom?q=".$q."";

$tw = curl_init();

curl_setopt($tw, CURLOPT_URL, $search);
curl_setopt($tw, CURLOPT_RETURNTRANSFER, TRUE);
$twi = curl_exec($tw);
$search_res = new SimpleXMLElement($twi);

echo "<div class='divisao'>No Twitter</div>";
echo "Obs: As informações aqui apresentadas correspondem a dados coletados na <a href='http://search.twitter.com/'>Busca do Twitter</a>, e não necessariamente se referem ao político em questão.<br /><br />";  
foreach ($search_res->entry as $twit1) {

$description = $twit1->content;

$description = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $description);
$description = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" >\\2</a>'", $description);
$description = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" >\\2</a>'", $description);

$retweet = strip_tags($description);

$date =  strtotime($twit1->updated);
$dayMonth = date('d M', $date);
$year = date('y', $date);
$message = $row['content'];
$datediff = dateteste($theDate, $date);

echo "
<div class='user'>
	<a href=\"",$twit1->author->uri,"\" target=\"_blank\">
		<img border=\"0\" width=\"48\" class=\"twitter_thumb\" src=\"",$twit1->link[1]->attributes()->href,"\" title=\"", $twit1->author->name, "\" />
	</a>\n";
	echo "
	<div class='text'>
		<a href=\"",$twit1->author->uri,"\" target=\"_blank\">
		", $twit1->author->name,
		"</a>: ",
		$description."<br /> 
		<strong>".
			$datediff."
		</strong>
		<a href='http://twitter.com/home?status=RT: ".$retweet."' target='_blank'>Retweet!</a>
	</div>
	<div class='clear'>
	</div>
</div>";

}

curl_close($tw);

?>