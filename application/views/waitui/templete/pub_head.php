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
<meta name="baidu_union_verify" content="6ffef5279ad2d9a0bc8c1c8063d93051">
<link rel="icon" href="<?php echo CDN_URL; ?>cdn-lendbase/waitui/images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo CDN_URL; ?>cdn-lendbase/waitui/images/favicon.ico" type="image/x-icon">
<?php if(isset($styles)){ foreach($styles as $style){ echo '<link rel="stylesheet" href="'.$style.'"/>';} }?>
<link rel="stylesheet" href="<?php echo CDN_URL; ?>cdn-lendbase/waitui/css/animate.min.css?<?php echo CACHE_TIME; ?>">
<link rel="stylesheet" href="<?php echo CDN_URL; ?>cdn-lendbase/waitui/css/public.css?<?php echo CACHE_TIME; ?>">
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?5cb30c8b2b42783b4db12dfe342099e2";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

