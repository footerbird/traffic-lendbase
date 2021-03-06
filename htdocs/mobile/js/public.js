//验证
var Valid = function(){
    var methods = {};
    methods.isUrl = function(str){//验证域名合法
        return /^(http:\/\/)?(www\.)?.+\..+$/.test(str);
    };
    
    methods.isEmail = function(str){//验证邮箱
        return /^.+@.+\.[\w]{2,4}$/.test(str);
    };
    
    methods.isMobile = function(str){//验证手机号码
        return /^1[3|4|5|8][0-9]\d{8}$/.test(str);
    };
    
    methods.isCode6 = function(str){//验证手机验证码，6位数字
        return /^\d{6}$/.test(str);
    };
    
    methods.isInt = function(str){//验证正整数
        return /^\d+$/.test(str);
    };
    
    methods.isNumber = function(str){//验证是否是数字（包括负数和小数）
        return /^(-)?\d+(\.\d+)?$/.test(str);
    };
    
    methods.isCardNo = function(str){//验证身份证号码
        var len = str.length;
        if(len == 15){
            return /^(\d{6})()?(\d{2})(\d{2})(\d{2})(\d{2})(\w)$/.test(str);
        }else if(len == 18){
            return /^(\d{6})(19|20)(\d{2})((0\d)|(1[0-2]))(([0-2]\d)|(3[0-1]))(\d{3})(\w)$/.test(str);
        }else{
            return false;
        }
    };
    
    methods.isCnChar = function(str){//验证中文
        return /^[\u4e00-\u9fa5]+$/.test(str);
    };
    
    methods.isEqualto = function(str1,str2){//验证一致性
        return str1 === str2?true:false;
    };
    
    return methods;
}();

//倒计时发送
function sendCode(obj,seconds,phone){
    var $this = $(obj), wait = seconds;
    if($this.hasClass("forbid")){
        return;
    }
    $.ajax({
        type:"post",
        data:{
            phone:phone
        },
        url:"/mobile/Index_controller/send_smsCodeAjax",
        async:true,
        dataType:"json",
        success:function(data){
            if(data.state == "success"){
                $this.addClass("forbid");
                time();
            }else{
                $.alert(data.msg);
            }
        }
    });
    
    function time(){
        wait--;
        if(wait<0){
            $this.removeClass("forbid").text("获取验证码");
            return false;
        }
        $this.text("发送成功("+wait+")");
        
        setTimeout(function(){
            time();
        },1000);
    }
}

//图片懒加载
function lazyLoading(count){
    $("img[data-src]").slice(0,count).each(function(){
        var $this = $(this);
        if(($('.container').scrollTop()+$('.container').height())>$this.offset().top){
            $this.attr("src",$this.data("src")).removeAttr("data-src");
        }
    })
}
