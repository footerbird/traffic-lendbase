<?php
class Flash_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add_flashOne($flash_title,$flash_content){//新增一条快讯记录
        $sql = "insert into flash_info(flash_title,flash_content"
            .")values('".$flash_title."','".$flash_content."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>