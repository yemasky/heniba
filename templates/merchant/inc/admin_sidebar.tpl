<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
  <div class="am-offcanvas-bar admin-offcanvas-bar">
    <ul class="am-list admin-sidebar-list">
      <li><a href="./"><span class="am-icon-home"></span> 管理首页</a></li>
      <%section name=menu loop=$merchantMenu%>
      <%if !$smarty.section.menu.last && $merchantMenu[menu].mc_id==$merchantMenu[menu].mc_father_id && $merchantMenu[menu].mc_id==$merchantMenu[menu.index_next].mc_father_id%>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-<%$merchantMenu[menu].mc_ico%>"></span> <%$merchantMenu[menu].mc_name%> <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
        <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
      <%else%>
          <li><a <%if $merchantMenu[menu].mc_module!=''%>href="index.php?model=<%$merchantMenu[menu].mc_module%>&action=<%$merchantMenu[menu].mc_module_action%>"<%/if%><%if $merchantMenu[menu].mc_new==1%> class="am-cf"<%/if%>><span class="am-icon-<%$merchantMenu[menu].mc_ico%>"></span> <%$merchantMenu[menu].mc_name%><%if $merchantMenu[menu].mc_new==1%><span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span><%/if%></a></li>
      <%/if%>
      <%if !$smarty.section.menu.last && $merchantMenu[menu].mc_id!=$merchantMenu[menu].mc_father_id && $merchantMenu[menu.index_next].mc_id==$merchantMenu[menu.index_next].mc_father_id%>
        </ul>
      </li>
      <%/if%>
      <%/section%>
      <!--
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 管理模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
        <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
          <li><a href="admin-user.html" class="am-cf"><span class="am-icon-university"></span> 旅游产品<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
          <li><a href="admin-help.html"><span class="am-icon-hotel"></span> 酒店产品</a></li>
          <li><a href="admin-gallery.html"><span class="am-icon-map-marker"></span>　地图查找<span class="am-badge am-badge-secondary am-margin-right am-fr"></span></a></li>
          <li><a href="admin-log.html"><span class="am-icon-users"></span> 用户管理</a></li>
          <li><a href="admin-table.html"><span class="am-icon-table"></span> 订单管理</a></li>
          <li><a href="admin-404.html"><span class="am-icon-bug"></span> 404</a></li>
        </ul>
      </li>
      <li><a href="admin-log.html"><span class="am-icon-calendar"></span> 系统日志</a></li>     
      <li><a href="admin-form.html"><span class="am-icon-pencil-square-o"></span> 表单</a></li>
      -->
      <li><a href="#logout" onclick="location.href='index.php?action=login&method=logout'"><span class="am-icon-sign-out"></span> 注销</a></li>
    </ul>

    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <p><span class="am-icon-bookmark"></span> 公告</p>
        <p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>
      </div>
    </div>

    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <p><span class="am-icon-tag"></span> wiki</p>
        <p>Welcome to the Amaze UI wiki!</p>
      </div>
    </div>
  </div>
</div>