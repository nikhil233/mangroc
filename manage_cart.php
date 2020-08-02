<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
$type=get_safe_value($_POST['type']);
$attr=get_safe_value($_POST['attt']);
if($type=='add'){
	$qty=get_safe_value($_POST['qty']);
	if(isset($_SESSION['USER_ID'])){
		$uid=$_SESSION['USER_ID'];
		manageUserCart($uid,$qty,$attr);
		
	}else{
		$_SESSION['cart'][$attr]['qty']=$qty;
	}
	$getUserFullCart=getUserFullCart();
	$totalPrice=0;
	foreach($getUserFullCart as $list){
		$totalPrice=$totalPrice+($list['qty']*$list['price']);
	}
	
	$getProductDetail=getProductDetailById($attr);
	$price=$getProductDetail['price'];
	$product_name=$getProductDetail['name'];
	$image=$getProductDetail['image'];
	
	$totaProduct=count(getUserFullCart());
	$arr=array('totalCartProduct'=>$totaProduct,'totalPrice'=>$totalPrice,'price'=>$price,'product_name'=>$product_name,'image'=>$image);
	echo json_encode($arr);
}

if($type=='delete'){
	removeProductFromCartByid($attr);
	$getUserFullCart=getUserFullCart();
	$totaProduct=count($getUserFullCart);
	$totalPrice=0;
	foreach($getUserFullCart as $list){
		$totalPrice=$totalPrice+($list['qty']*$list['price']);
	}
	$arr=array('totalCartProduct'=>$totaProduct,'totalPrice'=>$totalPrice);
	echo json_encode($arr);
}


?>

