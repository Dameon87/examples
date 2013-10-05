<?php

class Newznab {

	public static function Search($searchfor, $type, $quality = null, $season = null, $episode = null) {

		global $db;
		$nnserver = Settings::fetch_setting('search_newznab_server');
		$nnapikey = Settings::fetch_setting('search_newznab_apikey');
		$baseurl = "{$nnserver}api/?apikey={$nnapikey}";
		$capstring = "&t=caps";
		// First lets get a list of the capabilities, and the category IDs. This saves having to physically store them, and we can use name matching instead.
		$capurl = $baseurl.$capstring;
		$capabilities = simplexml_load_file($capurl);
		print_pre($capurl);
		$moviecats = array();
		//print_pre($capabilities->categories);
		foreach ($capabilities->categories->category as $category) {
			${$category->attributes()->name} = array();
			$catname = (string)$category->attributes()->name;
			${$catname} = array();
			${$catname.'id'} = (int)$category->attributes()->id;
			//print_pre($Movies);
			//print_pre($category);
			foreach ($category->subcat as $subcat) {
				$subcatid = (int)$subcat->attributes()->id;
				$subcatname = (string)$subcat->attributes()->name;
				${$catname}[$subcatname] = $subcatid;
				//echo "<pre>{$category->attributes()->name} - {$subcat->attributes()->name} ({$subcat->attributes()->id})</pre>";
			}
			//echo "<pre>Category: {$catname}<br />";
			//print_r(${$catname});
			//echo "</pre>";
		}
		$ss = "&t=".strtolower($type);
		$qs = "&q=".urlencode($searchfor);
		if($quality != null) {
			if (isset(${$type}[$quality])) { $catid = ${$type}[$quality]; $quals = "&cat={$catid}"; } else { $quals = ''; }
			if (strtolower($quality) == 'any') { $quals = "&cat=".${$type.'id'}; }
		}
		if(strtolower($type) == "tv") { $ss .= "search"; }
		if(strtolower($type) == "movies") { $ss = "&t=movie"; }
		$searchurl = "{$baseurl}{$ss}{$qs}{$quals}&extended=1";
		print_pre($searchurl);
		$results = simplexml_load_file($searchurl);
		foreach($results->channel->item as $item) {
			echo "<tr>";
            echo "<td>{$item->guid}</td>";
            echo "<td>{$item->title}</td>";
            echo "<td>{$item->category}</td>";
            echo "<td>N/A</td>";
            echo "<td>Newznab</td>";
            echo "<td><a href='#NZBtoSAB' class='btn btn-small btn-success'><i class='icon-white icon-download'></i>Grab!</a>";
            echo "</tr>";
		}
	}

}
