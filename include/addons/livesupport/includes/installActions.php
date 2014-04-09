<?php
clearstatcache();
//installation file
if(!empty($_GET['step'])) {
$step = $_GET['step'];
// step 1 - Welcome
	if($step == 1) {
	?>
	<p>Hello, and welcome to the live support installation application.  Here, you will be guided through the installation of your live support chat system.  To begin, click the continue button</p>
        <p><button type="submit" name="cancel" value="next" onClick="loadStep('2');">Continue</button></p>
	<?
	} // end step 1
// step 2 - check permissions
	if($step == 2) {
	$errors = 0;
	echo '<h3>Checking file permissions</h3>';
		// check to make sure includes directory is writeable
		$includesFile = "writeTest.txt";
		$archiveFile = "../archive/writeTest.txt";
		if(is_writable($includesFile)) {
			echo '<div class="success"><p>Includes directory is writeable!</div>';
		} else {
			echo '<div class="error"><p>Includes directory is NOT writeable! please alter permissions manually.</div>';
			$errors = 1;
		}
		if(is_writable($archiveFile)) {
                        echo '<div class="success"><p>Archive directory is writeable!</div>';
                } else {
                        $errors = 1;
			echo '<div class="error"><p>Archive directory is not writeable, please alter permissions manually.</div>';
                }
		clearstatcache();
		if($errors == 0) {
			?><p><button type="submit" name="cancel" value="next" onClick="loadStep('3');">Continue</button></p><?
		} else {
			?><p>Please fix the errors above, then click retry.  <button type="submit" name="cancel" value="retry" class="del" onClick="loadStep('2');">Retry</button></p><?
		}
	} // end step 2
	if($step == 3) {
		// creat mysql connection and tables
		?>
		<h3>MySQL Setup</h3>
		<p>This section of the installer will create the connection to your MySQL database, and setup the relevant tables.</p>
		<form method="post" action="install.php">
		<label for="host">Database Host, normally 'localhost'</label><br/>
		<input type="text" id="host" name="host" class="input_field" onKeyup="sqlHide();"><br />
		<label for="host">Database name, if you want to create a new database, enter its name here, otherwise enter the name of your existing database</label><br/>
		<input type="text" name="name" id="name" class="input_field" onKeyup="sqlHide();"><br />
		<label for="username">MySQL Username</label><br/>
		<input type="text" name="username" id="username" class="input_field" onKeyup="sqlHide();"><br />
		<label for="password">MySQL Password</label><br/>
		<input type="password" name="password" id="password" class="input_field" onKeyup="sqlHide();"><br />
		<button type="submit" id="sql_submit" name="db_install" value="next">create config and tables</button>
		</form>
		<script type="text/javascript">sqlHide();</script>
		<?
		} // end step 3
		// step 4, make sure tables created
		if($step == 4 ) {
		$output = "";
		$errors = 0;
		if(file_exists("base.php")) {
			include "base.php";
			$output = $output . '<div class="success"><p>base.php created!</p></div>';
		} else {
			$output = $output . '<div class="error"><p>Error creating base.php!</p></div>';
		}
		function table_exists ($table, $db) { 
			$tables = db_list_tables ($db); 
				while (list ($temp) = db_fetch_array ($tables)) {
					if ($temp == $table) {
						return TRUE;
					}
				}
			return FALSE;
		}
		if(table_exists("sessions",$dbname)) {
			$output = $output . '<div class="success"><p>Sessions table created!</p></div>';
		} else {
			$output = $output . '<div class="error"><p>Error creating sessions table!</p></div>';
			$errors = 1;
		}
		if(table_exists("transcript",$dbname)) {
			$output = $output . '<div class="success"><p>Transcript table created!</p></div>';
		} else {
			$output = $output . '<div class="error"><p>Error creating transcript table!</p></div>';
			$errors = 1;
		}
		if(table_exists("archive",$dbname)) {
			$output = $output . '<div class="success"><p>Archive table created!</p></div>';
		} else {
			$output = $output . '<div class="error"><p>Error creating archive table!</p></div>';
			$errors = 1;
		}
		if(table_exists("users",$dbname)) {
			$output = $output . '<div class="success"><p>Users table created!</p></div>';
		} else {
			$output = $output . '<div class="error"><p>Error creating users table!</p></div>';
			$errors = 1;
		}
		if(table_exists("leads",$dbname)) {
			$output = $output . '<div class="success"><p>Leads table created!</p></div>';
		} else {
			$output = $output . '<div class="error"><p>Error creating leads table!</p></div>';
			$errors = 1;
		}
		if(table_exists("config",$dbname)) {
			$output = $output . '<div class="success"><p>Config table created!</p></div>';
		} else {
			$output = $output . '<div class="error"><p>Error creating config table!</p></div>';
			$errors = 1;
		}
		if($errors == 0) {
			echo $output;
			?><p><button type="submit" name="cancel" value="next" onClick="loadStep('5');">Continue</button></p><?
		} else {
			echo $output;
			?><p><button type="submit" name="cancel" value="next" class="del" onClick="loadStep('3');">Retry</button></p><?
		}
		} // end step 4
		// step 5 - user creation
		if($step == 5) {
		?>
		<h3>Create your admin user</h3>
		<form method="post" action="install.php">
                <label for="name">Name</label><br />
                <input type="text" name="name" id="name" class="input_field" size="40"><br />
                <label for="password">Password</label><br />
                <input type="password" name="password" id="password" class="input_field" size="40"><br />
                <label for="email">Email Address</label><br />
                <input type="text" name="email" id="email" class="input_field" size="40"><br />
                <label for="username">Username</label><br />
                <input type="text" name="username" id="username" class="input_field" size="40"><br />
		<button type="submit" name="add_user" value="next">Continue</button>
	        </form>
		<?
		} // end step 5
		// step 6, all done!
		if($step == 6) {
		?>
		<h3>All Done!</h3>
		<p>Congratulations, everything is now installed.  Please <a href="login.php"><span class="red">Click Here</span></a> to log into your support system!</a>
		<?
		}
} // end if ! empty get
?>
