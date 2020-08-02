/*function send_message(){
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var mobile=jQuery("#mobile").val();
	var message=jQuery("#message").val();
	
	if(name==""){
		alert('Please enter name');
	}else if(email==""){
		alert('Please enter email');
	}else if(mobile==""){
		alert('Please enter mobile');
	}else if(message==""){
		alert('Please enter message');
	}else{
		jQuery.ajax({
			url:'send_message.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
			success:function(result){
				alert(result);
			}	
		});
	}
}

function user_register(){
	jQuery('.field_error').html('');
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var mobile=jQuery("#mobile").val();
	var password=jQuery("#password").val();
	var is_error='';
	if(name==""){
		jQuery('#name_error').html('Please enter name');
		is_error='yes';
	}if(email==""){
		jQuery('#email_error').html('Please enter email');
		is_error='yes';
	}if(mobile==""){
		jQuery('#mobile_error').html('Please enter mobile');
		is_error='yes';
	}if(password==""){
		jQuery('#password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'register_submit.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
			success:function(result){
				if(result=='email_present'){
					jQuery('#email_error').html('Email id already present');
				}
				if(result=='mobile_present'){
					jQuery('#mobile_error').html('Mobile number already present');
				}
				if(result=='insert'){
					jQuery('.register_msg p').html('Thank you for registeration');
				}
			}	
		});
	}
	
}


function user_login(){
	jQuery('.field_error').html('');
	var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';
	if(email==""){
		jQuery('#login_email_error').html('Please enter email');
		is_error='yes';
	}if(password==""){
		jQuery('#login_password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				if(result=='wrong'){
					jQuery('.login_msg p').html('Please enter valid login details');
				}
				if(result=='valid'){
					window.location.href=window.location.href;
				}
			}	
		});
	}	
}


function manage_cart(pid,type){
	if(type=='update'){
		var qty=jQuery("#"+pid+"qty").val();
	}else{
		var qty=jQuery("#qty").val();
	}
	jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type,
		success:function(result){
			if(type=='update' || type=='remove'){
				window.location.href=window.location.href;
			}
			if(result=='not_avaliable'){
				alert('Qty not avaliable');	
			}else{
				jQuery('.htc__qua').html(result);
			}
		}	
	});	
}

function sort_product_drop(cat_id,site_path){
	var sort_product_id=jQuery('#sort_product_id').val();
	window.location.href=site_path+"categories.php?id="+cat_id+"&sort="+sort_product_id;
}

function wishlist_manage(pid,type){
	jQuery.ajax({
		url:'wishlist_manage.php',
		type:'post',
		data:'pid='+pid+'&type='+type,
		success:function(result){
			if(result=='not_login'){
				window.location.href='login.php';
			}else{
				jQuery('.htc__wishlist').html(result);
			}
		}	
	});	
}
function send_message(){
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var mobile=jQuery("#mobile").val();
	var message=jQuery("#message").val();
	
	if(name==""){
		alert('Please enter name');
	}else if(email==""){
		alert('Please enter email');
	}else if(mobile==""){
		alert('Please enter mobile');
	}else if(message==""){
		alert('Please enter message');
	}else{
		jQuery.ajax({
			url:'send_message.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
			success:function(result){
				alert(result);
			}	
		});
	}
}

function user_register(){
	jQuery('.field_error').html('');
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var mobile=jQuery("#mobile").val();
	var password=jQuery("#password").val();
	var is_error='';
	if(name==""){
		jQuery('#name_error').html('Please enter name');
		is_error='yes';
	}if(email==""){
		jQuery('#email_error').html('Please enter email');
		is_error='yes';
	}if(mobile==""){
		jQuery('#mobile_error').html('Please enter mobile');
		is_error='yes';
	}if(password==""){
		jQuery('#password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'register_submit.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
			success:function(result){
				if(result=='email_present'){
					jQuery('#email_error').html('Email id already present');
				}
				if(result=='mobile_present'){
					jQuery('#mobile_error').html('Mobile number already present');
				}
				if(result=='insert'){
					jQuery('.register_msg p').html('Thank you for registeration');
				}
			}	
		});
	}
	
}


function user_login(){
	jQuery('.field_error').html('');
	var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';
	if(email==""){
		jQuery('#login_email_error').html('Please enter email');
		is_error='yes';
	}if(password==""){
		jQuery('#login_password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				if(result=='wrong'){
					jQuery('.login_msg p').html('Please enter valid login details');
				}
				if(result=='valid'){
					window.location.href=window.location.href;
				}
			}	
		});
	}	
}


function manage_cart(pid,type){
	if(type=='update'){
		var qty=jQuery("#"+pid+"qty").val();
	}else{
		var qty=jQuery("#qty").val();
	}
	jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type,
		success:function(result){
			if(type=='update' || type=='remove'){
				window.location.href=window.location.href;
			}
			if(result=='not_avaliable'){
				alert('Qty not avaliable');	
			}else{
				jQuery('.htc__qua').html(result);
			}
		}	
	});	
}

function sort_product_drop(cat_id,site_path){
	var sort_product_id=jQuery('#sort_product_id').val();
	window.location.href=site_path+"categories.php?id="+cat_id+"&sort="+sort_product_id;
}

function wishlist_manage(pid,type){
	jQuery.ajax({
		url:'wishlist_manage.php',
		type:'post',
		data:'pid='+pid+'&type='+type,
		success:function(result){
			if(result=='not_login'){
				window.location.href='login.php';
			}else{
				jQuery('.htc__wishlist').html(result);
			}
		}	
	});	
}

function emeAccordion(){
	$('.accordion__title')
	  .siblings('.accordion__title').removeClass('active')
	  .first().addClass('active');
	$('.accordion__body')
	  .siblings('.accordion__body').slideUp()
	  .first().slideDown();
	$('.accordion').on('click', '.accordion__title', function(){
	  $(this).addClass('active').siblings('.accordion__title').removeClass('active');
	  $(this).next('.accordion__body').slideDown().siblings('.accordion__body').slideUp();
	});
	};
emeAccordion();*/
jQuery('#frmRegister').on('submit',function(e){
	jQuery('.error_field').html('');
	
	jQuery('#register_submit').attr('disabled',true);
	jQuery('#form_msg').html('Please wait...');
	jQuery.ajax({
		url:'login_register_submit.php',
		type:'post',
		data:jQuery('#frmRegister').serialize(),
		success:function(result){
			jQuery('#form_msg').html('');
			jQuery('#register_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='error'){
				jQuery('#'+data.field).html(data.msg);
			}
			if(data.status=='success'){
				jQuery('#'+data.field).html(data.msg);
				jQuery('#frmRegister')[0].reset();
			}
		}
		
	});
	e.preventDefault();
});	
function wishlist_manage(pid,type){
	jQuery.ajax({
		url:'wishlist_manage.php',
		type:'post',
		data:'id='+pid+'&type='+type,
		success:function(result){
			if(result=='not_login'){
				window.location.href='login_register.php';
			}else{
				jQuery('.htc__wishlist').html(result);
			}
		}	
	});	
}

jQuery('#frmLogin').on('submit',function(e){
	
	jQuery('.error_field').html('');
	jQuery('#login_submit').attr('disabled',true);
	jQuery('#form_login_msg').html('Please wait...');
	jQuery.ajax({
		url:'login_register_submit.php',
		type:'post',
		data:jQuery('#frmLogin').serialize(),
		success:function(result){
			jQuery('#form_login_msg').html('');
			jQuery('#login_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='error'){
				jQuery('#form_login_msg').html(data.msg);
			}else{
				var is_checkout=jQuery('#is_checkout').val();
				if(is_checkout=='yes'){
					window.location.href='checkout.php';
				}else if(data.status=='success'){
					//jQuery('#form_login_msg').html(data.msg);
					window.location.href='shop.php';
				}
			}
		}
		
	});
	e.preventDefault();
});	


jQuery('#frmForgotPassword').on('submit',function(e){
	jQuery('#forgot_submit').attr('disabled',true);
	jQuery('#form_forgot_msg').html('Please wait...');
	jQuery.ajax({
		url:'login_register_submit.php',
		type:'post',
		data:jQuery('#frmForgotPassword').serialize(),
		success:function(result){
			jQuery('#form_forgot_msg').html('');
			jQuery('#forgot_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='error'){
				jQuery('#form_forgot_msg').html(data.msg);
			}
			if(data.status=='success'){
				jQuery('#form_forgot_msg').html(data.msg);
				//window.location.href='shop.php';
			}
		}
		
	});
	e.preventDefault();
});	


function set_checkbox(id){
	var cat_product=jQuery('#cat_product').val();
	var check=cat_product.search(":"+id);
	if(check!='-1'){
		cat_product=cat_product.replace(":"+id,'');
	}else{
		cat_product=cat_product+":"+id;	
	}
	jQuery('#cat_product').val(cat_product);
	jQuery('#frmCatproduct')[0].submit();
}

function setFoodType(type){
	jQuery('#type').val(type);
	jQuery('#frmCatproduct')[0].submit();
}

function setSearch(){
	var search_str=jQuery('#search').val();
	
	if(search_str!=''){
		jQuery.ajax({
			//url:'shop.php',
			type:'post',
			data:'search_str='+search_str,
			
			success:function(){
				
				jQuery('#search').val(search_str);
				jQuery('#search_str').val(search_str);
				jQuery('#frmCatproduct')[0].submit();
				
				
			}
			
		});
	}
	alert(url);
}

function add_to_cart(id,type){
	var qty=jQuery('#qty'+id).val();
	var attr=jQuery('#radio_'+id).val();
	
	var is_attr_checked='';
	if(typeof attr=== 'undefined'){
		is_attr_checked='no';
	}
	
	if(qty>0  && is_attr_checked!='no'){
		jQuery.ajax({
			url:'manage_cart.php',
			type:'post',
			data:'qty='+qty+'&attt='+attr+'&type='+type,
			success:function(result){
				var data=jQuery.parseJSON(result);
				jQuery('.cart_already_added'+attr).html('(Added -'+qty+')');
				jQuery('.htc__qua').html(data.totalCartProduct);
				jQuery('.header__cart__price').html(data.totalPrice);
				var tp1=data.totalPrice;
				if(data.totalProductDish==1){
					var tp=qty*data.price;
					var html='<div class="shopping-cart-content"><ul id="cart_ul"><li class="single-shopping-cart" id="attr_'+attr+'"><div class="shopping-cart-img"><a href="javascript:void(0)"><img alt="" src="'+SITE_PRODUCT_IMAGE+data.image+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.dish+'</a></h4><h6>Qty: '+qty+'</h6><span>'+tp+' Rs</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li></ul><h4>Total : <span class="shop-total" id="shopTotal">'+tp+' Rs</span></h4><div class="shopping-cart-btn"><a href="cart">view cart</a><a href="checkout">checkout</a></div></div>';	
					jQuery('.header-cart').append(html);
				}else{
					var tp=qty*data.price;
					jQuery('#attr_'+attr).remove();
					var html='<li class="single-shopping-cart" id="attr_'+attr+'"><div class="shopping-cart-img"><a href="#"><img alt="" src="'+SITE_PRODUCT_IMAGE+data.image+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.dish+'</a></h4><h6>Qty: '+qty+'</h6><span>'+tp+' Rs</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li>';
					jQuery('#cart_ul').append(html);
					jQuery('#shopTotal').html(tp1+ 'Rs');
				}
				
			}
		});
	}else{
		swal("Error", "Please select qty and dish item", "error");
	}
}



function delete_cart(id,is_type){
	jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'attt='+id+'&type=delete',
		success:function(result){
			if(is_type=='load'){
				window.location.href=window.location.href;
			}else{
				var data=jQuery.parseJSON(result);
				//swal("Congratulation!", "Dish added successfully", "success");
				jQuery('.htc__qua').html(data.totalCartProduct);
				jQuery('#shop_added_msg_'+id).html('');
				
				if(data.totalCartProduct==0){
					jQuery('.shopping-cart-content').remove();
					jQuery('.header__cart__price').html('');
				}else{
					var tp1=data.totalPrice;
					jQuery('#shopTotal').html(tp1+ 'Rs');
					jQuery('#attr_'+id).remove();
					jQuery('totalPrice').html(data.totalPrice);
				}
			}
			
		}
	});
}


jQuery('#frmProfile').on('submit',function(e){
	jQuery('#profile_submit').attr('disabled',true);
	jQuery('#form_msg').html('Please wait...');
	jQuery.ajax({
		url:'update_profile.php',
		type:'post',
		data:jQuery('#frmProfile').serialize(),
		success:function(result){
			jQuery('#form_msg').html('');
			jQuery('#profile_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='success'){
				jQuery('#user_top_name').html(jQuery('#uname').val());
				jQuery('#form_msg').html(data.msg);
				
			}
		}
	});
	e.preventDefault();
});	

jQuery('#frmPassword').on('submit',function(e){
	jQuery('#password_submit').attr('disabled',true);
	jQuery('#password_form_msg').html('Please wait...');
	jQuery.ajax({
		url:'update_profile.php',
		type:'post',
		data:jQuery('#frmPassword').serialize(),
		success:function(result){
			jQuery('#password_form_msg').html('');
			jQuery('#password_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='success'){
				jQuery('#password_form_msg').html( data.msg);
				
			}
			if(data.status=='error'){
				jQuery('#password_form_msg').html( data.msg);
			}
		}
	});
	e.preventDefault();
});	

function apply_coupon(){
	var coupon_code=jQuery('#coupon_code').val();
	
	if(coupon_code==''){
		jQuery('#coupon_code_msg').html('Please enter coupon code');
	}else{
		jQuery.ajax({
			url:'apply_coupon.php',
			type:'post',
			data:'coupon_code='+coupon_code,
			success:function(result){
				var data=jQuery.parseJSON(result);
				if(data.status=='success'){
					jQuery('#coupon_code_msg').html(data.msg);
					
					jQuery('.shopping-cart-total').show();
					jQuery('.coupon_code_str').html(coupon_code);
					jQuery('.final_price').html(data.coupon_code_apply+' Rs');
				}
				if(data.status=='error'){
					jQuery('#coupon_code_msg').html(data.msg);
					
				}
			}
		})
	}
}

function updaterating(id,oid){
	var rate=jQuery('#rate'+id).val();
	var rate_str=jQuery('#rate'+id+' option:selected').text();
	
	if(rate==''){
		//jQuery('#coupon_code_msg').html('Please enter coupon code');
	}else{
		jQuery.ajax({
			url:FRONT_SITE_PATH+'updaterating',
			type:'post',
			data:'id='+id+'&rate='+rate+'&oid='+oid,
			success:function(result){
				jQuery('#rating'+id).html("<div class='set_rating'>"+rate_str+"</div>");
			}
		})
	}
}
function get_mrp(id){
	var pro_id=jQuery('#radio_'+id).val();
		
		jQuery.ajax({
			url:'get_mrp.php',
			type:'post',
			data:'pro_id='+pro_id,
			success:function(result){
				var data=jQuery.parseJSON(result);
				jQuery('#mrp_price'+data.main_id).html(data.html);
			}
		});
	}