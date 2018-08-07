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
use think\Route;
//验证器 validate
//  http://nyfz-tp5.com/banner/1
Route::get('banner/:id','api/v1.Banner/getBanner');
//异常处理  try{}catch(){}
Route::get('bannerTest/:id','api/v1.Banner/getBannerTest');
//定义全局异常处理  exceptionHandlar
Route::get('bannerTop/:id','api/v1.Banner/getBannerTop');
//  http://nyfz-tp5.com/banner/1
Route::alias('home','index/index/hello');

//mysql
Route::get('api/v1/bannerMysql/:id','api/v1.Banner/getBannerMysql');

//版本控制替换
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

Route::get('api/:version/theme/:id','api/:version.Theme/getSimpleList');

//tocke
Route::post('api/:version/tocke/user','api/:version.Tocke/getTocke');

//测试两个参数的传递
Route::get('api/:version/order/:product_id/:count','api/:version.Order/getOrder');

//post测试提交，validata的自动验证和手动验证
//http://nyfz-tp5.com/index/index/index.html
Route::post('api/:version/order','api/:version.Order/getOrder');

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    //http://nyfz-tp5.com/hello/1/name/jdf
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
