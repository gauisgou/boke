<?php

namespace app\api\model;

use think\Model;

class Image extends BaseModel
{
    public function item(){
        return $this->belongsTo('BannerItem', 'id','img_id');
    }
    /*
     * getUrlAttr修改图片路径
     * $value 图片路径的字段，框架会自动识别
     * $data 当前表的所有字段 ， 例如：$data['id']
     */
//    public function getUrlAttr($value){
//      return $this->prefixImgUrl($value);
//    }
}
