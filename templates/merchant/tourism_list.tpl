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
      <li><a href="#" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>新增旅游景点<br/>2300</a></li>
      <li><a href="#" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>成交订单<br/>308</a></li>
      <li><a href="#" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>昨日访问<br/>80082</a></li>
      <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>在线用户<br/>3000</a></li>
    </ul>
	<%/if%>
    <div class="am-g">
      <div class="am-u-sm-12">
          <div class="am-panel am-panel-default">
              <div class="am-panel-hd">搜索景点：</div>
              <form method="post" action="index.php?model=tourism&action=search" id="form-book" class="am-form am-form-horizontal">
                  <div class="am-panel-bd am-padding-bottom-0 am-margin-0">
                      <div class="am-form-group">
                          <div class="am-input-group am-input-group-sm am-u-md-4">
                              <span  class="am-input-group-label am-icon-home"> 地方、景点名称</span>
                              <input id="place" name="place" type="text" class="am-form-field am-input-sm" autocomplete="off" value="<%$place%>">
                              <input type="hidden" name="pn" id="pn" value="<%$pn%>">
                          </div>
                          <div class="am-input-group am-input-group-sm am-u-md-4 am-padding-left-0 am-padding-right-xl">
                              <div data-am-dropdown="" class="am-cf am-padding-right">
                                  <button type="submit" id="order-popup-button" class="am-btn am-btn-warning am-round am-fr"><i class="am-icon-shopping-cart"></i>&#12288;查&#12288;看</button>
                              </div>
                          </div>

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
          <%section name=i loop=$tourism%>
          <tr>
              <td><%$tourism[i].t_id%></td>
              <td width="175">
                  <a href="index.php?model=tourism&action=product&id=<%$tourism[i].t_id%>" target="_blank">
                  <div class="am-slider am-slider-default" data-am-flexslider id="img-slider-<%$tourism[i].t_id%>">
                      <ul class="am-slides" id="img-<%$tourism[i].t_id%>">
                      </ul>
                  </div>
                  </a>
                  <script language="JavaScript">
                      obj = jQuery.parseJSON('<%$tourism[i].t_images%>');
                      img = '';
                      $.each(obj, function(i, item){
                          img += '<li><img src="'+item+'"></li>';
                          $('#img-<%$tourism[i].t_id%>').html(img);
                      });
                  </script>
                  </td><td><%$tourism[i].t_title%><br><%$tourism[i].t_title_cn%></td>
              <td><a href="#"><%$tourism[i].t_currency%> <%$tourism[i].wholesale%> </a></td>
              <td><span class="am-badge am-badge-success"><%$tourism[i].t_currency%> <%$tourism[i].sell%></span></td>
              <td>
                  <a href="index.php?model=tourism&action=product&id=<%$tourism[i].t_id%>" target="_blank">
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