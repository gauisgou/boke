<?php

namespace app\api\controller\v1;

use app\api\controller\validate\TockeGet;
use app\api\service\UserTocke;

class Tocke
{
    public function getTocke($code = ''){
        (new TockeGet())->goCheck();
        $ut = new UserTocke($code);
//        echo $code;die;
        $result = $ut->get();
        return  $result;die;
    }
}
