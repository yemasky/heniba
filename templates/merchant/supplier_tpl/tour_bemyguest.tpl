<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-md-8">
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
        <a href="#"><%$tourism_product.title%></a>
      </h3>
      <h4 class="am-article-meta blog-meta">by <a href="">open</a> posted on 2014/06/17 under <a href="#">字体</a></h4>

      <div class="am-g blog-content">
        <div data-am-widget="slider" class="am-slider am-slider-d3" data-am-slider='{&quot;controlNav&quot;:&quot;thumbnails&quot;,&quot;directionNav&quot;:false}' >
        <ul class="am-slides">
          <li>
            <img id="img-<%$tourism_product.id%>">
            <div class="am-slider-desc"><h2 class="am-slider-title"><%$tourism_product.title%></p></div>
		  </li> 
        </ul>
      	</div>
   	  	<ul data-am-widget="gallery" class="am-gallery am-avg-sm-3 am-avg-sm-4 am-gallery-imgbordered" data-am-gallery="{pureview: 1}" id="thumb_img-<%$tourism_product.id%>"></ul>
		      	
      </div>
      <script language="JavaScript">
        var obj = jQuery.parseJSON('<%$tourism_product.photos%>');
        var img = '';
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
          if(i == 1) {
			$('#img-<%$tourism_product.id%>').attr('src', original);
          }
          html_img += '<li><div class="am-gallery-item"><img class="am-thumbnail" src="' 
	            + thumb_img + '" onerror="this.src=\''+error_img+'\'" '
	            +'alt="<%$tourism_product.title%>" data-rel="'+original+'"/></div></li>';
      		$('#thumb_img-<%$tourism_product.id%>').html(html_img);
        });
      </script>
      <div class="am-g">
        <div class="am-u-sm-12">
          <p>旅游介绍：<%$tourism_product.description%></p>

          <p></p>
        </div>
      </div>
    </article>

    <hr class="am-article-divider blog-hr">

    <article class="blog-main">
    <div class="am-sticky-placeholder">
      <nav class="scrollspy-nav" data-am-scrollspy-nav="{offsetTop: 45}" data-am-sticky>
		  <ul class="am-nav am-nav-tabs am-nav-justify">
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

  <div class="am-u-md-4 blog-sidebar">
    <div class="am-panel-group">
      <div data-am-sticky>
        <section class="am-panel am-panel-default">
          <div class="am-panel-hd">旅游特色：</div>
          <div class="am-panel-bd">
            <p><%$tourism_product.highlights%></p>
          </div>
          <div class="am-panel-hd">预订：</div>
          <div class="am-panel-bd">
          <label class="am-form-label am-u-md-10" for="pax">游玩类型</label>
            <div class="am-form-group am-input-group am-u-md-10">
              <span class="am-input-group-label"><i class="am-icon-puzzle-piece am-icon-fw"></i></span>
              <select name="pax" data-am-selected="{searchBox: 1}" class="am-form-field" id="pax" >
                <option value="a">1 人</option>
                <option value="b">Banana</option>
                <option value="o">Orange</option>
                <option value="m">Mango</option>
                <option value="phone">iPhone</option>
                <option value="im">iMac</option>
                <option value="mbp">Macbook Pro</option>
              </select>
            </div>
            <label class="am-form-label am-u-md-10" for="arrivalDate">选择日期</label>
            <div class="am-form-group am-input-group am-u-md-10">
              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i></span>
              <input name="arrivalDate" type="text" class="am-form-field" id="arrivalDate" placeholder="YYYY-MM-DD" />
            </div>
            <label class="am-form-label am-u-md-10" for="pax">选择人数</label>
            <div class="am-form-group am-input-group am-u-md-10">
              <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i></span>
              <select name="pax" data-am-selected="{searchBox: 1}" class="am-form-field" id="pax" >
                <option value="a">1 人</option>
                <option value="b">Banana</option>
                <option value="o">Orange</option>
                <option value="m">Mango</option>
                <option value="phone">iPhone</option>
                <option value="im">iMac</option>
                <option value="mbp">Macbook Pro</option>
              </select>
            </div>
            <label class="am-form-label am-u-md-10" for="pax">价格标准</label>
            <div class="am-form-group am-input-group am-u-md-10">
            	<span class="am-input-group-label" id="currency"></span>
            	<input type="text" class="am-form-field" readonly>
            	<span class="am-input-group-label">.00</span>
            </div>
            <div class="am-cf" data-am-dropdown>
              <button class="am-btn am-btn-warning am-round am-fr" type="button" data-am-modal="{target: '#order-popup'}" ><i class="am-icon-shopping-cart"></i>　预　定</button>
            </div>
          </div>
        </section>
      </div>
      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">文章目录</div>
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
        <div class="am-panel-hd">团队成员</div>
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
<script>
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
<script language="JavaScript">obj = jQuery.parseJSON('<%$tourism_product.currency%>');$('#currency').text(obj.code);</script>
