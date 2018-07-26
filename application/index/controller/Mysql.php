<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class Mysql extends Controller
{
    public function index()
    {
        //插入数据
//        $insert_add = Db::execute('insert into runoob_tbl (id,name,author,aub_date) values (null,"张三","12",null)');  //author
//        echo Db::getLastSql();die;
//        print_r($insert_add);
//        更新数据
//        $uodate = Db::execute('update runoob_tbl set name="李四" where id=3');
//        print_r($uodate);
//        删除数据
//        $delete = Db::execute('delete from runoob_tbl where id=4');
//        print_r($delete);
//        查询数据
//        $select = Db::query('select * from runoob_tbl');
//        var_dump($select);
//        数据库切换
//        $db2 = Db::connect("db2")->query("select * from runoob_tbl");
//        dump($db2);
//        $db3 = Db::connect("db3")->query("select * from cource");
//        dump($db3);
//        参数替换
//        Db::execute('insert into runoob_tbl(id,name,author,aub_date) values (?,?,?,?)',[null,'ww','ww',null]);
//        事物操作
//        1。把需要操作的语句放到闭包中操作
//        Db::transaction(function(){
//            Db::execute('insert into runoob_tbl(id,name,author,aub_date) values (?,?,?,?)',[null,'ww','ww',null]);
//        });
//        2。手动执行事务
//        Db::startTrans();
//        try{
//            Db::execute('delete from runoob_tbl where id=4');
//            //提交事务
//            Db::commit();
//        } catch (Exception $ex) {
//            //事物回滚
//            Db::rollback();
//        }
        
    }
    
}

