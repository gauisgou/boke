<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\model;
use think\Request;
use org\util\VerificationCode;
use app\common\controller\Index as BasicController;

class Index extends BasicController
{
    public function index()
    {
        $user_id = $_SESSION['user']['user_id'];
        if($user_id){
            $field = 'r.id,role_name';
            //取出顶级目录
            $sql = "select $field from user_role ur left join role r on ur.role_pk=r.id where ur.user_pk='$user_id' and r.ascription='0' and display='1'";
            $role_large = db::query($sql);
            if($role_large){
                foreach($role_large as $k=>$v){
                    //取出下级目录
                    $role_lower = db::table("role")->where("ascription='".$v['id']."' and display='1'")->select();
                    $role_large[$k]['role_lower'] = $role_lower;
                }
                $this->assign('role_large',$role_large);
            }
        }
        return $this->fetch();
    }
    
    public function test(){
        $request = Request::instance();
        $id = $request->param();
    }
    
    //无效级商品分类
    public function goods_type(){
        $concat_path = db::query("select *,concat(`path`,',',`id`) as path from goods_type order by path");
        foreach($concat_path as $k=>$v){
            $concat_path[$k]['name'] = str_repeat("|---",$v['level']).$v['name'];
        }
        dump($concat_path);
    }
}
