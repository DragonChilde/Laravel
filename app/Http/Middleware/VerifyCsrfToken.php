<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    //多个元素之前通过","分割,遵循数组写法
    protected $except = [
        //该处写需排除csrf验证的路由
        //'home/test/test7',
        //'*',    //表示全部的路由都不需要进行csrf验证
    ];
}
