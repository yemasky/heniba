<!doctype html>
<html class="no-js fixed-layout">
<head>
  <%include file="merchant/inc/head.tpl"%>
  <link rel="stylesheet" href="<%$__RESOURCE%>assets/css/admin.css">
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

</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，现在网站暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
<script language="JavaScript">
    var obj;
    var img
</script>
<div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理模块</strong> / <small>订单管理</small></div>
    </div>
	<%if $pn==1%>
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="#" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>新增订单<br/>2300</a></li>
      <li><a href="#" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>成交订单<br/>308</a></li>
      <li><a href="#" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>昨日订单<br/>80082</a></li>
      <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>退款订单<br/>3000</a></li>
    </ul>
	<%/if%>
    <div class="am-g">
      <div class="am-u-sm-12">
        <table class="am-table am-table-bd am-table-striped admin-content-table">
          <thead>
          <tr>
            <th>订单号</th><th>类型</th><th>标题</th><th>基价</th><th>售价</th><th> </th>
          </tr>
          </thead>
          <tbody>
          <%section name=i loop=$datalist%>
          <tr>
              <td><%$datalist[i].o_order_number%></td>
              <td width="175">
                  <a href="index.php?model=tourism&action=product&id=<%$datalist[i].o_order_number%>" target="_blank">
                  <div class="am-slider am-slider-default" data-am-flexslider id="img-slider-<%$datalist[i].o_order_number%>">
                      <ul class="am-slides" id="img-<%$datalist[i].o_order_number%>">
                          <li><img src="'+item+'"></li>
                      </ul>
                  </div>
                  </a>
                  </td><td>标题</td>
              <td><a href="#">t_currency:(原价) (售价)</a></td>
              <td><span class="am-badge am-badge-success">20</span></td>
              <td>
                  <a href="index.php?model=tourism&action=product&id=<%$datalist[i].o_order_number%>" target="_blank">
                  <div class="am-dropdown" data-am-dropdown>
                      <button class="am-btn am-btn-warning am-round" type="button"><i class="am-icon-shopping-cart"></i>　预 定</button>
                  </div>
                  </a>
              </td>
          </tr>
          <%/section%>
          </tbody>
        </table>
          <%include file="merchant/inc/page.tpl"%>
      </div>
    </div>

    <%include file="merchant/inc/footer.tpl"%>
  </div>
</body>
</html>