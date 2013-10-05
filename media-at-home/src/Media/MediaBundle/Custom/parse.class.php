<?php

/**
 * ParseXML class
 *
 * @package Parse.XML
 * @author Jonathon Bischof
 **/
class MediaParse
{

	/** Variables **/
	public $showid;
	public $showname;
	public $showoverview;
	public $airday;
	public $airtime;
	public $shownetwork;
	public $imdbid;
	public $poster;
	public $network;
	public $status;
    public $season;
	/** End Variables **/

	public static function add_show($showid) {
        global $db;

		if (file_exists(XMLDIR."/".$showid.".xml")) {
        	$array = file_get_contents(XMLDIR."/".$showid.".xml");
		} else {
			$url = XMLURL.$showid."/all/en";
			$filename = $showid.".xml";
			save_xml($url, $filename);
			$array = file_get_contents(XMLDIR."/".$showid.".xml");
		}

		$array = xml2array($array);
        $showinfo = $array['Data']['Series'];
		$array = $array['Data']['Episode'];
		$results = array();
		save_banner($showinfo['banner']);
		// Lets add the show to the shows list; if it doesn't exist.
		$showoverview = htmlspecialchars($showinfo['Overview'], ENT_QUOTES);
		if ($showinfo['Status'] == "Continuing") { $showstatus = 1; } else { $showstatus = 0; }
		if (empty($showinfo['Airs_Time'])) { $airtimetmp = "00"; } else { $airtimetmp = strtotime($showinfo['Airs_Time']); }
		$airtime = date('G:i', $airtimetmp);
		$addshowquery = "INSERT IGNORE INTO shows VALUES ({$showid}, \"{$showinfo['SeriesName']}\", \"{$showoverview}\", \"{$showinfo['Airs_DayOfWeek']}\", \"{$airtime}\", '{$showstatus}', 'Any', '1', \"{$showinfo['poster']}\", \"{$showinfo['banner']}\", \"{$showinfo['Network']}\", \"{$showinfo['IMDB_ID']}\" );";
		//echo $addshowquery;
		$db->query($addshowquery);

		$rquery = "DELETE FROM episodes WHERE showid='{$showid}';";
        $db->query($rquery);
        foreach($array as $result) {
			 // print_pre($result);
              if (isset($result['Overview']) && !empty($result['Overview'])) { $overview = htmlspecialchars($result['Overview'], ENT_QUOTES); } else { $overview = htmlspecialchars("No overview available...", ENT_QUOTES); }
			  if (isset($result['EpisodeName']) && !empty($result['EpisodeName'])) { $epname = htmlspecialchars($result['EpisodeName'], ENT_QUOTES); } else { $epname = htmlspecialchars("Not Available", ENT_QUOTES); }
			  if (isset($result['FirstAired']) && !empty($result['FirstAired'])) { $firstaired = $result['FirstAired']; } else { $firstaired = '0'; }
			  $airedfull = "{$firstaired} {$airtime}";
              $query = "INSERT INTO episodes VALUES ({$showid}, {$result['Combined_season']}, {$result['Combined_episodenumber']}, \"{$epname}\", \"{$overview}\", \"{$airedfull}\", '1', '/media/NAS/Shared/Media/...', 'Null');";
			  //TODO REPLACE WITH LOG CLASS CALL!
              $logquery = "INSERT INTO tvlogs (showid, entry, entrytype) VALUES ({$showid}, \"Added S{$result['Combined_season']} E{$result['Combined_episodenumber']} to episodes.\", 2)";
              //echo $query;
              $db->query($query);
              $db->query($logquery);
              // Do insert actions here
			  echo "Added {$showinfo['SeriesName']} Season {$result['Combined_season']}, Episode {$result['Combined_episodenumber']} to database.<br />";
       }
	   echo "Show Added, Episodes Added.";
	   //header("Location: /media/tv-show/?id={$showid}");
   }

	public static function get_variables_tv($xmlfile) {
		$xml = file_get_contents($xmlfile);
        $array = xml2array($xml);
		$array = $array['Data']['Series'];

		$showname = $array['SeriesName'];
        $airday = $array['Airs_DayOfWeek'];
        $airtime = $array['Airs_Time'];
		$status = $array['Status'];
		$shownetwork = $array['Network'];
		$imdbid = $array['IMDB_ID'];
		$poster = $array['poster'];
        $banner = $array['banner'];
		$showoverview = $array['Overview'];
       	$bannerfile = BANNERDIR."/".$banner;
		$bannerurl = BANNERREL."/".$banner;
        if (file_exists($bannerfile)) {
		} else {
			save_banner($banner);
		}
		echo "<img src='{$bannerurl}' />\n";
        echo "<strong>Show Name:</strong> ".$showname."\n";
		echo "<strong>Overview:</strong> ".$showoverview."\n";
		echo "<strong>Airs:</strong> ".$airday." @ ".$airtime."\n";
		echo "<strong>Network:</strong> ".$shownetwork."\n";
		echo "<strong>Status:</strong> ".$status."\n";
		echo "<strong>IMDB:</strong> ".$imdbid."\n";
		echo "<strong>Poster:</strong> ".$poster;
	}

} // END class
