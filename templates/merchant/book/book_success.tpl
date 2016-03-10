<div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">预定下一步</strong> / <small>支付费用</small></div>
    </div>

    <hr>

    <div class="am-g">

      <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
        <div class="am-panel am-panel-default">
          <div class="am-panel-bd">
            <div class="am-g">
              <div class="am-u-md-4">
                <img alt="" src="http://s.amazeui.org/media/i/demos/bw-2014-06-19.jpg?imageView/1/w/200/h/200/q/80" class="am-img-circle am-img-thumbnail">
              </div>
              <div class="am-u-md-8">
                <p>你可以使用<a href="#">gravatar.com</a>提供的头像或者使用本地上传头像。 </p>
                <form class="am-form">
                  <div class="am-form-group">
                    <input type="file" id="user-pic">
                    <p class="am-form-help">请选择要上传的文件...</p>
                    <button class="am-btn am-btn-primary am-btn-xs" type="button">保存</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="am-panel am-panel-default">
          <div class="am-panel-bd">
            <div class="user-info">
              <p>等级信息</p>
              <div class="am-progress am-progress-sm">
                <div style="width: 60%" class="am-progress-bar"></div>
              </div>
              <p class="user-info-order">当前等级：<strong>LV8</strong> 活跃天数：<strong>587</strong> 距离下一级别：<strong>160</strong></p>
            </div>
            <div class="user-info">
              <p>信用信息</p>
              <div class="am-progress am-progress-sm">
                <div style="width: 80%" class="am-progress-bar am-progress-bar-success"></div>
              </div>
              <p class="user-info-order">信用等级：正常当前 信用积分：<strong>80</strong></p>
            </div>
          </div>
        </div>

      </div>

      <div class="am-u-sm-9 am-u-md-8 am-u-md-pull-4">
        <form class="am-form am-form-horizontal">
          <div class="am-form-group">
            <label class="am-u-sm-3 am-form-label" for="user-name">订单号：</label>
            <div class="am-u-sm-9">
              <ul class="am-list">
                <li class="am-g am-list-item-dated">
                  <a href="##" class="am-list-item-hd "><%$order.o_order_number%></a>
                  <span class="am-list-date"></span>
                </li>
              </ul>
            </div>
            <label class="am-u-sm-3 am-form-label" for="user-name">价格：</label>
            <div class="am-u-sm-9">
              <ul class="am-list">
                <li class="am-g am-list-item-dated">
                  <a href="##" class="am-list-item-hd ">￥<%$order.o_price_sell%>元</a>
                  <span class="am-list-date"></span>
                </li>
              </ul>
            </div>
          </div>
          <div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <button class="am-btn am-btn-danger" type="button">点击支付</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>