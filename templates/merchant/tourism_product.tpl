<!DOCTYPE html>
<html>
<head lang="en">
  <%include file="merchant/inc/head.tpl"%>
  <style>
    @media only screen and (min-width: 1200px) {
      .blog-g-fixed {
        max-width: 1200px;
      }
    }

    @media only screen and (min-width: 641px) {
      .blog-sidebar {
        font-size: 1.4rem;
      }
    }

    .blog-main {
      padding: 20px 0;
    }

    .blog-title {
      margin: 10px 0 20px 0;
    }

    .blog-meta {
      font-size: 14px;
      margin: 10px 0 20px 0;
      color: #222;
    }

    .blog-meta a {
      color: #27ae60;
    }

    .blog-pagination a {
      font-size: 1.4rem;
    }

    .blog-team li {
      padding: 4px;
    }

    .blog-team img {
      margin-bottom: 0;
    }

    .blog-content img,
    .blog-team img {
      max-width: 100%;
      height: auto;
    }

    .blog-footer {
      padding: 10px 0;
      text-align: center;
    }
  </style>
  <!--[if lt IE 9]>
  <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
  <script src="<%$__RESOURCE%>assets/js/amazeui.ie8polyfill.min.js"></script>
  <![endif]-->

  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="<%$__RESOURCE%>assets/js/jquery.min.js"></script>
  <!--<![endif]-->
  <script src="<%$__RESOURCE%>assets/js/amazeui.min.js"></script>
</head>
<body>
<header class="am-topbar">
  <h1 class="am-topbar-brand">
    <a href="#">blog</a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
          data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
      class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-active"><a href="#">首页</a></li>
      <li><a href="#">项目</a></li>
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          菜单 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li class="am-dropdown-header">标题</li>
          <li><a href="#">关于我们</a></li>
          <li><a href="#">关于字体</a></li>
          <li><a href="#">TIPS</a></li>
        </ul>
      </li>
    </ul>

    <form class="am-topbar-form am-topbar-left am-form-inline am-topbar-right" role="search">
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm" placeholder="搜索文章">
      </div>
      <button type="submit" class="am-btn am-btn-default am-btn-sm">搜索</button>
    </form>

  </div>
</header>

<div class="am-g am-g-fixed blog-g-fixed">
  <div class="am-u-md-8">
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
        <a href="#"><%$tourism_product.title%></a>
      </h3>
      <h4 class="am-article-meta blog-meta">by <a href="">open</a> posted on 2014/06/17 under <a href="#">字体</a></h4>

      <div class="am-g blog-content">
        <div class="am-slider am-slider-default" data-am-flexslider id="product-slider-0">
          <ul class="am-slides" id="img-<%$tourism_product.id%>">

          </ul>
        </div>
      </div>
      <script language="JavaScript">
        var obj = jQuery.parseJSON('<%$tourism_product.photos%>');
        var img = '';
        var error_img = '';
        var path = '<%$tourism_product.photosUrl%>';
        $.each(obj, function(i, item){
          $.each(item.paths, function(k, k_item) {
	       	  if(k == '680x325') {
	       		error_img = path + k_item;
	       	  }
	          if(k == '1280x720') {
	            img += '<li><img src="' + path + k_item + '" onerror="this.src=\''+error_img+'\'"></li>';
	            $('#img-<%$tourism_product.id%>').html(img);
	          }
          })
        });
      </script>
      <div class="am-g">
        <div class="am-u-sm-12">
          <p>看著自己的作品，你的喜悅之情溢於言表，差點就要說出我要感謝我的父母之類的得獎感言。但在你對面的客戶先是一點表情也沒有，又瞬間轉為陰沉，抿了抿嘴角冷冷的說……</p>

          <p>「我要一種比較跳的感覺懂嗎？」</p>
        </div>
      </div>
    </article>

    <hr class="am-article-divider blog-hr">

    <article class="blog-main">
      <div class="admin-content">

        <div class="am-cf am-padding">
          <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">表单</strong> / <small>form</small></div>
        </div>

        <div data-am-tabs="" class="am-tabs am-margin">
          <ul class="am-tabs-nav am-nav am-nav-tabs">
            <li class="am-active"><a href="#tab1">基本信息</a></li>
            <li class=""><a href="#tab2">详细描述</a></li>
            <li class=""><a href="#tab3">SEO 选项</a></li>
          </ul>

          <div class="am-tabs-bd">
            <div id="tab1" class="am-tab-panel am-fade am-active am-in">
              <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">所属类别</div>
                <div class="am-u-sm-8 am-u-md-10">
                  <select data-am-selected="{btnSize: 'sm'}" style="display: none;">
                    <option value="option1">选项一...</option>
                    <option value="option2">选项二.....</option>
                    <option value="option3">选项三........</option>
                  </select><div data-am-dropdown="" id="am-selected-3s79j" class="am-selected am-dropdown ">  <button class="am-selected-btn am-btn am-dropdown-toggle am-btn-sm am-btn-default" type="button">    <span class="am-selected-status am-fl">选项一...</span>    <i class="am-selected-icon am-icon-caret-down"></i>  </button>  <div class="am-selected-content am-dropdown-content">    <h2 class="am-selected-header"><span class="am-icon-chevron-left">返回</span></h2>       <ul class="am-selected-list">                     <li data-value="option1" data-group="0" data-index="0" class="am-checked">         <span class="am-selected-text">选项一...</span>         <i class="am-icon-check"></i></li>                                 <li data-value="option2" data-group="0" data-index="1" class="">         <span class="am-selected-text">选项二.....</span>         <i class="am-icon-check"></i></li>                                 <li data-value="option3" data-group="0" data-index="2" class="">         <span class="am-selected-text">选项三........</span>         <i class="am-icon-check"></i></li>            </ul>    <div class="am-selected-hint"></div>  </div></div>
                </div>
              </div>

              <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">显示状态</div>
                <div class="am-u-sm-8 am-u-md-10">
                  <div data-am-button="" class="am-btn-group">
                    <label class="am-btn am-btn-default am-btn-xs">
                      <input type="radio" id="option1" name="options"> 正常
                    </label>
                    <label class="am-btn am-btn-default am-btn-xs">
                      <input type="radio" id="option2" name="options"> 待审核
                    </label>
                    <label class="am-btn am-btn-default am-btn-xs">
                      <input type="radio" id="option3" name="options"> 不显示
                    </label>
                  </div>
                </div>
              </div>

              <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">推荐类型</div>
                <div class="am-u-sm-8 am-u-md-10">
                  <div data-am-button="" class="am-btn-group">
                    <label class="am-btn am-btn-default am-btn-xs">
                      <input type="checkbox"> 允许评论
                    </label>
                    <label class="am-btn am-btn-default am-btn-xs">
                      <input type="checkbox"> 置顶
                    </label>
                    <label class="am-btn am-btn-default am-btn-xs">
                      <input type="checkbox"> 推荐
                    </label>
                    <label class="am-btn am-btn-default am-btn-xs">
                      <input type="checkbox"> 热门
                    </label>
                    <label class="am-btn am-btn-default am-btn-xs">
                      <input type="checkbox"> 轮播图
                    </label>
                  </div>
                </div>
              </div>

              <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                  发布时间
                </div>
                <div class="am-u-sm-8 am-u-md-10">
                  <form class="am-form am-form-inline" action="">
                    <div class="am-form-group am-form-icon">
                      <i class="am-icon-calendar"></i>
                      <input type="text" placeholder="时间" class="am-form-field am-input-sm">
                    </div>
                  </form>
                </div>
              </div>

            </div>

            <div id="tab2" class="am-tab-panel am-fade">
              <form class="am-form">
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    文章标题
                  </div>
                  <div class="am-u-sm-8 am-u-md-4">
                    <input type="text" class="am-input-sm">
                  </div>
                  <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                </div>

                <div class="am-g am-margin-top">
                  <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    文章作者
                  </div>
                  <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <input type="text" class="am-input-sm">
                  </div>
                </div>

                <div class="am-g am-margin-top">
                  <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    信息来源
                  </div>
                  <div class="am-u-sm-8 am-u-md-4">
                    <input type="text" class="am-input-sm">
                  </div>
                  <div class="am-hide-sm-only am-u-md-6">选填</div>
                </div>

                <div class="am-g am-margin-top">
                  <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    内容摘要
                  </div>
                  <div class="am-u-sm-8 am-u-md-4">
                    <input type="text" class="am-input-sm">
                  </div>
                  <div class="am-u-sm-12 am-u-md-6">不填写则自动截取内容前255字符</div>
                </div>

                <div class="am-g am-margin-top-sm">
                  <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
                    内容描述
                  </div>
                  <div class="am-u-sm-12 am-u-md-10">
                    <textarea placeholder="请使用富文本编辑插件" rows="10"></textarea>
                  </div>
                </div>

              </form>
            </div>

            <div id="tab3" class="am-tab-panel am-fade">
              <form class="am-form">
                <div class="am-g am-margin-top-sm">
                  <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    SEO 标题
                  </div>
                  <div class="am-u-sm-8 am-u-md-4 am-u-end">
                    <input type="text" class="am-input-sm">
                  </div>
                </div>

                <div class="am-g am-margin-top-sm">
                  <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    SEO 关键字
                  </div>
                  <div class="am-u-sm-8 am-u-md-4 am-u-end">
                    <input type="text" class="am-input-sm">
                  </div>
                </div>

                <div class="am-g am-margin-top-sm">
                  <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    SEO 描述
                  </div>
                  <div class="am-u-sm-8 am-u-md-4 am-u-end">
                    <textarea rows="4"></textarea>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>

        <div class="am-margin">
          <button class="am-btn am-btn-primary am-btn-xs" type="button">提交保存</button>
          <button class="am-btn am-btn-primary am-btn-xs" type="button">放弃保存</button>
        </div>
      </div>
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
          <div class="am-panel-hd">关于我</div>
          <div class="am-panel-bd">
            <p>前所未有的中文云端字型服务，让您在 web 平台上自由使用高品质中文字体，跨平台、可搜寻，而且超美。云端字型是我们的事业，推广字型学知识是我们的志业。从字体出发，关心设计与我们的生活，justfont blog
              正是為此而生。</p>
            <div class="am-input-group">
              <span class="am-input-group-label"><i class="am-icon-calendar am-icon-fw"></i></span>
              <input type="text" class="am-form-field" placeholder="YYYY-MM-DD" data-am-datepicker="{theme: 'success'}" style="cursor: hand;"/>
            </div>
            <div class="am-input-group">
              <span class="am-input-group-label"><i class="am-icon-users am-icon-fw"></i></span>
              <select data-am-selected="{searchBox: 1}" class="am-form-field" >
                <option value="a">Apple</option>
                <option value="b">Banana</option>
                <option value="o">Orange</option>
                <option value="m">Mango</option>
                <option value="phone">iPhone</option>
                <option value="im">iMac</option>
                <option value="mbp">Macbook Pro</option>
              </select>
              </div>
            <div class="am-dropdown" data-am-dropdown>
              <button class="am-btn am-btn-warning am-round" type="button" data-am-modal="{target: '#order-popup'}" ><i class="am-icon-shopping-cart"></i>　预　定</button>
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

<div class="am-popup" id="order-popup">
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

<footer class="blog-footer">
  <p>blog template<br/>
    <small>© Copyright XXX. by the AmazeUI Team.</small>
  </p>
</footer>



</body>
</html>
