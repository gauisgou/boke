<?php

namespace app\index\controller;

use think\Controller;

class User extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    
    static function add()
    {
        return 'qqqqqqq';
    }
    
    public function edit($id)
    {
        return $this->fetch();
    }
}

