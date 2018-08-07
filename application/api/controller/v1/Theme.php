<?php

namespace app\api\controller\v1;

use think\Request;
use app\api\controller\validate;
use app\api\controller\validate\IDCollection;
use think\Db;

use app\lib\exception\ThemeException;
use app\api\model\Theme as ThemeModel;

class Theme
{
    /*
     * @uel /theme?ids=id1,id2,id3...
     * @return 一组theme模型
     */
    public function getSimpleList($id = ''){
        (new IDCollection())->goCheck();
        $request = Request::instance();
//        dump($id);die;
//        $id = $request->param();
        $ids = explode(',',$id);
//        
//        dump(implode(',',$ids));
        //关联模型
        $result = ThemeModel::with(['topicImg','headImg'])->select($ids);
//        $result = ThemeModel::with('topicImg','headImg')->select(implode(',',$ids));
//      echo  Db::getlastsql();die;
//        $result = false;
        if(!$result){
            throw new ThemeException();
        }
        return json($result);
    }
}

