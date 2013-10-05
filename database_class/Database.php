<?php
/**
* Simple class for MySQL database connection with a .ini formatted configuration file.
* @author Jonathon Bischof
* @copyright 2013 Jonathon Bischof
* @license http://www.gnu.org/licenses/gpl-2.0.html
*/
if(class_exists('Database') != true) {
	class Database {

		private $connection;
		public $last_query;
		private $magic_quotes_active;
		private $real_escape_string_exists;
		private $server;
		private $user;
		private $pass;
		private $database;
		private $port;

		function __construct() {
			// Our constructor
			if (!class_exists('Config')) {
                require_once('Config.php');
            }
			$this->open_connection();
			$this->magic_quotes_active = get_magic_quotes_gpc();
			$this->real_escape_string_exists = function_exists( "mysqli_real_escape_string" );
		}

		function __destruct() {
			// Our destructor
			if (isset($this->connection)) {
				mysqli_close($this->connection);
				unset($this->connection);
			}
		}

		public function open_connection() {
			// Opens the database connection by the Config class.
			$server = Config::getConfig('Database', 'host');
			$user = Config::getConfig('Database', 'user');
			$pass = Config::getConfig('Database', 'pass');
			$database = Config::getConfig('Database', 'database');
			$this->connection = mysqli_connect($server, $user, $pass, $database);
			if (!$this->connection) {
				die("Database connection failed: " . mysqli_error($this->connection));
			}
		}

		public function close_connection() {
			// Closes the database connection.
			if (isset($this->connection)) {
				mysqli_close($this->connection);
				unset($this->connection);
			}
		}

		public function query($sql) {
			// Executes a query, and then confirms it; returning the result set.
			$this->last_query = $sql;
			$result = mysqli_query($this->connection, $sql);
			$this->confirm_query($result);
			return $result;
		}

		private function confirm_query($result) {
			// Confirms the query executed successfully, or returns the error associated.
			if (!$result) {
	    		$output = "Database query failed: <br />" . mysqli_error($this->connection) . "<br />";
	    		// Uncomment the next line if you wish to see the query executed with the error.
	    		//$output .= "Last Query {$this->last_query}";
	    		die($output);
			}
		}

		public function fetch_array($result_set) {
			// Returns an array of the result set.
			return mysqli_fetch_array($result_set);
		}

   		public function fetch_assoc($result_set) {
   			// Returns an associative array of the result set.
            return mysqli_fetch_assoc($result_set);
        }

        public function fetch_object($result_set) {
        	// Returns an object of the result set.
        	return mysqli_fetch_object($result_set);
        }

		public function prep_string($value) {
			// Prepares a string to be inserted using mysqli_real_escape_string, or falling back to simply addslashes().
			// This also compensates for magic_quotes being active. (Though hopefully they aren't!)
			// Note: magic_quotes has been removed in PHP 5.4.
			if ($this->real_escape_string_exists) {
				if ($this->magic_quotes_active) { $value = stripslashes($value); }
				$value = mysqli_real_escape_string($this->connection, $value);
			} else {
				if (!$this->magic_quotes_active) { $value = addslashes($value); }
			}
			return $value;
		}

		public function num_rows($result_set) {
			// returns number of rows of a result set
			return mysqli_num_rows($result_set);
		}

		public function insert_id() {
		// get id of the last inserted item
			return mysqli_insert_id($this->connection);
		}

		public function affected_rows() {
			// get affected rows of last query
			return mysqli_affected_rows($this->connection);
		}

	}
}
//require_once('Config.php');
global $db;
$db = new Database();
//Insert Tests here if desired.
//Sample insert
$sometable = 'test';
$somename = $db->prep_string("Jonathon Bischof");
$sometext = $db->prep_string("It's simple isn't it?");
$somequery = $db->query("INSERT INTO {$sometable} (name, bio, date) VALUES('{$somename}', '{$sometext}', NOW() )");
// Grab the id of the inserted item.
$someid = $db->insert_id();
// Fetch an object by using the id.
$someresult = $db->fetch_object($db->query("SELECT * FROM {$sometable} WHERE id='{$someid}'"));
// var_dump() it out.
var_dump($someresult);
?>



