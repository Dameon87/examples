<?php
/**
* Simple config class for reading from a .ini configuration file.
* @author Jonathon Bischof
* @copyright 2013 Jonathon Bischof
* @license http://www.gnu.org/licenses/gpl-2.0.html
*/
class Config {
	private config_file = 'config.ini';
	function __construct() {
		$this->config = parse_ini_file($config_file, true);
	}
	public $config;
	// This example simply assumes the configuration file is config.ini, located in the same directory.
	public function openConfig() {
		$this->config = parse_ini_file($config_file, true);
	}

	public static function getConfig($section, $key)
	{
		$config = parse_ini_file('config.ini', true);
		return $config[$section][$key];
	}

	// No setConfig function is included for sake of the example (as it would not be used.)
}

