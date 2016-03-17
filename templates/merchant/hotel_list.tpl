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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理模块</strong> / <small>旅游产品</small></div>
    </div>
	<%if $pn==1%>
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="#" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>新增页面<br/>2300</a></li>
      <li><a href="#" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>成交订单<br/>308</a></li>
      <li><a href="#" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>昨日访问<br/>80082</a></li>
      <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>在线用户<br/>3000</a></li>
    </ul>
	<%/if%>



    <div class="am-g">
      <div class="am-u-sm-12">

          <div class="am-panel am-panel-default">
              <div class="am-panel-hd">搜索酒店：</div>
              <form method="post" action="" id="form-book" class="am-form am-form-horizontal">
                  <div class="am-panel-bd am-padding-bottom-0 am-margin-0">
                      <div class="am-form-group">
                          <div class="am-input-group am-input-group-sm am-u-md-3 am-padding-left-0 am-padding-right-0">
                              <span id="currency" class="am-input-group-label am-icon-rmb"> 酒店名称地址</span>
                              <input type="text" readonly="" class="am-form-field am-input-sm" value="" id="product_all">
                              <span class="am-input-group-label">总共</span>
                          </div>
                          <label for="arrivalDate" class="am-form-label am-u-sm-1 am-padding-left-0 am-padding-right-0 am-text-sm"></label>
                          <div class="am-input-group am-input-group-sm am-u-sm-3">
                              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 入住日期</span>
                              <input type="text" readonly="" placeholder="2016-03-16" value="2016-03-22" id="arrivalDate" class="am-form-field" name="arrivalDate">
                          </div>
                          <div class="am-input-group am-input-group-sm am-u-sm-3">
                              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 入住日期</span>
                              <input type="text" readonly="" placeholder="2016-03-16" value="2016-03-22" id="arrivalDate" class="am-form-field" name="arrivalDate">
                          </div>
                          <div class="am-form-group am-btn-group">
                              <div class="am-input-group am-input-group-sm am-form-select am-u-sm-4 am-padding-0">
                                  <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i> 人数</span>
                                  <select onchange="setProductPrice($('#arrivalDate').val(), 0)" id="pax_0" class="am-form-field am-input-sm" name="pax">
                                      <option value="1">1 人</option>
                                      <option value="2">2 人</option>
                                  </select>
                              </div>
                              <div class="am-input-group am-input-group-sm am-u-md-6 am-padding-left-0 am-padding-right-xl">
                                  <span id="currency" class="am-input-group-label am-icon-rmb"> CNY</span>
                                  <input type="text" readonly="" class="am-form-field am-input-sm" value="" id="product_0">
                                  <span class="am-input-group-label">每人</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="am-panel-bd am-cf">
                      <div class="am-g am-margin-left-0 am-padding-bottom">
                          <div class="am-u-sm-7">
                          </div>
                          <div class="am-u-sm-6 am-padding-left-0 am-padding-right-0">

                          </div>
                      </div>

                      <div data-am-dropdown="" class="am-cf am-padding-right">
                          <button type="button" id="order-popup-button" class="am-btn am-btn-warning am-round am-fr"><i class="am-icon-shopping-cart"></i>&#12288;预&#12288;定</button>
                      </div>
                  </div>
              </form>
          </div>

        <table class="am-table am-table-bd am-table-striped admin-content-table">
          <thead>
          <tr>
            <th>ID</th><th>图片</th><th>标题</th><th>基价</th><th>售价</th><th> </th>
          </tr>
          </thead>
          <tbody>
          <%section name=i loop=$hotel_list%>
          <tr>
              <td><%$hotel_list[i].h_id%></td>
              <td width="175">
                  <a href="index.php?model=<%$model%>&action=product&id=<%$hotel_list[i].h_id%>" target="_blank">
                  <div class="am-slider am-slider-default" data-am-flexslider id="img-slider-<%$hotel_list[i].h_id%>">
                      <ul class="am-slides" id="img-<%$hotel_list[i].h_id%>">
                          <li><img src="<%$hotel_list[i].h_images%>" /> </li>
                      </ul>
                  </div>
                  </a>
                  </td><td><%$hotel_list[i].h_name%></td>
              <td><a href="#"><%$hotel_list[i].h_currency%>:(原价)<%$hotel_list[i].wholesale%> (售价)<%$hotel_list[i].sell%></a></td>
              <td><span class="am-badge am-badge-success">+20</span></td>
              <td>
                  <a href="index.php?model=hotel&action=product&id=<%$hotel_list[i].h_id%>" target="_blank">
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

   <footer>
      <hr>
      <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
  </div>
</body>
</html>