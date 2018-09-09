<?php
class Article_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add_articleOne($article_title,$thumb_path,$article_lead,$article_tag,$article_content,$status,$author_id,$article_category){//新增一条资讯记录
        $sql = "insert into article_info(article_title,thumb_path,article_lead,article_tag,article_content,status,author_id,article_category"
            .")values('".$article_title."','".$thumb_path."','".$article_lead."','".$article_tag."','".$article_content."',".$status.",".$author_id.",'".$article_category."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>