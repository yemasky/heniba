<div class="am-popup am-radius" id="order-popup">
    <div class="am-popup-inner">
        <div class="am-popup-hd">
            <h4 class="am-popup-title">填写预订信息</h4>
            <span data-am-modal-close class="am-close">&times;</span>
        </div>
        <div class="am-popup-bd">
            <div class="">
                <span class="am-input-group-labe">身份证</span>
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-newspaper-o"></i>
                    <input name="id_card_no" id="id_card_no" type="text" placeholder="身份证，必填" class="am-form-field" minlength="10" maxlength="18" required/>
                </div>
                <span class="am-input-group-labe">请选择称呼</span>
                <div class="am-form-group am-form-select">
                    <select name="salutation" class="am-input-sm" required>
                        <option value="">请选择称呼</option>
                        <option value="Mr.">先生</option>
                        <option value="Ms.">女士</option>
                        <option value="Mrs.">夫人</option>
                    </select>
                </div>
                <span class="am-input-group-labe">姓名</span>
                <div class="am-form-group am-form-icon"><i class="am-icon-male"></i>
                    <input name="lastName_firstName" type="text" placeholder="姓名，必填" class="am-form-field" minlength="3" required/>
                </div>
                <span class="am-input-group-labe">电子邮件</span>
                <div class="am-form-group am-form-icon"><i class="am-icon-envelope"></i>
                    <input name="email" type="email" placeholder="电子邮件，必填" class="am-form-field" required/>
                </div>
                <span class="am-input-group-labe">移动电话</span>
                <div class="am-form-group am-form-icon"><i class="am-icon-mobile"></i>
                    <input name="mobile" type="text" placeholder="11位移动电话，必填" class="am-form-field" pattern="^1((3|5|8){1}\d{1}|70)\d{8}$" required />
                </div>
                <span class="am-input-group-labe">客户备注</span>
                <div class="am-form-group am-form-icon"><i class="am-icon-commenting-o"></i>
                    <input name="message" type="text" placeholder="客户备注" class="am-form-field">
                </div>
            </div>
        </div>
        <div class="am-center am-padding"><button class="am-btn am-btn-primary am-center" type="submit">开始预订 <i class="am-icon-check-circle"></i></button></div>
    </div>
</div>
<script language="JavaScript">
    $('#id_card_no').blur(function(){
    });
    $('#form-book').submit(function(){
    });
    /*$('#form-book').validator({
        submit: function() {
            var formValidity = this.isFormValid();

            $.when(formValidity).then(function() {
                return false;
                // 验证成功的逻辑
            }, function() {
                return false;
                // 验证失败的逻辑
            });
        }
    });*/
</script>
