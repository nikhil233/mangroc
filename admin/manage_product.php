<?php 
include('top.php');

$msg="";
$category_id="";
$name="";
$product_detail="";
$image="";
$best_seller='';
$type="";
$id="";
$image_status='required';
$image_error="";
$sub_categories_id='';
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$id'"));
	$category_id=$row['category_id'];
	$name=$row['name'];
	$type=$row['type'];
	
	$product_detail=$row['product_detail'];
	$image=$row['image'];
	$sub_categories_id=$row['sub_categories_id'];
	$best_seller=$row['best_seller'];
	$image_status='';
}

if(isset($_GET['product_details_id']) && $_GET['product_details_id']>0){
	$product_details_id=get_safe_value($_GET['product_details_id']);
	$id=get_safe_value($_GET['id']);
	mysqli_query($con,"delete from product_details where id='$product_details_id'");
	redirect('manage_product.php?id='.$id);
}

if(isset($_POST['submit'])){
	
	$category_id=get_safe_value($_POST['category_id']);
	$name=get_safe_value($_POST['name']);
	$product_detail=get_safe_value($_POST['product_detail']);
	
	$sub_categories_id=get_safe_value($_POST['sub_categories_id']);
	$food_type=get_safe_value($_POST['type']);
	$best_seller=get_safe_value($_POST['best_seller']);
	$added_on=date('Y-m-d h:i:s');
	
	if($id==''){
		$sql="select * from product where name='$name'";
	}else{
		$sql="select * from product where name='$name' and id!='$id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="product already added";
	}else{
		$type=$_FILES['image']['type'];
		if($id==''){
			if($type!='image/jpeg' && $type!='image/png'){
				$image_error="Invalid image format";
			}else{
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],SERVER_PRODUCT_IMAGE.$image);
				mysqli_query($con,"insert into product(category_id,sub_categories_id,name,product_detail,status,added_on,image,type,best_seller) values('$category_id','$sub_categories_id','$name','$product_detail','$mrp',1,'$added_on','$image','$food_type','$best_seller')");
				$did=mysqli_insert_id($con);
				
				$attributeArr=$_POST['attribute'];
				$priceArr=$_POST['price'];
				$statusArr=$_POST['status'];
				$mrpArr=$_POST['mrp'];
				foreach($attributeArr as $key=>$val){
					$attribute=$val;
					$mrp=$mrpArr[$key];
					$price=$priceArr[$key];
					$status=$statusArr[$key];
					mysqli_query($con,"insert into product_details(product_id,attribute,mrp,price,status,added_on) values('$did','$attribute','$mrp','$price','$status','$added_on')");
					//echo "insert into product_details(product_id,attribute,price,status,added_on) values('$did','$attribute','$price',1,'$added_on')";
				}
			
				redirect('product.php');
			}
		}else{
			$image_condition='';
			if($_FILES['image']['name']!=''){
				if($type!='image/jpeg' && $type!='image/png'){
					$image_error="Invalid image format";
				}else{
					$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
					move_uploaded_file($_FILES['image']['tmp_name'],SERVER_PRODUCT_IMAGE.$image);
					$image_condition=", image='$image'";
					
					$oldImageRow=mysqli_fetch_assoc(mysqli_query($con,"select image from product where id='$id'"));
					$oldImage=$oldImageRow['image'];
					unlink(SERVER_PRODUCT_IMAGE.$oldImage);
		
				}
			}
			if($image_error==''){
				$sql="update product set category_id='$category_id',sub_categories_id='$sub_categories_id', name='$name' , product_detail='$product_detail', type='$food_type',best_seller='$best_seller' $image_condition where id='$id'";
				mysqli_query($con,$sql);
				$attributeArr=$_POST['attribute'];
				$mrpArr=$_POST['mrp'];
				$priceArr=$_POST['price'];
				$statusArr=$_POST['status'];
				$productDetailsIdArr=$_POST['product_details_id'];
				
				foreach($attributeArr as $key=>$val){
					$attribute=$val;
					$price=$priceArr[$key];
					$status=$statusArr[$key];
					$mrp=$mrpArr[$key];
					if(isset($productDetailsIdArr[$key])){
						$did=$productDetailsIdArr[$key];
						mysqli_query($con,"update product_details set attribute='$attribute',mrp='$mrp',price='$price',status='$status' where id='$did'");
					}else{
						mysqli_query($con,"insert into product_details(product_id,attribute,mrp,price,status,added_on) values('$id','$attribute','$mrp','$price','$status','$added_on')");
					}
					
					
					//echo "insert into product_details(product_id,attribute,price,status,added_on) values('$did','$attribute','$price',1,'$added_on')";
				}
				
				
				redirect('product.php');
			}
		}
	}
}
$res_category=mysqli_query($con,"select * from category where status='1' order by category asc");
$arrType=array("veg","non-veg");
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">product</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Category</label>
                      <select class="form-control" name="category_id"  id="category_id" onchange="get_sub_cat('')" required>
						<option value="">Select Category</option>
						<?php
						$res_category=mysqli_query($con,"select id,category from category where status='1' order by category asc");
						while($row_category=mysqli_fetch_assoc($res_category)){
							if($row_category['id']==$category_id){
								echo "<option value='".$row_category['id']."' selected>".$row_category['category']."</option>";
							}else{
								echo "<option value='".$row_category['id']."'>".$row_category['category']."</option>";
							}
						}
						?>
					  </select>
					  
					</div>
					<div class="form-group">
									<label for="categories" class=" form-control-label">Sub Categories</label>
									<select class="form-control" name="sub_categories_id" id="sub_categories_id">
										<option>Select Sub Category</option>
									</select>
					</div>
					<div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" placeholder="product" name="name" required value="<?php echo $name?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
					<div class="form-group">
                      <label for="exampleInputName1">Type</label>
                      <select class="form-control" name="type" required>
						<option value="">Select Type</option>
						<?php 
						foreach($arrType as $list){
							if($list==$type){
								echo "<option value='$list' selected>".strtoupper($list)."</option>";
							}else{
								echo "<option value='$list'>".strtoupper($list)."</option>";
							}
						}
						?>
					  </select>
					  
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>product Detail</label>
                      <textarea name="product_detail" class="form-control" placeholder="product Detail"><?php echo $product_detail?></textarea>
                    </div>
					
					
					<div class="form-group">
                      <label for="exampleInputEmail3">product Image</label>
                      <input type="file" class="form-control" placeholder="product Image" name="image" <?php echo $image_status?>>
					  <div class="error mt8"><?php echo $image_error?></div>
					</div>
					<div class="form-group">
									<label for="categories" class=" form-control-label">Best Seller</label>
									<select class="form-control" name="best_seller" required>
										<option value=''>Select</option>
										<?php
										if($best_seller==1){
											echo '<option value="1" selected>Yes</option>
												<option value="0">No</option>';
										}elseif($best_seller==0){
											echo '<option value="1">Yes</option>
												<option value="0" selected>No</option>';
										}else{
											echo '<option value="1">Yes</option>
												<option value="0">No</option>';
										}
										?>
									</select>
								</div>
					
					<div class="form-group" id="product_box1">
						<label for="exampleInputEmail3">product Attributes</label>
					<?php if($id==0){?>
						<div class="row">
							<div class="col-3">
								<input type="text" class="form-control" placeholder="Attribute" name="attribute[]" required>
							</div>
							
							<div class="col-3">
							<input type="text" name="mrp[]" placeholder=" mrp" class="form-control" required >
							</div>
							<div class="col-3">
								<input type="text" class="form-control" placeholder="Price" name="price[]" required>
							</div>
							<div class="col-2">
								<select required name="status[]" class="form-control">
									<option value="">Select Status</option>
									<option value="1">Active</option>
									<option value="0">Deactive</option>
								</select>
							</div>
						</div>
					<?php } else{
						$product_details_res=mysqli_query($con,"select * from product_details where product_id='$id'");
						$ii=1;
						while($product_details_row=mysqli_fetch_assoc($product_details_res)){
						?>
						<div class="row mt8">
							<div class="col-3">
								<input type="hidden" name="product_details_id[]" value="<?php echo $product_details_row['id']?>">
								<input type="text" class="form-control" placeholder="Attribute" name="attribute[]" required value="<?php echo $product_details_row['attribute']?>">
							</div>
							<div class="col-3">
							<input type="text" name="mrp[]" placeholder=" mrp" class="form-control" required value="<?php echo $product_details_row['mrp']?>">
							</div>
							<div class="col-3">
								<input type="text" class="form-control" placeholder="Price" name="price[]" required  value="<?php echo $product_details_row['price']?>">
							</div>
							<div class="col-2">
								<select required name="status[]" class="form-control">
									<option value="">Select Status</option>
									<?php
									if($product_details_row['status']==1){
									?>
										<option value="1" selected>Active</option>
										<option value="0">Deactive</option>
									<?php } ?>
									<?php
									if($product_details_row['status']==0){
									?>
										<option value="1">Active</option>
										<option value="0" selected>Deactive</option>
									<?php } ?>
								</select>
							</div>
							<?php if($ii!=1){
							?>
							<div class="col-2"><button type="button" class="btn badge-danger mr-2" onclick="remove_more_new('<?php echo $product_details_row['id']?>')">Remove</button></div>
							
							<?php
							}
							?>
						</div>
					<?php 
					$ii++;
					} } ?>
					</div>
						
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
					
					<button type="button" class="btn badge-danger mr-2" onclick="add_more()">Add More</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
		 <input type="hidden" id="add_more" value="1"/>
        <script>
		function add_more(){
			var add_more=jQuery('#add_more').val();
			add_more++;
			jQuery('#add_more').val(add_more);
			var html='<div class="row mt8" id="box'+add_more+'"><div class="col-4"><input type="text" class="form-control" placeholder="Attribute" name="attribute[]" required></div><div class="col-3"><input type="text" class="form-control" placeholder="Price" name="price[]" required></div><div class="col-3"><select class="form-control"  required name="status[]"><option value="">Select Status</option><option value="1">Active</option><option value="0">Deactive</option></select></div><div class="col-2"><button type="button" class="btn badge-danger mr-2" onclick=remove_more("'+add_more+'")>Remove</button></div></div>';
			jQuery('#product_box1').append(html);
		}
		
		function remove_more(id){
			jQuery('#box'+id).remove();
		}
		
		function remove_more_new(id){
			var result=confirm('Are you sure?');
			if(result==true){
				var cur_path=window.location.href;
				window.location.href=cur_path+"&product_details_id="+id;
			}
		}	
		</script>
		 <script>
			function get_sub_cat(sub_cat_id){
				var categories_id=jQuery('#category_id').val();
				
				jQuery.ajax({
					url:'get_sub_cat.php',
					type:'post',
					data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
					success:function(result){
						jQuery('#sub_categories_id').html(result);
					}
				});
			}
		 </script>
<?php include('footer.php');?>
<script>
<?php
if(isset($_GET['id'])){
?>
get_sub_cat('<?php echo $sub_categories_id?>');
<?php } ?>
</script>