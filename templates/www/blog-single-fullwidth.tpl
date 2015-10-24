
<!DOCTYPE html>

<html>

	<head>
		
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Title -->
		<title>Full width blog post | Candidate HTML Template</title>
		
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
						<li class="current-menu-item">
						
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
				
				<h1>Full width blog post</h1>
				<p class="breadcrumb"><a href="main-v1.html">Home</a> / Full width blog post</p>
				
			</section>
			<!-- Page Heading -->
			

			
			<!-- Section -->
			<section class="section full-width-bg gray-bg">
				
				<div class="row">
				
					<div class="col-lg-12 col-md-12 col-sm-12">
						
						<!-- Single Blog Post -->
						<div class="blog-post-single fullwidth-post">
							
							<div class="post-side-meta animate-onscroll">
										
								<div class="date">
									<span class="day">17</span>
									<span class="month">DEC</span>
								</div>
								
								<div class="post-format">
									<i class="icons icon-video"></i>
								</div>
								
								<div class="post-comments">
									<a href="blog-single-sidebar.html#comments"><i class="icons icon-chat-empty"></i> 13</a>
								</div>
								
							</div>

							
							<iframe class="youtube-video animate-onscroll" width="1200" height="600" src="//www.youtube.com/embed/bd2B6SjMh_w?rel=0&amp;wmode=transparent"></iframe>
							
							<div class="post-meta animate-onscroll">
								<span>by <a href="#">admin</a></span>
								<span>in <a href="#">Politics</a>, <a href="#">Videos</a></span>
							</div>
							
							<div class="post-content">
								
								<p class="animate-onscroll no-margin-bottom">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit agna,endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. </p>
								
								<div class="row">
									
									<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
										<p>Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia</p>
										<p>fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. 
Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor.
Aliquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. </p>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 animate-onscroll">
										<p>Aliquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in,auctor ut, ligula. Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem.</p>
										<p>Vestibulum sed ante. Donec sagittis euismod purus.Sed ut perspiciatis sit voluptatem accusantium doloremque laudantium, totam rem.</p>
									</div>
									
								</div>
								
							</div>
							
							
							<!-- Post Meta Track -->
							<div class="post-meta-track animate-onscroll">
								
								<table class="project-details">
									
									<tr>
										<td class="share-media">
											<ul class="social-share">	
												<li>Share this:</li>
												<li class="facebook"><a href="#" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>
												<li class="twitter"><a href="#" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>
												<li class="google"><a href="#" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>
												<li class="pinterest"><a href="#" class="tooltip-ontop" title="Pinterest"><i class="icons icon-pinterest-3"></i></a></li>
												<li class="email"><a href="#" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>
											</ul>
										</td>
										<td class="tags">Tags: <a href="#">meeting</a>, <a href="#">politics</a>, <a href="#">photos</a></td>
									</tr>
									
								</table>
								
							</div>
							<!-- /Post Meta Track -->
							
							
							
							<!-- Pagination -->
							<div class="row animate-onscroll">
								
								<div class="col-lg-6 col-md-6 col-sm-6 button-pagination align-left">
									<a href="#" class="button big previous">Prev post</a>
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6 button-pagination align-right">
									<a href="#" class="button big next">Next post</a>
								</div>
								
							</div>
							<!-- /Pagination -->
							
							
							<!-- Post Author -->
							<div class="post-author animate-onscroll">
								
								<h4>About Admin</h4>
								
								<div class="author-info">
									<div class="author-img">
										<img src="img/testimonials/profile9.jpg" alt="">
									</div>
									<div class="author-description">
										<p>Vestibulum sed ante. Donec sagittis euismod purus.Sed ut perspiciatis sit voluptatem accusantium doloremque laudantium, totam rem aperiam,eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
									</div>
								</div>
								
							</div>
							<!-- /Post Author -->
							
						</div>
						<!-- /Single Blog Post -->
							
							
							
						<!-- Related Articles -->
						<div class="related-articles">
							
							<h3>Related Articles</h3>
							
							<div class="row">
								
								<div class="col-lg-3 col-md-3 col-sm-6">
									
									<!-- Blog Post -->
									<div class="blog-post animate-onscroll">
										
										<div class="post-image">
											<img src="img/blog/post2.jpg" alt="">
										</div>
										
										<h4 class="post-title"><a href="#">Donec porta diam eu massa</a></h4>
										
										<div class="post-meta">
											<span>by <a href="#">admin</a></span>
											<span>October 01, 2013 11:28AM</span>
										</div>
										
									</div>
									<!-- /Blog Post -->
									
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-6">
									
									<!-- Blog Post -->
									<div class="blog-post animate-onscroll">
										
										<div class="post-image">
											<img src="img/blog/post3.jpg" alt="">
										</div>
										
										<h4 class="post-title"><a href="#">Vestibulum iaculis </a></h4>
										
										<div class="post-meta">
											<span>by <a href="#">admin</a></span>
											<span>October 01, 2013 11:28AM</span>
										</div>
										
									</div>
									<!-- /Blog Post -->
									
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-6">
									
									<!-- Blog Post -->
									<div class="blog-post animate-onscroll">
										
										<div class="post-image">
											<img src="img/blog/post1.jpg" alt="">
										</div>
										
										<h4 class="post-title"><a href="#">Praesent justo dolor</a></h4>
										
										<div class="post-meta">
											<span>by <a href="#">admin</a></span>
											<span>October 01, 2013 11:28AM</span>
										</div>
										
									</div>
									<!-- /Blog Post -->
									
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-6">
									
									<!-- Blog Post -->
									<div class="blog-post animate-onscroll">
										
										<div class="post-image">
											<img src="img/blog/post4.jpg" alt="">
										</div>
										
										<h4 class="post-title"><a href="#">Praesent justo dolor</a></h4>
										
										<div class="post-meta">
											<span>by <a href="#">admin</a></span>
											<span>October 01, 2013 11:28AM</span>
										</div>
										
									</div>
									<!-- /Blog Post -->
									
								</div>
								
							</div>
							
						</div>
						<!-- /Related Articles -->
						
						
						
						<!-- Post Comments -->
						<div class="post-comments">
							
							<h3 class="animate-onscroll">Comments</h3>
							
							<ul>
								<li>
									
									<div class="comment animate-onscroll">
									
										<div class="comment-author">
											<img src="img/testimonials/profile1.jpg" alt="">
											<div class="author-meta">
												<h6>Gloria Mann</h6>
												<div class="comment-meta">
													<span>September 23, 2013 at 11:45 am</span>
													<span><a href="#">Reply</a></span>
												</div>
											</div>
										</div>
										
										<div class="comment-content">
											<p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna." 
Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>
										</div>
									
									</div>
									
									<ul>
										
										<li>
									
											<div class="comment animate-onscroll">
											
												<div class="comment-author">
													<img src="img/testimonials/profile5.jpg" alt="">
													<div class="author-meta">
														<h6>admin</h6>
														<div class="comment-meta">
															<span>September 23, 2013 at 11:45 am</span>
															<span><a href="#">Reply</a></span>
														</div>
													</div>
												</div>
												
												<div class="comment-content">
													<p>Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. </p>
												</div>
											
											</div>
											
										</li>
										
									</ul>
									
								</li>
								
								<li>
									
									<div class="comment animate-onscroll">
									
										<div class="comment-author">
											<img src="img/testimonials/profile1.jpg" alt="">
											<div class="author-meta">
												<h6>Gloria Mann</h6>
												<div class="comment-meta">
													<span>September 23, 2013 at 11:45 am</span>
													<span><a href="#">Reply</a></span>
												</div>
											</div>
										</div>
										
										<div class="comment-content">
											<p>Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>
										</div>
									
									</div>
									
								</li>
							</ul>
							
						</div>
						<!-- /Post Comments -->
						
						
						
						<h3 class="animate-onscroll">Leave a reply</h3>
					
						<p class="animate-onscroll">Your email address will not be published. Fields marked * are mandatory.</p>

						<form id="comment-form" class="animate-onscroll">
							
							<div class="inline-inputs">
								
								<div class="col-lg-4 col-md-4 col-sm-4">
									<label>Name*</label>
									<input type="text" name="contact-email">								
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4">
									<label>Email*</label>
									<input type="text" name="contact-fname"> 	
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-4">
									<label>Website</label>
									<input type="text" name="contact-lname"> 	
								</div>
								
								<div class="col-lg-12 col-md-12 col-sm-12">
									<label>Comment</label>
									<textarea rows="10" name="contact-message"></textarea>
								</div>
								
							</div>
							
							<input type="submit" value="Post Comment">
							
						</form>
						
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