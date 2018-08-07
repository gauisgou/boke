<?php

namespace app\api\controller\v1;

use app\api\controller\validate\OrderPlace;
use think\Request;

class Order
{
    public function getOrder(){
//        $request = Request::instance();
//        $dd = $request->param();
//        dump($dd);die;
//        echo 234;die;
        (new OrderPlace())->goCheck();
        echo 353;die;
    }
}

