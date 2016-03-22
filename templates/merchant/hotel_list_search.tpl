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
    Y.one('#form-book').on('submit', function(e) {
        //e.halt();
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
            //alert('开始时间：' + sDepDate + '\n返程时间：' + sEndDate);
            //e.submit();
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
	<%if $pn==1 && $place==''%>
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
              <form method="post" action="index.php?model=hotel&action=search" id="form-book" class="am-form am-form-horizontal">
                  <div class="am-panel-bd am-padding-bottom-0 am-margin-0">
                      <div class="am-form-group">
                          <div class="am-input-group am-input-group-sm am-u-md-6">
                              <span  class="am-input-group-label am-icon-home"> 地方、酒店名称</span>
                              <input id="place" name="place" type="text" class="am-form-field am-input-sm" autocomplete="off" value="<%$place%>">
                              <input type="hidden" name="place_type" id="place_type" value="<%$arraySearchData.place_type%>">
                              <input type="hidden" name="place_en_name" id="place_en_name" value="<%$arraySearchData.place_en_name%>">
                              <input type="hidden" name="city" id="city" value="<%$arraySearchData.c_city_id%>">
                          </div>
                          <div class="am-input-group am-input-group-sm am-u-sm-6">
                              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 入住时间</span>
                              <input type="text" readonly placeholder="<%$arraySearchData.CheckIn%>" value="<%$arraySearchData.CheckIn%>" class="am-form-field" name="CheckIn" id="J_DepDate">
                              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 退房时间</span>
                              <input type="text" readonly placeholder="<%$arraySearchData.CheckOut%>" value="<%$arraySearchData.CheckOut%>" class="am-form-field" name="CheckOut" id="J_EndDate">
                          </div>
                          <div id="doc-dropdown-justify-js" style="margin-left: 160px;">
                              <div class="am-dropdown am-u-sm-400" id="doc-dropdown-js">
                                  <div class="am-dropdown-content am-padding-0" id="place_content">...</div>
                              </div>
                          </div>

                      </div>

                      <div class="am-form-group">

                      	<div class="am-input-group am-input-group-sm am-form-select am-u-sm-2">
                              <span class="am-input-group-label"><i class="am-icon-bed am-icon-fw"></i> 客房</span>
                              <select onchange="setProductPrice($('#arrivalDate').val(), 0)" id="pax_0" class="am-form-field am-input-sm" name="AdultNum">
                                  <option value="1">1 人</option>
                                  <option value="2">2 人</option>
                              </select>
                          </div>
                          <div class="am-input-group am-input-group-sm am-form-select am-u-sm-2">
                              <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i> 成人</span>
                              <select onchange="setProductPrice($('#arrivalDate').val(), 0)" id="pax_0" class="am-form-field am-input-sm" name="AdultNum">
                                  <option value="1">1 人</option>
                                  <option value="2">2 人</option>
                              </select>
                          </div>
                          <div class="am-input-group am-input-group-sm am-form-select am-u-sm-2">
                              <span class="am-input-group-label"><i class="am-icon-child am-icon-fw"></i> 儿童</span>
                              <select onchange="setProductPrice($('#arrivalDate').val(), 0)" id="pax_0" class="am-form-field am-input-sm" name="ChildNum">
                                  <option value="1">1 人</option>
                                  <option value="2">2 人</option>
                              </select>
                          </div>
                          <div class="am-input-group am-input-group-sm am-u-md-6 am-padding-left-0 am-padding-right-xl">
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
            <th>ID</th><th>图片</th><th></th><th>基价</th><th></th><th> </th>
          </tr>
          </thead>
          <tbody>
          <%if $tourico==1%>
          <%include file="merchant/book/search_hotel_tourico_list.tpl"%>
          <%else%>
          <tr>
              <th></th><th></th><th><font color="red"> 错误：<%$hotel_list[0]%>，请重新搜索！</font></th><th></th><th></th><th> </th>
          </tr>
          <%/if%>
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
    var $dropdown = $('#doc-dropdown-js'),
        data_place = $dropdown.data('amui.dropdown');
    var $place = $('#place');
	var is_en = false;
    $place.keyup(function(e) {
		var re=/[^\u4e00-\u9fa5]/; 
		is_en = re.test($place.val());
        if((is_en && $place.val().length >= 2) || is_en == false) {
            $.get('index.php?model=hotel&action=ajax_get_place&place=' + $place.val(), function (result) {
                $('#place_content').html(result);
                $dropdown.dropdown('open');
                $place.focus();
                $('#place_content').find('a').click(function(e){
                    $place.val($(this).html());
                    $('#place_en_name').val($(this).attr('data-name'));
                    $('#place_type').val($(this).attr('data-id'));
                    $('#city').val($(this).attr('city'));
                    $dropdown.dropdown('close');
                });
            });
        }
    });

    /*var place = $('#place');
    place.keyup(function(){
        $.getJSON('index.php?model=hotel&action=ajax_get_place', function(result){
            place.popover({
                trigger: 'focus',
                content: ''
            }).popover('open');
        });
    });*/
});
</script>

</body>
</html>