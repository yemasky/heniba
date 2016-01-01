<style>.scrollspy-nav{top:0;z-index:100;background:#666666;width:100%;padding:0px}.scrollspy-nav ul{margin:0;padding:0}.scrollspy-nav li{display:inline-block;list-style:none}.scrollspy-nav a{color:#eee;padding:10px 20px;display:inline-block}.scrollspy-nav a.am-active{color:#fff;font-weight:700}.am-panel{margin-top:0px}</style>
<style>.am-pureview-direction a:before{font-size: 60px;} .am-pureview-actions a{text-align: right; width: 99%;font-size: 60px; color:#FFFFFF; margin-top:10px;} .am-pureview-bar{font-size: 24px;}
  /*.am-active .am-btn-primary.am-dropdown-toggle, .am-btn-primary.am-active, .am-btn-primary:active {}*/
  .am-form-field{background:#FFFFFF;}
</style>
<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-md-8">
    <article class="blog-main am-cf">
      <h3 class="am-article-title blog-title">
        <a href="#"><%$tourism_product.title%></a>
      </h3>
      <h4 class="am-article-meta blog-meta">最后更新时间 <a>北京时间</a> posted on <%$tourism_product.update_date%> </h4>

      <div class="am-g blog-content am-u-sm-12">
        <div data-am-widget="slider" class="am-slider am-slider-d3" data-am-slider='{&quot;controlNav&quot;:&quot;thumbnails&quot;,&quot;directionNav&quot;:false}' >
        <ul class="am-slides">
          <li>
            <img id="img-<%$tourism_product.id%>">
            <div class="am-slider-desc"><h2 class="am-slider-title"><%$tourism_product.title%></p></div>
		  </li> 
        </ul>
      	</div>
        <!--div class="am-slider am-slider-default am-slider-carousel" data-am-flexslider="{itemWidth: 200, itemMargin: 5, slideshow: false}"-->
   	  	<ul data-am-widget="gallery" class="am-slides am-avg-lg-8" data-am-gallery="{pureview: 1}" id="thumb_img-<%$tourism_product.id%>"></ul>
        <!--/div-->
      </div>
      <script language="JavaScript">
	    var product_price = eval('(<%$productprice%>)');
        var obj = jQuery.parseJSON('<%$tourism_product.photos%>');
        var html_masonry = '';
        var thumb_img = '';
        var big_img = '';
        var error_img = '';
        var original = '';
        var html_img = '';
        var path = '<%$tourism_product.photosUrl%>';
        $.each(obj, function(i, item){
          $.each(item.paths, function(k, k_item) {
	       	  if(k == '680x325') {
	       		error_img = path + k_item;
	       	  }
	          if(k == '1280x720') {
	            big_img = path + k_item;
	          }
	          if(k == '175x112') {
	        	  thumb_img = path + k_item;
	          }
	          if(k == 'original') {
	        	  original = path + k_item;
	          }
          })
          html_img += '<li><div class="am-gallery-item"><img class="am-thumbnail" src="'
	            + thumb_img + '" onerror="this.src=\''+error_img+'\'" '
	            +'alt="<%$tourism_product.title%>" data-rel="'+original+'"/></div></li>';
            $('#thumb_img-<%$tourism_product.id%>').html(html_img);
        });
        $('#img-<%$tourism_product.id%>').attr('src', original);
      </script>
    </article>
      <div class="am-panel am-panel-default">
          <div class="am-panel-hd">景点特色</div>
          <div class="am-panel-bd"><p><%$tourism_product.highlights%></p></div>
      </div>
	<div class="am-panel am-panel-default">
        <div class="am-panel-hd">游玩类型：</div>
      <form class="am-form am-form-horizontal" id="form-book" action="index.php?model=book&action=savebookinfo" method="post">
        <div class="am-panel-bd am-padding-bottom-0 am-margin-0">
          <div class="am-form-group am-padding-0 am-margin-0">
            <label class="am-form-label am-u-sm-1 am-padding-left-0 am-padding-right-0 am-text-sm" for="arrivalDate"></label>
            <div class="am-input-group am-input-group-sm am-u-sm-6">
              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i> 选择日期</span>
              <input name="arrivalDate" type="text" class="am-form-field" id="arrivalDate" value="<%$today%>" placeholder="<%$today%>" readonly />
            </div>
          </div>
        </div>
          <ul class="am-list am-list-static">
            <%section name=i loop=$tourism_product.productTypes%>
            <li>
              <div class="am-g am-margin-left-0">
                <div class="am-u-sm-6">
                  <div><%$tourism_product.productTypes[i].titleTranslated%></div>
                  <div><%$tourism_product.productTypes[i].descriptionTranslated%></div>
                </div>
                <div class="am-u-sm-8 am-padding-left-0 am-padding-right-sm">
                  <div class="am-form-group am-padding-0 am-margin-0 am-btn-group">
                    <div data-am-button class="am-btn-group">
                      <label class="am-btn am-btn-primary am-btn-sm am-icon-square-o"><input type="radio" id="option<%$smarty.section.i.index%>" value="选项 <%$smarty.section.i.index%>" name="options">套餐<%$smarty.section.i.index+1%></label>
                    </div>
                    <div class="am-input-group am-input-group-sm am-form-select am-u-sm-4 am-padding-0">
                      <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i> 人数</span>
                      <select name="pax" class="am-form-field am-input-sm" id="pax_<%$smarty.section.i.index%>" onChange="setProductPrice($('#arrivalDate').val(), <%$smarty.section.i.index%>)">
                        <%section name=iPax loop=$tourism_product.productTypes[i].paxMax%>
                          <%if ($smarty.section.iPax.index+$tourism_product.productTypes[i].paxMin) <=  $tourism_product.productTypes[i].paxMax%>
                            <option value="<%$smarty.section.iPax.index+$tourism_product.productTypes[i].paxMin%>"><%$smarty.section.iPax.index+$tourism_product.productTypes[i].paxMin%> 人</option>
                          <%/if%>
                        <%/section%>
                      </select>
                    </div>
                    <div class="am-input-group am-input-group-sm am-u-md-6 am-padding-left-0 am-padding-right-xl">
                      <span class="am-input-group-label<%if $currency=='CNY'%> am-icon-rmb<%/if%>" id="currency"> <%$currency%></span>
                      <input id="product_<%$smarty.section.i.index%>" type="text" value="" class="am-form-field am-input-sm" readonly>
                      <span class="am-input-group-label">每人</span>
                    </div>
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
                  <span class="am-input-group-label<%if $currency=='CNY'%> am-icon-rmb<%/if%>" id="currency"> <%$currency%></span>
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
      </form>
    </div>
    <article class="blog-main">
        <div class="am-panel am-panel-default">
            <div class="am-panel-hd">景点介绍</div>
            <div class="am-panel-bd"><p><%$tourism_product.description%></p></div>
        </div>
    <div class="am-sticky-placeholder">
      <nav class="scrollspy-nav" data-am-scrollspy-nav="{offsetTop: 45}" data-am-sticky>
		  <ul>
		  <%section name=i loop=$tourismAttr max=5%>
		  <li><a href="#<%$tourismAttr[i].k%>"><%$tourismAttr[i].n%></a></li>
		  <%/section%>
		  </ul>
	  </nav>
	</div>
	<%section name=i loop=$tourismAttr%>
	<div id="<%$tourismAttr[i].k%>" class="am-panel am-panel-default">
		<div class="am-panel-hd"><%$tourismAttr[i].n%></div>
		<div class="am-panel-bd"><p><%$tourismAttr[i].v%></p></div>
	</div>
	<%/section%>
    </article>

    <hr class="am-article-divider blog-hr">
  </div>

  <div class="am-u-md-4">
      <section class="am-panel am-panel-default">
          <div class="am-panel-hd">地图：</div>
          <div class="am-panel-bd am-padding-0">
              <iframe src="http://www.google.cn/maps/embed?pb=!1m14!1m8!1m3!1d3668.6122398251186!2d<%$tourism_product.longitude%>!3d<%$tourism_product.latitude%>!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2s!5e0!3m2!1szh-CN!2scn!4v1449945641309" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
      </section>
      <%include file="news/tour_product_news.tpl"%>
      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">推荐景点</div>
        <div class="am-panel-bd">
          <ul class="am-avg-sm-2 blog-team">
            <%section name=i loop=$relation_tourism%>
            <li><a href="index.php?model=tourism&action=product&id=<%$relation_tourism[i].t_id%>" target="_blank"><img class="am-thumbnail" id="relation_img_<%$relation_tourism[i].t_id%>" alt=""/></a>
              <%if $relation_tourism[i].t_title_cn != ''%><%$relation_tourism[i].t_title_cn%><%else%><%$relation_tourism[i].t_title%><%/if%>
            </li>
            <script language="JavaScript">
              obj = jQuery.parseJSON('<%$relation_tourism[i].t_images%>');
              $.each(obj, function(k, item){
                $('#relation_img_<%$relation_tourism[i].t_id%>').attr('src', item);
                return true;
              });
            </script>
            <%/section%>
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
    var $arrivalDate = $('#arrivalDate');

    var checkin = $arrivalDate.datepicker({
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
      checkin.close();
	  setProductPrice($('#arrivalDate').val(), -1);
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
          $('#product_all').val($('#product_'+k).val() * $('#pax_'+k).val());
        }
      });
      $(this.parentElement).removeClass('am-icon-square-o');
      $(this.parentElement).addClass('am-icon-check-square-o');
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
<script language="JavaScript">
  setProductPrice($('#arrivalDate').val(), -1);
  //pax
  function setProductPrice(date, index) {
	  if(product_price[date] == undefined) {
		$('#my-modal-loading').modal('open');
		$.getJSON('index.php?model=supplier&action=gettourism&id=<%$t_id%>&checkdate='+date,function(result){
			$('#my-modal-loading').modal('close');
			if(result == "") {
				setPrice(result);
				return;
			}
			$.each(result, function(k_date, k_pax){
				product_price[k_date] = new Array();
				$.each(k_pax, function(v_pax, prices){
					product_price[k_date][v_pax] = new Array();
					$.each(prices, function(id, price){
						product_price[k_date][v_pax][id] = price;
					});
				});
			});
          setPrice(product_price[k_date], index);
		});
	  } else {
          setPrice(product_price[date], index);
	  }
  }
  function setPrice(prices, index) {
    var pax;
    if(prices == undefined || prices == "") {
      for(var i = 0; i<= <%$productTypeNum%>; i++) {
          $('#product_'+i).val('选其它日期/人数');
      }
      return;
    }
    for (var i = 0; i <= <%$productTypeNum%>; i++) {
      pax = $('#pax_' + i).val();
      if (prices[pax] == undefined || prices[pax] == "") {
        $('#product_' + i).val('选其它日期/人数');
      } else {
        if (prices[pax][i] == 0 || prices[pax][i] == "" || prices[pax][i] == undefined) {
          $('#product_' + i).val('选其它日期/人数');
        } else {
          $('#product_' + i).val(prices[pax][i]);
        }
      }
    }
    $radios_price = $('[name="options"]');
    $.each($radios_price, function(k, item){
      if($($radios_price[k]).is(':checked')) {
        $('#product_all').val($('#product_'+k).val() * $('#pax_'+k).val());
        return;
      }
    });
  }


</script>
<!--script>

    function initMap() {
        var myLatLng = {lat: <%$tourism_product.longitude%>, lng: <%$tourism_product.latitude%>};

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