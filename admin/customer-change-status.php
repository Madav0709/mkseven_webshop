<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=?"); //preparing the database
	$statement->execute(array($_REQUEST['id'])); //executing
	$total = $statement->rowCount();
	if( $total == 0 ) { //if the row is empty
		header('location: logout.php'); //then relocate to logout.php
		exit;
	} else {
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);	//else fetch all the data						
		foreach ($result as $row) { //convert the resualt as row
			$cust_status = $row['cust_status'];  //making a funtion of customer status from data imported from database
		}
	}
}
?>

<?php
if($cust_status == 0) {$final = 1;} else {$final = 0;} // if status = 0 then change to 1. If not viceverse
$statement = $pdo->prepare("UPDATE tbl_customer SET cust_status=? WHERE cust_id=?");  //preparing the database
$statement->execute(array($final,$_REQUEST['id'])); //executing

header('location: customer.php');
?>