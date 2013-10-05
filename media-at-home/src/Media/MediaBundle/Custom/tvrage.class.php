<?php

class TVRage {

	public static function find_show_by_name($query) {
		//This function will find the show by name, and then provide a list with info to choose.
		$url = Settings::fetch_setting('tvrage_searchurl');
		$query = urlencode($query);
		$url = $url.$query."&key=MGT8uRujoykhpHiy83Vh";
		$results = simplexml_load_file($url);
		foreach ($results->show as $show) {
			echo "
				<div class='row-fluid'>
                <div class='box span12'>
                    <div class='box-header' data-original-title=''>
                        <h2><i class='icon-eye-open'></i><span class='break'></span>{$show->name}</h2>
                        <div class='box-icon'>
                            <a href='{$show->link}' target='_blank' class='btn-search'><i class='icon-search'></i></a>
                            <a href='#' class='btn-close'><i class='icon-remove'></i></a>
                        </div>
                    </div>
                    <div class='box-content'>
						<strong>Airs:</strong> {$show->airday} at {$show->airtime} <br />
						<strong>First Aired:</strong> <span class='label label-info'>{$show->started}</span> <br />
						<strong>Seasons:</strong> <span class='label label-info'>{$show->seasons}</span> <br />
						<form method='POST' action='/actions/tvsearch.php?action=find_by_id'><button type='submit' name='id' value='{$show->showid}' class='tvrageshow btn btn-small btn-success' style='float: right'>This one!</button></form>
                    </div>
                </div><!--/span-->
				</div>
			";




			/*
			echo "<pre style='width: 500px;'>";
			echo "Name: {$show->name} <span class='label label-info'>{$show->status}</span> <br />";
			echo "Seasons: {$show->seasons} <br />";
			echo "ShowID: {$show->showid} <br />";
			echo "First Aired: {$show->started} <br />";
			echo "Network: {$show->network} <br />";
			echo "Airs: {$show->airday} @ {$show->airtime} <br />";
			echo "TV Rage: {$show->link}";
			echo "</pre>";
			//print_pre($show);
			*/
		}


	}

	public static function get_full_schedule() {
		$url = Settings::fetch_setting('tvrage_fullschedule');
		$us = $url."US";
		$uk = $url."UK";
		$curdate = date("Ymd");
		echo $curdate;
		$ukfilename = "full_schedule-UK.xml";
        $usfilename = "full_schedule-US.xml";
		save_xml($us, $usfilename);
		save_xml($uk, $ukfilename);
	}

	public static function full_schedulexml() {
		global $db;
		//$us = 'storage/xml/full_schedule-US.xml';
		$us = 'storage/xml/full_schedule.xml';
        $uk = 'storage/xml/full_schedule-UK.xml';
		$xmlobject = simplexml_load_file($us);
		$idquery = "SELECT id,name,banner,poster FROM shows;";
        $idresults = $db->query($idquery);
        $ids = array();
        while ($id = $db->fetch_assoc($idresults)) {
            $ids[] = $id;
        }
		//print_pre($ids);
		//print_pre($xmlobject);
		foreach($xmlobject->DAY as $day) {
			$tmparray = array();
			foreach ($day->time as $time) {
				foreach($time->show as $show) {
					foreach ($ids as $showid) {
						if ($showid['name'] == $show->attributes()) {
							if (!empty($show->ep)) { list($season, $episode) = explode('x', $show->ep); }
							if (file_exists(BANNERDIR."/{$showid['banner']}")) { $banner = BANNERREL."/{$showid['banner']}"; } else { save_banner($showid['banner']); $banner = BANNERREL."/{$showid['banner']}"; }
							$tmparray[] = "<div style='width: 600px;'><span class='label label-inverse' style='width: 592px;'><div style='float: left;'>{$time->attributes()}</div> <div style='float: right;'>{$showid['name']}</div></span>";
							$tmparray[] = "<img src='{$banner}' style='width: 600px; position: relative; top: -7px;' /> <span class='label label-inverse' style='width:592px; position: relative; top: -9px; color: white !important; font-weight: bold'><strong><span style='float: left'>{$show->title} | Season {$season} Episode {$episode}</span><span style='float: right'>{$show->network}</span></strong></span>";
							$tmparray[] = "</div>";
						} //IF
					} //ShowID
				} //Show
			} //Time
			if (!empty($tmparray)) {
				$fdate = strtotime($day->attributes());
				$tmpdate = date('l, F d, Y', $fdate);
				echo "<center><div class='well' style='width: 800px'><span class='label label-info' style='width: 100%; padding-top: 10px; padding-bottom: 10px; font-size: 20px'>{$tmpdate}</span><br /><br />";
				foreach ($tmparray as $item) { echo $item; }
				unset($tmparray);
				echo "</div></center>";
			}
		} //Day
	} // Function

	public static function quick_schedule() {
		global $db;
		$us = 'storage/xml/quick_schedule-US.xml';
		$uk = 'storage/xml/quick_schedule-UK.xml';
		$usarr = file_get_contents($us);
		$ukarr = file_get_contents($uk);
		$days = explode("\n\n", $usarr);
		foreach ($days as $day) {
			$main = array();
			$i = 0;
			$times = explode("[TIME]", $day);
			$tmpdate = substr($times[0], 5, -7);
			$main[0]['date'] = str_replace(']', '', $tmpdate);
			$main[0]['times'] = array();
			array_shift($times);
			foreach ($times as $time) {
				$shows = explode("[SHOW]", $time);

				//print_r($shows);
				$main[0]['times'][$i]['time'] = substr(array_shift($shows), 0, -8);
				$main[0]['times'][$i]['shows'] = array();
				foreach ($shows as $show) {
					$sub = explode('^', substr($show, 0, -8));
					$sub_done = array(
						'network' => $sub[0],
						'name' => $sub[1],
						'seasonepp' => $sub[2],
						'rage' => $sub[3]
					);
					$main[0]['times'][$i]['shows'][] = $sub_done;

				}
				$i++;

			}
		print_pre($main);
		echo "{$main[0]['date']} @ ";
		}
		//print_pre($main);

		$idquery = "SELECT id,name FROM shows;";
		$idresults = $db->query($idquery);
		$ids = array();
		while ($id = $db->fetch_assoc($idresults)) {
			$ids[] = $id;
		}
    }

}
