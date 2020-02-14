<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    //定义关联的数据表
    protected $table =  'keyword';

    //禁用时间字段
    public $timestamps = false;
}
