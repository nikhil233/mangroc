<?php 
include ("top.php");
if(!isset($_SESSION['USER_ID'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$uid=$_SESSION['USER_ID'];

$res=mysqli_query($con,"select product.name,product.image,product.price,product.mrp,product.id as pid,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");
?>

 <div class="ht__bradcaump__area" >
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="shoping-cart spad ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#" >               
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="">name of products</th>
                                            <th class="">Remove</th>
											<th class=""></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										while($row=mysqli_fetch_assoc($res)){
										?>
											<tr>
												<td class="product-thumbnail"><a href="#"><img src="<?php echo SITE_PRODUCT_IMAGE.$row['image']?>"  /></a></td>
												<td class="product-name"><a href="#"><div class="div_order_id"><?php echo $row['name']?></div></a>
													<ul  class="pro__prize">
														<li class="old__prize"><?php echo $row['mrp']?></li>
														<li><?php echo $row['price']?></li>
													</ul>
												</td>
												
												<td class=""><a href="wishlist.php?wishlist_id=<?php echo $row['id']?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
												<td class="product-remove">
                                                    <p style="display:flex; align-items: center; justify-content: center;"><span style="padding-right:20px;">Qty:</span> 
                                                        <select id="qty<?php echo $row['pid']?>">
                                                        <option value="1">1</option>
                                                            <?php
                                                            
                                                            for($i=2;$i<=10;$i++){
                                                                echo "<option>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </p>
                                                    <a href="javascript:void(0)" onclick="add_to_cart('<?php echo $row['pid']?>','add')"><div class="div_order_id">Add to Cart</div></a></td>
											</tr>
											<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                    <div class="cart-shiping-update">
                                            <a href="<?php echo FRONT_SITE_PATH?>shop.php">Continue Shopping</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <form method="get" id="frmCatproduct">
			<input type="hidden" name="cat_product" id="cat_product" value='<?php echo $cat_product?>'/>
			<input type="hidden" name="type" id="type" value='<?php echo $type?>'/>
			<input type="hidden" id="qty" value="1"/>	
		</form>
							
<?php include("footer.php");?>        