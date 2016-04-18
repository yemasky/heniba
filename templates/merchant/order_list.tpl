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
            <th width="175">订单号</th><th>类型</th><th>名称</th><th>基价</th><th>售价</th><th>时间</th><th>操作</th>
          </tr>
          </thead>
          <tbody>
          <%section name=i loop=$datalist%>
          <tr>
              <td><%$datalist[i].o_order_number%></td>
              <td>
                  <%if $datalist[i].oi_type=='tourism'%>旅游<%elseif $datalist[i].oi_type=='hotel'%>酒店<%else%>机票<%/if%>
              </td>
              <td><%$datalist[i].oi_title%></td>
              <td><a href="#"><%$datalist[i].oi_price_wholesale%></a></td>
              <td><span class="am-badge am-badge-success">RMB <%$datalist[i].oi_price_sell%></span></td>
              <td><%$datalist[i].oi_add_date%></td>
              <td>
                  <div class="am-btn-toolbar">
                      <div class="am-btn-group am-btn-group-xs">
                          <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                          <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 查看</button>
                          <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                      </div>
                  </div>
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