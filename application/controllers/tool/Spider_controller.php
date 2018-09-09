<?php
require 'QueryList/phpQuery.php';
require 'QueryList/QueryList.php';
use QL\QueryList;
  
class Spider_controller extends CI_Controller {
    
    public function index(){//爬虫首页
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleCategory方法得到文章分类信息
        $article_category = $this->article->get_articleCategory();
        $data['article_category'] = $article_category;
        
        $this->load->view('tool/spider',$data);
    }
    
    public function insert_flashListAjax(){//插入快讯列表
        
        $api = trim($this->input->get_post('api'));//得到快讯数据接口
        $info_json_str = file_get_contents($api);
        $info = json_decode($info_json_str);
        $flash_list = $info->data->items;
        $result_list = array();
        
        //加载快讯模型类
        $this->load->model('tool/Flash_model','flash');
        foreach ($flash_list as $flash){
            $flash_title = $flash->title;
            $flash_content = '<p>'.$flash->description.'</p>';
            $addStatus = $this->flash->add_flashOne($flash_title,$flash_content);
            if($addStatus){
                $result["status"] = 1;//1-成功，0-失败
                $result["msg"] = "插入成功，快讯：".$flash_title;
            }else{
                $result["status"] = 0;
                $result["msg"] = "插入失败";
            }
            array_push($result_list,$result);
        }
        $data["result_list"] = $result_list;
        
        echo json_encode($data);
    }
    
    public function insert_articleOneAjax(){
        
        $article_category = trim($this->input->get_post('article_category'));//资讯类型
        $article_title = trim($this->input->get_post('article_title'));//资讯标题
        $thumb_path = trim($this->input->get_post('thumb_path'));//缩略图地址
        $article_lead = trim($this->input->get_post('article_lead'));//资讯导语
        $article_tag = trim($this->input->get_post('article_tag'));//资讯标签
        $article_content = trim($this->input->get_post('article_content'));//资讯内容
        
        //加载快讯模型类
        $this->load->model('tool/Article_model','article');
        $addStatus = $this->article->add_articleOne($article_title,$thumb_path,$article_lead,$article_tag,$article_content,1,1,$article_category);
        if($addStatus){
            $data["status"] = 1;//1-成功，0-失败
            $data["msg"] = "插入成功，资讯：".$article_title;
        }else{
            $data["status"] = 0;
            $data["msg"] = "插入失败";
        }
        
        echo json_encode($data);
    }
    
}
?>