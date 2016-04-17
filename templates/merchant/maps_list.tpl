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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理模块</strong> / <small>世界地图</small></div>
    </div>

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
                            <select class="am-form-field am-input-sm" name="RoomsNum">
                                <%section name=i loop=10%>
                                <option value="<%$smarty.section.i.index+1%>"<%if ($smarty.section.i.index+1)==$arraySearchData.RoomsNum%> selected<%/if%>><%$smarty.section.i.index+1%> 人</option>
                                <%/section%>
                            </select>
                          </div>
                          <div class="am-input-group am-input-group-sm am-form-select am-u-sm-2">
                              <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i> 成人</span>
                              <select class="am-form-field am-input-sm" name="AdultNum">
                                  <%section name=i loop=10%>
                                  <option value="<%$smarty.section.i.index+1%>"<%if ($smarty.section.i.index+1)==$arraySearchData.AdultNum%> selected<%/if%>><%$smarty.section.i.index+1%> 人</option>
                                  <%/section%>
                              </select>
                          </div>
                          <div class="am-input-group am-input-group-sm am-form-select am-u-sm-2">
                              <span class="am-input-group-label"><i class="am-icon-child am-icon-fw"></i> 儿童</span>
                              <select class="am-form-field am-input-sm" name="ChildNum">
                                  <%section name=i loop=10%>
                                  <option value="<%$smarty.section.i.index+1%>"<%if ($smarty.section.i.index+1)==$arraySearchData.ChildNum%> selected<%/if%>><%$smarty.section.i.index+1%> 人</option>
                                  <%/section%>
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

          <div class="am-g error-log">
              <div class="am-u-sm-12 am-u-sm-centered">
                <pre class="am-pre-scrollable">
                    <iframe width="100%" height="800" frameborder="0" allowfullscreen="" style="border:0" src="http://www.google.cn/maps/embed?pb=!1m14!1m8!1m3!1d3668.6122398251186!2d110.0470650!3d25.2158800!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2s!5e0!3m2!1szh-CN!2scn!4v1449945641309"></iframe>
                </pre>
                  <p>这里是静态页面展示，使用时结合代码高亮插件</p>
              </div>
          </div>
      </div>
    </div>

    <%include file="merchant/inc/footer.tpl"%>
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