<div class="am-popup am-radius" id="order-popup">
    <div class="am-popup-inner">
        <div class="am-popup-hd">
            <h4 class="am-popup-title">填写预订信息</h4>
            <span data-am-modal-close class="am-close">&times;</span>
        </div>
        <div class="am-popup-bd">
            <div id="id_card_no_div">
                <span class="am-input-group-labe">身份证</span>
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-newspaper-o"></i>
                    <input name="id_card_no" id="id_card_no" type="text" placeholder="身份证，必填，18位" class="am-form-field" minlength="10" maxlength="18" required pattern="(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)"/>
                </div>
            </div>
            <div id="orther_info_div">
                <span class="am-input-group-labe">请选择称呼</span>
                <div class="am-form-group am-form-select">
                    <select name="salutation" class="am-input-sm" required>
                        <option value="">请选择称呼</option>
                        <option value="Mr.">先生</option>
                        <option value="Ms.">女士</option>
                        <option value="Mrs.">夫人</option>
                    </select>
                </div>
                <span class="am-input-group-labe ">姓名(英文)</span>
                <div class="am-form-inline">
                    <div class="am-form-group am-form-icon"><i class="am-icon-male"></i>
                        <input name="lastName" type="text" placeholder="姓(英文)，必填" class="am-form-field" minlength="2" required/>
                    </div>
                    <div class="am-form-group am-form-icon"><i class="am-icon-male"></i>
                        <input name="firstName" type="text" placeholder="名(英文)，必填" class="am-form-field" minlength="2" required/>
                    </div>
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
                <div class="am-center am-padding"><button class="am-btn am-btn-primary am-center" type="submit">开始预订 <i class="am-icon-check-circle"></i></button></div>
            </div>
        </div>
    </div>
</div>
<script language="JavaScript">
    function check_id_card_no() {
        var id_card_no_val =  $('#id_card_no').val();
        if(id_card_no_val != '') {
            $.getJSON('index.php?model=book&action=ajax_check_identity', {id_card_no:$('#id_card_no').val()}, function(result){
                if(result.error == 1) {
                    alert(result.error_message);
                } else {

                }
            });
        }
    }
    $('#id_card_no').blur(function(){
        check_id_card_no();
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
