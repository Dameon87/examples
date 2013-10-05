<?php

class NZBMatrix {


	public static function Search($searchfor, $quality, $season, $episode, $type) {
		$apikey = Settings::fetch_setting('search_nzbmatrix_apikey');
		$username = Settings::fetch_setting('search_nzbmatrix_username');
		$apiurl = Settings::fetch_setting('search_nzbmatrix_url');
		$retention = Settings::fetch_setting('gen_retention');
		$qualitys = array(
			"hd-tv" => "41",
			"sd-tv" => "6",
			"any-tv" => "0",
			"hd-movie" => "42",
			"sd-movie" => "2",
			"any-movie" => "0",
			"any-apps-pc" => "18",
			"any-apps-linux" => "20",
			"any-games-pc" => "10",
		);

		$apiquery = $apiurl."username=".$username."&apikey=".$apikey."&search=".$searchfor."&num=50&catid=".$qualitys[$quality]."&age=".$retention;
		echo "<div class='alert alert-info'><strong>Using API URL:</strong> {$apiquery}</div>";
		$sresults = file_get_contents($apiquery);

		$start = explode('|', $sresults);
		$new = array();
		$finalresults = array();
		$i = 0;
		foreach ($start as $s) {
    		if (!empty($s)) {
        		$tmp = explode("\n", $s);
        		foreach ($tmp as $t) {
            		if (!empty($t)) {
                		$bar = explode(':', $t);
                		if (!empty($bar[1])) {
                    		$new[$i][$bar[0]] = rtrim($bar[1], ';');
                		}
            		}
        		}
    		}
    		$i++;
		}
		//$new = (object) $new;
		$searchterms = self::tv_parse_search_items($type, $season, $episode);
		//print_pre($searchterms);
		//print_pre($new);
		if ($season == 0 && $episode == 0) { $usesearchterms = 'no'; }
		if ($type != 'tv') { $usesearchterms = 'no'; }
		foreach ($new as $tmpitem) {
    		foreach ($searchterms as $searchterm) {
				if ($usesearchterms != 'no') {
        			$strpos = strpos($tmpitem['NZBNAME'], $searchterm);
        			if ($strpos !== false) {
            			$finalresults[] = $tmpitem;
        			}
				} else { $finalresults[] = $tmpitem; }
    		}
		}
		return $finalresults;
	}

	public static function tv_parse_search_items($type, $season, $episode) {
		global $db;
		$query = "SELECT * FROM searchterms WHERE type='{$type}';";
		$results = $db->query($query);
		$searchterms = array();
		while ($result = $db->fetch_assoc($results)) {
			$withseason = str_replace('[S]', $season, $result['value']);
			$withepisode = str_replace('[E]', $episode, $withseason);
			$searchterms[] = $withepisode;
		}
		return $searchterms;
	}


	public static function parse_results($results) {

		foreach ($results as $result) {
            echo "<tr>";
            echo "<td><a href='http://nzbmatrix.com/nzb-details.php?id={$result['NZBID']}&hit=1'><span class='label label-info'>{$result['NZBID']}</span></a></td>";
            echo "<td>{$result['NZBNAME']}</td>";
            echo "<td>{$result['INDEX_DATE']}</td>";
            echo "<td>{$result['GROUP']}</td>";
            echo "<td>NZBMatrix</td>";
            echo "<td><a href='#NZBtoSAB' class='btn btn-small btn-success'><i class='icon-white icon-download'></i>Grab!</a>";
            echo "</tr>";
        }

	}

}
