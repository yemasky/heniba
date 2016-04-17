<style>.scrollspy-nav{top:0;z-index:100;background:#666666;width:100%;padding:0px}.scrollspy-nav ul{margin:0;padding:0}.scrollspy-nav li{display:inline-block;list-style:none}.scrollspy-nav a{color:#eee;padding:10px 20px;display:inline-block}.scrollspy-nav a.am-active{color:#fff;font-weight:700}.am-panel{margin-top:0px}</style>
<style>.am-pureview-direction a:before{font-size: 60px;} .am-pureview-actions a{text-align: right; width: 99%;font-size: 60px; color:#FFFFFF; margin-top:10px;} .am-pureview-bar{font-size: 24px;}
  /*.am-active .am-btn-primary.am-dropdown-toggle, .am-btn-primary.am-active, .am-btn-primary:active {}*/
  .am-form-field{background:#FFFFFF;}
</style>
<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-md-8">
    <article class="blog-main am-cf">
      <h3 class="am-article-title blog-title">
        <a href="#"><%$data_product.name%></a>
      </h3>
      <h4 class="am-article-meta blog-meta">最后更新时间 <a>北京时间</a> posted on <%$data_product.update_date%> </h4>

      <div class="am-g blog-content am-u-sm-12">
        <div data-am-widget="slider" class="am-slider am-slider-d3" data-am-slider='{&quot;controlNav&quot;:&quot;thumbnails&quot;,&quot;directionNav&quot;:false}' >
        <ul class="am-slides">
          <li>
            <img id="img-<%$data_product.hotelID%>">
            <div class="am-slider-desc"><h2 class="am-slider-title"><%$data_product.name%></h2></div>
		  </li> 
        </ul>
      	</div>
        <!--div class="am-slider am-slider-default am-slider-carousel" data-am-flexslider="{itemWidth: 200, itemMargin: 5, slideshow: false}"-->
   	  	<ul data-am-widget="gallery" class="am-slides am-avg-lg-8" data-am-gallery="{pureview: 1}" id="thumb_img-<%$data_product.hotelID%>"></ul>
        <!--/div-->
      </div>
      <script language="JavaScript">
        var obj = jQuery.parseJSON('<%$data_product_images%>');
        var thumb_img = '';
        var error_img = '';
        var html_img = '';
        $.each(obj, function(i, item){
          thumb_img = item;
          html_img += '<li><div class="am-gallery-item"><img class="am-thumbnail" src="'
	            + thumb_img + '" onerror="this.src=\''+error_img+'\'" '
	            +'alt="<%$data_product.name%>" data-rel="'+thumb_img+'"/></div></li>';
            $('#thumb_img-<%$data_product.hotelID%>').html(html_img);
        });
        $('#img-<%$data_product.hotelID%>').attr('src', thumb_img);
      </script>
    </article>
      <div class="am-panel am-panel-default">
          <div class="am-panel-hd">酒店特色</div>
          <div class="am-panel-bd am-text-break"><p><%$data_product.Descriptions[0].ShortDescription[0].desc%></p></div>
      </div>
    <form class="am-form am-form-horizontal" id="form-book" action="index.php?model=hotel&action=product&supplier_code=tourico&id=<%$HotelId%>" method="post">
    <div class="am-panel am-panel-default">
        <div class="am-panel-hd">更改搜索条件：</div>
        <div class="am-panel-bd">
          <div class="am-form-group">
            <div class="am-input-group am-input-group-sm am-u-sm-6">
              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 入住日期</span>
              <input name="CheckIn" type="text" class="am-form-field" id="CheckIn" value="<%$arraySearchData.CheckIn%>" placeholder="<%$arraySearchData.CheckIn%>" readonly />
            </div>
            <div class="am-input-group am-input-group-sm am-u-sm-6">
              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 退房日期</span>
              <input name="CheckOut" type="text" class="am-form-field" id="CheckOut" value="<%$arraySearchData.CheckOut%>" placeholder="<%$arraySearchData.CheckOut%>" readonly />
            </div>
          </div>
          <div class="am-form-group">
            <div class="am-input-group am-input-group-sm am-form-select am-u-sm-3">
              <span class="am-input-group-label"><i class="am-icon-bed am-icon-fw"></i> 客房</span>
              <select class="am-form-field am-input-sm" name="RoomsNum">
                <%section name=i loop=10%>
                <option value="<%$smarty.section.i.index+1%>"<%if ($smarty.section.i.index+1)==$arraySearchData.RoomsNum%> selected<%/if%>><%$smarty.section.i.index+1%> 人</option>
                <%/section%>
              </select>
            </div>
            <div class="am-input-group am-input-group-sm am-form-select am-u-sm-3">
              <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i> 成人</span>
              <select class="am-form-field am-input-sm" name="AdultNum">
                <%section name=i loop=10%>
                <option value="<%$smarty.section.i.index+1%>"<%if ($smarty.section.i.index+1)==$arraySearchData.AdultNum%> selected<%/if%>><%$smarty.section.i.index+1%> 人</option>
                <%/section%>
              </select>
            </div>
            <div class="am-input-group am-input-group-sm am-form-select am-u-sm-3">
              <span class="am-input-group-label"><i class="am-icon-child am-icon-fw"></i> 儿童</span>
              <select class="am-form-field am-input-sm" name="ChildNum">
                <%section name=i loop=10%>
                <option value="<%$smarty.section.i.index+1%>"<%if ($smarty.section.i.index+1)==$arraySearchData.ChildNum%> selected<%/if%>><%$smarty.section.i.index+1%> 人</option>
                <%/section%>
              </select>
            </div>
            <div data-am-dropdown="" class="am-cf am-padding-right">
              <button type="submit" class="am-btn am-btn-warning am-round am-fr"><i class="am-icon-shopping-cart"></i> 查看空房</button>
            </div>

          </div>
        </div>
      </div>
      </form>
      <form class="am-form am-form-horizontal" id="form-book" action="index.php?model=book&action=savebookinfo&tour_type=hotel" method="post">
      <div class="am-panel am-panel-default">
        <div class="am-panel-hd">客房类型：</div>
          <ul class="am-list am-list-static">
            <%section name=i loop=$data_product.RoomType%>
            <li>
              <div class="am-g am-margin-left-0">
                <div class="am-u-sm">
                  <div><%$data_product.RoomType[i].name%></div>
                  <div>
                    客房设施：
                    <ul class="am-list am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-text-left">
                      <%if isset($data_product.RoomType[i].Facilities)%>
                      <%section name=j loop=$data_product.RoomType[i].Facilities[0].Facility%>
                      <li class="am-btn am-btn-default am-btn-xs am-text-secondary am-text-left"><%$data_product.RoomType[i].Facilities[0].Facility[j].name%></li>
                      <%/section%>
                      <%/if%>
                    </ul>
                  </div>
                </div>
                <div class="am-u-sm-8 am-padding-left-0 am-padding-right-sm">
                  <div class="am-form-group am-padding-0 am-margin-0 am-btn-group">
                    <div data-am-button class="am-btn-group">
                      <label class="am-btn am-btn-primary am-btn-sm am-icon-square-o<%if $data_product.RoomType[i].is_can_book==0%> am-disabled<%/if%>"><input type="radio" id="option<%$smarty.section.i.index%>" data-RoomType="<%$data_product.RoomType[i].HotelRoomTypeIds[0].HotelRoomTypeId[0].ID%>" value="<%$data_product.RoomType[i].roomId%>" name="options"> 预订</label>
                    </div>
                    <%if $data_product.RoomType[i].is_can_book==1%>
                    <div class="am-input-group am-input-group-sm am-u-md-7 am-padding-left-0 am-padding-right-xl">
                      <span class="am-input-group-label<%if ''=='CNY'%> am-icon-rmb<%/if%>" id="currency"> $ 每晚</span>
                      <input id="product_one_<%$smarty.section.i.index%>" type="text" value="<%$data_product.RoomType[i].Occupancies[0].Occupancy[0].avrNightPublishPrice%>" class="am-form-field am-input-sm" readonly>
                      <span class="am-input-group-label">总共</span>
                      <input id="product_<%$smarty.section.i.index%>" type="text" value="<%$data_product.RoomType[i].Occupancies[0].Occupancy[0].occupPublishPrice%>" class="am-form-field am-input-sm" readonly>
                    </div>
                    <%else%>
                      <div class="am-input-group am-input-group-sm am-u-md-7 am-padding-left-0 am-padding-right-xl">
                          <span class="am-input-group-label<%if ''=='CNY'%> am-icon-rmb<%/if%>" id="currency"> $ 每晚</span>
                          <input id="product_one_<%$smarty.section.i.index%>" type="text" value="不可预定" class="am-form-field am-input-sm" readonly>
                          <span class="am-input-group-label">总共</span>
                          <input id="product_<%$smarty.section.i.index%>" type="text" value="" class="am-form-field am-input-sm" readonly>
                      </div>
                    <%/if%>
                  </div>
                </div>
              </div>
            </li>
            <%/section%>
          </ul>
          <div class="am-panel-bd am-cf">
            <div class="am-g am-margin-left-0 am-padding-bottom">
              <div class="am-u-sm-7">
              </div>
              <div class="am-u-sm-6 am-padding-left-0 am-padding-right-0">
                <div class="am-input-group am-input-group-sm am-u-md-11 am-padding-left-0 am-padding-right-0">
                  <span class="am-input-group-label am-icon-rmb" id="currency"></span>
                  <input id="product_all" type="text" value="" class="am-form-field am-input-sm" readonly>
                  <span class="am-input-group-label">总共</span>
                </div>
              </div>
            </div>

            <div class="am-cf am-padding-right" data-am-dropdown>
              <button class="am-btn am-btn-warning am-round am-fr" id="order-popup-button" type="button" ><i class="am-icon-shopping-cart"></i>　预　定</button>
            </div>
          </div>
        <%include file="order/order_from_userinfo.tpl"%>
        <input type="hidden" name="supplierCode" value="<%$supplierCode%>">
        <input type="hidden" name="supplier" value="<%$supplier%>">
        <input type="hidden" name="searchData" value="<%$searchData%>">
        <input type="hidden" name="RoomType" value="" id="RoomType">
    </div>
    </form>
    <article class="blog-main">
        <div class="am-panel am-panel-default">
            <div class="am-panel-hd">酒店介绍</div>
            <div class="am-panel-bd am-text-break"><p><%$data_product.Descriptions[0].LongDescription[0].FreeTextLongDescription[0]%></p></div>
        </div>
    <div class="am-sticky-placeholder">
      <nav class="scrollspy-nav" data-am-scrollspy-nav="{offsetTop: 45}" data-am-sticky>
		  <ul>
		  <li><a href="">sss</a></li>
	  </nav>
	</div>
	<div id="s" class="am-panel am-panel-default">
		<div class="am-panel-hd">s</div>
		<div class="am-panel-bd"><p>s</p></div>
	</div>
    </article>

    <hr class="am-article-divider blog-hr">
  </div>

  <div class="am-u-md-4">
      <section class="am-panel am-panel-default">
          <div class="am-panel-hd">地图：</div>
          <div class="am-panel-bd am-padding-0">
              <iframe src="http://www.google.cn/maps/embed?pb=!1m14!1m8!1m3!1d3668.6122398251186!2d<%$data_product.Location[0].longitude%>!3d<%$data_product.Location[0].latitude%>!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2s!5e0!3m2!1szh-CN!2scn!4v1449945641309" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
      </section>
      <%include file="news/tour_product_news.tpl"%>
      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">其它酒店</div>
        <div class="am-panel-bd">
          <ul class="am-avg-sm-2 blog-team">
            <li></li>
          </ul>
        </div>
      </section>
  </div>
</div>
<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">正在载入...</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>
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
<script language="JavaScript">
  $(function() {
    var $radios = $('[name="options"]');
    $radios.on('change',function() {
      //alert('单选框当前选中的是：', $radios.filter(':checked').val());
      $.each($radios, function(k, item){
        $($radios[k].parentElement).removeClass('am-active am-icon-check-square-o');
        $(this.parentElement).addClass('am-icon-square-o');
        if($($radios[k]).is(':checked')) {
          //$($radios[k].parentElement).removeClass('am-icon-check-square-o');
          //$($radios[k].parentElement).addClass('am-icon-square-o');
          $('#product_all').val($('#product_'+k).val());
        }
      });
      $(this.parentElement).removeClass('am-icon-square-o');
      $(this.parentElement).addClass('am-icon-check-square-o');
      $('#RoomType').val($(this).attr('data-roomtype'));
      $('#order-popup-button').popover('close');
    });

    $('#order-popup-button').on('click', function(e) {
      //alert($radios);
      var $modal = $('#order-popup');
      var is_select = false;
      $.each($radios, function(k, item){
        if($($radios[k]).is(':checked')) {
          is_select = true;
          $modal.modal();
          is_select = false;
          return;
        }
      });
      if(is_select == false) {
        //alert(1);
        var options = {content: '请选择套餐'};
        $('#order-popup-button').popover(options)
        $('#order-popup-button').popover('open');
        //$('#order-popup-button').popover('open');
      }
    });
  });
</script>
<script language="JavaScript">
  Date.prototype.Format = function(fmt) {
    var o = {
      "M+" : this.getMonth()+1,                 //月份
      "d+" : this.getDate(),                    //日
      "h+" : this.getHours(),                   //小时
      "m+" : this.getMinutes(),                 //分
      "s+" : this.getSeconds(),                 //秒
      "q+" : Math.floor((this.getMonth()+3)/3), //季度
      "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt))
      fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
      if(new RegExp("("+ k +")").test(fmt))
        fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
    return fmt;
  }
  var today = new Date().Format("yyyy-MM-dd");
</script>
<!--script>

    function initMap() {
        var myLatLng = {lat: <%$data_product.longitude%>, lng: <%$data_product.latitude%>};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!'
        });
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJR6VQ6XJkPt3eFNE1oSglfdWl3N1kTro&signed_in=true&callback=initMap">
</script-->