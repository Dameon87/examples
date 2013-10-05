<?php

class TVDB {
	//ini_set('error_reporting', E_ALL & ~E_NOTICE);
	public static function find_show_by_name($query) {
		//This function will find the show by name, and then provide a list with info to choose.
		$url = "http://www.thetvdb.com/api/GetSeries.php?seriesname=";
		$query = urlencode($query);
		$url = $url.$query;
		$results = simplexml_load_file($url);
		$tmpresults = xml2array(file_get_contents($url));
		$slist = $tmpresults['Data']['Series'];
		$newitems = array();
		//print_pre(count(array_unique($slist, SORT_REGULAR)));
		if (isset($slist[0])) {
			foreach ($slist as $newitem) {
				//print_pre($newitem);
				if (!isset($newitem['FirstAired'])) { @$newitem['FirstAired'] &= 0; }
				$newitems[] = $newitem;
			}
		} else {
			$newitems = $slist;
		}

		if (isset($slist[0])) {
			$newitems = msort($newitems, 'FirstAired', SORT_DESC);
			foreach ($newitems as $show) {
				if ($show['FirstAired'] == 0) { $firstaired = 'Unknown'; } else { $firstaired = $show['FirstAired']; }
				if (isset($show['Overview'])) { $overview  = Truncate($show['Overview'], 255); } else { $overview = "No Overview available."; }
				if (!empty($show['banner'])) { $banner = "<img src='http://thetvdb.com/banners/{$show['banner']}' />"; } else { $banner = ''; }
				echo "
					<div class='row-fluid' style='padding:1px;'>
                	<div class='box span12' style='margin-top: 1px; margin-bottom: 1px;'>
                    <div class='box-header' data-original-title='' style='padding: 5px;'>
                        <h2><i class='icon-eye-open'></i><span class='break'></span>{$show['SeriesName']}</h2>
                        <div class='box-icon'>
                            <a href='http://thetvdb.com/?tab=series&id={$show['seriesid']}' target='_blank' class='btn-search'><i class='icon-search'></i></a>
                            <a href='#' class='btn-close'><i class='icon-remove'></i></a>
                        </div>
                    	</div>
                    	<div class='box-content'>
							{$banner}
							<strong>First Aired:</strong> <span class='label label-info'>{$firstaired}</span> <br />
							<strong>Overview:</strong> {$overview}
							<form name='show' method='POST' action='/addshow/?action=add_show'><button type='submit' name='id' value='{$show['seriesid']}' class='tvrageshow btn btn-small btn-success' style='float: right'>This one!</button></form>
                    	</div>
                	</div><!--/span-->
					</div>
				";
			}

		} else {
			$show = $newitems;
			if ($show['FirstAired'] == 0) { $firstaired = 'Unknown'; } else { $firstaired = $show['FirstAired']; }
                $overview = Truncate($show['Overview'], 255);
                if (!empty($show['banner'])) { $banner = "<img src='http://thetvdb.com/banners/{$show['banner']}' />"; } else { $banner = ''; }
                echo "
                    <div class='row-fluid' style='padding:1px;'>
                    <div class='box span12' style='margin-top: 1px; margin-bottom: 1px;'>
                    <div class='box-header' data-original-title='' style='padding: 5px;'>
                        <h2><i class='icon-eye-open'></i><span class='break'></span>{$show['SeriesName']}</h2>
                        <div class='box-icon'>
                            <a href='http://thetvdb.com/?tab=series&id={$show['seriesid']}' target='_blank' class='btn-search'><i class='icon-search'></i></a>
                            <a href='#' class='btn-close'><i class='icon-remove'></i></a>
                        </div>
                        </div>
                        <div class='box-content'>
                            {$banner}
                            <strong>First Aired:</strong> <span class='label label-info'>{$firstaired}</span> <br />
                            <strong>Overview:</strong> {$overview}
                            <form name='show' class='tv-show' method='POST' action='/addshow/?action=add_show'><button type='submit' name='id' value='{$show['seriesid']}' class='tvrageshow btn btn-small btn-success' style='float: right'>This one!</button></form>
                        </div>
                    </div><!--/span-->
                    </div>
                ";

		}
	}

//New Function


}
