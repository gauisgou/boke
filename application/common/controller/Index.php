<?php
namespace app\common\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function _initialize(){
        session_start();
        if(isset($_SESSION['user']['expiretime'])){
            if($_SESSION['user']['expiretime'] < time()){
                unset($_SESSION['user']);
    //            session_destroy();
                $this->success('请先登陆', 'login/index');
            }
        }else{
            $this->success('请先登陆', 'login/index');
            //重定向
    //        $this->redirect('http://nyfz-tp5.com/admin/login/index.html');
    //        echo 111;die;
        }
    }
    public function index()
    {
        $this->assign('name','礼拜');
        echo 334;die;
        return $this->fetch('index');
        die;
        $data = Db::name("runoob_tbl")->select();
        //打印sql语句
        $sql=Db::getLastSql();
        Db::listen(function($sql, $time, $explain){
            // 记录SQL
            echo $sql. ' ['.$time.'s]';
            // 查看性能分析结果
            dump($explain);
        });
    }
}