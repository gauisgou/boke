<?php

namespace app\api\model;

class Theme extends BaseModel
{
    //单表联查
    public function topicImg(){
//        "select * from theme left join image on theme.topic_img_id=image.id"
        return $this->belongsTo('Image','topic_img_id','id');
    }
    //单表联查
    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
        
    }
    
    /*
     * 多表联查，通过中间表查询
     * 表一：theme
     * 表二：product
     * 中间表：theme_product
     */
    public function products(){
        return $this->belongsToMany('Product','theme_product','produce_id','theme_id');
    }
}

