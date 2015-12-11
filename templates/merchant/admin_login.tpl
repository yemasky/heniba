<!DOCTYPE html>
<html>
<head lang="en">
  <%include file="merchant/inc/head.tpl"%>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1><img src="<%$__RESOURCE%>assets/i/favicon.png" width="100"/></h1>
    <p>The world tourism<br/>旅游世家</p>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <h3>登录</h3>
    <hr>
    <div class="am-btn-group">
      <a href="#" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-github am-icon-sm"></i> Github</a>
      <a href="#" class="am-btn am-btn-success am-btn-sm"><i class="am-icon-google-plus-square am-icon-sm"></i> Google+</a>
      <a href="#" class="am-btn am-btn-primary am-btn-sm"><i class="am-icon-stack-overflow am-icon-sm"></i> stackOverflow</a>
    </div>
    <br>
    <br>
    <%if $error_login==1%>
    <div class="am-alert am-alert-danger" data-am-alert>
      <button type="button" class="am-close">&times;</button>
      <p>登录失败，请检查您的登录邮箱和密码！</p>
    </div>
    <%/if%>
    <form method="post" class="am-form" action="index.php?action=login">
      <label for="email">邮箱:</label>
      <div class="am-input-group">
        <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
        <input class="am-form-field" type="email" name="email" id="email" value="" placeholder="example@example.com">
      </div>
       <br>
      <label for="password">密码:</label>
      <div class="am-input-group">
        <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
        <input class="am-form-field" type="password" name="password" id="password" value="" placeholder="password">
      </div>
      <br>
      <label for="remember-me">
        <input id="remember-me" value="1" name="remember_me" type="checkbox">
        保持1个月登录
      </label>
      <br />
      <div class="am-cf">
        <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm"><span class="am-icon-user"></span>　登 录</button>
        <input type="submit" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
      </div>
    </form>
    <hr>
    <p>© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
  </div>
</div>
</body>
</html>