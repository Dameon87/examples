<?php
//Movies class

class Movies {

	public static function get_movies_from_dir() {
		//The purpose of this function is to grab all movies from a directory, and parse them into the DB.
		//First Iterations will simply output this to a table, for reference.
		$moviesdir = Settings::fetch_setting('gen_movies_dir');
        $handle = opendir($moviesdir);
		global $db;

        while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				echo "<tr>";
				echo "<td>{$entry}</td>";
				echo "<td>Initial</td>";
				echo "<td>0%</td>";
				echo "</tr>";
				$db->query("INSERT INTO movies VALUES (\"{$entry}\", '0000', '0', '0', \"MOVIEDIR/{$entry}\", '0', '0')");
			}
    	}

	}

	public static function check_imdbapi($input) {
		$apilink = "http://www.deanclatworthy.com/imdb/?";
		$search = trim(preg_replace('/\s*\([^)]*\)/', '', $input));
		$search = urlencode($search);

		if (preg_match('!\(([^\)]+)\)!', $input, $year)) {
			if (is_numeric($year[1])) {
    			$year = "&year=".$year[1];
			} else {
				$year = '';
			}
		} else {
			$year = '';
		}

		$request = file_get_contents($apilink."q=".$search.$year."&type=json");
		$result = json_decode($request);
		print_pre($result);
		echo $input;
	}

	public static function list_movies($by) {
		global $db;
		if (isset($_GET['showonly'])) { $by = $_GET['showonly']; }
        if ($by != 'none') {
			$initquery = "SELECT * FROM movies WHERE name like '{$by}%' order by name";
		} else {
			$initquery = "SELECT * FROM movies order by name";
		}
		$initresults = $db->query($initquery);
		while ($initresult = $db->fetch_assoc($initresults)) {
			echo "<tr>";
			echo "<td><img height='70px' width='50px' src='/templates/default/images/movie-placeholder.png'></td>";
			echo "<td><a href='/movie/?id={$initresult['id']}'>{$initresult['name']}</a></td>";
			echo "<td><span class='label label-info'>{$initresult['year']}</span></td>";
			echo "<td>{$initresult['imdb']}</td>";
			echo "</tr>";
		}
	}

	public static function create_jump_list() {
		$showonly = '';
		echo "<a href='/movies' class='btn btn-small btn-inverse'>ALL</a>&nbsp;";
		if (isset($_GET['showonly'])) { $showonly = $_GET['showonly']; } else { $showonly == ''; }
		foreach (range('0', '9') as $char) {
			if ($showonly == (string)$char) {
            	echo "<a href='/movies/?showonly={$char}' class='btn btn-small btn-success'>{$char}</a>&nbsp;";
			} else {
				echo "<a href='/movies/?showonly={$char}' class='btn btn-small btn-default'>{$char}</a>&nbsp;";
			}
        }
		echo " | | &nbsp;";
		foreach (range('A', 'Z') as $char) {
			if ($showonly == (string)$char) {
                echo "<a href='/movies/?showonly={$char}' class='btn btn-small btn-success'>{$char}</a>&nbsp;";
            } else {
                echo "<a href='/movies/?showonly={$char}' class='btn btn-small btn-default'>{$char}</a>&nbsp;";
            }
		}

	}

}
