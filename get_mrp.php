<?php
include('database.inc.php');
include('function.inc.php');

$pro_id=get_safe_value($_POST['pro_id']);
//$sub_cat_id=get_safe_value($_POST['sub_cat_id']);
$res=mysqli_query($con,"select * from product_details where id='$pro_id' and status='1'");
if(mysqli_num_rows($res)>0){
	$html=0;
	while($row=mysqli_fetch_assoc($res)){
		
			$html=$row['mrp'];
            $main_id=$row['product_id'];
    }
    $arr=array('html'=>$html,'main_id'=>$main_id);
	echo  json_encode($arr);
}else{
    
	echo "Not found";
}
?>