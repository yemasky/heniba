
<!DOCTYPE html>

<html>

	<head>
		
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Title -->
		<title>Shortcodes | Candidate HTML Template</title>
		
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
						<li class="current-menu-item">
						
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
						<li >
						
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
				
				<h1>Shortcodes</h1>
				<p class="breadcrumb"><a href="main-v1.html">Home</a> / Shortcodes</p>
				
			</section>
			<!-- Page Heading -->
			
			
			
			
			<!-- Section -->
			<section class="section full-width-bg gray-bg">
				
				<div class="row">
				
					<div class="col-lg-4 col-md-4 col-sm-12 animate-onscroll">
						
						<h3>Accordion</h3>
						
												<!-- Accordions -->
						<ul class="accordions">
								
							<!-- Accordion -->
							<li class="accordion">
								
								<div class="accordion-header">
									<div class="accordion-icon"></div>
									<h6>Section 1</h6>
									
								</div>
								
								<div class="accordion-content">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
							</li>
							<!-- /Accordion -->
							
							<!-- Accordion -->
							<li class="accordion">
								
								<div class="accordion-header">
									<div class="accordion-icon"></div>
									<h6>Section 2</h6>
									
								</div>
								
								<div class="accordion-content">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
							</li>
							<!-- /Accordion -->
							
							<!-- Accordion -->
							<li class="accordion">
								
								<div class="accordion-header">
									<div class="accordion-icon"></div>
									<h6>Section 2</h6>
									
								</div>
								
								<div class="accordion-content">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
							</li>
							<!-- /Accordion -->
							
							<!-- Accordion -->
							<li class="accordion">
								
								<div class="accordion-header">
									<div class="accordion-icon"></div>
									<h6>Section 4</h6>
									
								</div>
								
								<div class="accordion-content">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
							</li>
							<!-- /Accordion -->
							
						</ul>
						<!-- /Accordions -->						
					</div>
					
					
					
					<div class="col-lg-4 col-md-4 col-sm-12 animate-onscroll">
						
						<h3>Toggles</h3>
						
												<!-- Accordions -->
						<ul class="accordions toggles">
								
							<!-- Accordion -->
							<li class="accordion">
								
								<div class="accordion-header">
									<div class="accordion-icon"></div>
									<h6>Section 1</h6>
									
								</div>
								
								<div class="accordion-content">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
							</li>
							<!-- /Accordion -->
							
							<!-- Accordion -->
							<li class="accordion">
								
								<div class="accordion-header">
									<div class="accordion-icon"></div>
									<h6>Section 2</h6>
									
								</div>
								
								<div class="accordion-content">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
							</li>
							<!-- /Accordion -->
							
							<!-- Accordion -->
							<li class="accordion">
								
								<div class="accordion-header">
									<div class="accordion-icon"></div>
									<h6>Section 2</h6>
									
								</div>
								
								<div class="accordion-content">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
							</li>
							<!-- /Accordion -->
							
							<!-- Accordion -->
							<li class="accordion">
								
								<div class="accordion-header">
									<div class="accordion-icon"></div>
									<h6>Section 4</h6>
									
								</div>
								
								<div class="accordion-content">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
							</li>
							<!-- /Accordion -->
							
						</ul>
						<!-- /Accordions -->						
					</div>
					
					
					
					
					
					<div class="col-lg-4 col-md-4 col-sm-12 animate-onscroll">
					
						<h3>Tabs</h3>
						
												<!-- Tabs -->
						<div class="tabs">
							
							<div class="tab-header">
								<ul>
									<li><a href="#tab11"><h6>Section 1</h6></a></li>
									<li><a href="#tab22"><h6>Section 2</h6></a></li>
									<li><a href="#tab33"><h6>Section 3</h6></a></li>
								</ul>
							</div>
							
							<div class="tab-content">
								
								<div id="tab11" class="tab">
									<img class="align-center" src="img/tab-image.jpg" alt="">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
								<div id="tab22" class="tab">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
								<div id="tab33" class="tab">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin.</p>
								</div>
								
							</div>
							
						</div>
						<!-- /Tabs -->					
					</div>
					
					
				
				</div>
				
				
				
				
				<div class="row">
				
					
					<div class="col-lg-8 col-md-8 col-sm-12 animate-onscroll">
					
						<h3>Tabs 2</h3>
						
												<!-- Tabs -->
						<div class="tabs style2">
							
							<div class="tab-header">
								<ul>
									<li><a href="#tab1"><h6>Section 1</h6></a></li>
									<li><a href="#tab2"><h6>Section 2</h6></a></li>
									<li><a href="#tab3"><h6>Section 3</h6></a></li>
								</ul>
							</div>
							
							<div class="tab-content">
								
								<div id="tab1" class="tab">
									<img class="align-left" src="img/tab-image-round.jpg" alt="">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
								<div id="tab2" class="tab">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin. 
<br><br>
Aiquam eget, iaculis id lacus. Praesent tudin. Ut sem lacus, ttitor putate uam mi nec hendrerit.</p>
								</div>
								
								<div id="tab3" class="tab">
									<p>Sed entum velit vel ipsum bibendum em lacus, itor et aliquam eget, iaculis id lacus. Praesent tudin.</p>
								</div>
								
							</div>
							
						</div>
						<!-- /Tabs -->						
					</div>
					
					
					
					
					<div class="col-lg-4 col-md-4 col-sm-12 animate-onscroll">
						
						<h3>Buttons</h3>
						
												<a href="#" class="button transparent">Small Button 1</a>
						<a href="#" class="button transparent button-arrow">Small Button 2</a>
						<br><br>
						<a href="#" class="button">Middle Button 1</a>
						<a href="#" class="button button-arrow">Middle Button 2</a>
						<br><br>
						<a href="#" class="button big">Big Button 1</a>
						<a href="#" class="button big button-arrow">Big Button 2</a>
						<br><br>
						<a href="#" class="button donate">Donate</a>
						<a href="#" class="button donate big">Donate</a>					
					</div>
					
				
				</div>
				
				
				
				
				
				<div class="row">
					
					<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
						
						<h3>Lists</h3>
						
												<div class="row">
							
							<div class="col-lg-2 col-md-2 col-sm-4">
								
								<ul class="list arrow-list">
									<li>Ut tellus dolor</li>
									<li>Dapibus eget</li>
									<li>Elementum vel</li>
								</ul>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-4">
								
								<ul class="list check-list">
									<li>Ut tellus dolor</li>
									<li>Dapibus eget</li>
									<li>Elementum vel</li>
								</ul>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-4">
								
								<ul class="list star-list">
									<li>Ut tellus dolor</li>
									<li>Dapibus eget</li>
									<li>Elementum vel</li>
								</ul>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-4">
								
								<ul class="list plus-list">
									<li>Ut tellus dolor</li>
									<li>Dapibus eget</li>
									<li>Elementum vel</li>
								</ul>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-4">
								
								<ul class="list finger-list">
									<li>Ut tellus dolor</li>
									<li>Dapibus eget</li>
									<li>Elementum vel</li>
								</ul>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-4">
								
								<ol class="list ordered-list">
									<li>Ut tellus dolor</li>
									<li>Dapibus eget</li>
									<li>Elementum vel</li>
								</ol>
								
							</div>
							
						</div>					
					</div>
					
				
				</div>
				
				
				
				
				
				<div class="row">
				
					
					<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
						<h3>Blockquotes</h3>
					</div>
					
										<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
						
						<blockquote>"Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum."</blockquote>
						
					</div>
					
					
					<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
						
						<blockquote class="iconic-quote">"Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum."</blockquote>
						
					</div>				
				</div>
				
				
				
				
				
				
				
				<div class="row">
				
					
					<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
						<h3>Testimonials</h3>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-12 animate-onscroll">
						
												<!-- Testimonial -->
						<div class="testimonial animate-onscroll">
							
							<div class="testimonial-content">
								<p>"Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit."</p>
							</div>
							
							<div class="testimonial-author">
								<img src="img/testimonials/profile1.jpg" alt="">
								<div class="author-meta">
									<span class="name">Gloria Mann,</span>
									<span class="location">Los Angeles</span>
								</div>
							</div>
							
						</div>
						<!-- /Testimonial -->						
					</div>
					
					
					<div class="col-lg-6 col-md-6 col-sm-12 animate-onscroll">
						
												<!-- Owl Carousel -->
						<div class="owl-carousel-container testimonial-carousel animate-onscroll">
							
														<div class="owl-carousel" data-max-items="1">
										
								<!-- Owl Item -->
								<div>
									
									<!-- Testimonial -->
									<div class="testimonial">
							
										<div class="testimonial-content">
											<p>"Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis."<br>
Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna." </p>
										</div>
										
										<div class="testimonial-author">
											<img src="img/testimonials/profile1.jpg" alt="">
											<div class="author-meta">
												<span class="name">Gloria Mann,</span>
												<span class="location">Los Angeles</span>
											</div>
										</div>
										
									</div>
									<!-- /Testimonial -->
									
								</div>
								<!-- /Owl Item -->
								
								<!-- Owl Item -->
								<div>
									
									<!-- Testimonial -->
									<div class="testimonial">
							
										<div class="testimonial-content">
											<p>"Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros." </p>
										</div>
										
										<div class="testimonial-author">
											<img src="img/testimonials/profile2.jpg" alt="">
											<div class="author-meta">
												<span class="name">Gloria Mann,</span>
												<span class="location">Los Angeles</span>
											</div>
										</div>
										
									</div>
									<!-- /Testimonial -->
									
								</div>
								<!-- /Owl Item -->
								
								<!-- Owl Item -->
								<div>
									
									<!-- Testimonial -->
									<div class="testimonial">
							
										<div class="testimonial-content">
											<p>"Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis."<br>
Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna." </p>
										</div>
										
										<div class="testimonial-author">
											<img src="img/testimonials/profile3.jpg" alt="">
											<div class="author-meta">
												<span class="name">Gloria Mann,</span>
												<span class="location">Los Angeles</span>
											</div>
										</div>
										
									</div>
									<!-- /Testimonial -->
									
								</div>
								<!-- /Owl Item -->
							
							</div>
							
							<div class="owl-header">
								
								<div class="carousel-arrows">
									<span class="left-arrow"><i class="icons icon-left-dir"></i></span>
									<span class="right-arrow"><i class="icons icon-right-dir"></i></span>
								</div>
								
							</div>
						
						</div>
						<!-- /Owl Carousel -->						
					</div>
				
				</div>
				
				
				
				
				
				
				
				<div class="row">
					
					<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
						<h3>Alert Boxes</h3>
					</div>
					
										<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
						
						<div class="alert-box warning">
							<p><strong>Warning!</strong> Best check yo self, you're not looking too good.</p>
							<i class="icons icon-cancel-circle-1"></i>
						</div>
						
						<div class="alert-box error">
							<p><strong>Oh snap!</strong> Change a few things up and try submitting again. </p>
							<i class="icons icon-cancel-circle-1"></i>
						</div>
						
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
						
						<div class="alert-box success">
							<p><strong>Well done!</strong> You successfully read this important alert message. </p>
							<i class="icons icon-cancel-circle-1"></i>
						</div>
						
						<div class="alert-box info">
							<p><strong>Heads up!</strong> This alert needs your attention, but it's not super important. </p>
							<i class="icons icon-cancel-circle-1"></i>
						</div>
						
					</div>				
				</div>
				
				
				
				
				
				
				
				<div class="row">
					
					<div class="col-lg-6 col-md-6 col-sm-12 animate-onscroll">
						
						<h3>Pagination</h3>
						
												<div class="numeric-pagination">
							<a href="#" class="button"><i class="icons icon-left-dir"></i></a>
							<a href="#" class="button">1</a>
							<a href="#" class="button">2</a>
							<a href="#" class="button">3</a>
							<a href="#" class="button"><i class="icons icon-right-dir"></i></a>
						</div>
						
						<div class="button-pagination">
							<a href="#" class="button big previous">Prev post</a>
							<a href="#" class="button big next">Next post</a>
						</div>						
						
						
						
						<h3>Dividers</h3>
						
												<div class="divider"></div>
						<div class="divider light"></div>						
						
						
						
						
						<h3>Progress Bars</h3>
						
												<p>Alabama</p>
						<div class="progressbar" data-percent="80">
							<span class="progress-percent"></span>
							<div class="progress-width"></div>
						</div>
						
						<p>California</p>
						<div class="progressbar" data-percent="65">
							<span class="progress-percent"></span>
							<div class="progress-width"></div>
						</div>
						
						<p>Louisiana</p>
						<div class="progressbar" data-percent="92">
							<span class="progress-percent"></span>
							<div class="progress-width"></div>
						</div>						
						
						
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-12 animate-onscroll">
						
						<h3>Tables</h3>
						
												<table>
							
							<tr>
								<th>Header 1</th>
								<th>Header 2</th>
								<th>Header 3</th>
							</tr>
							
							<tr>
								<td>Item#1</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#2</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#3</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#4</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#5</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#6</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td>Item#7</td>
								<td>Lorem Ipsum</td>
								<td>1032</td>
							</tr>
							
							<tr>
								<td><strong>Total:</strong></td>
								<td><strong>Lacinia fermentum</strong></td>
								<td><strong>55</strong></td>
							</tr>
							
						</table>						
					</div>
				
				</div>
				
				
				
				
				
				<div class="row">
					
					<div class="col-lg-6 col-md-6 col-sm-12 animate-onscroll">
						
						<h3>Forms</h3>
						
												<label>Text</label>
						<input type="text">
						
						<br><br>
						
						<label>Radio</label><br>
						<input type="radio" name="radiogroup" id="radio-1"><label for="radio-1">Radio 1</label>
						<input type="radio" name="radiogroup" id="radio-2"><label for="radio-2">Radio 2</label>
						
						<br><br>
						
						<label>Checkbox</label><br>
						<input type="checkbox" id="checkbox-1"><label for="checkbox-1">Checkbox 1</label>
						<input type="checkbox" id="checkbox-2"><label for="checkbox-2">Checkbox 2</label>
						
						<br><br>
						
						<label>Select</label>
						<select class="chosen-select">
							<option>Please select</option>
							<option>Option 1</option>
							<option>Option 2</option>
							<option>Option 3</option>
							<option>Option 4</option>
							<option>Option 5</option>
						</select>
						
						<br><br>
						
						<label>Textarea</label>
						<textarea rows="8"></textarea>
						
						<br><br>
						
						<div class="notification-input">
							
							<label>Input with warning</label>
							<div class="warning">
								<input type="text"><label>Something may have gone wrong</label>
							</div>
							
							<label>Input with error</label>
							<div class="error">
								<input type="text"><label>Please correct the error</label>
							</div>
							
							<label>Input with info</label>
							<div class="info">
								<input type="text"><label>Username is taken</label>
							</div>
							
							<label>Input with success</label>
							<div class="success">
								<input type="text"><label>Woohoo!</label>
							</div>
							
						</div>						
						
					</div>
					
					
					
					
					<div class="col-lg-6 col-md-6 col-sm-12 animate-onscroll">
						
						<h3>Dropcaps</h3>
						
												<p><span class="dropcap">M</span>auris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.</p>
						<br>
						<p><span class="dropcap blue">M</span>auris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.</p>
						<br>
						<p><span class="dropcap squared">M</span>auris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.</p>
						<br>
						<p><span class="dropcap squared blue">M</span>auris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.</p>						
						
						<h3>Tooltips &amp; Highligths</h3>
						
											<p>Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor <a href="#" title="Top positioned tooltip" class="tooltip-ontop">sit amet</a>, consectetuer adipiscing elit. <span class="highlight">Mauris fermentum</span> dictum magna. Sed laoreet aliquam leo. Ut <a href="#" title="Left positioned tooltip" class="tooltip-onleft">tellus dolor</a>, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam <a href="#" title="Bottom positioned tooltip" class="tooltip-onbottom">erat volutpat</a>. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget,<a href="#" title="Right positioned tooltip" class="tooltip-onright"> malesuada at</a>, neque. </p>						
						
						<h3>Emphasis</h3>
						
												<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<p>Here is small text<br>
								<i>Here is italicized text</i><br>
								<u>Here is underlined text</u><br>
								<strong>Here is bold text</strong>
								</p>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<p><span class="yellow">Something may have gone wrong</span><br>
								<span class="red">Please correct the error</span><br>
								<span class="blue">Username is taken</span><br>
								<span class="green">Woohoo!</span>
								</p>
							</div>
						</div>						
						
					</div>
				
				
				</div>
				
				
				
				
				
				
				<div class="row">
					
					<div class="col-lg-6 col-md-6 col-sm-12 animate-onscroll">
					
											<iframe width="420" height="320" src="//www.youtube.com/embed/bd2B6SjMh_w?rel=0&amp;wmode=transparent"></iframe>						<h6>Youtube Video Player</h6>
						
											<iframe height="166" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/120155029&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>						<h6>Sound Cloud Audio Player</h6>
						
												<audio class="volume-on">
							<source src="assets/song.mp3" type="audio/mpeg">
							<source src="assets/song.ogg" type="audio/ogg">
							Your browser does not support the audio element.
						</audio>						<h6>Self Hosted Audio Player</h6>
						
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-12 animate-onscroll">
						
											
					<iframe src="//player.vimeo.com/video/16921888" width="500" height="320"></iframe>						<h6>Vimeo Video Player</h6>
						
						
												<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="media-item gallery-item no-margin-bottom">
									<img src="img/media/media1-medium.jpg" alt="">
									<div class="media-hover">
										<div class="media-icons">
											<a href="img/media/media1.jpg" data-group="media-jackbox" class="jackbox media-icon"><i class="icons icon-eye"></i></a>
											<a href="#" class="media-icon"><i class="icons icon-link"></i></a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="media-item gallery-item no-margin-bottom">
									<img src="img/media/media2-medium.jpg" alt="">
									<div class="media-hover">
										<div class="media-icons">
											<a href="http://vimeo.com/17573879" data-group="media-jackbox" class="jackbox media-icon"><i class="icons icon-eye"></i></a>
											<a href="#" class="media-icon"><i class="icons icon-link"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>						<h6 class="shortcodes-caption">LightBox</h6>
						
					</div>
				
				</div>
				
				
				
				
				
				<div class="row">
				
					<div class="col-lg-12 col-md-12 col-sm-12 animate-onscroll">
						
						<h3 class="no-margin-top">Pricing tables</h3>
						
												<table class="pricing-tables">
							<tr>
								
								<td>
									
									<div class="pricing-table">
										
										<div class="pricing-header">
											<h4>Basic</h4>
										</div>
										
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">9</span>
											<span class="period">/ mo</span>
										</div>
										
										<ul class="pricing-features">
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
										</ul>
										
										<div class="pricing-button">
											<a href="#" class="button big">Sign up</a>
										</div>
										
									</div>
									
								</td>
								
								<td>
									
									<div class="pricing-table most-popular">
										
										<div class="pricing-header">
											<h4>Pro</h4>
											<span>Most Popular</span>
										</div>
										
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">19</span>
											<span class="period">/ mo</span>
										</div>
										
										<ul class="pricing-features">
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
											<li>Elementum vel cursus</li>
										</ul>
										
										<div class="pricing-button">
											<a href="#" class="button big">Sign up</a>
										</div>
										
									</div>
									
								</td>
								
								<td>
									
									<div class="pricing-table">
										
										<div class="pricing-header">
											<h4>Advanced</h4>
										</div>
										
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">29</span>
											<span class="period">/ mo</span>
										</div>
										
										<ul class="pricing-features">
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
										</ul>
										
										<div class="pricing-button">
											<a href="#" class="button big">Sign up</a>
										</div>
										
									</div>
									
								</td>
								
								<td>
									
									<div class="pricing-table">
										
										<div class="pricing-header">
											<h4>Business</h4>
										</div>
										
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">39</span>
											<span class="period">/ mo</span>
										</div>
										
										<ul class="pricing-features">
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
											<li>Ut tellus dolor</li>
											<li>Dapibus deget</li>
											<li>Elementum vel cursus</li>
										</ul>
										
										<div class="pricing-button">
											<a href="#" class="button big">Sign up</a>
										</div>
										
									</div>
									
								</td>
								
							</tr>
						</table>						
					
					</div>
				
				</div>
				
				
				
				
				
				
				<div class="row">
					
					<div class="col-lg-12 col-md-12 col-sm-12">
					
					
						<h3 class="animate-onscroll no-margin-bottom">Columns</h3>
						
												<div class="row">
							
							<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
								<h5>One half</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. </p>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
								<h5>One half</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. </p>
							</div>
							
						</div>
						
						<div class="row">
							
							<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
								<h5>One third</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
								<h5>One third</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
								<h5>One third</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>
							</div>
							
						</div>
						
						<div class="row">
							
							<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
								<h5>One third</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>
								
							</div>
							
							<div class="col-lg-8 col-md-8 col-sm-8 animate-onscroll">
								<h5>Two third</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat.  Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </p>
								
							</div>
							
						</div>
						
						<div class="row">
							
							<div class="col-lg-3 col-md-3 col-sm-3 animate-onscroll">
								<h5>One fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget.</p>
								
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-3 animate-onscroll">
								<h5>One fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget.</p>
								
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-3 animate-onscroll">
								<h5>One fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget.</p>
								
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-3 animate-onscroll">
								<h5>One fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget.</p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
								<h5>Two fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. </p>
								
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-3 animate-onscroll">
								<h5>One fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget.</p>
								
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-3 animate-onscroll">
								<h5>One fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget.</p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-9 col-md-9 col-sm-9 animate-onscroll">
								<h5>Three fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. </p>
								
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-3 animate-onscroll">
								<h5>One fourth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget.</p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-10 col-md-10 col-sm-10 animate-onscroll">
								<h5>Five sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. </p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-8 col-md-8 col-sm-8 animate-onscroll">
								<h5>Four sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
								<h5>Three sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. </p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
								<h5>Two sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. </p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
								<h5>Three sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
								<h5>Two sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. </p>
								
							</div>
							
						</div>
						
						
						<div class="row">
							
							<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
								<h5>Two sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-2 animate-onscroll">
								<h5>One sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing. </p>
								
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 animate-onscroll">
								<h5>Two sixth</h5>
								<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. </p>
								
							</div>
							
						</div>						
						
					</div>
				
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