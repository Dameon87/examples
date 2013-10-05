<?php

class Newzbin {

	public static function Search($query, $type, $quality = null, $episode = null, $season = null) {
		$retention = Settings::fetch_setting('gen_retention');
		//pb_rb_os
		$catids = array(
			"games-pc" => "1",
			"games-mac" => "4",
			"games-linux" => "8",
			"apps-windows" => "1",
            "apps-mac" => "4",
            "apps-linux" => "8",
			"movie" => "6",
			"tv" =>	 "8",
		);
		//ps_rb_os
		$appcategory = array(
			"apps-windows" => "1",
			"apps-mac" => "4",
			"apps-linux" => "8",
		);
		//ps_rb_video_format
		$videoqualitys = array(
			"1080P" => "2097152",  //GOOD
			"720P" => "524288",    //GOOD
			"BRRip" => "262144",   //GOOD
			"DVDR" => "2",         //GOOD
			"3D" => "4194304",	   //GOOD
        );

		$baseurl = Settings::fetch_setting('search_newzbin_url');
		$username = Settings::fetch_setting('search_newzbin_username');
		$password = Settings::fetch_setting('search_newzbin_password');
		if ($type != 'tv' && $type != 'movie') {
			$platform = "ps_rb_os=".$catids[$type];
			$category = '&u_search_system=0&category=-1';
		} else {
			$platform = '';
			$category = "&category=".$catids[$type];
		}
		if ($quality != null) { $vidquality = "ps_rb_video_format=".$videoqualitys[$quality]; } else { $vidquality = ''; }
		$urldata = "?q=".$query."&feed=rss&searchaction=Search&u_show_passworded=0&".$vidquality.$platform.$category;
		$results = post($baseurl.$urldata, $username, $password);
		print_pre($baseurl.$urldata);
		//$results = file_get_contents($baseurl.$postdata);
		return $results;
	}

	public static function parse_results($results) {

		$xml = new SimpleXmlElement($results);
		foreach ($xml->channel->item as $item) {
			$ns = $xml->getNamespaces(true);
			$report = $item->children($ns['report']);
			$groups = '';
			$attributes = array();
			$Source = array();
			$VideoFmt = array();
			$VideoGenre = array();
			$Language = array();
			$Subtitles = array();
			$AudioFmt = array();
			$qualitytags = '';
			$langtags = '';
			$nfo = substr($report->nfo->filename, 0, -4);
			foreach ($report->groups->group as $group) {
				$groups .= $group.",";
			}
			foreach ($report->attributes->attribute as $attribute) {

				$attrtype = (string)$attribute->attributes()->type;
				$attrtype = str_replace(' ', '', $attrtype);
				if ($attrtype == 'Source') { $Source[] = $attribute; }
				if ($attrtype == 'VideoFmt') { $VideoFmt[] = $attribute; }
				if ($attrtype == 'AudioFmt') { $AudioFmt[] = $attribute; }
				if ($attrtype == 'Language') { $Language[] = $attribute; }
			}
			foreach ($VideoFmt as $vidformat) {
				if (substr($vidformat, -1) == 'p') {
					$qualitytags .= "<span class='label label-success'>{$vidformat}</span> ";
				} else {
					$qualitytags .= "<span class='label label-info'>{$vidformat}</span> ";
				}
			}
			foreach ($Language as $lang) {
            	$langtags .= "<span class='label label-info'>{$lang}</span> ";
            }
			foreach ($AudioFmt as $audformat) {
				$qualitytags .= "<span class='label label-info'>{$audformat}</span> ";
			}
			$groups = trim($groups, ',');
			echo "<tr>";
            echo "<td><a href='{$item->link}'>{$report->id}</a></td>";
            echo "<td>{$item->title}<br /><font size='1'>{$nfo}</font></td>";
			echo "<td>{$qualitytags}<br /> {$langtags}</td>";
            echo "<td>{$report->postdate}</td>";
            //echo "<td>{$groups}</td>";
            echo "<td>Newzbin</td>";
            echo "<td class='grabnzb'><form method='POST' action='/actions/sab.php?action=getbyid' class='getnzb' name='getnzb'><input type='hidden' name='postid' value='{$report->id}'> <button type='submit' class='btn btn-small btn-success'><i class='icon-white icon-download'></i>Grab!</button></form></td>";
            echo "</tr>";
		}
	}

}
