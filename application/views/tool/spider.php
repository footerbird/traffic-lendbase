<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no' />
<link rel="icon" href="<?php echo CDN_URL; ?>cdn-lendbase/waitui/images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo CDN_URL; ?>cdn-lendbase/waitui/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="<?php echo CDN_URL; ?>cdn-lendbase/waitui/css/animate.min.css?<?php echo CACHE_TIME; ?>">
<link rel="stylesheet" href="<?php echo CDN_URL; ?>cdn-lendbase/waitui/css/public.css?<?php echo CACHE_TIME; ?>">
<style type="text/css">
.spider-block{
    padding: 30px;
    margin-top: 30px;
    border: 1px solid #ddd;
    background-color: #fff;
}
.spider-block h2{
    font-size: 20px;
    line-height: 40px;
    border-bottom: 2px solid #ea6f5a;
}
.spider-block p{
    font-size: 16px;
    line-height: 32px;
    margin: 15px 0;
    text-align: center;
}
.spider-block a{
    padding: 0 5px;
    color: #5195d5;
}
.spider-block .api-input{
    width: 100%;
    height: 36px;
}
.spider-block .spider-btn{
    display: inline-block;
    width: 120px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    font-size: 14px;
    color: #fff;
    background-color: #ea6f5a;
    border: none;
    cursor: pointer;
    box-sizing: border-box;
    border-radius: 3px;
}
.spider-result{
    width: 600px;
    margin: 0 auto;
    text-align: left;
    padding: 15px;
    font-size: 14px;
    line-height: 24px;
}
.spider-result h3{
    font-size: 16px;
    text-align: center;
    margin-bottom: 15px;
}
.spider-result .red{
    color: #f00;
}
.spider-result .green{
    color: #080;
}

.spider-block li{
   margin: 15px 0;
   line-height: 36px;
   font-size: 14px;
}
.spider-block li label{
    display: inline-block;
    width: 100px;
    text-align: right;
}
.spider-block li select{
    width: 120px;
    height: 36px;
    padding-left: 10px;
}
.spider-block li input[type=text]{
    width: 720px;
    height: 36px;
    padding-left: 15px;
}
.spider-block li textarea{
    width: 720px;
    height: 200px;
    padding: 15px;
    vertical-align: top;
}
.spider-block li .red{
    color: #f00;
}
.spider-block li .green{
    color: #080;
}
</style>
</head>

<body>

<div class="container after-cls pt30 pb30">
    <div class="spider-block">
        <h2>抓取24小时快讯</h2>
        <p>抓取页面为36kr快讯板块（每次抓取前先校验接口是否有数据）<a href="https://36kr.com/newsflashes" target="_blank">https://36kr.com/newsflashes</a></p>
        <p><input type="text" class="api-input" placeholder="请输入抓取接口" id="flash_api" value="https://36kr.com/api/newsflash?b_id=2000000&per_page=5" /></p>
        <p><a href="javascript:;" class="spider-btn" id="flash_btn">查询</a></p>
        <div class="spider-result" id="flash_result" style="display: none;">
            <h3>抓取结果</h3>
            <p></p>
        </div>
    </div>
    
    <div class="spider-block">
        <h2>抓取文章详情页</h2>
        <ul>
            <li><label>资讯类型：</label>
                <select id="article_category">
                    <?php foreach($article_category as $category){ ?>
                    <option value="<?php echo $category->category_type; ?>"><?php echo $category->category_name; ?></option>
                    <?php } ?>
                </select>
            </li>
            <li><label>资讯标题：</label>
                <input type="text" placeholder="请输入标题" id="article_title" />
            </li>
            <li><label>缩略图：</label>
                <input type="text" placeholder="请输入缩略图地址" id="thumb_path" />
            </li>
            <li><label>资讯导语：</label>
                <input type="text" placeholder="请输入导语" id="article_lead" />
            </li>
            <li><label>资讯标签：</label>
                <input type="text" placeholder="请输入标签，以、隔开" id="article_tag" />
            </li>
            <li><label>资讯内容：</label>
                <textarea placeholder="请输入内容" id="article_content"></textarea>
            </li>
            <li><label>&nbsp;</label>
                <a href="javascript:;" class="spider-btn" id="article_btn">查询</a>
                <span id="article_result"></span>
            </li>
        </ul>
    </div>
    
</div>

<script src="<?php echo CDN_URL; ?>cdn-lendbase/waitui/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
<script src="<?php echo CDN_URL; ?>cdn-lendbase/waitui/js/public.js?<?php echo CACHE_TIME; ?>"></script>
<script src="<?php echo CDN_URL; ?>cdn-lendbase/waitui/js/dom-ready.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">
$(function(){
    $("#flash_btn").on("click",function(){
        var $this = $(this);
        $this.text("查询中");
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>tool/Spider_controller/insert_flashListAjax",
            async:true,
            data:{
                api: $.trim($("#flash_api").val())
            },
            dataType:"json",
            success: function(data){
                $this.text("查询");
                $("#flash_result").show();
                var results = data.result_list;
                $.each(results, function(i) {
                    if(results[i].status == 0){
                        $("#flash_result").append('<p class="red">'+results[i].msg+'</p>');
                    }else{
                        $("#flash_result").append('<p class="green">'+results[i].msg+'</p>');
                    }
                });
            }
        });
    })
    
    $("#article_btn").on("click",function(){
        var $this = $(this);
        if($("#article_category").val() == ""){
            Pop.alert("资讯类型不能为空");
            return;
        }
        if($("#article_title").val() == ""){
            Pop.alert("资讯标题不能为空");
            return;
        }
        if($("#thumb_path").val() == ""){
            Pop.alert("缩略图不能为空");
            return;
        }
        if($("#article_lead").val() == ""){
            Pop.alert("资讯导语不能为空");
            return;
        }
        if($("#article_tag").val() == ""){
            Pop.alert("资讯标签不能为空");
            return;
        }
        if($("#article_content").val() == ""){
            Pop.alert("资讯内容不能为空");
            return;
        }
        var article_category = $("#article_category").val();
        var article_title = $("#article_title").val();
        var thumb_path = $("#thumb_path").val();
        var article_lead = $("#article_lead").val();
        var article_tag = $("#article_tag").val();
        var regExp = new RegExp("data-src", "g");
        var article_content = $("#article_content").val();
        article_content = article_content.replace(regExp,"src");
        $this.text("查询中");
        
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>tool/Spider_controller/insert_articleOneAjax",
            async:true,
            data:{
                article_category: article_category,
                article_title: article_title,
                thumb_path: thumb_path,
                article_lead: article_lead,
                article_tag: article_tag,
                article_content: article_content
            },
            dataType:"json",
            success: function(data){
                $this.text("查询");
                if(data.status == 0){
                    $("#article_result").html('<font class="red">'+data.msg+'</font>');
                }else{
                    $("#article_result").html('<font class="green">'+data.msg+'</font>');
                }
            }
        });
        
    })
})
</script>
</body>
</html>
