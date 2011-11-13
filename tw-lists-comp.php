<?php
$next_cursor = -1;
$drupal_members = array();

while ($next_cursor != 0) {
	$url = "https://api.twitter.com/1/lists/members.json?slug=drupal&owner_screen_name=shrop&cursor=".$next_cursor;
	$json = file_get_contents($url);
	$jsonIterator = new RecursiveIteratorIterator(
    	new RecursiveArrayIterator(json_decode($json, TRUE)),
    	RecursiveIteratorIterator::SELF_FIRST);

	foreach ($jsonIterator as $key => $val) {
		if ($key == 'screen_name' and $key != 'Array') {
			$drupal_members[] = $val;
		}
		if ($key == 'next_cursor' and $key != 'Array') {
			$next_cursor = $val;
		}
	}
}

$next_cursor = -1;
$techies_creatives_members = array();

while ($next_cursor != 0) {
	$url = "https://api.twitter.com/1/lists/members.json?slug=techies-creatives&owner_screen_name=shrop&cursor=".$next_cursor;
	$json = file_get_contents($url);
	$jsonIterator = new RecursiveIteratorIterator(
    	new RecursiveArrayIterator(json_decode($json, TRUE)),
    	RecursiveIteratorIterator::SELF_FIRST);

	foreach ($jsonIterator as $key => $val) {
		if ($key == 'screen_name' and $key != 'Array') {
			$techies_creatives_members[] = $val;
		}
		if ($key == 'next_cursor' and $key != 'Array') {
			$next_cursor = $val;
		}
	}
}

$twitter_lists = array_count_values(array_merge($drupal_members, $techies_creatives_members));
$members_on_both = array();

foreach ($twitter_lists as $key => $val) {
	if ($val == 2) {
		$members_on_both[] = $key;
	}
}

print_r($members_on_both);
?>
