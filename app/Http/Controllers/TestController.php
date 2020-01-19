<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;	//命名空间的三元素:常量,方法,类
use Input;
//
use DB;

class TestController extends Controller
{
    public function test1()
    {
    	echo phpinfo();
    }

    public function test2()
    {
    	//获取一个值,如果没有则使用第二个参数当默认值
    	echo Input::get('id','10086').'<br/>';
    	//获取全部的值(数组形式返回)
    	$all = Input::all();
    	//dd($all);
    	//获取指定的信息(字符串形式)
		//dd(Input::get('name'));

    	//获取指定的几个值(数组形式)
    	//dd(Input::only(['id','name']));

    	//获取除了指定的值,之外的值
    	//dd(Input::except(['name']));

    	//判断某个值存在与否(返回布尔值)
    	dd(Input::has('gender'));
    }

    public function add()
    {
    	$result = DB::table('member')->insert([
    		[
    			'name'	=>	'张三',
    			'age'	=>	12,
    			'email'	=>	'test1@test.com',
    		],
    		[
    			'name'	=>	'李四',
    			'age'	=>	13,
    			'email'	=>	'test2@test.com',
    		],
    	]);

    	dd($result);

/*
    	$result = DB::table('member')->insertGetId([
    			'name'	=>	'张三',
    			'age'	=>	12,
    			'email'	=>	'test1@test.com',
    	]);

    	dd($result);*/
    }

    public function update()
    {
    	/*$result = DB::table('member')->where('id','=','1')->update([
    		'name' => '李五'
    	]);

    	dd($result);*/

    	$result = DB::table('member')->where('id','=','1')->Increment('age',1);
    	dd($result);
    }

    //查询方法
    public function select()
    {

       $db =  DB::table('member');
        /*
       $data = $db->get();
       //dd($data);
        foreach ($data as $key => $value) {
          echo "id is {$value->id},name is {$value->name},age is {$value->age}<br/>";
        }
        */

        //查询id<3的数据
    /*   $data = $db->where("id","<","3")->get();
       dd($data);*/

       //查询Id大于2并且age小于40的数据
      /* $data = $db->where('id',">","2")->where("age","<","40")->get();
       dd($data);*/

       /*取出单行记录*/
      /* $data = $db->first();
       dd($data);*/

       /*取出指定字段的值*/
     /*  $data = $db->where('id',1)->value('name');
       dd($data);*/

       /*查询指定的一些字段的值*/
      /* $data = $db->where("id",1)->select('name',"age")->get();
       dd($data);*/

       //按照指定的字段进行特定规则排序
     /*  $data = $db->orderBy("age","desc")->get();
       dd($data);*/

       //分页操作
       $data = $db->offset(1)->limit(2)->get();
       dd($data);
    }

    /*删除操作*/
    public function del()
    {
        //指定需要操作的数据表
        $db = DB::table('member');
        //删除id为1的记录
        $result = $db->where("id",3)->delete();
        dd($result);
    }


    /*模板操作*/
    public function test3()
    {
       $date =  date('Y-m-d',time());
       $year = '年';
        //return view('home.test.test3',['date'=>$date,'year'=>$year]);
        //定义一个时间戳,在页面进行格式化
       $timeStamp = time();
        return view('home.test.test3',compact('date','year','timeStamp'));
    }

    /*循环操作*/
    public function test4()
    {
        //查询数据
       $data =  DB::table('member')->get();
       //获取今天的星期数字
       $day = date("w");
       //展示视图,传递数据
       return view('home.test.test4',compact('data','day'));
    }

    public function test5()
    {
         //展示视图,传递数据
       return view('home.test.test5');
    }

     public function test6()
    {
         //展示视图,传递数据
       return view('home.test.test6');
    }

    public function test7()
    {
        echo "提交成功!";
    }
}
