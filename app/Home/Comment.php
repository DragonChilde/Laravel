<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //定义关联的数据表
    protected $table    = 'comment';

    //禁用时间字段
    public $timestamps = false;
}
