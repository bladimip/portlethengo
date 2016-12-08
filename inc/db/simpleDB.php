<?php
/*
Developed by Arnis Zelcs
Created: 28/10/2016

This is a simple ORM based on procedural mysqli and php.
Methods are developed to simplify the access and work with a DB.
Note: This is NOT a SECURE option and is build just to simplify and automate some operations.

To use this class for a cpecific project you have to specify the servername, db name, username and password.


CLASS METHODS:

	MAIN METHODS:
		open()
		runQuery()
		close()

	EXTRA:
		escape()


METHODS DESCRIPTION AND USAGE:

	DESCRIPTION:
		open() 												- create a connection to a database
		runQuery( ***query goes here*** ) 					- execute a query passed as a parameter
		close() 											- close connection to a database
		escape() 											- escape special characters, characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.

	USAGE:
		Example.

		$db = new Connection(); 							- create a new connection instance
		$db->open(); 										- open a connection
		$users = $db->runQuery("SELECT * FROM users"); 		- execute a query and assign a query result to an variable
		$db->close(); 										- close a connection

		$notSafeString;										- escape special characters from a string and return an escaped string
		$safeString = $db->escape($notSafeString);

*/

////////////////////////////////////////////////
///////////   DB Connection Class   ////////////
////////////////////////////////////////////////


	class Connection {

		private $servername = "localhost";
		private $db = "webdev5";
		private $username = "root";
		private $password = "";
		private $myConn;
		private $result;

// Open
		public function open() {
			$conn = new mysqli($this->servername, $this->username, $this->password, $this->db);					// Create connection
			if ($conn->connect_error) {																			// Check connection
				die("Connection failed: " . $conn->connect_error);
			} else {
				$this->myConn = $conn;
				return $this->myConn;
			}
		}

// Query
		public function runQuery($query) {

			$this->result = $this->myConn->query($query);

			if ($this->result == TRUE) {
				//echo "Success";
			} else {
				echo "Error: " . $this->myConn->error;
			}

			return $this->result;
		}

// Close
		public function close() {
			$this->myConn->close();
		}

		public function getLastID() {
			$last_id = mysqli_insert_id($this->myConn);
			return $last_id;
		}

// Escape characters
		public function escape($str) {
			return mysqli_real_escape_string($this->myConn, $str);
		}

	}
?>
