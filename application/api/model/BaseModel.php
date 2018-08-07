<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    
    protected function prefixImgUrl($value){
        
        return config('setting.img_prefix').$value;
    }
}

