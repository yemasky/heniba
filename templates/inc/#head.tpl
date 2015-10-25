<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Title -->
<title>Candidate HTML Template</title>

<!-- Google Fonts -->
<link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<%$__RESOURCE%>img/favicon.ico">

<!-- Stylesheets -->
<link href="<%$__RESOURCE%>css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<%$__RESOURCE%>css/fontello.css" rel="stylesheet" type="text/css">
<link href="<%$__RESOURCE%>css/flexslider.css" rel="stylesheet" type="text/css">
<link href="<%$__RESOURCE%>js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<%$__RESOURCE%>css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="<%$__RESOURCE%>css/responsive-calendar.css" rel="stylesheet" type="text/css">
<link href="<%$__RESOURCE%>css/chosen.css" rel="stylesheet" type="text/css">
<link href="<%$__RESOURCE%>jackbox/css/jackbox.min.css" rel="stylesheet" type="text/css" />
<link href="<%$__RESOURCE%>css/cloud-zoom.css" rel="stylesheet" type="text/css" />
<link href="<%$__RESOURCE%>css/style.css" rel="stylesheet" type="text/css">


<!--[if IE 9]>
	<link rel="stylesheet" href="<%$__RESOURCE%>css/ie9.css">
<![endif]-->

<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<link href="<%$__RESOURCE%>css/jackbox-ie8.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<%$__RESOURCE%>css/ie.css">
<![endif]-->

<!--[if gt IE 8]>
	<link href="<%$__RESOURCE%>css/jackbox-ie9.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if IE 7]>
	<link rel="stylesheet" href="<%$__RESOURCE%>css/fontello-ie7.css">
<![endif]-->

<style type="text/css">
	.no-fouc {display:none;}
</style>

<!-- jQuery -->
<script src="<%$__RESOURCE%>js/jquery-1.11.0.min.js"></script>
<script src="<%$__RESOURCE%>js/jquery-ui-1.10.4.min.js"></script>

<!-- Preloader -->
<script src="<%$__RESOURCE%>js/jquery.queryloader2.min.js"></script>

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