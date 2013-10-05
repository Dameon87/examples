<?php

/**
 * TV class
 *
 * @package Media@Home.TV
 * @author Jonathon Bischof / John Oliver
 **/
class TV
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
    public $db;

	public static function get_show_name($showid) {
		global $db;
		$result = $db->fetch_assoc($db->query("SELECT name FROM shows WHERE id='{$showid}';"));
		return $result['name'];
	}

	public static function get_tv_info($showid) {
		global $db;
		$query = "SELECT * FROM shows WHERE id={$showid};";
		$resource = $db->query($query);
		$showinfo = $db->fetch_assoc($resource);
		$bannerurl = 'http://thetvdb.com/banners/';
		$banner = $bannerurl.$showinfo['banner'];
		//echo $result['id'];
		echo "<div style='width: 775px; float: left;'>";
		echo "<img class='img-polaroid' src='{$banner}' />";
		echo "<div style='padding-top: 12px;'>{$showinfo['overview']}</div>";
		echo "</div>";

		echo "<div style='float: left; padding-left: 12px;'>";
		echo "<span style='float: left;'><strong>Airs:</strong> {$showinfo['airday']} @ {$showinfo['airtime']}</span><br />";
		echo "<span style='float: left;'><strong>Channel:</strong> {$showinfo['network']}</span><br />";
		echo "<span style='float: left;'><strong>Status:</strong> {$showinfo['status']}</span><br />";
		echo "<span style='float: left;'><strong>Enabled:</strong> {$showinfo['active']}</span><br />";
		echo "</div>";

	}

	public static function get_episodes_all($showid) {
		global $db;
		$output = '';
		$query = "SELECT * FROM episodes WHERE showid='{$showid}' order by season desc , episode desc;";
        $results = $db->query($query);
		while ($result = $db->fetch_assoc($results)) {
		  if ($result['status'] == 1) { $status = "<span class='label label-important'>Wanted</span>"; } else if ($result['status'] == 0) { $status = "<span class='label label-info'>Skipped</span>"; } else if ($result['status'] == 2) { $status = "<span class='label label-success'>Downloaded</span>"; }
		  $overview = htmlspecialchars($result['overview'], ENT_QUOTES);
          $output .= "<tr>";
          $output .= "<td><span class='badge badge-info'>".$result['season']." / ".$result['episode']."</span></td>";
          $output .= "<td class='center'><span class='tooltip' rel='tooltip' title='{$overview}'></span><i class='icon-info-sign'></i> ".$result['name']."</td>";
		  $output .= "<td class='center'>{$result['status']}</td>";
          $output .= "<td class='center'>/media/NAS/Shared/Media/TV/Merlin (2008)/Season x/</td>";
          $output .= "<td class='center'>".$result['airdate']."</td>";
          $output .= "<td class='center'>
                                    <a class='btn btn-small btn-success' href='#'>
                                        <i class='icon-zoom-in icon-white'></i>
                                    </a>
                                    <a class='btn btn-small btn-info' href='#'>
                                        <i class='icon-edit icon-white'></i>
                                    </a>
                                    <a class='btn btn-small btn-danger' href='#'>
                                        <i class='icon-trash icon-white'></i>
                                    </a>
                                </td>";
          $output .= "</tr>";
          }
		  return $output;
	}

	public static function get_episodes_by_season($showid, $season) {
        global $db;
		$output = '';
        $query = "SELECT * FROM episodes WHERE showid='{$showid}' AND season='{$season}' order by season,episode desc;";
        $results = $db->query($query);
        while ($result = $db->fetch_assoc($results)) {
		  if ($result['status'] == 1) { $status = "<span class='label label-important'>Wanted</span>"; } else if ($result['status'] == 0) { $status = "<span class='label label-info'>Skipped</span>"; } else if ($result['status'] == 2) { $status = "<span class='label label-success'>Downloaded</span>"; }
		  $overview = htmlspecialchars($result['overview'], ENT_QUOTES);
          $output .= "<tr>";
          $output .= "<td><span class='badge badge-info'>".$result['season']." / ".$result['episode']."</span></td>";
          $output .= "<td class='center'><span class='tooltip' rel='tooltip' title='{$overview}'></span><i class='icon-info-sign'></i> ".$result['name']."</td>";
		  $output .= "<td class='center'>{$status}</td>";
          $output .= "<td class='center'>/media/NAS/Shared/Media/TV/Merlin (2008)/Season x/</td>";
          $output .= "<td class='center'>".$result['airdate']."</td>";
          $output .= "<td class='center'>
                                    <a class='btn btn-small btn-success' href='#'>
                                        <i class='icon-zoom-in icon-white'></i>
                                    </a>
                                    <a class='btn btn-small btn-info' href='#'>
                                        <i class='icon-edit icon-white'></i>
                                    </a>
                                    <a class='btn btn-small btn-danger' href='#'>
                                        <i class='icon-trash icon-white'></i>
                                    </a>
                                </td>";
          $output .= "</tr>";
          }
		  		  return $output;


	}

	public static function get_shows_list() {

		global $db;

		$query = "SELECT * FROM shows";
		$results = $db->query($query);

        while ($result = $db->fetch_assoc($results)) {
            $showid = $result['id'];
			$nextair = self::get_next_air_date($showid);
			$episodecount = self::get_episode_count($showid);
			if ($result['active'] == 1) { $active = "<span class='label label-success'>Yes</span>"; } else { $active = "<span class='label label-important'>No</span>"; }
			echo "<tr>";
			echo "<td>{$nextair}</td>";
			echo "<td><a href='/tv-show/?showid={$showid}'>{$result['name']}</a></td>";
            echo "<td>{$result['network']}</td>";
            echo "<td>{$result['quality']}</td>";
			echo "<td><span class='badge badge-info'>{$episodecount}</span></td>";
            echo "<td>{$active}</td>";
		}
	}

	public static function get_last_aired_date($showid) {
		global $db;
        $query = "SELECT airdate FROM episodes WHERE showid='{$showid}' AND airdate <= CURRENT_DATE() order by airdate desc limit 1;";
        $result = $db->query($query);
        $output = $db->fetch_assoc($result);
        return $output['airdate'];
	}

	public static function get_next_air_date($showid) {
        global $db;
        // TODO: Use setting for date formats
		$dateformat = "D, M j, Y g:i A";
		$query = "SELECT airdate FROM episodes WHERE showid='{$showid}' AND airdate >= CURRENT_DATE() order by airdate limit 1;";
        $result = $db->query($query);
        $output = $db->fetch_assoc($result);
		$showquery = "SELECT status from shows WHERE id='{$showid}';";
		$showstatus = $db->fetch_assoc($db->query($showquery));
		if ($output['airdate'] == '') {
			if ($showstatus['status'] == '1' ) { return "On Break"; } else { return "Ended/Cancelled"; }
		} else {
			$datetime = strtotime($output['airdate']);
			return date($dateformat, $datetime);
			//return strftime($output['airdate']);
			//return date("G:i", $output['airdate']);
		}
    }


	public static function get_episode_count($showid) {
		global $db;
		$query = "SELECT COUNT(*) FROM episodes WHERE showid='{$showid}';";
		$result = $db->query($query);
		$output = $db->fetch_assoc($result);
		return $output['COUNT(*)'];

	}

	public static function num_of_seasons($showid) {
		global $db;
		$minquery = "SELECT MIN(season) FROM episodes WHERE showid='{$showid}'";
		$minresult = $db->fetch_assoc($db->query($minquery));
		$maxquery = "SELECT MAX(season) FROM episodes WHERE showid='{$showid}'";
        $maxresult = $db->fetch_assoc($db->query($maxquery));
		$min = $minresult['MIN(season)'];
		$max = $maxresult['MAX(season)'];
		return "{$min}.{$max}";
	}

	public static function generate_tabs($showid) {
		global $db;
		list($min, $max) = explode('.', self::num_of_seasons($showid));
		//echo "{$min}-{$max}";
		foreach (array_reverse(range($min, $max)) as $season) {
			if ($season == $max) { $active = 'active'; } else { $active = 'inactive'; }
			if ($season == 0) { $sname = 'Specials'; } else { $sname = "Season {$season}"; }
			echo "<li class='{$active}'><a href='#s{$season}'>{$sname}</a></li>";
		}
		echo "<li><a href='#sall'>All Seasons</a></li>";

	}

	public static function generate_tab_content($showid) {
        global $db;
		$tablehead = file_get_contents('pages/tables/tablehead.show.tpl');
        $tablefoot = file_get_contents('pages/tables/tablefoot.tpl');
        list($min, $max) = explode('.', self::num_of_seasons($showid));
        foreach (range($min, $max) as $season) {
			if ($season == $max) { $active = 'active'; } else { $active = 'inactive'; }
			$tabcontent = self::get_episodes_by_season($showid, $season);
            echo "<div class='tab-pane $active' id='s{$season}'> {$tablehead} {$tabcontent} {$tablefoot}</div>";
        }
		$allseasons = self::get_episodes_all($showid);
		echo "<div class='tab-pane' id='sall'> {$tablehead} {$allseasons} {$tablefoot}</div>";
    }



	public static function full_update($showid) {
		//This function forces a full update, redownloads episode/show info, and attempts to match existing files to episodes.
		global $db;
		
	}


	public static function get_shows_schedule() {
		global $db;
		$showlist = array();
		$tmparray = array();
		$days = array();
		$showlistq = "SELECT * from shows";
		$showlistr = $db->query($showlistq);
		while ($ashow = $db->fetch_assoc($showlistr)) {
			$id = $ashow['id'];
			$showlist[$id] = $ashow;
		}

		$dquery = "SELECT date(airdate) FROM episodes WHERE date(airdate) >= CURDATE() ORDER BY airdate";
		$dresults = $db->query($dquery);
		while ($aday = $db->fetch_assoc($dresults)) {
			$theday = $aday['date(airdate)'];
			$days[$theday] = $theday;
		}
		$query = "SELECT * from episodes WHERE airdate >= CURDATE() ORDER BY airdate;";
		$results = $db->query($query);
		$episodes = array();
		while ($result = $db->fetch_assoc($results)) {
			$episodes[] = $result;
		}
		foreach ($days as $day) {
			$tmparray = array();
			foreach ($episodes as $episode) {
				$epdate = strtotime($episode['airdate']);
				$epdate = date('Y-m-d', $epdate);
				if($epdate == $day) {
					$id = $episode['showid'];
					if (file_exists(BANNERDIR."/{$showlist[$id]['banner']}")) { $banner = BANNERREL."/{$showlist[$id]['banner']}"; } else { save_banner($showlist[$id]['banner']); $banner = BANNERREL."/{$showlist[$id]['banner']}"; }
					$tmparray[] = "<div style='width: 600px;'><span class='label label-inverse' style='width: 592px;'><div style='float: left;'>{$showlist[$id]['airtime']}</div> <div style='float: right;'>{$showlist[$id]['name']}</div></span>";
					$tmparray[] = "<img src='{$banner}' style='width: 600px; position: relative; top: -7px;' /> <span class='label label-inverse' style='width:592px; position: relative; top: -9px; color: white !important; font-weight: bold'><strong><span style='float: left'>{$episode['name']} | Season {$episode['season']} Episode {$episode['episode']}</span><span style='float: right'>{$showlist[$id]['network']}</span></strong></span>";
				}
			}
			echo "<center><div class='well' style='width: 800px'><span class='label label-info' style='width: 100%; padding-top: 10px; padding-bottom: 10px; font-size: 20px'>{$day}</span><br /><br />";
			foreach ($tmparray as $item) { echo $item; }
			echo "</div></center>";
		}
	}


}
