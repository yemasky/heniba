<!doctype html>
<html class="no-js fixed-layout">
<head>
  <%include file="merchant/inc/head.tpl"%>
  <link rel="stylesheet" href="<%$__RESOURCE%>assets/css/admin.css">
  <link rel="stylesheet" href="<%$__RESOURCE%>assets/css/trip-calendar.css">
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
<style type="text/css">
.am-popover-inner{background:#FFF;}
.am-popover{background:#999; border:1px solid #CCC;}

body,form,ul,li,input{margin:0;padding:0;}
body{font:12px/1.5 Arial;}
.title{padding:0;margin:10px 0;font:700 18px/1.5 \5fae\8f6f\96c5\9ed1;text-align:center;}
.title a{font:400 14px/1.5 Tahoma;margin-left:20px;}
#search input{background:#FFF url(http://img02.taobaocdn.com/tps/i2/T122NIXoBAXXXXXXXX-200-200.png) 0 0 no-repeat;}
#search{width:350px;margin:20px auto 0;border:1px solid #C4E6F1;}
#search form{color:#666;border:2px solid #78B1C8;}
#search ul{padding:10px 20px;vertical-align:top;}
#search li{padding:5px 0;list-style:none;line-height:25px;zoom:1;}
#search li:after{content:".";clear:both;display:block;height:0;	visibility:hidden;}
#search label,#search input,#search span{float:left;}
#search .tit{width:60px;min-height:25px;height:auto!important;height:25px;}
#search .f-text{padding:3px;width:179px;height:18px;color:#666;line-height:18px;font-family:inherit;border-color:#AFAFAF #DCDCDC #DCDCDC #AFAFAF;border-width:0 1px 1px 0;background-position:0 -100px;}
#search .f-btn{border:0;width:85px;height:31px;cursor:pointer;}
#search .f-btn:hover{background-position:-86px 0;}
</style>
<script src="<%$__RESOURCE%>assets/js/yui-min.js"></script>
<script language="javascript">
YUI({
    modules: {
        'trip-calendar': {
            fullpath: '<%$__RESOURCE%>assets/js/trip-calendar.js',
            type    : 'js',
            requires: ['<%$__RESOURCE%>assets/css/trip-calendar-css']
        },
        'trip-calendar-css': {
            fullpath: '<%$__RESOURCE%>assets/css/trip-calendar.css',
            type    : 'css'
        }
    }
}).use('trip-calendar', function(Y) {
    
    var oCal = new Y.TripCalendar({
        minDate         : new Date,     //最小时间限制
        triggerNode     : '#J_DepDate', //第一个触节点
        finalTriggerNode: '#J_EndDate'  //最后一个触发节点
    });
    
    //校验
    Y.one('#J_Search').on('submit', function(e) {
        e.halt();
        var rDate    = /^((19|2[01])\d{2})-(0?[1-9]|1[012])-(0?[1-9]|[12]\d|3[01])$/;
            oDepDate = Y.one('#J_DepDate'),
            oEndDate = Y.one('#J_EndDate'),
            sDepDate = oDepDate.get('value'),
            sEndDate = oEndDate.get('value'), 
            aMessage = ['请选择出发日期', '请选择返程日期', '返程时间不能早于出发时间，请重新选择', '日期格式错误'],
            iError   = -1;   
            switch(!0) {
                case !sDepDate:
                    oDepDate.focus();
                    iError = 0;
                    break;
                case !rDate.test(sDepDate):
                    oDepDate.focus();
                    iError = 3;
                    break;
                case !sEndDate:
                    oEndDate.focus();
                    iError = 1;
                    break;
                case !rDate.test(sEndDate):
                    oEndDate.focus();
                    iError = 3;
                    break;
                case sDepDate.replace(/-/g, '') > sEndDate.replace(/-/g, ''):
                    oEndDate.focus();
                    iError = 2;
                    break;
            };
            if(iError > -1) {
                this.set('message', aMessage[iError]).showMessage();                
            }
            else {
                alert('开始时间：' + sDepDate + '\n返程时间：' + sEndDate);
            }
    }, oCal);
});
</script>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，现在网站暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

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

<div id="search">
    <form id="J_Search" target="_blank">
        <ul>
            <li><label class="tit" for="J_DepDate">出发时间：</label><input id="J_DepDate" type="text" class="f-text" value="" /></li>
            <li><label class="tit" for="J_EndDate">返程时间：</label><input id="J_EndDate" type="text" class="f-text" value="" /></li>
            <li><label class="tit"></label><input id="J_search_btn" type="submit" class="f-btn" value="" /></li>
        </ul>
    </form>
</div>

    <div class="am-g">
      <div class="am-u-sm-12">

          <div class="am-panel am-panel-default">
              <div class="am-panel-hd">搜索酒店：</div>
              <form method="post" action="" id="form-book" class="am-form am-form-horizontal">
                  <div class="am-panel-bd am-padding-bottom-0 am-margin-0">
                      <div class="am-form-group">
                          <div class="am-input-group am-input-group-sm am-u-md-6">
                              <span  class="am-input-group-label am-icon-home"> 地方、酒店名称</span>
                              <input id="place" type="text" class="am-form-field am-input-sm" value="">
                          </div>
                          <div class="am-input-group am-input-group-sm am-u-sm-6">
                              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 入住时间</span>
                              <input type="text" readonly placeholder="2016-03-16" value="2016-03-22" class="am-form-field" name="arrivalDate">
                              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 退房时间</span>
                              <input type="text" readonly placeholder="2016-03-16" value="2016-03-22" class="am-form-field" name="arrivalDate">
                          </div>
                      </div>
                      <div class="am-form-group">
                      	<div class="am-input-group am-input-group-sm am-form-select am-u-sm-2">
                              <span class="am-input-group-label"><i class="am-icon-bed am-icon-fw"></i> 客房</span>
                              <select onchange="setProductPrice($('#arrivalDate').val(), 0)" id="pax_0" class="am-form-field am-input-sm" name="pax">
                                  <option value="1">1 人</option>
                                  <option value="2">2 人</option>
                              </select>
                          </div>
                          <div class="am-input-group am-input-group-sm am-form-select am-u-sm-2">
                              <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i> 成人</span>
                              <select onchange="setProductPrice($('#arrivalDate').val(), 0)" id="pax_0" class="am-form-field am-input-sm" name="pax">
                                  <option value="1">1 人</option>
                                  <option value="2">2 人</option>
                              </select>
                          </div>
                          <div class="am-input-group am-input-group-sm am-form-select am-u-sm-2">
                              <span class="am-input-group-label"><i class="am-icon-child am-icon-fw"></i> 儿童</span>
                              <select onchange="setProductPrice($('#arrivalDate').val(), 0)" id="pax_0" class="am-form-field am-input-sm" name="pax">
                                  <option value="1">1 人</option>
                                  <option value="2">2 人</option>
                              </select>
                          </div>
                          <div class="am-input-group am-input-group-sm am-u-md-6 am-padding-left-0 am-padding-right-xl">
                              <div data-am-dropdown="" class="am-cf am-padding-right">
                                  <button type="button" id="order-popup-button" class="am-btn am-btn-warning am-round am-fr"><i class="am-icon-shopping-cart"></i>&#12288;查&#12288;看</button>
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
<script language="javascript">
$(function() {
  var place = $('#place');
  place.keyup(function(){
	 place.popover({
		trigger: 'focus',
		content: ''
	  }).popover('open');
  
  });
});
</script>

</body>
</html>