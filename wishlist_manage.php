<?php
session_start();
include('database.inc.php');
include('function.inc.php');

$pid=get_safe_value($_POST['id']);
$type=get_safe_value($_POST['type']);

if(isset($_SESSION['USER_NAME'])){
	$uid=$_SESSION['USER_ID'];
	if(mysqli_num_rows(mysqli_query($con,"select * from wishlist where user_id='$uid' and product_id='$pid'"))>0){
		//echo "Already added";
	}else{
		//$added_on=date('Y-m-d h:i:s');
		//mysqli_query($con,"insert into wishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");
		wishlist_add($uid,$pid);
	}
	echo $total_record=mysqli_num_rows(mysqli_query($con,"select * from wishlist where user_id='$uid'"));
}else{
	$_SESSION['WISHLIST_ID']=$pid;
	echo "not_login";
}
?>