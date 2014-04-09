<?
/******************************************************/
// open the text file
$fd = fopen ("reports/affiliatereport.csv", "r");
// initialize a loop to go through each line of the file
while (!feof ($fd)) {
$buffer = fgetcsv($fd, 4096); // declare an array to hold all of the contents of each
//row, indexed
echo "<BR>";
// this for loop to traverse thru the data cols
// when this is re-created with MySQL use the db_num_fileds() function to get
// this number
for ($i = 0; $i < 5; ++$i){
if ($buffer[$i] == ""){
$buffer[$i] = " ";
}
// print 's with each index
echo " $buffer[$i] |";
}
echo "<BR>";
}
fclose ($fd);

?>