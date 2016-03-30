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
                              <input type="hidden" name="place_type" id="place_type" value="">
                              <input type="hidden" name="place_en_name" id="place_en_name" value="">
                              <input type="hidden" name="city" id="city" value="">
                          </div>
                          <div class="am-input-group am-input-group-sm am-u-sm-6">
                              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 入住时间</span>
                              <input type="text" readonly placeholder="" value="" class="am-form-field" name="CheckIn" id="CheckIn">
                              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 退房时间</span>
                              <input type="text" readonly placeholder="" value="" class="am-form-field" name="CheckOut" id="CheckOut">
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
<script language="javascript">
    $(function() {
        var nowTemp = new Date();
        var nowDay = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0).valueOf();
        var nowMoth = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), 1, 0, 0, 0, 0).valueOf();
        var nowYear = new Date(nowTemp.getFullYear(), 0, 1, 0, 0, 0, 0).valueOf();
        var $CheckIn = $('#CheckIn');
        var $CheckOut = $('#CheckOut');

        var CheckIn = $CheckIn.datepicker({
            onRender: function(date, viewMode) {
                // 默认 days 视图，与当前日期比较
                var viewDate = nowDay;

                switch (viewMode) {
                    // moths 视图，与当前月份比较
                    case 1:
                        viewDate = nowMoth;
                        break;
                    // years 视图，与当前年份比较
                    case 2:
                        viewDate = nowYear;
                        break;
                }
                return date.valueOf() < viewDate ? 'am-disabled' : '';
            }
        }).on('changeDate.datepicker.amui', function(ev) {
            if (ev.date.valueOf() > CheckOut.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                CheckOut.setValue(newDate);
            }
            CheckIn.close();
            CheckOut.open();
            //setProductPrice($('#arrivalDate').val(), -1);
        }).data('amui.datepicker');

        var CheckOut = $CheckOut.datepicker({
            onRender: function(date, viewMode) {
                var inTime = CheckIn.date;
                var inDay = inTime.valueOf();
                var inMoth = new Date(inTime.getFullYear(), inTime.getMonth(), 1, 0, 0, 0, 0).valueOf();
                var inYear = new Date(inTime.getFullYear(), 0, 1, 0, 0, 0, 0).valueOf();
                // 默认 days 视图，与当前日期比较
                var viewDate = inDay;

                switch (viewMode) {
                    // moths 视图，与当前月份比较
                    case 1:
                        viewDate = inMoth;
                        break;
                    // years 视图，与当前年份比较
                    case 2:
                        viewDate = inYear;
                        break;
                }
                return date.valueOf() <= viewDate ? 'am-disabled' : '';
            }
        }).on('changeDate.datepicker.amui', function(ev) {
            CheckOut.close();
            //setProductPrice($('#arrivalDate').val(), -1);
        }).data('amui.datepicker');
    });
</script>
</body>
</html>