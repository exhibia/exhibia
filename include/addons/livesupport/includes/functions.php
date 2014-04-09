<?php
/*////////////////////////
// MAIN FUNCTIONS FILE //
///////////////////////*/
$archive_path = "";
// make textfile of given conversation
function createTxt($convoID) {
global $archive_path;
$userInfo = db_query("SELECT * FROM sessions WHERE convoID = '".$convoID."' ");
$result = db_fetch_array($userInfo);

	$name = "archive/" .$result['name'] . "-" . date('ljSY') . ".txt";

	$handle = fopen($name, 'w') or die("can't open file");
	$stringData = "Transcript of conversation with " . $result['name'] . " on " .  date('l-j-S-F-Y') . "\n\n";
	fwrite($handle,$stringData);

	$trans = db_query("SELECT * FROM transcript WHERE convoID = '".$convoID."' ORDER BY id ASC ");
	while ($row = db_fetch_array($trans)) {
		$message = strip_tags($row['message']);
		$stringData = $row['time'] . " - " . $row['name'] . " said :" . "\n" . $message . "\n\n";
		fwrite($handle,$stringData);
	}
fclose($handle);
$archive_path = $name;
}
// archive conversation
function archive($convoID,$name,$email) {
	include "date.php";
	$check = db_query("SELECT * FROM archive WHERE convoID = '".$convoID."' ");
	if(db_num_rows($check) == 0) {
		$scrape = db_query("SELECT * FROM transcript WHERE convoID = '".$convoID."' ORDER BY id ASC ");
		while($row = db_fetch_array($scrape)) {
			db_query("INSERT INTO archive (name,message,user,convoID,time,class) 
			VALUES
			('".$row['name']."','".$row['message']."','".$row['user']."','".$row['convoID']."','".$row['time']."','".$row['class']."')
			");
		}
		db_query("INSERT INTO leads (name,email,transcript,date)
                VALUES
                ('".$name."','".$email."','".$convoID."','".date('l jS \of F Y')."')
                ");
	}
}
// email archived convo
function send_archived($email,$convoID,$user,$user_email,$agent,$customer) {
global $archive_path;
	// assign vars
	$to = $email;
	$from = $user_email;
	$name = $user;
	$message = "Archived conversation between ".$agent." and ".$customer.", as requested.";
	$subject = "Archived conversation between ".$agent." and ".$customer;
	//create text version of message
	createTxt($convoID);
	// attach to email and send
	//Get the uploaded file information
        $name_of_uploaded_file = $archive_path;
        //get the file extension of the file
        $type_of_uploaded_file = substr($name_of_uploaded_file, strrpos($name_of_uploaded_file, '.') + 1);
	$headers = 'From: ' . $name;
        // Obtain file upload vars
        $fileatt      = $archive_path;
        // Read the file to be attached ('rb' = read binary)
        $file = fopen($fileatt,'rb');
        $data = fread($file,filesize($fileatt));
        fclose($file);
        // Generate a boundary string
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
	// Add the headers for a file attachment
        $headers .= "\nMIME-Version: 1.0\n" .
              "Content-Type: multipart/mixed;\n" .
              " boundary=\"{$mime_boundary}\"";
        // Add a multipart boundary above the plain message
        $message = "This is a multi-part message in MIME format.\n\n" .
             "--{$mime_boundary}\n" .
             "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
             "Content-Transfer-Encoding: 7bit\n\n" .
             $message . "\n\n";
        // Base64 encode the file data
        $data = chunk_split(base64_encode($data));
        // Add file attachment to the message
        $message .= "--{$mime_boundary}\n" .
              "Content-Type: {$type_of_uploaded_file};\n" .
              " name=\"{$name_of_uploaded_file}\"\n" .
              "Content-Disposition: attachment;\n" .
              " filename=\"{$name_of_uploaded_file}\"\n" .
              "Content-Transfer-Encoding: base64\n\n" .
              $data . "\n\n" .
              "--{$mime_boundary}--\n";
	// send the message
        $sendMail = @mail($to, $subject, $message, $headers);
	unlink($archive_path);
}
?>
