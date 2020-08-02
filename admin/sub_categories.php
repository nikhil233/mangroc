<?php
include('top.php');
if(isset($_GET['type']) && $_GET['type']!=''  && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		$update_status_sql="update sub_categories set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		
		$delete_sql="delete from sub_categories where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select sub_categories.*,category.category from sub_categories,category where category.id=sub_categories.categories_id order by sub_categories.sub_categories asc";
$res=mysqli_query($con,$sql);
?>
 <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Sub Categories  Master</h1>
			  <a href="manage_sub_categories.php" class="add_link">Add Sub Categories</a>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
							<th width="5%">S.No #</th>
							<th width="5%">ID</th>
                            <th width="50%">Category</th>
                            <th width="15%">Sub Categories</th>
                            <th width="25%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php if(mysqli_num_rows($res)>0){
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['category']?></td>
							   <td><?php echo $row['sub_categories']?></td>
							<td>
								<a href="manage_sub_category.php?id=<?php echo $row['id']?>"><label class="badge badge-success hand_cursor">Edit</label></a>&nbsp;
								<?php
								if($row['status']==1){
								?>
								<a href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-danger hand_cursor">Active</label></a>
								<?php
								}else{
								?>
								<a href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-info hand_cursor">Deactive</label></a>
								<?php
								}
								
								?>
								&nbsp;
								<a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a>
							</td>
                           
                        </tr>
                        <?php 
						$i++;
						 }} else { ?>
						<tr>
							<td colspan="5">No data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>
<?php
include('footer.php');
?>