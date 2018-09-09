<div class="header">
    <div class="top-bar">
        <div class="container">
            <a href="/" class="top-logo"></a>
            <div class="top-nav">
                <ul>
                    <?php foreach ($article_category as $item){ ?>
                    <li <?php if(!empty($category) && $item->category_type == $category){ echo 'class="cur"'; } ?>>
                        <a href="<?php echo base_url() ?>category/<?php echo $item->category_type; ?>"><?php echo $item->category_name; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
