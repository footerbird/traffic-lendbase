<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if (isset($seo)){ ?>
<title><?php echo empty($seo->seo_title)?constant('SEO_TITLE'):$seo->seo_title; ?></title>
<meta name="Keywords" content="<?php echo empty($seo->seo_keywords)?constant('SEO_KEYWORDS'):$seo->seo_keywords; ?>"/>
<meta name="description" content="<?php echo empty($seo->seo_description)?constant('SEO_DESCRIPTION'):$seo->seo_description; ?>"/>
<?php }else{ ?>
<title><?php echo constant('SEO_TITLE'); ?></title>
<meta name="Keywords" content="<?php echo constant('SEO_KEYWORDS'); ?>"/>
<meta name="description" content="<?php echo constant('SEO_DESCRIPTION'); ?>"/>
<?php } ?>
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no' />
<link rel="icon" href="<?php echo CDN_URL; ?>cdn-lendbase/mobile/images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo CDN_URL; ?>cdn-lendbase/mobile/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="<?php echo CDN_URL; ?>cdn-lendbase/mobile/dist/css/weui.css?<?php echo CACHE_TIME; ?>">
<link rel="stylesheet" href="<?php echo CDN_URL; ?>cdn-lendbase/mobile/dist/css/jquery-weui.css?<?php echo CACHE_TIME; ?>">
<?php if(isset($styles)){ foreach($styles as $style){ echo '<link rel="stylesheet" href="'.$style.'"/>';} }?>
<link rel="stylesheet" href="<?php echo CDN_URL; ?>cdn-lendbase/mobile/css/base.css?<?php echo CACHE_TIME; ?>">
<!--<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?5cb30c8b2b42783b4db12dfe342099e2";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8451154341694974",
    enable_page_level_ads: true
  });
</script>
