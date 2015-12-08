<!doctype html>
<html class="no-js fixed-layout">
<head>
<%include file="merchant/inc/head.tpl"%>
  <link rel="stylesheet" href="<%$__RESOURCE%>assets/css/admin.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，现在网站暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
<%include file="merchant/inc/admin_header.tpl"%>
<div class="am-cf admin-main">
  <!-- sidebar start -->
  <%include file="merchant/inc/admin_sidebar.tpl"%>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content" style="overflow-y: hidden;">
  <iframe name="main_frame" src="index.php?action=admin_content" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" allowtransparency="1"></iframe>
  </div>
  <!-- content end -->

</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.1.11.1.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="<%$__RESOURCE%>assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<%$__RESOURCE%>assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="<%$__RESOURCE%>assets/js/amazeui.min.js"></script>
<script src="<%$__RESOURCE%>assets/js/app.js"></script>
</body>
</html>
