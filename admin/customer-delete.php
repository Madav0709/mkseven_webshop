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
	}
}
?>

<?php

	// Delete from tbl_customer
	$statement = $pdo->prepare("DELETE FROM tbl_customer WHERE cust_id=?"); //preparing the database
	$statement->execute(array($_REQUEST['id'])); //executing

	header('location: customer.php');
?>