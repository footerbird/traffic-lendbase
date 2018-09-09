<?php
class Index_controller extends CI_Controller {
    
    public function article_list(){//文章列表
        
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList('',0,10);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
        }
        $data['article_list'] = $article_list;
        
        $seo = array(
            'seo_title'=>'专业的品牌资讯分享平台 | 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/article_list',$data);
    }
    
    public function get_articleAjax_tpl(){//文章列表加载更多（模板加載）
        
        $category = $this->input->get_post('category');//得到文章类型
        $category = $category?$category:'';
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList($category,$offset,$page_size);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
        }
        $data['article_list'] = $article_list;
        
        $this->load->view('mobile/templete/tpl_article',$data);
    }
    
    public function article_detail($article_id){//文章详细页面
        
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        
        //edit_articleRead方法改变文章阅读数
        $updateStatus = $this->article->edit_articleRead($article_id);
        
        //get_articleDetail方法得到文章详情
        $article = $this->article->get_articleDetail($article_id);
        $article->create_time = format_article_time($article->create_time);
        
        $author_info = $this->article->get_authorinfoById($article->author_id);
        $article->author_name = $author_info->author_name;
        $article->figure_path = $author_info->figure_path;
        $data['article'] = $article;
        
        $seo = array(
            'seo_title'=>$article->article_title.' | 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/article_detail',$data);
    }
    
    public function article_latest(){//文章详细页面（最新更新）
        
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        
        //get_articleList方法得到头条列表最新一条
        $article_list = $this->article->get_articleList('',0,1);
        $article_latest = $article_list[0];
        $article_id = $article_latest->article_id;
        
        //edit_articleRead方法改变文章阅读数
        $updateStatus = $this->article->edit_articleRead($article_id);
        
        //get_articleDetail方法得到文章详情
        $article = $this->article->get_articleDetail($article_id);
        $article->create_time = format_article_time($article->create_time);
        
        $author_info = $this->article->get_authorinfoById($article->author_id);
        $article->author_name = $author_info->author_name;
        $article->figure_path = $author_info->figure_path;
        $data['article'] = $article;
        
        $seo = array(
            'seo_title'=>$article->article_title.' | 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/article_detail',$data);
    }
    
}
?>