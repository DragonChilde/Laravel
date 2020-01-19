<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
     public function index()
    {
    	echo '这是Admin分组下的index方法';
    }
}
