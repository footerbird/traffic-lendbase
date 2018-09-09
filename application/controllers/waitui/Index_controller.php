<?php
class Index_controller extends CI_Controller {
    
    public function article_list($category){//文章列表
        
        if($category == ''){
            redirect(base_url());
            exit;
        }
        
        $data['category'] = $category;
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleCategory方法得到文章分类信息
        $article_category = $this->article->get_articleCategory();
        $data['article_category'] = $article_category;
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList($category,0,10);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorinfoById($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        $data['article_list'] = $article_list;
        
        //get_articleRecommend方法得到推荐阅读列表
        $article_recommend = $this->article->get_articleRecommend(0,3);
        $data['article_recommend'] = $article_recommend;
        
        //加载快讯模型类
        $this->load->model('waitui/Flash_model','flash');
        //get_flashList方法得到头条列表
        $flash_list = $this->flash->get_flashList(0,5);
        foreach($flash_list as $flash){
            $flash->create_time = format_article_time($flash->create_time);
        }
        $data['flash_list'] = $flash_list;
        
        $this->footer = 'no';//默认有底部
        
        $seo = array(
            'seo_title'=>'外推头条 - 专业的品牌资讯分享平台 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            CDN_URL.'cdn-lendbase/waitui/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            CDN_URL.'cdn-lendbase/waitui/js/swiper.min.js?'.CACHE_TIME,
            CDN_URL.'cdn-lendbase/waitui/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/article_list',$data);
    }
    
    public function get_articleListAjax_tpl(){//文章列表加载更多（模板加載）
        
        $category = $this->input->get_post('category');//得到文章类型
        $category = $category?$category:'';
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList($category,$offset,$page_size);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorinfoById($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        
        $data['article_list'] = $article_list;
        
        $this->load->view('waitui/templete/tpl_article',$data);
    }
    
    public function article_search($keyword){//文章搜索
        
        $data['keyword'] = urldecode($keyword);
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleCategory方法得到文章分类信息
        $article_category = $this->article->get_articleCategory();
        $data['article_category'] = $article_category;
        //get_articleSearch方法得到头条搜索列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),0,10);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorinfoById($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        $data['article_list'] = $article_list;
        
        //get_articleRecommend方法得到推荐阅读列表
        $article_recommend = $this->article->get_articleRecommend(0,3);
        $data['article_recommend'] = $article_recommend;
        
        //加载快讯模型类
        $this->load->model('waitui/Flash_model','flash');
        //get_flashList方法得到头条列表
        $flash_list = $this->flash->get_flashList(0,5);
        foreach($flash_list as $flash){
            $flash->create_time = format_article_time($flash->create_time);
        }
        $data['flash_list'] = $flash_list;
        
        $seo = array(
            'seo_title'=>'外推头条 - 专业的品牌资讯分享平台 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            CDN_URL.'cdn-lendbase/waitui/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            CDN_URL.'cdn-lendbase/waitui/js/swiper.min.js?'.CACHE_TIME,
            CDN_URL.'cdn-lendbase/waitui/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/article_search',$data);
    }
    
    public function get_articleSearchAjax_tpl(){//文章搜索加载更多（模板加載）
        
        $keyword = $this->input->get_post('keyword');//得到文章类型
        $keyword = $keyword?$keyword:'';
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleSearch方法得到头条搜索列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),$offset,$page_size);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorinfoById($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        $data['article_list'] = $article_list;
        
        $this->load->view('waitui/templete/tpl_article',$data);
    }
    
    public function article_detail($article_id){//文章详情
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleCategory方法得到文章分类信息
        $article_category = $this->article->get_articleCategory();
        $data['article_category'] = $article_category;
        //edit_articleRead方法改变文章阅读数
        $updateStatus = $this->article->edit_articleRead($article_id);
        
        //get_articleDetail方法得到文章详情
        $article = $this->article->get_articleDetail($article_id);
        if(empty($article)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        $article->create_time = format_article_time($article->create_time);
        
        $author_info = $this->article->get_authorinfoById($article->author_id);
        $article->author_name = $author_info->author_name;
        $article->figure_path = $author_info->figure_path;
        $data['article'] = $article;
        
        //加载相关阅读
        $category = $article->article_category;
        $article_relative = $this->article->get_articleList($category,0,10);
        foreach($article_relative as $key => $relative){
            if($relative->article_id == $article_id){
                unset($article_relative[$key]);
            }
        }
        $data['article_relative'] = $article_relative;
        
        //加载快讯模型类
        $this->load->model('waitui/Flash_model','flash');
        //get_flashList方法得到头条列表
        $flash_list = $this->flash->get_flashList(0,5);
        foreach($flash_list as $flash){
            $flash->create_time = format_article_time($flash->create_time);
        }
        $data['flash_list'] = $flash_list;
        
        $seo = array(
            'seo_title'=>$article->article_title.' | 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            CDN_URL.'cdn-lendbase/waitui/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            CDN_URL.'cdn-lendbase/waitui/js/swiper.min.js?'.CACHE_TIME,
            CDN_URL.'cdn-lendbase/waitui/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/article_detail',$data);
    }
    
    public function article_latest(){//文章详情（最新更新）
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleCategory方法得到文章分类信息
        $article_category = $this->article->get_articleCategory();
        $data['article_category'] = $article_category;
        
        //get_articleList方法得到头条列表最新一条
        $article_list = $this->article->get_articleList('',0,1);
        $article_latest = $article_list[0];
        $article_id = $article_latest->article_id;
        
        //edit_articleRead方法改变文章阅读数
        $updateStatus = $this->article->edit_articleRead($article_id);
        
        //get_articleDetail方法得到文章详情
        $article = $this->article->get_articleDetail($article_id);
        if(empty($article)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        $article->create_time = format_article_time($article->create_time);
        
        $author_info = $this->article->get_authorinfoById($article->author_id);
        $article->author_name = $author_info->author_name;
        $article->figure_path = $author_info->figure_path;
        $data['article'] = $article;
        
        //加载相关阅读
        $category = $article->article_category;
        $article_relative = $this->article->get_articleList($category,0,10);
        foreach($article_relative as $key => $relative){
            if($relative->article_id == $article_id){
                unset($article_relative[$key]);
            }
        }
        $data['article_relative'] = $article_relative;
        
        //加载快讯模型类
        $this->load->model('waitui/Flash_model','flash');
        //get_flashList方法得到头条列表
        $flash_list = $this->flash->get_flashList(0,5);
        foreach($flash_list as $flash){
            $flash->create_time = format_article_time($flash->create_time);
        }
        $data['flash_list'] = $flash_list;
        
        $seo = array(
            'seo_title'=>$article->article_title.' | 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            CDN_URL.'cdn-lendbase/waitui/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            CDN_URL.'cdn-lendbase/waitui/js/swiper.min.js?'.CACHE_TIME,
            CDN_URL.'cdn-lendbase/waitui/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/article_detail',$data);
    }
    

}
?>