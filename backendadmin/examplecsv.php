<?php
// by Andrew Cetinick
// jumbabox.com 2008
 
// CONFIG //
//Help:http://www.jumbabox.com/2008/05/php-export-to-csv-with-iefirefox-support/

include_once("admin.config.inc.php");
include("connect.php");

// Must be a writeable location for file
$output_file="export.csv";
 
// The query to output to CSV
$sql = "select * from countries";
// Support for multi-table select
// $sql = "SELECT * FROM tbl2, tbl1 WHERE tbl1.col1 = tbl2.col2";
 
//---------------------------------------------------
 
// Connect database
//db_connect($host,$username,$password,$DATABASENAME);
//db_select_db($database);
 
$result=db_query($sql);
 
$output = '';
 
// Get a list of all the fields in the table
// $fields = db_list_fields($database,$table);
// Count the number of fields
$count_fields = db_num_fields($result);
 
// Put the name of all fields to $out.
for ($i = 0; $i < $count_fields; $i++) 
{
	$field=db_fetch_field($result);
	$output.= '"'.$field->name.'",';
}
$output .="\n";
 
// Add all values in the table to $out.
while ($row = db_fetch_array($result)) 
{
	for ($i = 0; $i < $count_fields; $i++) 
	{
		$output .='"'.$row["$i"].'",';
	}
	$output .="\n";
}
 
// Output the file to the local filesystem.  You could append a 
// date to the filename to keep a record of the exports.
 
// Open a new output file
$file = fopen ($output_file,'w');
// Put contents of $output into the $file
fputs($file, $output);
fclose($file);
 
// This line will stream the file to the user rather than spray it across the screen
header("Content-type: application/octet-stream");
// Internet Explorer support 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=report.csv");
header("Pragma: no-cache");
header("Expires: 0");
readfile($output_file);
//echo $output;
?>