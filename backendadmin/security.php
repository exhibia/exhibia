<?
if ( !isset($_SESSION['logedin']) ) {
?>
<script language="javascript">window.parent.location.replace("index.php");</script>
<?
	exit;
}


?>