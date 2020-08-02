<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
$totalPrice=0;
$getSetting=getSetting();
$wishlist_count=0;
$website_close=$getSetting['website_close'];
$website_close_msg=$getSetting['website_close_msg'];
$cart_min_price=$getSetting['cart_min_price'];
$cart_min_price_msg=$getSetting['cart_min_price_msg'];

//getProductCartStatus();
/*if(isset($_SESSION['USER_NAME'])){
	$uid=$_SESSION['USER_ID'];
	if(isset($_GET['wishlist_id'])){
		$wid=get_safe_value($_GET['wishlist_id']);
		mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
	}

	$wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
}*/

if(isset($_POST['update_cart_plus'])){
   
	foreach($_POST['qty'] as $key=>$val){
        $val[0]=$val[0]+1;
		if(isset($_SESSION['USER_ID'])){
			if($val[0]==0){
				mysqli_query($con,"delete from product_cart where product_detail_id='$key' and user_id=".$_SESSION['USER_ID']);
			}else{
				mysqli_query($con,"update product_cart set qty='".$val[0]."' where product_detail_id='$key' and user_id=".$_SESSION['USER_ID']);	
			}
		}else{
			if($val[0]==0){
				unset($_SESSION['cart'][$key]['qty']);
			}else{
				$_SESSION['cart'][$key]['qty']=$val[0];	
			}
		}
	}
}
if(isset($_POST['update_cart_minus'])){
   
	foreach($_POST['qty'] as $key=>$val){
        $val[0]=$val[0]-1;
		if(isset($_SESSION['USER_ID'])){
			if($val[0]==0){
				mysqli_query($con,"delete from product_cart where product_detail_id='$key' and user_id=".$_SESSION['USER_ID']);
			}else{
				mysqli_query($con,"update product_cart set qty='".$val[0]."' where product_detail_id='$key' and user_id=".$_SESSION['USER_ID']);	
			}
		}else{
			if($val[0]==0){
				unset($_SESSION['cart'][$key]['qty']);
			}else{
				$_SESSION['cart'][$key]['qty']=$val[0];	
			}
		}
	}
}
$search_str='';
if(isset($_GET['search_str'])){
    $search_str=get_safe_value($_GET['search_str']);
}

$cartArr=getUserFullCart();


$totalPrice=getcartTotalPrice();
$totalCartProduct=count($cartArr);

$getWalletAmt=0;
if(isset($_SESSION['USER_ID'])){
	$getWalletAmt=getWalletAmt($_SESSION['USER_ID']);
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/ionicons.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
     <!-- Humberger Begin -->
     <style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
.login-user{
    color:#000;
}
.seahc_box_btn {
    background-color: #e02c2b;
    color: #fff;
    border: 0px;
}
.search_box {
    width: 200px !important;
    float: left;
    color:#fff !important;
}
</style>
	 <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
            <li><a href="wishlist.php"><i class="fa fa-heart"></i> <span class="htc__wishlist"><?php echo $wishlist_count?></span></a></li>
            <li><a href="cart.php"><i class="fa fa-shopping-bag" ></i> <span class="htc__qua"  id="totalCartProduct"><?php echo $totalCartProduct?></span></a></li>
            </ul>
            Total <div class="header__cart__price" id="totalPrice">&#8377 <span><?php 
											 if($totalPrice!=0){
												echo $totalPrice;
                                            }
                                            else{
                                                echo 0;
                                            }?></span></div>
        </div>
        <div class="humberger__menu__widget">
            
            <div class="header__top__right__auth">
            <?php
								if(isset($_SESSION['USER_NAME'])){
								?>
                                <div class="dropdown">

                                    <div class="dropbtn">
                                        <span>
										<i class="fa fa-user"></i>Hi <?php echo $_SESSION['USER_NAME']?> <i class="fa fa-angle-down"></i>
										</span>
                                    </div>
                                    <ul class="dropdown-content">
                                        <li><a href="#">ORDERS</a></li>
                                        <li><a href="#">PROFILE</a></li>
                                        <li><a href="logout.php">LOGOUT</a></li>
                                        
                                    </ul>
                                </div>
                                <?php
										}else{
											echo ' <a href="login_register.php" class="mr15"><i class="fa fa-user"></i> Login</a>';
								}?>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="./blog.html">About Us</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            
                            <div class="header__top__right__auth">
                           
                            <?php
								if(isset($_SESSION['USER_NAME'])){
								?>
                                <div class="dropdown">

                                    <div class="dropbtn">
                                        <span>
										<i class="fa fa-user"></i>Hi <?php echo $_SESSION['USER_NAME']?> <i class="fa fa-angle-down"></i>
										</span>
                                    </div>
                                    <ul class="dropdown-content">
                                        <li><a href="<?php echo FRONT_SITE_PATH?>order_history.php">ORDERS</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>profile.php">PROFILE</a></li>
                                        <li><a href="logout.php">LOGOUT</a></li>
                                        
                                    </ul>
                                </div>
                                <?php
										}else{
											echo ' <a href="login_register.php" class="mr15"><i class="fa fa-user login-user"></i>Login</a>';
								}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./shop.php">Shop</a></li>
                            <li><a href="./blog.html">About Us</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="wishlist.php"><i class="fa fa-heart"></i> <span class="htc__wishlist"><?php echo $wishlist_count?></span></a></li>
                            <li><a href="cart.php"><i class="fa fa-shopping-bag" ></i> <span class="htc__qua"  id="totalCartProduct"><?php echo $totalCartProduct?></span></a></li>
                        </ul>
                        Total <div class="header__cart__price" id="totalPrice">&#8377 <span><?php 
											 if($totalPrice!=0){
												echo $totalPrice;
                                            }
                                            else{
                                                echo 0;
                                            }?>
                                            </span></div> 
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

   
   <!-- Hero Section Begin -->
   <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="shop.php" method="get" >
                               
                                <input type="text"  name="search_str" placeholder="What do yo u need?" id="search" value="<?php echo $search_str?>">
                                <button type="submit" class="site-btn" onclick="setSearch()">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Hero Section End -->
    