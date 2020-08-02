<?php require('top.php')?>
<div class="body__overlay"></div>
 <!-- Hero Section Begin -->
 <section class="hero">
 <div class="latest-product__slider owl-carousel">
 <div class="latest-prdouct__slider__item">
 <div class="hero__item set-bg" data-setbg="img/hero/banner2.png">
                        <div class="hero__text" >
                        <div style="background-color:#000;opacity:0.4;"></div>
                            <span style="color:#fff;">FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p style="color:#fff;">Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
 </div>
 <div class="latest-prdouct__slider__item">
 <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
 </div>
 </div>
                   
                
    </section>
        
        
        <!-- Start Category Area -->
           <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>New Arrival</h2>
                    </div>
                   
                </div>
            </div>
            <div class="row featured__filter">
            <?php
            $product_sql="select * from product where status=1 ";
            $product_sql.=" order by id desc";
            $product_res=mysqli_query($con,$product_sql);
            $j=1;
            
            for($j=1;$j<=4;$j++){
                $product_row=mysqli_fetch_assoc($product_res);
            ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
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
        </div>
    </section>
    <!-- Featured Section End -->


    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
             
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <?php
                                $get_product=get_product($con,3);
                                foreach($get_product as $list){
                                ?> 
                                    <a href="product.php?id=<?php echo $list['id']?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo SITE_PRODUCT_IMAGE.$list['image']?>" alt="" style="width:110px;">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $list['name']?></h6>
                                            
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                            
                            <div class="latest-prdouct__slider__item">
                            <?php
                                $get_product=get_product($con,3);
                                foreach($get_product as $list){
                                ?> 
                                    <a href="product.php?id=<?php echo $list['id']?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo SITE_PRODUCT_IMAGE.$list['image']?>" alt="" style="width:110px;">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $list['name']?></h6>
                                            
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                            <?php
                                $get_product=get_product($con,3);
                                foreach($get_product as $list){
                                ?> 
                                    <a href="product.php?id=<?php echo $list['id']?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo SITE_PRODUCT_IMAGE.$list['image']?>" alt="" style="width:110px;">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $list['name']?></h6>
                                            
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="latest-prdouct__slider__item">
                            <?php
                                $get_product=get_product($con,3);
                                foreach($get_product as $list){
                                ?> 
                                    <a href="product.php?id=<?php echo $list['id']?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo SITE_PRODUCT_IMAGE.$list['image']?>" alt="" style="width:110px;">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $list['name']?></h6>
                                           
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
               
                  
            </div>
        </div>
    </section>
       
	
<?php require('footer.php')?>        