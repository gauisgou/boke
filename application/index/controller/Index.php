<?php
namespace app\index\controller;

use think\controller;
use think\Db;
use think\Url;
use think\captcha;
use think\Request;
use think\Session;
use think\Cache;
use app\index\model\Comment;
use org\util\VerificationCode;
use org\util\RedisModel;
use app\index\controller\User;

class Index extends controller
{
    public function index()
    {
//        $redis = Cache::connect();
        //缓存方法
//        if(Cache::get('index_index') == ''){
//            
//            $index = Cache::set('index_index',$article,60);
//        }
//        $index = Cache::get('index_index');
        //redis方法
//        $redis = new \Redis();  
//        $redis->connect('127.0.0.1', 6379);
//            $redis->delete('index_index');
//        if($redis->get('index_index') == ''){
//            $article = Db::query("select * from article");
////            dump(json_encode($article));die;
////            dump(json_decode($article));die;
//            $index = $redis->set('index_index',json_encode($article));
//        }
//        $index = json_decode($redis->get('index_index')); 
        //正常查询数据库
        $index = Db::query("select * from article");
//        echo Db::getlastsql();die;
        $this->assign('article',$index);
        return $this->fetch();
    }
    
    //详情页
    public function details(){
        session_start();
        $request = Request::instance();
        $id = $request->param();
        $where = 'id='.$id['id'];
        //详情-
        $article = Db::query("select * from article where $where limit 1");
        $this->assign("article",$article);
        //评论区
        $comment = Db::table('comment')->where('article_pk='.$id['id'])->select();
        $this->assign('comment',$comment);
//        dump($article);
//        dump($comment);die;
        //验证码
//        $verificationCode = new VerificationCode();
//        $verificationCode->code();
        $this->assign('authcode',$_SESSION['authcode']);
        $this->assign('authcode_url','/'.$_SESSION['authcode_url']);
        return $this->fetch('article');
    }
    
    /*
     * 添加评论
     * 参数：$verify  验证码
     *      uname    评论者名称
     *      contents 评论
     */
    public function addComment(){
        session_start();
        $_SESSION['authcode'] = 'iab4';
        $verify = preg_replace('/^(&nbsp;|\s)*|(&nbsp;|\s)*$/', '', input('post.verify'));
        $verify = 'iab4';
        if($_SESSION['authcode'] != $verify){
            return json(
                array('status' => 400,'msg' => '验证码错误')   
            );
        }
        $data['comment_name'] = preg_replace('/^(&nbsp;|\s)*|(&nbsp;|\s)*$/', '', input('post.uname'));
        $data['comment'] = input('post.contents');
        if($data['comment_name'] == '' && $data['comment'] == ''){
            return json(array('status' => 400,'msg' => '请输入内容'));
        }
        $data['article_pk'] = input('post.article_pk');
        $data['comment_time'] = date('Y-m-d H:i:s');
        $comment = new Comment;
        $request = $comment->allowfield(true)->isUpdate(false)->save($data);
//         echo Db::getlastsql();die;
        if($request){
            return json(
                    array('status'=>200,'msg'=>'添加评论成功','data'=>$request)
                    );
        }
        return json(array('status'=>400,'msg'=>'添加评论失败'));
//        echo Db::getlastsql();die;
////        model("comment")->select();
////        DB::getlastsql();
////        $request = Request::instance();
////        $request->param();
//        dump($request);
//        die;
    }
    
    //了解博客
    public function blogDetails(){
        
        return $this->fetch('about');
    }

    public function hello($world = 'world'){
        $name = $this->request->param();
//        dump($name['name']);die;
        return 'hello'.$world.":::".$name['name'];
    }
    
    public function today(){
        $data = $this->request->param();
        return '今年是'.$data['year'].'年'.$data['month'].'月';
    }
  
    //参数的传递接收
    public function world(){
        //获取当前url不含域名
        //方法一
        $request = Request::instance();
        echo($request->url());  //获取当前url不含域名
        echo '<br/>';
        //方法二
        echo($this->request->url());//获取当前url不含域名
        echo '<br/>';
        echo($this->request->bind('user_name','张三')); //动态绑定参数
        echo '<br/>';
        echo($this->request->user_name); //获取参数
        echo '<br/>';
        echo request()->url(); //获取当前url不含域名
        echo '<br/>';
        print_r($request->param());  //获取传递参数（不区分get和post）
        echo '<br/>';
//    //=====================request============================
        echo $request->get();  //获取get参数
        echo '<br/>';
        echo $request->post();  //获取post参数
        echo '<br/>';
        echo $request->cookie();  //获取cookie参数
        echo '<br/>';
        echo $request->file();  //获取文件上传参数
        echo '<br/>';
    //========================input=========================
        print_r(input("get."));  //获取get参数
        echo '<br/>';
        print_r(input("post."));  //获取post参数
        echo '<br/>';
        echo input("cookie.name"); //获取cookie参数
        echo '<br/>';
        echo input("file.images");  //获取文件上传参数
        echo '<br/>';
    }
    
    //页面输出
    public function bind($i=111,$b=22){
        $data['name']=User::add();
        $data['de'] = '======'.$i.'=========='.$b;
        //第一种json返回
        return json($data);  //返回json格式
        //第二种json返回（直接改变header头的状态码不太友好）
//        return json($data,300);   //返回json格式并且改变接口的状态嘛
//        第三种json返回
//        return json(
//             array('status' => 200,'msg' => '查询成功','data' => $data)   
//        );
//        return xml($data);   //返回xml格式
        $this->assign("name",'模版');
        $this->fetch();  
    }
    
    //页面跳转
    public function hello3(){
        $this->success("正确的页面跳转","/index/user/add");
//        $this->error("错误的页面跳转","/admin/index/index");
//        $this->redirect("http://nyfz-tp5.com/index/index/bind.html");
    }
    
    public function php_info(){
        phpinfo();
    }
    public function redis(){
            $redis = new \Redis();  
            $redis->connect('127.0.0.1', 6379);
            $redis->set('test','qqqqqqq');
            $result = $redis->get('test');  
            var_dump($result);   //结果：string(11) "11111111111" 
    }
}
