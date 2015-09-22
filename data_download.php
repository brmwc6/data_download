<?PHP

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		//===================================================
		//	GET THE QUESTION AND ANSWERS FROM THE FORM
		//===================================================

	$data_type = $_POST['data_type'];

	if ($data_type == 'survey') {
		$file_name = '/Users/brmwc6/Sites/data_download/survey_data.csv';
		$download_file = 'survey_data.csv';
	}
	else {
		$file_name = '/Users/brmwc6/Sites/data_download/gps_data.csv';
		$download_file = 'gps_data.csv';
	}


		//============================================
		//	OPEN A CONNECTION THE DATABASE
		//============================================
	
	$user_name = "root";
	$password = "benM#059";
	$database = "brmwc6_4380";
	$server = "localhost";

	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) {

		$SQL = "SELECT * FROM survey";
		echo $SQL;
		$result = mysql_query($SQL);

		if (!$result) {
		    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
		    exit;
		}

		if (mysql_num_rows($result) == 0) {
		    echo "No rows found, nothing to print so am exiting";
		    exit;
		}

		$data = array();
		while ($row = mysql_fetch_assoc($result)){
			print $row['item_collection_id'].'--';
 			$data[] = $row[0]; // add the row in to the results (data) array
		}

		//=========================================================
		//	Download selected data to CSV file
		//=========================================================

		//foreach ($data as $value) {

		//	$SQL = "SELECT S.item_collection_id, S.name, S.description INTO OUTFILE '".$file_name."' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' FROM Survey S WHERE S.item_collection_id = ".$value;
		//	$result = mysql_query($SQL);

		//	$SQL = "SELECT Q.question_order, Q.label, Q.help_text INTO OUTFILE '".$file_name."' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' FROM data_item D, question Q WHERE D.item_collection_id = ".$value." AND D.data_item = Q.data_item";
		//	$result = mysql_query($SQL);

		//	mysql_close($db_handle);

		//	print "The data file has been created.";
		//}


	}
	else {
		print "Database NOT Found ";
		mysql_close($db_handle);
	}



}


?>
<?PHP

if (empty($_POST)) {
?>

<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />

<div class="content-wrapper">
        <div class="container">
              <div class="row">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Download Data
                        </div>
                        <div class="panel-body">
                       <form action="" method="post">
  <div class="form-group">
  	<label>Select Data to Download</label>
    <select name="data_type" class="form-control">
    	<option value="survey">Survey Data</option>
    	<option value="gps">GPS Data</option>
    </select>
  </div>
  <button type="submit" name="submit" class="btn btn-default">Fetch Data</button>
  </form>


<?PHP
}
else {
?>

<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />

<div class="content-wrapper">
        <div class="container">
              <div class="row">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Options
                        </div>
                        <div class="panel-heading">
                           <a href="<?php echo $download_file;?>"><button type="submit" name="submit3" class="btn btn-default">Download Data</button></a>
                        </div>
<form action="data_download.php">
<button type="submit" name="submit3" class="btn btn-default">Back to Data Download</button>
</form>


<?PHP
}
?>