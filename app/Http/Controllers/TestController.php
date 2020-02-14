<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;	//命名空间的三元素:常量,方法,类
use Illuminate\Support\Facades\Input;
//
use DB;

use App\Home\Member;

use Session;

use Cache;

use App\Home\Article;

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

    //模型添加操作
    //方法一
  /*  public function modeladd()
    {
        //实例化模型,将表和类映射起来
        $model = new Member();
        //给属性赋值,将字段与类的属性映射起来
        $model->name = "王五";
        $model->age = 50;
        $model->email = "test@test.com";
        //去做具体的操作,将记录映射到实例
        $model->save();
        dd($model);     //可以看到模型的完整信息
    }*/

    //模型添加操作
    //方法二
    public function modeladd(Request $request)
    {
        //实例化模型,将表和类映射起来
       $model =  new Member();
        //添加操作
       $result = $model->create($request->all());
        dd($result);
    }

    public function test8()
    {
        return view('home.test.test8');
    }

    //模型查询操作
    public function modelselect()
    {
        //查询指定主键的记录
       /* $data = Member::find(1)->toArray();
        dd($data);*/
        //查询符合指定条件的第1条记录
        $data = Member::where('age','>','20')->first()->toArray();
        dd($data);
    }

    //模型更新操作
    public function modelupdate()
    {
        /*//AR模型的修改操作
        $model = Member::find(10);
        //赋值属性(需要修改的字段进行赋值)
        $model->name = "陈二";
        //具体操作:实例映射到记录
        $result = $model->save();
        dd($result);*/

       $result =  Member::where('id','10')->update([
            'age'   =>  40,
        ]);
       dd($result);
    }

    //模型删除操作
    public function modeldel()
    {
       $result = Member::find(10)->delete();
        dd($result);
    }

    //自动验证
    public function autoValidation(Request $request)
    {
        //判断请球类型
        $method = Input::method();
        if($method =="POST")
        {
            //自动验证
            //具体的规则
            //字段=>验证规则1|验证规则2|验证规则3
            $this -> validate($request,[
                'name'  =>  'required|min:2|max:20',
                'age'   =>  'required|integer|min:1|max:100',
                'email' =>  'required|email',
                'captcha'=> 'required|captcha',
            ]);
        } else {
            //展示视图
            return view('home.test.test9');
        }
    }

    //文件上传
    public function uploadFile(Request $request)
    {
        //判断请求类型
        $method = Input::method();
        if($method == "POST")
        {
            //判断文件是否正常上传
             if($request->file('avatar')->isValid() && $request->hasFile('avatar')){
                //获取文件的原始名称
                //$name = $request->file('avatar')->getClientOriginalName();
                //dd($name);
                //获取文件大小
              // $size = $request->file('avatar')->getClientSize();
              // dd($size);
              $path = md5(time()). rand(10000,99999).".".$request->file('avatar')->guessClientExtension();
              $request->file('avatar')->move('./uploads',$path);

              $data = $request->all();
              $data['avatar'] = './uploads/'.$path;
                $result = Member::create($data);
                //dd($result);
                //判断是否成功
                if($result)
                {
                    return redirect("/");
                }
             }

        } else {
            //展示示图
             return view('home.test.test10');
        }

    }

    //数据分页
    public function paging()
    {
        //查询全部数据
       $data = Member::paginate(1);
       //展示视图并且传递数据
        return view('home.test.test11',compact('data'));
    }


    //json
    public function json()
    {
        //查询数据
        $data = Member::all();
        //json格式响应
        return response()->json($data);
    }

    //Session
    public function session()
    {
        //Session中存储一个变量
        Session::put("name","张三");
        //Session中获取一个变量
        echo Session::get("name");
        //Session中获取一个变量或近回一个默认值(如果变量不存在)
        echo Session::get("value",function(){return "123";});
        //Session中获取所有变量
        dd(Session::all());
        //检查一个变量是否在Session中存在
        dd(Session::has("age"));
        //Session中删除一个变量
        Session::forget("name");
        //Session中删除所有变量
        Session:flush();
    }

    //Cache
    public function cache()
    {
        //设置一个缓存,如果存在同名则覆盖
        Cache::put('test01','111',10);
        Cache::put('test01','222',10);
        Cache::add('test02','222',10);
        //设置一个缓存,但是存在同名不添加
        Cache::add('test02','333',10);
        //永久缓存
        Cache::forever('name','test');
        //获取指定的值
        echo Cache::get('name');
        //获取指定的值,如果不存在,则使用默认值替换
        echo Cache::get('sign','没有缓存值!');
        //通过回调函数的方式返回默认值
        echo Cache::get('time',function(){
            return date('Y-m-d H:i:s',time());
        });
        //判断某个值是否存在
        var_dump(Cache::has('time'));
        //使用pull方法实现一次性存储
       var_dump(Cache::pull('test02'));
        //直接删除某一个值
        Cache::forget('name');
        //删除全部的缓存文件
       // Cache::flush();
       //递增或者递减的实现
       /*Cache::increment('count');
       Cache::increment('count',10);*/
       Cache::decrement('count');
        Cache::decrement('count',10);
        //设置默认的时间
        $time = Cache::remember('time',100,function(){
            return date('Y-m-d H:i:s',time());
        });
        var_dump(Cache::has('time'));
        //永久存储
        $date = Cache::rememberForever('date',function(){
            return date('Y-m-d');
        });
        dd($date);
    }

    //联表查询
    public function jointable()
    {
        //select  t1.id,t1.article_name,t2.author_name from article as t1 left join author as t2 on t1.author_id = t2.id;
        $data = DB::table('article as t1')->select('t1.id','t1.article_name','t2.author_name')
                            ->leftJoin('author as t2','t1.author_id','=','t2.id')
                            ->get();
        dd($data);
    }

    //关联模型(一对一)
    public function joinModelOneForOne()
    {
            //查询数据
            $data = Article::get();
            //循环展示
            foreach($data as $key => $item)
            {
                echo $item->id."&emsp;".$item->article_name."&emsp;".$item->author->author_name."<br/>";
            }
    }

    //关联模型(一对多)
    public function joinModelOneForMany()
    {

            //查询数据
            $data = Article::get();
            //循环展示
            foreach($data as $key => $item)
            {
                echo $item->article_name."<br/>";
                //获取当前文章下全部的评论
                foreach($item->comment as $k => $v)
                {
                    echo "&emsp;".$v->comment."<br/>";
                }
            }
    }

    //关联模型（多对多）
    public function joinModelManyForMany()
    {
        //查询数据
        $data = Article::get();
        //循环展示
        foreach($data as $key => $item)
        {
              echo $item->article_name."<br/>";
                //获取当前文章下全部的评论
            foreach ($item->keyword as $k => $v) {
               echo "&emsp;".$v->keyword."<br/>";
            }
        }
    }
}
