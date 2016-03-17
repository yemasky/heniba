<!DOCTYPE html>
<html>
<head lang="en">
  <%include file="merchant/inc/head.tpl"%>
  <style>
    @media only screen and (min-width: 1200px) {.blog-g-fixed {max-width: 1200px;}}
    @media only screen and (min-width: 641px) {.blog-sidebar {font-size: 1.4rem;}}
    .blog-title {margin: 10px 0 20px 0;}
	.blog-meta {font-size: 14px;margin: 10px 0 20px 0;color: #222;}
	.blog-meta a {color: #27ae60;}
	.blog-pagination a {font-size: 1.4rem;}
    .blog-team li {padding: 4px;}
    .blog-team img {margin-bottom: 0;}
	.blog-content img,.blog-team img {max-width: 100%;height: auto;}
	.blog-footer {padding: 10px 0;text-align: center;}
  </style>
  <!--[if lt IE 9]>
  <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
  <script src="<%$__RESOURCE%>assets/js/amazeui.ie8polyfill.min.js"></script>
  <![endif]-->

  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="<%$__RESOURCE%>assets/js/jquery.min.js"></script>
  <!--<![endif]-->
  <script src="<%$__RESOURCE%>assets/js/amazeui.min.js"></script>
</head>
<body>
<header class="am-topbar">
  <h1 class="am-topbar-brand">
    <a href="#">旅游管理</a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
          data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
      class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-active"><a href="#">预订内容</a></li>
      <li><a href="./">返回后台管理</a></li>
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          出境旅游-世界游 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li class="am-dropdown-header">世界</li>
          <li><a href="#">亚洲</a></li>
          <li><a href="#">欧洲</a></li>
          <li><a href="#">美洲</a></li>
        </ul>
      </li>
    </ul>

    <form class="am-topbar-form am-topbar-left am-form-inline am-topbar-right" role="search">
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm" placeholder="搜索旅游">
      </div>
      <button type="submit" class="am-btn am-btn-default am-btn-sm">搜索</button>
    </form>

  </div>
</header>
<%include file="merchant/supplier_tpl/$hotel_supplier_tpl.tpl"%>
<footer class="blog-footer">
  <p>blog template<br/>
    <small>© Copyright XXX. by the AmazeUI Team.</small>
  </p>
</footer>
</body>
</html>
