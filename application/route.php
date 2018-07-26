<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    //http://nyfz-tp5.com/hello/name.html
    'hello/[:name]' => ['index/index/hello',['method'=>'get','ext'=>'html']],
    //http://nyfz-tp5.com/today/2018/07.html
    'today/:year/:month' => ['index/index/today',['method'=>'get','ext'=>'html']],
    
//    'world' => ['index/index/world',['method'=>'get','ext'=>'html']],
];
