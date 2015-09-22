<?php

	$query = $_POST['word'];
	$old_data = $_POST['text'];

	$user_name = "root";
	$password = "benM#059";
	$database = "entries";
	$server = "localhost";

	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) {

		$SQL = "SELECT * FROM entries WHERE word='".$query."'";
		//echo $SQL;
		$result = mysql_query($SQL);

		if (!$result) {
		    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
		    exit;
		}

		$def_string = array();

		class definition {
    		public $word;
    		public $def;
		}


		$data = array();
		while ($row = mysql_fetch_assoc($result)){
			//$xyz = $row['word'].'- '.$row['definition'];
			$struct = new definition();
			$struct->word = $row['word'];
			$struct->def = $row['definition']; 
 			$data[] = $struct; // add the row in to the results (data) array
		}

	}
	else {
		print "Database NOT Found ";
		mysql_close($db_handle);
	}

	echo $old_data;

	foreach ($data as $value) {
		echo "<B>".$value->word."</b>"." - ".$value->def."<br><br>";
	}

?>