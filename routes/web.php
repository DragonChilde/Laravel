<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//默认根路由,当系统创建好之后就存在的
Route::get('/', function () {
    return view('welcome');		//view方法,输出视图文件,相当于$this->display();
});

Route::get('/test',function(){
	return 'test';
});

//例如访问/home地址则路由可以写成
//Route::请求方式('请求的URL',匿名函数或控制响应的方法)
Route::get('/home',function(){
	echo '当前访问的地址是/home';
});

//any语法
//Route::请求方式('请求的URL',匿名函数或控制响应的方法)
Route::any('/test1',function(){
	echo '当前访问的地址是/test1';
});

//match语法
//Route::请求方式([请求类型],'请求的URL',匿名函数或控制响应的方法)
Route::match(['get','post'],'/test2',function(){
	echo '当前访问的地址是/test2';
});

Route::get('user/{id}',function($id){
	return 'user id is '.$id;
});

Route::get('user1/{name?}',function($name=null){
	return 'user name is '.$name;
});

Route::get('user2/{age?}',function($age=13){
	return 'user age is '.$age;
});

Route::get('user3',function(){
	echo "当前的用户ID是".$_GET['id'];
});

Route::any('test3',function(){
	echo "当前的用户ID是".$_GET['id'];
})->name('t3');


Route::group(['prefix'=>'admin'],function(){
	Route::get('test1',function(){
		//匹配"/admin/test1"URL
	});
	Route::get('test2',function(){
		//匹配"/admin/test2"URL
	});
		Route::get('test3',function(){
		//匹配"/admin/test3"URL
	});
});


//控制器路由方法
Route::get('/home/test/test1','TestController@test1');

//分目录管理
Route::get('/home/index/index','Home\IndexController@index');
Route::get('/admin/index/index','Admin\IndexController@index');

Route::get('/home/test/test2','TestController@test2');


//DB门面的增删改查
Route::group(['prefix'=>'home/test'],function(){
	Route::get('/add','TestController@add');
	Route::get('/del','TestController@del');
	Route::get('/update','TestController@update');
	Route::get('/select','TestController@select');
});

//视图操作
Route::get('home/test/test3','TestController@test3');

//视图循环操作
Route::get('home/test/test4','TestController@test4');

//视图模板继承/包含
Route::get('home/test/test5','TestController@test5');

//验证CSRF
Route::get('home/test/test6','TestController@test6');
Route::post('home/test/test7','TestController@test7')->name('test7');

//模型操作
Route::group(['prefix'=>'home/test'],function(){
    Route::any('/modeladd','TestController@modeladd');
    Route::get('/modeldel','TestController@modeldel');
    Route::get('/modelupdate','TestController@modelupdate');
    Route::get('/modelselect','TestController@modelselect');
    Route::get('test8','TestController@test8');
});

//自动验证
Route::any('home/test/auto_valid','TestController@autoValidation');

//文件上传
Route::any('home/test/uploadfile','TestController@uploadFile');

//数据分页
Route::any('home/test/paging','TestController@paging');

//json响应
Route::any('home/test/json','TestController@json');

//Session
Route::get('home/test/session','TestController@session');

//缓存操作
Route::get('home/test/cache','TestController@cache');

//联表查询
Route::get('home/test/jointable','TestController@jointable');

//关联模型
//一对一
Route::get('home/test/joinmodeloneforone','TestController@joinModelOneForOne');
//一对多
Route::get('home/test/joinmodeloneformany','TestController@joinModelOneForMany');
//多对多
Route::get('home/test/joinmodelmanyformany','TestController@joinModelManyForMany');
