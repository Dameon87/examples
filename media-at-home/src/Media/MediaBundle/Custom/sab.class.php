<?php

class Sab {

	public static function info() {
		$sabinfo = file_get_contents("http://10.0.0.199:8080/api?mode=qstatus&output=json&apikey=8ba828ff1a208c9fc7042fd266224042");
		$sabinfo = json_decode($sabinfo);
		$mbleft = round($sabinfo->mbleft, 2);
		echo "<button class='btn btn-small' rel='tooltip' title='Time Remaining'>$sabinfo->timeleft left</button>";
		echo " <button class='btn btn-small' rel='tooltip' title='MB Remaining'>$mbleft MB left</button>";
		echo " <button class='btn btn-small curspeed' rel='tooltip' title='Current Download Speed'>$sabinfo->speed/s </button>";
		echo " <button class='btn btn-small' rel='tooltip' title='Current State'>$sabinfo->state </button>";
	}

	public static function format_queue($input = null) {
		$url = "http://10.0.0.199:8080/api?mode=queue&output=json&apikey=8ba828ff1a208c9fc7042fd266224042";
		$input = json_decode(file_get_contents($url));
		// Separate out the queue items from misc info
		$queue = $input->queue->slots;
		//print_pre($queue);
		foreach ($queue as $item) {
			if ($item->status == "Downloading") {
				$status = "<form method='POST' action='/actions/sab.php?action=pause&id={$item->nzo_id}'> <button type='submit' class='btn btn-small btn-success'><i class='icon-white icon-download'></i></button></form>";
			} else if ($item->status == "Queued") {
				$status = "<button class='btn btn-small btn-warning'><i class='icon-white icon-time'></i></button>";
			} else if ($item->status == "Paused") {
				$status = "<a href='/actions/sab.php?action=resume&id={$item->nzo_id}' class='btn btn-small btn-warning'><i class='icon-white icon-pause'></i></a>";
			}
			$name = substr($item->filename, 0, 30);
			$remainingsize = round($item->mb - $item->mbleft, 2);
			echo "<tr>";
			echo "<td style='text-align: center'><div style='margin-top:8px;'>$status</div></td>";
			echo "<td><span class='tooltip' rel='tooltip' title='$item->filename' style='opacity: 1; position: relative'>$name</span></td>";
			echo "<td><div class='progress' style='margin-top:10px;'><div class='bar' style='width: $item->percentage%;'></div></div></td>";
			echo "<td><div style='margin-top:8px; text-align: center;'><span class='label label-info'>$remainingsize <font size='1'>MB</font> / $item->mb <font size='1'>MB</font></span></div></td>";
			echo "<td><span class='tooltip' rel='tooltip' title='$item->eta' style='opacity: 1; position: relative; text-align: center;'>$item->timeleft</span></td>";
			echo "<td><select style='width: 130px; text-align: center;'><option value='$item->cat'>$item->cat</option></select></td>";
			echo "<td><select style='width: 130px; text-align: center;'><option value='$item->priority'>$item->priority</option></select></td>";
			echo "<td><select style='width: 130px; text-align: center;'><option value='$item->script'>$item->script</option></select></td>";
			echo "</tr>";
		}
	}

	public static function format_history($input = null) {
		$url = "http://10.0.0.199:8080/api?mode=history&output=json&limit=10&apikey=8ba828ff1a208c9fc7042fd266224042";
		$input = json_decode(file_get_contents($url));
		$history = $input->history->slots;
		//print_pre($history);
		foreach ($history as $item) {
			$seconds = $item->download_time+$item->postproc_time;
			$hours = floor($seconds / 3600);
			$mins = floor(($seconds - $hours*3600) / 60);
			$s = $seconds - ($hours*3600 + $mins*60);

			$mins = ($mins<10?"0".$mins:"".$mins);
			$s = ($s<10?"0".$s:"".$s);

			$time = ($hours>0?$hours.":":"").$mins.":".$s;

			if ($item->status == "Completed") {
                $status = "<button class='icon-download btn btn-success disabled' />";
				$scriptline = "<font color='green'>{$item->script_line}</font>";
            } else if ($item->status == "Failed") {
				$status = "<button class='icon-failed btn btn-danger disabled' />";
				$scriptline = "<font color='red'>{$item->stage_log[0]->actions[0]}</font>";
			} else {
                $status = "<i class='icon-pause' />";
            }
			echo "<tr>";
			echo "<td>$status</td>";
			echo "<td>$item->name</td>";
			echo "<td>$scriptline</td>";
			echo "<td>$time</td>";
			echo "</tr>";
		}
	}


	public static function set_speed($speed) {
		$result = file_get_contents("http://10.0.0.199:8080/api?mode=config&name=speedlimit&value={$speed}&apikey=8ba828ff1a208c9fc7042fd266224042");
		if (trim($result) == "ok") { header("Location: /downloads"); }
	}

	public static function pause_item($item) {
		$request = file_get_contents("http://10.0.0.199:8080/api?mode=queue&name=pause&value={$item}&apikey=8ba828ff1a208c9fc7042fd266224042");
        if (trim($request) == "ok") { header("Location: /downloads"); }
	}

	public static function resume_item($item) {
        $request = file_get_contents("http://10.0.0.199:8080/api?mode=queue&name=resume&value={$item}&apikey=8ba828ff1a208c9fc7042fd266224042");
        if (trim($request) == "ok") { header("Location: /downloads"); }
    }

	public static function send_to_sab($postid) {
        //Since SAB can auto grab by newzbin ID, we will toss it that way. Why reinvent the wheel?
        $saburl = Settings::fetch_setting('sab_url');
        $sabapikey = Settings::fetch_setting('sab_api_key');
        $url = $saburl."/api/?apikey=".$sabapikey."&mode=addid&name=".$postid;
        $result = file_get_contents($url);
		echo $result." {$postid}";
        if (trim($result) == 'ok') {
            echo 'Added';
        } else {
            echo 'Add failed!';
        }
    }

}
