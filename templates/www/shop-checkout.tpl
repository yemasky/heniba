
<!DOCTYPE html>

<html>

	<head>
		
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Title -->
		<title>Checkout | Candidate HTML Template</title>
		
		<!-- Google Fonts -->
		<link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.useso.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
		
		<!-- Stylesheets -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="css/fontello.css" rel="stylesheet" type="text/css">
		<link href="css/flexslider.css" rel="stylesheet" type="text/css">
		<link href="js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
		<link href="css/responsive-calendar.css" rel="stylesheet" type="text/css">
		<link href="css/chosen.css" rel="stylesheet" type="text/css">
		<link href="jackbox/css/jackbox.min.css" rel="stylesheet" type="text/css" />
		<link href="css/cloud-zoom.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel="stylesheet" type="text/css">

		
		<!--[if IE 9]>
			<link rel="stylesheet" href="css/ie9.css">
		<![endif]-->
		
		<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<link href="css/jackbox-ie8.css" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="css/ie.css">
        <![endif]-->
		
		<!--[if gt IE 8]>
			<link href="css/jackbox-ie9.css" rel="stylesheet" type="text/css" />
		<![endif]-->
		
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/fontello-ie7.css">
		<![endif]-->
		
		<style type="text/css">
			.no-fouc {display:none;}
	  	</style>
		
		<!-- jQuery -->
		<script src="js/jquery-1.11.0.min.js"></script>
		<script src="js/jquery-ui-1.10.4.min.js"></script>
		
		<!-- Preloader -->
		<script src="js/jquery.queryloader2.min.js"></script>
		
		<script type="text/javascript">
		$('html').addClass('no-fouc');
		
		$(document).ready(function(){
			
			$('html').show();
			
			var window_w = $(window).width();
			var window_h = $(window).height();
			var window_s = $(window).scrollTop();
			
			$("body").queryLoader2({
				backgroundColor: '#f2f4f9',
				barColor: '#63b2f5',
				barHeight: 4,
				percentage:false,
				deepSearch:true,
				minimumTime:1000,
				onComplete: function(){
					
					$('.animate-onscroll').filter(function(index){
					
						return this.offsetTop < (window_s + window_h);
						
					}).each(function(index, value){
						
						var el = $(this);
						var el_y = $(this).offset().top;
						
						if((window_s) > el_y){
							$(el).addClass('animated fadeInDown').removeClass('animate-onscroll');
							setTimeout(function(){
								$(el).css('opacity','1').removeClass('animated fadeInDown');
							},2000);
						}
						
					});
					
				}
			});
			
		});
		</script>
		
	</head>
	
	<body class="sticky-header-on tablet-sticky-header">
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>		
		<!-- Container -->
		<div class="container">
			
			
			<!-- Header -->
			<header id="header" class="animate-onscroll">
				
				<!-- Main Header -->
				<div id="main-header">
					
					<div class="container">
					
					<div class="row">
						
						
						
						<!-- Logo -->
						<div id="logo" class="col-lg-3 col-md-3 col-sm-3">
							
							<a href="main-v1.html"><img src="img/logo.png" alt="Logo"></a>
							
						</div>
						<!-- /Logo -->
						
						
						
						<!-- Main Quote -->
						<div class="col-lg-5 col-md-4 col-sm-4">
							
							<blockquote>Nam elit agna,enderit sit amet, tinciunt ac,<br>viverra sed, nulla..</blockquote>
							
						</div>
						<!-- /Main Quote -->
						
						
						
						<!-- Newsletter -->
						<div class="col-lg-4 col-md-5 col-sm-5">
							
							<form id="newsletter" action="php/newsletter-form.php" method="POST">
								
								<h5><strong>Sign up</strong> for email updates</h5>
								<div class="newsletter-form">
								
									<div class="newsletter-email">
										<input type="text" name="newsletter-email" placeholder="Email address">
									</div>
									
									<div class="newsletter-zip">
										<input type="text" name="newsletter-zip" placeholder="Zip code">
									</div>
									
									<div class="newsletter-submit">
										<input type="submit" value="">
										<i class="icons icon-right-thin"></i>
									</div>
									
								</div>
								
							</form>
							
						</div>
						<!-- /Newsletter -->
						
						
						
					</div>
					
					</div>
					
				</div>
				<!-- /Main Header -->
				
				
				
				
				
				<!-- Lower Header -->
				<div id="lower-header">
					
					<div class="container">
					
					<div id="menu-button">
						<div>
						<span></span>
						<span></span>
						<span></span>
						</div>
						<span>Menu</span>
					</div>
					
					<ul id="navigation">
						
						<!-- Home -->
						<li class="home-button ">
						
							<a href="main-v1.html"><i class="icons icon-home"></i></a>
							
							<ul>
							
								<li>
									<span>Layouts</span>
									<ul>
										<li><a href="main-v1.html">Home v1</a></li>
										<li><a href="main-v2.html">Home v2</a></li>
										<li><a href="main-v3.html">Home v3</a></li>
									</ul>
								</li>
								
								<li>
									<span>Sliders</span>
									<ul>
										<li><a href="main-v1.html">Flexslider</a></li>
										<li><a href="main-v2.html">Revolution</a></li>
									</ul>
								</li>
								
							</ul>
							
						</li>
						<!-- /Home -->
						
						<!-- Pages -->
						<li >
						
							<span>Pages</span>
							
							<ul>
							
								<li><a href="about.html">About</a></li>
								<li><a href="team.html">Team</a></li>
								<li><a href="issues.html">Issues</a></li>
								<li><a href="testimonials.html">Testimonials</a></li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="page-right-sidebar.html">Page with right sidebar</a></li>
								<li><a href="page-left-sidebar.html">Page with left sidebar</a></li>
								<li><a href="page-fullwidth.html">Full width page</a></li>
								
							</ul>
							
						</li>
						<!-- /Pages -->
						
						<!-- Events -->
						<li >
						
							<span>Events</span>
							
							<ul>
							
								<li><a href="event-calendar.html">Calendar</a></li>
								<li><a href="event-post-v1.html">Event post style 1</a></li>
								<li><a href="event-post-v2.html">Event post style 2</a></li>
								
							</ul>
							
						</li>
						<!-- /Events -->
						
						<!-- Media -->
						<li >
						
							<span>Media</span>
							
							<ul>
							
								<li>
									<span>Sortable Grid</span>
									<ul>
										<li><a href="media-sortable-1column-sidebar.html">1 Column with right sidebar</a></li>
										<li><a href="media-sortable-2columns.html">2 Columns</a></li>
										<li><a href="media-sortable-3columns.html">3 Columns</a></li>
										<li><a href="media-sortable-3columns-sidebar.html">3 Columns with left sidebar</a></li>
										<li><a href="media-sortable-4columns.html">4 Columns</a></li>
									</ul>
								</li>
								
								<li>
									<span>Grid with pagination</span>
									<ul>
										<li><a href="media-grid-1column-sidebar.html">1 Column with right sidebar</a></li>
										<li><a href="media-grid-2columns.html">2 Columns</a></li>
										<li><a href="media-grid-3columns.html">3 Columns</a></li>
										<li><a href="media-grid-3columns-sidebar.html">3 Columns with left sidebar</a></li>
										<li><a href="media-grid-4columns.html">4 Columns</a></li>
									</ul>
								</li>
								
								<li>
									<span>Classic gallery</span>
									<ul>
										<li><a href="media-classic-sortable-3columns.html">Sortable 3 Columns</a></li>
										<li><a href="media-classic-sortable-3columns-sidebar.html">Sortable 3 Columns with right sidebar</a></li>
										<li><a href="media-classic-sortable-4columns.html">Sortable 4 Columns</a></li>
										<li><a href="media-classic-3columns.html">3 Columns</a></li>
										<li><a href="media-classic-3columns-sidebar.html">3 Columns with left sidebar</a></li>
										<li><a href="media-classic-4columns.html">4 Columns</a></li>
									</ul>
								</li>
								
								<li>
									<span>Single portfolio post</span>
									<ul>
										<li><a href="portfolio-single-fullwidth.html">Fullwidth</a></li>
										<li><a href="portfolio-single-sidebar.html">With Sidebar</a></li>
										<li><a href="portfolio-single-extended.html">Extended Image Slideshow</a></li>
									</ul>
								</li>
								
							</ul>
							
						</li>
						<!-- /Media -->
						
						
						
						<!-- Get Involved -->
						<li >
							<a href="get-involved.html">Get Involved</a>
						</li>
						<!-- /Get Involved -->
						
						
						
						<!-- Features -->
						<li >
						
							<span>Features</span>
							
							<ul>
							
								<li><a href="features-typography.html">Typography</a></li>
								<li><a href="features-shortcodes.html">Shortcodes</a></li>
								
							</ul>
							
						</li>
						<!-- /Features -->
						
						
						<!-- Blog -->
						<li >
						
							<span>Blog</span>
							
							<ul>
							
								<li><a href="blog-v1.html">Blog style 1 with right sidebar</a></li>
								<li><a href="blog-v2.html">Blog style 2 with left sidebar</a></li>
								<li><a href="blog-fullwidth.html">Full width blog</a></li>
								<li><span>Single blog post</span>
									<ul>
										<li><a href="blog-single-sidebar.html">With sidebar</a></li>
										<li><a href="blog-single-fullwidth.html">Full width</a></li>
									</ul>
								</li>
								
							</ul>
							
						</li>
						<!-- /Blog -->
						
						
						<!-- Shop -->
						<li class="current-menu-item">
						
							<span>Shop</span>
							
							<ul>
							
								<li><a href="shop-frontpage.html">Front page</a></li>
								<li><a href="shop-productpage.html">Product page</a></li>
								<li><a href="shop-cart.html">Shopping cart</a></li>
								<li><a href="shop-checkout.html">Checkout</a></li>
								
							</ul>
							
						</li>
						<!-- /Shop -->
						
						<!-- Donate -->
						<li class="donate-button ">
							<a href="#">Donate Today</a>
						</li>
						<!-- /Donate -->
						
					</ul>
					
					</div>
					
				</div>
				<!-- /Lower Header -->
				
				
			</header>
			<!-- /Header -->
			
			
		<section id="content">	
			
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-9">
					
						<h1>Checkout</h1>
						<p class="breadcrumb"><a href="main-v1.html">Home</a> / Checkout</p>
						
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 align-right">
					
												<!-- Shopping Cart -->
						<div class="shopping-cart">
						
							<div class="cart-button">
								<i class="icons icon-basket"></i>
							</div>
							
							<div class="shopping-cart-dropdown">
							
								<div class="shopping-cart-content">
									<div class="cart-item">
										<div class="featured-image">
											<img src="img/shop/item6.jpg" alt="">
										</div>
										<div class="item-content">
											<h6><a href="#">Woo Ninja</a></h6>
											<span class="price">1 x &pound;20</span>
											<div class="remove-item">
												<i class="icons remove-shopping-item icon-cancel-circled"></i>
											</div>
										</div>
									</div>
									<div class="cart-item">
										<div class="featured-image">
											<img src="img/shop/item3.jpg" alt="">
										</div>
										<div class="item-content">
											<h6><a href="#">Happy Ninja</a></h6>
											<span class="price">1 x &pound;35</span>
											<div class="remove-item">
												<i class="icons remove-shopping-item icon-cancel-circled"></i>
											</div>
										</div>
									</div>
									<div class="cart-item">
										<div class="featured-image">
											<img src="img/shop/item5.jpg" alt="">
										</div>
										<div class="item-content">
											<h6><a href="#">Woo Album #2</a></h6>
											<span class="price">1 x &pound;9</span>
											<div class="remove-item">
												<i class="icons remove-shopping-item icon-cancel-circled"></i>
											</div>
										</div>
									</div>
									<div class="cart-item">
										<h6>Cart subtotal: &pound;64</h6>
									</div>
									<div class="cart-item">
										<a href="#" class="button">View cart</a>
										<a href="#" class="button donate">Checkout</a>
									</div>
								</div>
								
							</div>
							
						</div>
						<!-- /Shopping Cart -->						
					</div>
				</div>
				
			</section>
			<!-- Page Heading -->
			

			
			<!-- Section -->
			<section class="section full-width-bg gray-bg">
				
				<div class="row">
				
					<div class="col-lg-9 col-md-9 col-sm-8">
						
						<!-- Checkout Login -->
						<div class="alert-box info toggle-alert-box animate-onscroll">
							<p>Returning customer? <a href=".checkout-login-form" class="toggle-link">Click here to login</a></p>
						</div>
						
						<form class="checkout-login-form animate-onscroll">
							
							<p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>
							
							<div class="row inline-inputs">
								
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>Username or email*</label>
									<input type="text">
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>Password*</label>
									<input type="text">
								</div>
								
							</div>
							
							<input type="submit" value="Login">
							<a href="#">Lost password?</a>
							
						</form>
						<!-- /Checkout Login -->
						
						
						
						<!-- Checkout Coupon -->
						<div class="alert-box info toggle-alert-box animate-onscroll">
							<p>Have a coupon? <a href=".checkout-coupon-form" class="toggle-link">Click here to enter your code</a></p>
						</div>
						
						<form class="checkout-coupon-form animate-onscroll">
							<div>
							
								<input type="text" placeholder="Coupon code">
								
								<input type="submit" value="Apply coupon">
							
							</div>
						</form>
						<!-- /Checkout Coupon -->
						
						
						
						<h3 class="animate-onscroll">Billing address</h3>
						
						<form id="checkout-form">
							
							<div class="animate-onscroll">
								<label>Country*</label>
								<select class="chosen-select">
									<option>United States</option>
									<option>France</option>
									<option>Germany</option>
									<option>United Kingdom</option>
								</select>
							</div>
							
							<div class="row inline-inputs animate-onscroll">
								
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>First Name*</label>
									<input type="text">
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>Last Name*</label>
									<input type="text">
								</div>
								
							</div>
							
							<div class="animate-onscroll">
								<label>Company Name</label>
								<input type="text">
								
								<label>Address*</label>
								<input type="text" placeholder="Street address">
								<input type="text" placeholder="Apartment, suite, unite etc. (optional)">
								
								<label>Town/City*</label>
								<input type="text" placeholder="Town/City">
							</div>
							
							<div class="row inline-inputs animate-onscroll">
								
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>Country</label>
									<input type="text" placeholder="State/Country">
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>Postcode*</label>
									<input type="text" placeholder="Postcode/Zip">
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>Email Address*</label>
									<input type="text">
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>Phone*</label>
									<input type="text">
								</div>
								
							</div>
							
							<div class="animate-onscroll">
								<input type="checkbox" id="create-an-account-chbx"><label for="create-an-account-chbx">Create an account?</label><br>
								<input type="checkbox" id="ship-to-billing-address-chbx"><label for="ship-to-billing-address-chbx">Ship to billing address</label><br>
							</div>
							
							<div class="animate-onscroll">
								<h3>Shipping address</h3>
								
								<label>Order notes</label>
								<textarea rows="7" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
							</div>
							
							<h3 class="animate-onscroll">Your Order</h3>
							
							<table class="your-order-table animate-onscroll">
							
								<tr>
									<th>Product</th>
									<th>Total</th>
								</tr>
								
								<tr>
									<td class="order-product">
										<div class="product-thumbnail">
											<img src="img/shop/item6.jpg" alt="">
										</div>
										<p>Woo Ninja x 1</p>
									</td>
									<th class="price">&pound;20</th>
								</tr>
								
								<tr>
									<td class="order-product">
										<div class="product-thumbnail">
											<img src="img/shop/item3.jpg" alt="">
										</div>
										<p>Happy Ninja x 1</p>
									</td>
									<th class="price">&pound;35</th>
								</tr>
								
								<tr>
									<td class="order-product">
										<div class="product-thumbnail">
											<img src="img/shop/item5.jpg" alt="">
										</div>
										<p>Woo Album #2 x 1</p>
									</td>
									<th class="price">&pound;9</th>
								</tr>
								
								<tr>

									<th class="align-right">Cart Subtotal</th>
									<th class="price">&pound;64</th>
								</tr>
								
								<tr>
									<th class="align-right">Shipping</th>
									<td class="price">Free shipping</td>
								</tr>
								
								<tr>
									<th class="align-right">Order Total</th>
									<th class="price">&pound;64</th>
								</tr>
								
							</table>
							
							
							<div class="payment-options animate-onscroll">
								<ul>
									<li>
										<div class="payment-header">
											<input type="radio" name="payment-option" checked="checked" id="direct-bank-transfer-radio">
											<label for="direct-bank-transfer-radio">Direct Bank Transfer</label>
										</div>
										<div class="payment-content">
											<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order wont be shipped until the funds have cleared in our account.</p>
										</div>
									</li>
									<li>
										<div class="payment-header">
											<input type="radio" name="payment-option" id="cheque-payment-radio">
											<label for="cheque-payment-radio">Cheque Payment</label>
										</div>
										<div class="payment-content">
											<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order wont be shipped until the funds have cleared in our account.</p>
										</div>
									</li>
									<li>
										<div class="payment-header">
											<input type="radio" name="payment-option" id="paypal-radio">
											<label for="paypal-radio">PayPal <img src="img/shop/paypal.png" alt=""></label>
										</div>
										<div class="payment-content">
											<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order wont be shipped until the funds have cleared in our account.</p>
										</div>
									</li>
								</ul>
							</div>
							
							<a href="#" class="button big donate animate-onscroll">Place Order</a>
							
						</form>	
						
						
						
					</div>
					
					
					
					<!-- Sidebar -->
					<div class="col-lg-3 col-md-3 col-sm-4 sidebar">
						
						
												<!-- Top Rated Products -->
						<div class="sidebar-box white animate-onscroll">
							
							<h3>Top rated products</h3>
							
							<ul class="shop-items-widget">
								
								<li>
									<div class="featured-image">
										<img src="img/shop/item3.jpg" alt="">
									</div>
									<div class="shop-item-content">
										<h6><a href="shop-productpage.html">Woo Album #1</a></h6>
										<span class="price">£9</span>
										<div class="shop-rating read-only-small" data-score="5"></div>
									</div>
								</li>
								
								<li>
									<div class="featured-image">
										<img src="img/shop/item6.jpg" alt="">
									</div>
									<div class="shop-item-content">
										<h6><a href="shop-productpage.html">Woo Ninja</a></h6>
										<span class="price">£20</span>
										<div class="shop-rating read-only-small" data-score="4.5"></div>
									</div>
								</li>
								
								<li>
									<div class="featured-image">
										<img src="img/shop/item7.jpg" alt="">
									</div>
									<div class="shop-item-content">
										<h6><a href="shop-productpage.html">Woo Logo</a></h6>
										<span class="price">£15</span>
										<div class="shop-rating read-only-small" data-score="5"></div>
									</div>
								</li>
								
							</ul>
							
						</div>
						<!-- /Top Rated Products -->						<!-- Categories -->
						<div class="sidebar-box category-box white animate-onscroll">
							
							<h3>Product Categories</h3>
							<ul>
								<li><a href="#">Clothing</a></li>
								<li><a href="#">Music</a></li>
								<li><a href="#">Posters</a></li>
								<li><a href="#">T-shirts</a></li>
							</ul>
							
						</div>
						<!-- /Categories -->						<!-- Tags -->
						<div class="sidebar-box white animate-onscroll">
							
							<h3>Tags</h3>
							<a href="#" class="tag">interviews</a>
							<a href="#" class="tag">design</a>
							<a href="#" class="tag">development</a>
							<a href="#" class="tag">marketing</a>
							<a href="#" class="tag">press</a>
							<a href="#" class="tag">projects</a>
							<a href="#" class="tag">resources</a>
							<a href="#" class="tag">tips</a>
							<a href="#" class="tag">tricks</a>
							<a href="#" class="tag">web</a>
							
						</div>
						<!-- /Tags -->						<!-- Instagram Photos -->
						<div class="sidebar-box white flickr-photos animate-onscroll">
							<h3>Instagram Photos</h3>
							<ul id="instagram-feed">
							</ul>
						</div>
						<!-- /Instagram Photos -->						<!-- Top Rated Products -->
						<div class="sidebar-box white animate-onscroll">
							
							<h3>Featured products</h3>
							
							<ul class="shop-items-widget">
								
								<li>
									<div class="featured-image">
										<img src="img/shop/item4.jpg" alt="">
									</div>
									<div class="shop-item-content">
										<h6><a href="shop-productpage.html">Woo Album #1</a></h6>
										<span class="price">£9</span>
									</div>
								</li>
								
								<li>
									<div class="featured-image">
										<img src="img/shop/item6.jpg" alt="">
									</div>
									<div class="shop-item-content">
										<h6><a href="shop-productpage.html">Woo Ninja</a></h6>
										<span class="price">£20</span>
									</div>
								</li>
								
								<li>
									<div class="featured-image">
										<img src="img/shop/item7.jpg" alt="">
									</div>
									<div class="shop-item-content">
										<h6><a href="shop-productpage.html">Woo Logo</a></h6>
										<span class="price">£15</span>
									</div>
								</li>
								
							</ul>
							
						</div>
						<!-- /Top Rated Products -->						
						
					</div>
					<!-- /Sidebar -->
					
					
					
				
				</div>
				
			</section>
			<!-- /Section -->
		
		</section>


			
			<!-- Footer -->
			<footer id="footer">
				
				<!-- Main Footer -->
				<div id="main-footer">
					
					<div class="row">
						
						<div class="col-lg-3 col-md-3 col-sm-6 animate-onscroll">
							
							<h4>Text Widget</h4>
							
							<p>Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel.<br><br>
Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum.</p>
							
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-6 animate-onscroll">
							
							<h4>Campaign</h4>
								
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 menu-container">
								
								<ul class="menu">
									<li><a href="#">About</a></li>
									<li><a href="#">Issues</a></li>
									<li><a href="#">Media</a></li>
									<li><a href="#">Blog</a></li> 
									<li><a href="#">Shop</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
								
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 menu-container">
								
								<ul class="menu">
									<li><a href="#">Email updates</a></li>
									<li><a href="#">Find events</a></li>
									<li><a href="#">Make calls</a></li>
									<li><a href="#">Register to vote</a></li> 
									<li><a href="#">Donate</a></li>
									<li><a href="#">Volunteer</a></li>
								</ul>
								
							</div>
							
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-6 twitter-widget-area animate-onscroll">
							
							<h4>Latest Tweets</h4>
							
							<div class="twitter-widget">
                                
							</div>
							
							<a href="#" class="button twitter-button">Follow us on twitter</a>
							
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-6 animate-onscroll">
							
							<h4>Like us on facebook</h4>
							
							</div>
						
					</div>
					
				</div>
				<!-- /Main Footer -->
				
				
				
				
				<!-- Lower Footer -->
				<div id="lower-footer">
					
					<div class="row">
						
						<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
						
							<p class="copyright">© 2014 Candidate. All Rights Reserved.More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
							
						</div>
						
						<div class="col-lg-8 col-md-8 col-sm-8 animate-onscroll">
							
							<div class="social-media">
								<ul class="social-icons">
									<li class="facebook"><a href="#" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>
									<li class="twitter"><a href="#" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>
									<li class="google"><a href="#" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>
									<li class="youtube"><a href="#" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>
									<li class="flickr"><a href="#" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>
									<li class="email"><a href="#" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>
								</ul>
								<ul class="social-buttons">
									<li>
										
									</li>
									<li>
										<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-type="button_count"></div>
									</li>
									
								</ul>
							</div>
							
						</div>
						
					</div>
					
				</div>
				<!-- /Lower Footer -->
				
			
			</footer>
			<!-- /Footer -->
			
			
			
			<!-- Back To Top -->
			<a href="#" id="button-to-top"><i class="icons icon-up-dir"></i></a>
		
		</div>
		<!-- /Container -->	
	
		<!-- JavaScript -->
		
		<!-- Bootstrap -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		
		<!-- Modernizr -->
		<script type="text/javascript" src="js/modernizr.js"></script>
		
		<!-- Sliders/Carousels -->
		<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="js/owl.carousel.min.js"></script>
		
		<!-- Revolution Slider  -->
		<script type="text/javascript" src="js/revolution-slider/js/jquery.themepunch.plugins.min.js"></script>
		<script type="text/javascript" src="js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
		
		<!-- Calendar -->
		<script type="text/javascript" src="js/responsive-calendar.min.js"></script>
		
		<!-- Raty -->
		<script type="text/javascript" src="js/jquery.raty.min.js"></script>
		
		<!-- Chosen -->
		<script type="text/javascript" src="js/chosen.jquery.min.js"></script>
		
		<!-- jFlickrFeed -->
		<script type="text/javascript" src="js/jflickrfeed.min.js"></script>
		
		<!-- InstaFeed -->
		<script type="text/javascript" src="js/instafeed.min.js"></script>
		
		<!-- Twitter -->
		<script type="text/javascript" src="php/twitter/jquery.tweet.js"></script>
		
		<!-- MixItUp -->
		<script type="text/javascript" src="js/jquery.mixitup.js"></script>
		
		<!-- JackBox -->
		<script type="text/javascript" src="jackbox/js/jackbox-packed.min.js"></script>
		
		<!-- CloudZoom -->
		<script type="text/javascript" src="js/zoomsl-3.0.min.js"></script>
		
		<!-- Main Script -->
		<script type="text/javascript" src="js/script.js"></script>
		
		
		<!--[if lt IE 9]>
			<script type="text/javascript" src="js/jquery.placeholder.js"></script>
			<script type="text/javascript" src="js/script_ie.js"></script>
		<![endif]-->
		
		
	</body>

</html>