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
        <div class="am-panel-hd">预订：</div>
        <form class="am-form am-form-horizontal">
          <div class="am-panel-bd">
            <div class="am-form-group">
              <label class="am-form-label am-u-sm-2 am-padding-left-0 am-padding-right-0" for="arrivalDate">选择日期:</label>
              <div class="am-input-group am-u-sm-3">
                <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i></span>
                <input name="arrivalDate" type="text" class="am-form-field" id="arrivalDate" placeholder="<%$today%>" readonly />
              </div>
              <label class="am-form-label am-u-sm-2 am-padding-left-0 am-padding-right-0" for="pax">选择人数:</label>
              <div class="am-input-group am-u-sm-5">
                <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i></span>
                <select name="pax" data-am-selected="{searchBox: 1}" class="am-form-field" id="pax" >
                  <%section name=i loop=$maxPax%>
                  <option value="<%$maxPax[i]%>"><%$maxPax[i]%> 人</option>
                  <%/section%>
                </select>
              </div>
            </div>
            <%section name=i loop=$tourism_product.productTypes%>
            <label class="am-form-label am-u-md-10" for="pax">价格</label>
            <div class="am-form-group am-input-group am-u-md-10">
                <span class="am-input-group-label" id="currency"></span>
                <input type="text" value="" class="am-form-field" readonly>
                <span class="am-input-group-label">.00</span>
            </div>
            <%/section%>
            <div class="am-cf" data-am-dropdown>
              <button class="am-btn am-btn-warning am-round am-fr" type="button" data-am-modal="{target: '#order-popup'}" ><i class="am-icon-shopping-cart"></i>　预　定</button>
            </div>
          </div>
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
    <ul class="am-pagination blog-pagination">
      <li class="am-pagination-prev"><a href="">&laquo; 上一页</a></li>
      <li class="am-pagination-next"><a href="">下一页 &raquo;</a></li>
    </ul>
  </div>

  <div class="am-u-md-4">
      <section class="am-panel am-panel-default">
          <div class="am-panel-hd">地图：</div>
          <div class="am-panel-bd">
              <iframe src="http://www.google.cn/maps/embed?pb=!1m14!1m8!1m3!1d3668.6122398251186!2d<%$tourism_product.longitude%>!3d<%$tourism_product.latitude%>!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2s!5e0!3m2!1szh-CN!2scn!4v1449945641309" width="350" height="280" frameborder="0" style="border:0" allowfullscreen></iframe>

          </div>
      </section>
      <div id="map">uuuuu</div>
      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">旅游文章</div>
        <ul class="am-list blog-list">
          <li><a href="#">Google fonts 的字體（sans-serif 篇）</a></li>
          <li><a href="#">[but]服貿最前線？－再訪桃園機場</a></li>
          <li><a href="#">到日星鑄字行學字型</a></li>
          <li><a href="#">glyph font vs. 漢字（上）</a></li>
          <li><a href="#">浙江民間書刻體上線</a></li>
          <li><a href="#">[極短篇] Android v.s iOS，誰的字體好讀？</a></li>
        </ul>
      </section>

      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">推荐景点</div>
        <div class="am-panel-bd">
          <ul class="am-avg-sm-2 blog-team">
            <%section name=i loop=$relation_tourism%>
            <li><a href="index.php?model=tourism&action=product&id=<%$relation_tourism[i].t_id%>" target="_blank"><img class="am-thumbnail" id="relation_img_<%$relation_tourism[i].t_id%>" alt=""/></a>
              <%$relation_tourism[i].t_title%>
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

<div class="am-popup am-radius" id="order-popup">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title">预定：<%$tourism_product.title%></h4>
      <span data-am-modal-close
            class="am-close">&times;</span>
    </div>
    <div class="am-popup-bd">
      ...
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
    }).data('amui.datepicker');
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

    function initMap() {
        var chicago = new google.maps.LatLng(<%$tourism_product.longitude%>, <%$tourism_product.latitude%>);

        var map = new google.maps.Map(document.getElementById('map'), {
            center: chicago,
            zoom: 3
        });

        var coordInfoWindow = new google.maps.InfoWindow();
        coordInfoWindow.setContent(createInfoWindowContent(chicago, map.getZoom()));
        coordInfoWindow.setPosition(chicago);
        coordInfoWindow.open(map);

        map.addListener('zoom_changed', function() {
            coordInfoWindow.setContent(createInfoWindowContent(chicago, map.getZoom()));
            coordInfoWindow.open(map);
        });
    }

    var TILE_SIZE = 256;

    function createInfoWindowContent(latLng, zoom) {
        var scale = 1 << zoom;

        var worldCoordinate = project(latLng);

        var pixelCoordinate = new google.maps.Point(
                Math.floor(worldCoordinate.x * scale),
                Math.floor(worldCoordinate.y * scale));

        var tileCoordinate = new google.maps.Point(
                Math.floor(worldCoordinate.x * scale / TILE_SIZE),
                Math.floor(worldCoordinate.y * scale / TILE_SIZE));

        return [
            'Chicago, IL',
            'LatLng: ' + latLng,
            'Zoom level: ' + zoom,
            'World Coordinate: ' + worldCoordinate,
            'Pixel Coordinate: ' + pixelCoordinate,
            'Tile Coordinate: ' + tileCoordinate
        ].join('<br>');
    }

    // The mapping between latitude, longitude and pixels is defined by the web
    // mercator projection.
    function project(latLng) {
        var siny = Math.sin(latLng.lat() * Math.PI / 180);

        // Truncating to 0.9999 effectively limits latitude to 89.189. This is
        // about a third of a tile past the edge of the world tile.
        siny = Math.min(Math.max(siny, -0.9999), 0.9999);

        return new google.maps.Point(
                TILE_SIZE * (0.5 + latLng.lng() / 360),
                TILE_SIZE * (0.5 - Math.log((1 + siny) / (1 - siny)) / (4 * Math.PI)));
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJR6VQ6XJkPt3eFNE1oSglfdWl3N1kTro&signed_in=true&callback=initMap">
</script>

<style>.scrollspy-nav{top:0;z-index:100;background:#666666;width:100%;padding:0px}.scrollspy-nav ul{margin:0;padding:0}.scrollspy-nav li{display:inline-block;list-style:none}.scrollspy-nav a{color:#eee;padding:10px 20px;display:inline-block}.scrollspy-nav a.am-active{color:#fff;font-weight:700}.am-panel{margin-top:0px}</style>
