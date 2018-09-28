<?php
	session_start();
	if(!isset($_SESSION['UserId'])){
		header("Location: login.php");
	}
?>
<?php
//include('../config.php');
//if($_SESSION['Role']==1) {
//    include('controller/c_index.php');
//}


?>