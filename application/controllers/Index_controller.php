<?php
class Index_controller extends CI_Controller {
    
    public function index(){//文章首页
        
        //301重定向，将lendbase.cn跳转到www.lendbase.cn
        $the_host = $_SERVER['HTTP_HOST'];//取得当前域名   
        $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';//判断地址后面是否有参数   
        
        if($the_host == 'lendbase.cn')//把这里的域名换上你想要的   
        {
            header('HTTP/1.1 301 Moved Permanently');//发出301头部   
            header('Location: http://www.lendbase.cn/');//跳转到你希望的地址格式   
            exit;
        }
        
        if($the_host == 'm.lendbase.cn'){
            header('HTTP/1.1 301 Moved Permanently');//发出301头部   
            header('Location: http://www.lendbase.cn/m'.$request_uri);//跳转到你希望的地址格式   
            exit;
        }
        
//      if($the_host != 'www.lendbase.cn')//把这里的域名换上你想要的   
//      {
//          header('HTTP/1.1 301 Moved Permanently');//发出301头部   
//          header('Location: http://www.lendbase.cn'.$request_uri.'?redirect='.$the_host);//跳转到你希望的地址格式   
//          exit;
//      }
        
        $this->load->library('user_agent');
        if($this->agent->is_mobile()){//跳转到手机端
            redirect(base_url().'m/');
        }else{//PC端主页
            $redirect = $this->input->get_post('redirect');//得到重定向host
            if($redirect){
                $data['redirect'] = $redirect;
            }
            
            //加载头条模型类
            $this->load->model('waitui/Article_model','article');
            //get_articleCategory方法得到文章分类信息
            $article_category = $this->article->get_articleCategory();
            $data['article_category'] = $article_category;
            //get_articleList方法得到头条列表
            $article_list = $this->article->get_articleList('',0,10);
            foreach($article_list as $article){
                $article->create_time = format_article_time($article->create_time);
                $author_info = $this->article->get_authorinfoById($article->author_id);
                $article->author_name = $author_info->author_name;
            }
            $data['article_first'] = $article_list[0];
            $data['article_second'] = $article_list[1];
            $data['article_third'] = $article_list[2];
            $data['article_list'] = array_slice($article_list, 3);
            
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
            
            $this->load->view('waitui/article_index',$data);
        }
    }
    
}
?>