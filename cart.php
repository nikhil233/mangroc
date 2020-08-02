<?php
include ("top.php");

if($website_close==1){
	redirect('shop.php');
}

?>

<!-- Shoping Cart Section Begin -->
<style>.quantity a{color:red;} .quantity a:hover{color:#7fad39;} </style>

<section class="shoping-cart spad">
       <div class="container">
        <h1>Your cart items</h1>
           <div class="row">
           
               <div class="col-lg-12">
                    <form method="post">
                   <div class="shoping__cart__table">
                   <?php
							$cartArr=getUserFullCart();
							if(count($cartArr)>0){
					?>
                       <table>
                           <thead>
                               <tr>
                               <tr>
                                  <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Product details</th>
                                            <th>Unit Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>action</th>
                                 </tr>
                               </tr>
                           </thead>
                           <tbody>
                           <?php
							foreach($cartArr as $key=>$list){
							?>
                               <tr>
                                   <td class="shoping__cart__item" style="text-align:center;">
                                       <img src="<?php echo SITE_PRODUCT_IMAGE.$list['image']?>" alt="">
                                       
                                   </td>
                                   <td class="shoping__cart__item">
                                       
                                       <h5><?php echo $list['name']?></h5>
                                   </td>
                                   <td class="shoping__cart__item">
                                       
                                       <h5><?php echo $list['attr']?></h5>
                                   </td>
                                   <td class="shoping__cart__price">
                                   &#8377
                                   <?php echo $list['price']?>
                                   </td>
                                   <td class="shoping__cart__quantity">
                                       <div class="quantity">
                                            

                                           <div class="pro-qty_cart">
                                           <button name="update_cart_minus" class="update-cart">-</button>
                                           <input type="text"  name="qty[<?php echo $key?>][]" value="<?php echo $list['qty']?>" id="qty<?php echo $key?>" readonly/>
                                           <button name="update_cart_plus"  class="update-cart">+</button>
                                           </div>
                                           
                                           <br/>
                                       </div>
                                       
                                   </td>
                                   <td class="shoping__cart__total">
                                   &#8377
                                   <?php echo $list['qty']*$list['price']?>
                                   </td>
                                   <td class="shoping__cart__item__close">
                                   <a href="javascript:void(0)" onclick="delete_cart('<?php echo $key?>','load')"><span class="icon_close"></span></a>
                                   </td>
                               </tr>
                               <?php } ?>
                           </tbody>
                       </table>
                   </div>
                   <?php } else {
								echo "Empty Cart";
                            }?>
                
               </div>
           </div>
           <div class="row">
           <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="<?php echo FRONT_SITE_PATH?>shop.php">Continue Shopping</a>
                                        </div>
                                        <div class="cart-clear">
                                            <button name="update_cart">Update Shopping Cart</button>
                                           
                                        </div>
                                        
                                        </form>
                                    </div>
                                </div>
            <div class="col-lg-6" > </div>
               <div class="col-lg-6" >
                   <div class="shoping__checkout">
                       <h5>Cart Total</h5>
                       <ul>
                       <?php foreach($cartArr as $key=>$list){ ?>
                           <li><?php echo $list['name']?> <span>'&#8377'<?php echo  $list['qty']*$list['price'];?></span></li>
                           <?php } ?>
                           
                           <li>Total <span>'&#8377'<?php echo $totalPrice?></span></li>
                          
                       </ul>
                       <a href="<?php echo FRONT_SITE_PATH?>checkout.php" class="primary-btn">PROCEED TO CHECKOUT</a>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <!-- Shoping Cart Section End -->

<?php
include("footer.php");
?>