<?php
include ("top.php");
$cat_product='';
$cat_product_arr=array();
$type='';
$search_str='';
if(isset($_GET['cat_product'])){
	$cat_product=get_safe_value($_GET['cat_product']);
	$cat_product_arr=array_filter(explode(':',$cat_product));
    $cat_product_str=implode(",",$cat_product_arr);
}

if(isset($_GET['type'])){
	$type=get_safe_value($_GET['type']);
}

if(isset($_GET['search_str'])){
     $search_str=get_safe_value($_GET['search_str']);
     
}

$arrType=array("veg","non-veg","both");

?>
<style>.rad input { width:30%; height:30px;} .cat input { width:30%; height:25px; color:green;} </style>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <div class="sidebar">
                        <div class="sidebar__item rad">
                            <h4>Type</h4>
                            <ul>
                            <?php
								foreach($arrType as $list){
									$type_radio_selected='';
									if($list==$type){
										$type_radio_selected="checked='checked'";
									}
									?>
									
                                    <input type="radio" class="dish_radio" <?php echo $type_radio_selected?> name="type" value="<?php echo $list?>" onclick="setFoodType('<?php echo $list?>')"/>&nbsp;<?php echo strtoupper($list)?> <br>
									<?php
								}									
								?>
                            </ul>
                        </div>
                        <?php
                            $cat_id=0;
                            $product_sql="select * from product where status=1";
                            if($cat_product!=''){		
                                $product_sql.=" and category_id in ($cat_product_str) ";
                            }
							if($type!='' && $type!='both'){		
                                $product_sql.=" and type ='$type' ";
                            }
							
							if($search_str!=''){		
                                $product_sql.=" and (name like '%$search_str%' or product_detail like '%$search_str%') ";
                            }
							
							
                            $product_sql.=" order by name desc";
                            $product_res=mysqli_query($con,$product_sql);
                            $product_count=mysqli_num_rows($product_res);
                            
                        ?>
                        <?php
                        $cat_res=mysqli_query($con,"select * from category where status=1 order by order_number desc")
                        ?>
                        <div class="sidebar__item cat">
                            <h4>Categories</h4>
                            <ul>
                            <?php 
                                        while($cat_row=mysqli_fetch_assoc($cat_res)){
                                            $class="selected";
                                            if($cat_id==$cat_row['id']){
                                                $class="active";
                                            }
											$is_checked='';
											if(in_array($cat_row['id'],$cat_product_arr)){
												$is_checked="checked='checked'";
											}
											
											echo "<li> <input $is_checked onclick=set_checkbox('".$cat_row['id']."') type='checkbox' class='cat_checkbox' name='cat_arr[]' value='".$cat_row['id']."'/>".$cat_row['category']."</li>";  

                                        }
                                        ?>
                            </ul>
                        </div>
                        
                        
                        
                            
                    </div>
                </div>
                
                <div class="col-lg-10 col-md-9">
                   
                   
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span><?php echo "$product_count"?></span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($product_count>0){?>
                    <div class="row">
                    
                        <?php while($product_row=mysqli_fetch_assoc($product_res)){?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?php echo SITE_PRODUCT_IMAGE.$product_row['image']?>">
                                    <ul class="product__item__pic__hover">
                                    <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $product_row['id']?>','add')"><i class="fa fa-heart"></i></a></li>
                                <li><a href="javascript:void(0)"  onclick="add_to_cart('<?php echo $product_row['id']?>','add')"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>
                                                    <?php
														if($product_row['type']=='veg'){
															echo "<img src='img/icon-img/veg.png'/>";
														}else{
															echo "<img src='img/icon-img/non-veg.png'/>";
														}
														?>
														
                                                        <a href="product.php?id=<?php echo $product_row['id']?>"><?php echo $product_row['name']?> </a>
                                                        <p><?php echo $product_row['product_detail']?></p>
                                    </h6>
                                    <ul class="fr__pro__prize">
                                     <?php
                                    $product_attr_res=mysqli_fetch_assoc(mysqli_query($con,"select * from product_details where status='1' and product_id='".$product_row['id']."' order by price asc"));
                                    ?>
                                       
                                        <li class="old_prize" style="text-decoration:line-through;" >MRP: '&#8377' <span id="mrp_price<?php echo $product_row['id']?>"><?php echo $product_attr_res['mrp']?> </span><br>  </li>
                                        
                                    </ul>
                                    <?php
                                    $product_attr_res=mysqli_query($con,"select * from product_details where status='1' and product_id='".$product_row['id']."' order by price asc");
                                    ?>
                                    <div class="product-price-wrapper">
                                    <?php 
                                            if($website_close==0){
                                                $i=1;
                                               
                                              echo " <div style='color:red;'>OUR PRICE:</div>
                                               
                                              <div class='select_pro'>
                                              
                                            <select class='select' id='radio_".$product_row['id']."' onchange='get_mrp(".$product_row['id'].")' >";
                                              while($product_attr_row=mysqli_fetch_assoc($product_attr_res)){
                                                    $f=count($product_row['id']);
                                                    for($i=1;$i<=$f;$i++){
                                                        echo "<option value='".$product_attr_row['id']." '><p>".$product_attr_row['attribute']."    <b>'&#8377'".$product_attr_row['price']."</b> </p></option>";
                                                    }
                                                }
                                                    echo "</select><br><br>
                                                    </div>
                                                
                                            ";
                                            /*echo "<input type='radio' class='dish_radio' name='radio_".$product_row['id']."' id='radio_".$product_row['id']."' value='".$product_attr_row['id']."'/>";*/
                                            }
                                     ?>
                                     
                                    </div>
                                    
                                    <?php
                                    $product_attr_res=mysqli_query($con,"select * from product_details where status='1' and product_id='".$product_row['id']."' order by price asc");
                                    ?>
                                    <div class="product-price-wrapper">
                                          <?php         
                                                        
														while($product_attr_row=mysqli_fetch_assoc($product_attr_res)){
															
															/*echo $product_attr_row['attribute'];
															echo "&nbsp;";
															echo " <span class='price'> '&#8377'".$product_attr_row['price']."</span> <br>" ;*/
															$added_msg="";
															if(array_key_exists($product_attr_row['id'],$cartArr)){
                                                                $added_qty=getUserFullCart($product_attr_row['id']);
																$added_msg="".$added_qty['attr'].":(Added -".$added_qty['qty'].")<br>";
                                                            }
                                                            
                                                            
															echo " <span class='cart_already_added".$product_attr_row['id']."' id='shop_added_msg'>".$added_msg."</span>";
															echo "&nbsp;&nbsp;&nbsp;";
														}
											?>
                                        </div>
                                        <?php
                                    $product_attr_res=mysqli_query($con,"select * from product_details where status='1' and product_id='".$product_row['id']."' order by price asc");
                                    ?>
                                    <div class="sin__desc">
                                    
                                        <?php if($website_close==0){
                                           $added_qty['qty']=1;
                                            while($product_attr_row=mysqli_fetch_assoc($product_attr_res)){
                                                if(array_key_exists($product_attr_row['id'],$cartArr)){
                                                   
                                                $added_qty=getUserFullCart($product_attr_row['id']);
                                                }
                                                
                                            }
                                           
                                            ?>
                                            <p style="display:flex; align-items: center; justify-content: center;"><span style="padding-right:20px;">Qty:</span> 
                                            <div class="pro-qty">
                                            
                                           <input type="number"  id="qty<?php echo $product_row['id']?>" name="qty[<?php echo $product_row['id']?>][]"   value="<?php echo $added_qty['qty']?>" min="1" />
                                           </div>
                                            
                                            
                                            </p>
                                            
                                        </div>
                                    <div>
                                        <div  class="button-box">
                                            <button class="button-box"  onclick="add_to_cart('<?php echo $product_row['id']?>','add')">Add to cart</button>
                                        </div>
                                        <div class="error_pro"></div>
                                    </div>
                                    <?php } else{
														?>
														<div class="product-price-wrapper">
														<strong><?php echo $website_close_msg?>
														</strong></div>
														<?php
													}
													?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } else{ 
                                    echo "No Product found";   
                                }?>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
		<form method="get" id="frmCatproduct">
			<input type="hidden" name="cat_product" id="cat_product" value='<?php echo $cat_product?>'/>
			<input type="hidden" name="type" id="type" value='<?php echo $type?>'/>
            <input type="hidden" name="search_str" id="search_str" value='<?php echo $search_str?>'/>
		</form>
		
       

<?php
include("footer.php");
?>
