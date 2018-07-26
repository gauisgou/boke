<?php

namespace app\index\model;

use think\Model;
use think\Validate;

class Article extends Model
{
//    //自定义表名（不包含前缀）
//    protected $name = 'admin';
//    //设置完整表面
//    protected $table = 'tb_table';
//     
    //读取器Name是users表中的一个字段
    public function getNameAttr($values){
      return $values;  
    }
    //修改器
    //$values 是属性值
    //$data  查询出的数组
    public function setNameAttr($values,$data){
        return $values; 
    }
    
    //查询范围  scope+名称
    public function scopeName($query){
        $query->where('name','张三');
    }
}

