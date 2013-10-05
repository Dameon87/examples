<?php
namespace Media\MediaBundle\Custom;

class Settings {
	public static function fetch_setting($setting, $conn) {
        $result = $conn->fetchAll("SELECT * FROM settings WHERE name='{$setting}';");
   		$value = $result[0]['value'];
    	return $value;
    }
}
