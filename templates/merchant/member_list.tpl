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
    <div class="am-g">
      <div class="am-u-sm-12">
          <div class="am-panel am-panel-default">
              <div class="am-panel-hd">搜索用户：</div>
              <form method="post" action="index.php?model=tourism&action=search" id="form-book" class="am-form am-form-horizontal">
                  <div class="am-panel-bd am-padding-bottom-0 am-margin-0">
                      <div class="am-form-group">
                          <div class="am-input-group am-input-group-sm am-u-md-4">
                              <span  class="am-input-group-label am-icon-home"> 手机、身份证</span>
                              <input id="place" name="place" type="text" class="am-form-field am-input-sm" autocomplete="off" value="">
                              <input type="hidden" name="place_type" id="place_type" value="">
                              <input type="hidden" name="place_en_name" id="place_en_name" value="">
                              <input type="hidden" name="city" id="city" value="">
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

          <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                  <th class="table-check"><input type="checkbox"></th><th class="table-id">ID</th><th class="table-title">标题</th><th class="table-type">类别</th><th class="table-author am-hide-sm-only">作者</th><th class="table-date am-hide-sm-only">修改日期</th><th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>1</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>2</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>3</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>4</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>5</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>6</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>7</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>8</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>9</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>10</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>11</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>12</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>13</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>14</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试14号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td>15</td>
                  <td><a href="#">Business management</a></td>
                  <td>default</td>
                  <td class="am-hide-sm-only">测试1号</td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                      <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                              <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                              <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                              <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                          </div>
                      </div>
                  </td>
              </tr>
              </tbody>
          </table>
          <%include file="merchant/inc/page.tpl"%>
      </div>
    </div>

    <%include file="merchant/inc/footer.tpl"%>
  </div>
</body>
</html>