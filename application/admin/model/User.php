<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class user extends Model{
    public function qwe(){
        return Db::name('user')->select();
//        $d = Db::query('select * from runoob_tbl');
//        return $d;
    }
}

