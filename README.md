
- <a href="https://laravel.com/">官网</a>：https://laravel.com/
- <a href="http://www.golaravel.com/">中文官网</a>：http://www.golaravel.com/
- <a href="https://laravel-china.org/">中文社区</a>：https://laravel-china.org/
- <a href="http://120.77.237.175:9080/photos/laravel/">Laravel</a>

# composer #

## composer介绍 ##

- composer英文单词意思：音乐指挥者
- **composer是PHP中用来管理依赖（dependency）关系的工具**，你可以在自己的项目中声明所依赖的外部工具库（libraries）,composer会帮您安装这些依赖的库文件。
- **一句话，composer是一个工具，是为php项目准备的软件管家。**

工作原理:

![](http://120.77.237.175:9080/photos/laravel/01.png)

如上图，composer可以去packagist应用市场 里边下载软件，但是该市场只给返回软件的地址，对应的软件都是在github里边存储的，最终下载的软件是从github返回的。
https://packagist.org

## 使用composer方式部署laravel项目 ##

- 第一步：切换镜像（软件下载地址）为国内镜像【建议】镜像官网：https://pkg.phpcomposer.com/

	通过composer可以去packagist.org市场 和 github代码库 下载功能代码但是packagist和github对应的服务器都部署在国外。
	
	这时“镜像”应运而生，其是把存储在packagist和github等外国服务器上的全部内容定期(更新比较及时，几分钟的延迟)同步到国内服务器里边，使得广大开发者可以不用绕远到外国，相反在自己国家就可以把软件更新到自己的项目中，方便了composer的使用。
	
	给composer配置镜像：**修改 composer 的全局配置文件（推荐方式）**
	
		#composer config -g repo.packagist composer https://packagist.phpcomposer.com

- 第二步：composer部署laravel项目【**重点**】。比如创建一个名为laravel的laravel项目

		#composer create-project laravel/laravel --prefer-dist ./

		命令解释：
		composer：表示执行composer程序；
		create-project：通过composer去创建项目；
		laravel/Laravel：需要创建的项目名称；
		--prefer-dist：优先下载压缩包方式，而不是直接从github上下载源码（克隆）；
		./：表示创建的项目目录名称，也可以是一个目录名；

	如果不指定版本号则默认使用最新的版本号

	**注意，如果要下载其他版本，比如5.4版本中最新小版本号，可以使用这个命令**

		#composer create-project laravel/laravel=5.4.* --prefer-dist ./

## 目录结构分析 ##

- **app目录**：项目的核心目录，主要用于**存放核心代码，也包括控制器、模型**
	- 比如控制器存放如下位置：app/Http/Controllers
	- 模型文件存放位置,模型文件直接写在app目录下即可，但是也可以在该目录下建立其他目录用于专门存放模型文件，例如建立Admin目录专门存放后台需要的模型文件，建立Home目录存放前台模型文件目录
- **bootstrap目录**，laravel启动目录
	- autoload.php文件用于自动载入需要的类文件。
- **config目录**，项目的配置目录，主要存放配置文件，比如数据库的配置
	- App.php：项目主要配置文件；
	- Auth.php：用于定义用户认证（登录）的配置文件；
	- Database.php：针对数据库的配置；
	- Filesystems.php：上传文件、文件存储需要使用到的配置文件；
- **database目录**，数据迁移目录

	存储跟数据表相关的操作类文件（迁移文件【创建数据表的类文件】、种子文件【存放一些数据表的数据填充文件】）。
	- migrations 存放数据库迁移文件（操作数据表结构）
	- 存放数据库种子文件（模拟测试数据）
- **public目录**，项目的入口文件和系统的静态资源目录（css,img,js,uploads）
**后期使用的外部静态文件（js、css、图片等）都需要放到Public目录下**

	**当然重点的是项目单一入口文件也在这个目录下。因此后续配置虚拟主机的时候需要将站点位置指定到public下。**
- **resources目录**，存放视图文件，还有就是语言包文件的目录
	- Lang目录：语言包目录（如果项目需要本地化则需要配置语言包）
	- Views目录：视图文件存储目录（**视图文件也可以分目录管理**）
- **routes目录**，是定义路由的目录，**web.php是定义路由的文件**
- **storage目录**，主要是存放缓存文件和日志文件，注意，如果在linux环境下，该目录需要有可写权限。**（后期用户上传文件如果存在本地则也在storage下**）
	- App：存放的用户上传的文件
	- Framework：框架运行时的缓存文件
	- Logs：日志目录
- **vendor目录**，主要是存放第三方的类库文件，laravel思想主要是共同的开发，不要重复的造轮子（例如，里面可能存在验证码类，上传类，邮件类），该目录还存放laravel框架的源码。注意如果要使用composer软件管理的，composer下载的类库都是存放在该目录下面的。
- **env文件**：主要是设置一些系统相关的环境配置文件信息。**config目录里面的文件配置内容一般都是读取该文件里面的配置信息（config里面的配置项的值基本都是来自.env文件）。**
- **artisan脚手架文件**，主要用于生成的代码的（自动生成），比如生成控制器，模型文件等。
	- 执行命令：#php artisan 需要执行的指令
	- 要求1：php必须添加环境变量，并且保证版本；
	- 要求2：artisan必须存在命令行当前的工作路径下；
- composer.json依赖包配置文件,声明当前需要的软件依赖，但是不能删除，composer需要使用。

# Laravel入门使用（路由） #

什么是路由：将用户的请求按照事先规划的方案提交给指定的控制器或者功能函数来进行处理.【通俗的讲，路由就是访问地址形式】
在博客中，当我们在URL地址中，传递p、c、a三个参数时，系统会自动跳转到指定模型中指定控制器的指定方法，这些处理过程都是由框架自动完成的。**但是，在Laravel框架中，其并没有指定固定参数，其路由必须要手工进行配置。**
## 路由配置文件 ##

路由文件的位置: routes/web.php文件

## routes\web.php配置文件中配置路由（重点） ##

### 默认根路由 ###

问题：为什么当我们在浏览器中访问虚拟域名http://域名时，如何显示Laravel5？

答：主要是受到web.php路由的影响，当我们访问http://域名，系统会自动跳转到web.php路由，然后查看是否有定位到根目录下的get请求，找到如下代码

	//默认根路由,当系统创建好之后就存在的
	Route::get('/', function () {
	    return view('welcome');		//view方法,输出视图文件,相当于$this->display();
	});

### 路由定义格式 ###

**Route::请求方式（'请求的URL', 匿名函数或控制响应的方法）**

	Route::get('/test1',function(){
		return 'test1';
	});

又比如请求：http://域名/home地址则路由写成：Route::get('/home',function(){return '您当前访问的是/home地址'})

	//例如访问/home地址则路由可以写成
	//Route::请求方式('请求的URL',匿名函数或控制响应的方法)
	Route::get('/home',function(){
		echo '当前访问的地址是/home'
	});

### 请求方式有哪些？ ###

有效的路由方法,可以注册路由来响应任何HTTP请求:

	Route::get($uri,$callback);
	Route::post($uri,$callback);
	Route::put($uri,$callback);
	Route::patch($uri,$callback);
	Route::delete($uri,$callback);
	Route::options($uri,$callback);

有时候还需要注册路由响应多个HTTP请求----这可以通过match方法来实现.或者用any方法注册一个路由来响应所有HTTP请求:

	Route::match(['get','post']),'/',function(){
		//
	});

	Route::any('foo',function(){
		//
	});

常用的四个:get/post/match/any

- **Get表示支持get请求方式的路由**；
- **Post表示支持post请求方式的路由**；
- Match表示匹配固定（自己定义）的请求方式的路由；
- **Any表示匹配任意请求方式的路由**；

- 语法上match比get/post/any多一个参数：
- Route::match(匹配的请求类型,地址,回调);
- 匹配请求类型要求是数组格式的声明（建议使用短数组）。

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

### 路由参数 ###
路由参数其实就是给路由传递参数。

**参数分为必选参数和可选参数**。

**路由参数的传递通过路由地址中的“{参数名}”的形式来进行传递，该形式是必选参数的形式，可以选的则使用“{参数名?}”。**

**必选参数**:

有时需要在路由中捕获URI片段.比如,要从URL中捕获用户ID,需要通过如下方式定义路由参数:

	Route::get('user/{id}',function($id){
		return 'user id is '.$id;
	});

**可选参数**

有时可能需要指定可选的路由参数,这可以通过在参数后加一个 **?**标记来实现,这种情况下需要给相应的变量指定默认值:

	Route::get('user1/{name?}',function($name=null){
		return 'user name is '.$name;
	});
	
	Route::get('user2/{age?}',function($age=13){
		return 'user age is '.$age;
	});


PS:除了通过定义路由的方式来传递路由参数以外,还可以通地"?"形式传递参数,例如:http://www.laravel123.com/user?id=1111

	Route::get('user3',function(){
		echo "当前的用户ID是".$_GET['id'];
	});

### 路由别名 ###

路由别名相当于在路由定义的时候,为路由起了一个别名,在以后的程序中可以通过这个别名来获取路由的信息

Route::any('test3',function(){

echo "当前的用户ID是".$_GET['id'];

})**->name('名字')**;

	Route::any('test3',function(){
		echo "当前的用户ID是".$_GET['id'];
	})->name('t3');

调用该路由则可以写成：**route(‘名字’);**

查看系统已经有的路由命令:**#php artisan route:list**(**注意:必须要当前项目里执行**)

![](http://120.77.237.175:9080/photos/laravel/03.png)

### 路由群组(理解) ###

比如后台有如下路由

	/admin/login
	/admin/logout
	/admin/index
	/admin/user/add
	/admin/user/del
	.....

它们的共同点是,都有/admin/前缀,为了管理方便,可以把它们放到一个路由分组中.使用prefix属性指定路由前缀

比如,要为所有路由URIS前面添加前缀admin

	Route::group(['prefix'=>'admin'],function(){
		Route::get('test1',function(){
			//匹配"/admin/test1"URL
		});
	});

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

**语法:Route::group(公共属性数组,回调函数)**;在后期会接触到middleware属性

# 控制器使用 #

## 控制器文件写在哪里？ ##

其位置位于**app/Http/Controllers**

## 控制器文件如何命名？ ##

依照已经存在的四个范例控制器文件名可以得知其命名方式为：

**大驼峰的控制器名 + Controller.php**

例如，如果需要创建一个商品goods控制器，则命名为：GoodsController.php

## 结构代码如何书写？ ##

注意：其控制器基础结构代码，不需要自己去手动编写，可以通过artisan命令行来自动生成。

因此需要记住对应的命令：

	#php artisan make:controller 控制器名（大驼峰）Controller关键词

例如：使用artisan命令创建TestController.php文件。先确定命令：

	#php artisan make:controller TestController

会在app/Http/Controllers路径下成功生成TestController.php文件

	<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;	//命名空间的三元素:常量,方法,类
	
	class TestController extends Controller
	{
	    //
	}


**注意:这里生成的TestController.php文件因为与Controllers是在同目录,所以没有用use进行引入**

## 控制器路由(项目以该方式为主) ##

即，如何使用路由规则调用控制器下的方法，而不再走回调函数。路由设置格式基本相同，只是将匿名函数换成‘**控制器类名@方法名**’

定义格式如下：

**Route::请求方法(路由表达式,控制器@方法')**

例如：在Test控制器中创建test1方法，其中输出phpinfo信息

	class TestController extends Controller
	{
	    public function test1()
	    {
	    	echo phpinfo();
	    }
	}

编写路由规则：

设定路由：/home/test/test1			/p/c/a

	//控制器路由方法
	Route::get('/home/test/test1','TestController@test1');

## 控制器是否可以分目录管理(支持) ##

支持的初步判断原因就是在初始化项目之后，其Controllers目录下就存在Auth目录，而这个目录就是用于分目录管理的。

例如：需要创建前台分组，在前台平台中创建IndexController.php文件；同时建立后台的分组，再创建后台的IndexController.php。

1. 先建立相关的区分目录 Admin和Home
2. 创建控制器文件（使用artisan命令创建）
	- php artisan make::controller Admin/IndexController
	- php artisan make::controller Home/IndexController

	**在创建的时候需要在命令指定控制器所存放的目录。**
	
	创建好的控制器其命名空间等问题，artisan已经解决了。
	
		<?php
	
		namespace App\Http\Controllers\Admin;
		
		use Illuminate\Http\Request;
		use App\Http\Controllers\Controller;
		
		class IndexController extends Controller
		{
		    //
		}
	
	
		<?php
	
		namespace App\Http\Controllers\Home;
		
		use Illuminate\Http\Request;
		use App\Http\Controllers\Controller;
		
		class IndexController extends Controller
		{
		    //
		}

3. 编写前后台Index方法的测试代码


		namespace App\Http\Controllers\Home;
		
		use Illuminate\Http\Request;
		use App\Http\Controllers\Controller;
		
		class IndexController extends Controller
		{
		    public function index()
		    {
		    	echo '这是Home分组下的index方法';
		    }
		}
	
	
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

4. 编写对应的路由

	Route::请求类型(路由表达式,控制器@方法)

		//分目录管理
		Route::get('/home/index/index','Home\IndexController@index');
		Route::get('/admin/index/index','Admin\IndexController@index');

## 接收用户输入 ##

**接收用户输入的类：Illuminate\Support\Facades\Input**

Facades：“门面”的思想。门面是介于一个类的实例化与没有实例化中间的一个状态。其实是类的一个接口实现。在这个状态下可以不实例化类但是可以调用类中的方法。说白了就是静态方法。

	Input::get(‘参数的名字’, ‘如果参数没有被传递使用该默认值’) 
	Input::all(): 获取所有的用户的输入
	Input::get(''): 获取单个的用户的输入
	Input::only([ ]): 获取指定几个用户的输入
	Input::except([ ]): 获取指定几个用户的输入以外的所有的参数
	Input::has('name')：判断某个输入的参数是否存在

	上述方法即既可以获取get中的信息，也可以获取post中信息。


在laravel中如果需要使用facades的话，但是又不想写那么长的引入操作：

	Use Illuminate\Support\Facades\Input

**则可以在config/app.php中定义长串的别名（在aliases数组中定义别名）：**

![](http://120.77.237.175:9080/photos/laravel/04.png)

直接可以在页面引用别名:

	use Input;

编写测试的路由:

	Route::get('/home/test/test2','TestController@test1');

测试代码:

在Laravel中友好输出函数:**dd()**

作用:dump+die,后续的代码不会执行

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

**注意:在laravel中不仅仅是Input门面可以获取用户的输入，Request门面也可以获取用户输入的，其语法和Input一样，也存在get、all、only等方法。**

# DB类操作数据库（重点） #

按照MVC 的架构，对数据的操作应该放在 Model 中完成，**但如果不使用Model，我们也可以用 laravel框架提供的 DB 类操作数据库**。而且，对于某些极其复杂的sql，用Model 已经很难完成，需要开发者自己手写sql语句，使用用 DB 类去执行原生sql。 laravel 中 DB 类的基本用法**DB::table('tableName')** 获取操作tableName表的实例。

1. 数据库在laravel框架中的配置

	在.env文件里面配置

		DB_CONNECTION=mysql
		DB_HOST=localhost
		DB_PORT=3306
		DB_DATABASE=laravel
		DB_USERNAME=root
		DB_PASSWORD=

	也可以在config目录下面的database.php文件里面配置，使用env函数，表示先从env文件里面获取，如果获取成功则使用，如果获取失败，则使用env函数的第二个参数。

		
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

	**注意：如果是php artisan serve方式启动的，修改了配置文件，则需要重新启动，才能读取修改后的配置文件；如果是wamp/lamp等环境则不需要重启。**

2. 在Test控制器中引入DB门面

DB门面在app.php中已经定义别名DB，可以直接use，不需要写太长空间

3. 定义增删改查需要的路由

	- 增加：/home/test/add
	- 删除：/home/test/del
	- 修改：/home/test/update
	- 查询：/home/test/select

			//DB门面的增删改查
			Route::group(['prefix'=>'home/test'],function(){
				Route::get('/add','TestController@add');
				Route::get('home/test/del','TestController@del');
				Route::get('home/test/update','TestController@update');
				Route::get('home/test/select','TestController@select');
			});


## 增加信息（insert） ##

对数据库中的某个表增加数据主要有两个函数可以实现，分别是insert()和insertGetId()

- **insert(数组)可以同时添加一条或多条，返回值是布尔类型。**

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

- insertGetId(一维数组)，只能添加一条数据，返回自增的id。

		$result = DB::table('member')->insertGetId([
    			'name'	=>	'王五',
    			'age'	=>	14,
    			'email'	=>	'test1@test.com',
    	]);

    	dd($result);

**注意：DB::table('无前缀的表名') -> insert();		连贯操作/链式操作**


## 修改数据( update) ##

数据修改可以使用update()、increment()和decrement()函数来实现。

Where语法：

->where(字段,运算符,值)    如果运算符为“=”，则第二个参数可以不写

- Update表示可以修改整个记录中的全部字段,其返回的结果表示受到影响的行数；

		$result = DB::table('member')->where('id','=','1')->update([
    		'name' => '张四'
    	]);

- Increment和decrement表示修改数字字段的数值（递增或者递减）,其返回的结果表示受到影响的行数；典型的应用：记录登录次数、积分的增加；

		$result = DB::table('member')->where('id','=','1')->Increment('age',1);

		//DB::table(' member')->increment('votes');			每次+1
		//DB::table(' member')->increment('votes', 5);		每次+5
		//DB::table(' member')->decrement('votes');			每次-1
		//DB::table(' member')->decrement('votes', 5);		每次-5


## 查询数据(get) ##

### 取出基本数据 ###

#### 案例1：获取member表中所有的数据 ####

**DB::table('member')->get();**  //相当于select * from member;返回值是一个集合对象，

	//查询方法
    public function select()
    {
       $db =  DB::table('member');
       $data = $db->get();
       dd($data);
    }

	//返回值
	/*
	Illuminate\Support\Collection {#257 ▼
	  #items: array:3 [▼
	    0 => {#259 ▼
	      +"id": 1
	      +"name": "李五"
	      +"age": 12
	      +"email": "test1@test.com"
	    }
	    1 => {#261 ▶}
	    2 => {#262 ▶}
	  ]
	}
	*/

完成遍历取出的数据：

	 //查询方法
    public function select()
    {
       $db =  DB::table('member');
       $data = $db->get();
       //dd($data);
        foreach ($data as $key => $value) {
          echo "id is {$value->id},name is {$value->name},age is {$value->age}<br/>";
        }

    }

Get查询的结果每一行的记录是**对象的形式，不是数组**。

#### 案例2：获取id<3的数据  ####

**->where()->get();**

	 //查询id<3的数据
	$data = $db->where("id","<","3")->get();

**注意：where方法之后继续调用where方法。**

- -> where() -> where() -> where()..			这个语法是并且（and）关系语法。

		 //查询Id大于2并且age小于40的数据
	      $data = $db->where('id',">","2")->where("age","<","40")->get();

- -> where() -> orWhere() -> orWhere()…		这个语法是或者（or）关系语法。
- orwhere方法的参数与where一致。

### 取出单行数据 ###

DB::table('member')->where('id','1')->**first()**;//返回值是一个对象 等价于limit 1

	/*取出单行记录*/
	 $data = $db->first();
  	 dd($data);

返回结果是对象：

	{#259 ▼
	  +"id": 1
	  +"name": "李五"
	  +"age": 10
	  +"email": "test1@test.com"
	}

### 获取某个具体的值（一个字段） ###

	/*取出指定字段的值*/
	$data = $db->where('id',1)->value('name');
   dd($data);

返回值

	"李五"

### 获取某些字段数据（多个字段） ###

$users = DB::table('member')->**select('name', 'age')**->get();

$users = DB::table('member')->**select('name as user_name')**->get();

	 /*查询指定的一些字段的值*/
	 $data = $db->where("id",1)->select('name',"age")->get();
   	dd($data);
	/**
		Illuminate\Support\Collection {#257 ▼
	  #items: array:1 [▼
	    0 => {#258 ▼
	      +"name": "李五"
	      +"age": 10
	    }
	  ]
	}
	**/

### 排序操作 ###

DB::table('member')->**orderBy('age','desc')**->get();

	 	//按照指定的字段进行特定规则排序
       $data = $db->orderBy("age","desc")->get();
       dd($data);

### 分页操作 ###

DB::table('member')->**limit(3)->offset(2)**->get();

- Limit：表示限制输出的条数
- Offset：从什么地方开始
- 组合起来等价于limit 5,5

       //分页操作
       $data = $db->offset(1)->limit(2)->get();
       dd($data);

## 删除数据(delete)【了解】 ##

数据删除可以通过delete函数和truncate函数实现，

- Delete表示删除记录
- Truncate表示清空整个数据表；

		DB::table('table_name')->where('id','1')->delete();

		 /*删除操作*/
	    public function del()
	    {
	        //指定需要操作的数据表
	        $db = DB::table('member');
	        //删除id为1的记录
	        $result = $db->where("id",3)->delete();
	        dd($result);
	    }

返回值表示受到影响的行数

补充：truncate

	语法：DB::table(‘member’) -> truncate();

## 执行任意的SQL语句（了解） ##

1. 执行任意的insert update delete语句【影响记录的语句使用statement语法】

		DB::statement(“insert into member values(null,’’)”);

2. 执行任意的select语句【不影响记录的语句使用select语法】

		$res = DB::select("select * from member"); 

# 视图操作 #

## 视图写哪里 ##

	\resources\views

## 视图文件的命名与渲染 ##

1. **文件名习惯小写（建议小写）**
2. **文件名的后缀是 .blade.
3. php**（因为laravel里面有一套模板引擎就是使用blade，可以直接使用标签语法{{ $title }}， 也可以使用原生的php语法显示数据。）
3. 需要注意的是也可以使用.php结尾，但是这样的话就不能使用laravel提供的标签{{ $title }}语法显示数据，只能使用原生语法 <?php echo $title;?> 显示数据

**两个视图文件同时存在，则.blade.php后缀的优先显示。**

![](http://120.77.237.175:9080/photos/laravel/05.png)

展示视图的方法:

	return view('视图文件的名称');

**视图可以进行分目录管理的,例如需要展示home/test/test3视图,则可以写成:return view("home/test/test3"),当然也支持点写法:view("home.test.test3")**

	
    /*模板操作*/
    public function test3()
    {
        return view('home.test.test3');
    }

## 变量分配与展示 ##

语法:

1. **view(模板文件名称,数组)	数组就是需要分配的变量集合(推荐使用这种方法)**
2. view(模板文件名称)->with(数组)
3. view(模板文件名称)->with(名称,值)->with(名称,值)

使用view()方式渲染一个视图后,在.blade.php的视图中,**模板中输出变量使用"{{$变量名}}"**

**Controller**:

    /*模板操作*/
    public function test3()
    {
       $date =  date('Y-m-d',time());
       $year = '年';
        return view('home.test.test3',['date'=>$date,'year'=>$year]);
    }

**View**:

	这是一个test3的blade模板页面<br/>
	<!-- 在页面显示定义的参数 -->
	{{$date}}{{$year}}

**显示**:

	这是一个test3的blade模板页面
	2020-01-17年


## 扩展:compact函数使用(传参) ##

Compact函数,是php内置函数跟Laravel框架没有关系.作用主要用于打包数组的.

语法:compact('变量名1','变量名2',....);

	  /*模板操作*/
    public function test3()
    {
       $date =  date('Y-m-d',time());
       $year = '年';
        //return view('home.test.test3',['date'=>$date,'year'=>$year]);
        return view('home.test.test3',compact('date','year'));//同样效果,可以在页面正常显示
    }

## 模板中直接使用函数 ##

回顾:在smarty模板引擎中存在一个特殊的符号"|",名称称之为变量修饰符.作用就是在视图中解释变量(使用函数去处理变量)

在laravel中.视图调用函数其语法基本与js,php的语法一致,只不过要求左右包含大括号:

**语法:{{函数名(参数1,参数2)}}**

说明:函数名可以是php内置的,也可以是laravel框架中定义的

**Controller**:

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

**View**:

	<!-- 在页面调用函数 -->
	{{date('H:i:s',$timeStamp)}}

显示

	 09:53:09

## 循环与分支语法标签(重点) ##

### 在视图里面遍历数据(重点) ###

在Laravel中模板中循环输出数据,则需要遵循语法:

	@foreach($variable as $key => $item)
		//循环操作
	@endforeach

**定义路由**

	//视图循环操作
	Route::get('home/test/test4','TestController@test4');

**Controller**:

	
    /*循环操作*/
    public function test4()
    {
       $data =  DB::table('member')->get();
       return view('home.test.test4',compact('data'));
    }

**view**:

	@foreach($data as $key=>$item)
	    id:{{$item->id}},name:{{$item->name}}<br/>
	@endforeach

**显示:**

	id:1,name:李五
	id:2,name:张三


在此过程中需要注意的就是get查询到的结果集中每一条记录其实都是一个对象,**因此在循环具体字段的时候需要注意使用对象调用属性的方式才可以获取其数据**


### 在视图里面可以进行执行if判断(重点) ###

	@if(条件表达式1)
		//执行语句1
	@elseif(条件表达式2)
		//执行语句2
	@elseif(条件表达式3)
		//执行语句3
	...
	@else
		//默认的执行语句
	@endif

案例:要求在php代码中(控制器的方法)动态输出今天的星期数字(1-7),将数字传递给视图,显示出今天是星期几,如假设传递的数字是7,则页面中要输出"星期天"[将数字转化成汉字]

**Controller**

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

**View**

	@if($day == 1)
	    星期一
	@elseif($day == 2)
	    星期二
	@elseif($day == 3)
	    星期三
	@elseif($day == 4)
	    星期四
	@elseif($day == 5)
	    星期五
	@elseif($day == 6)
	    星期六
	@else
	    星期日
	@endif

## 模板继承/包含(理解) ##

### 模板继承 ###
继承不仅仅在php类中存在,在视图中同样存在.一般是用于做有公共部分的页面

案例:编写父级页面,再编写一个子页面

语法:@yield("名字");		在父级页面中的占位

**父view(创建parent.blade.php父文件)**

	<h1>这是头</h1>
	@yield('mainbody')
	<h2>这是尾</h2>

继承语法:

子模板中按以下语法书写:

**@extends('需要继承的模板文件名') 其名称是要完整的路径**

**通过section 标签绑定区块/部件到父级页面,区块名称就是父级页面yield标签的参数名,不绑定的话页面继承后不清楚会在哪显示,会把继承过来的模板文件显示在页面最后**

	@section(区块名称)
		代码
	@endsection

**子view(创建test5.blade.php子文件)**

	@extends('home.test.parent')
	@section('mainbody')
	<div>
	    这是文章内容
	</div>
	@endsection

**显示效果**

	这是头
	这是文章内容
	这是尾

### 模板包含 ###

**模板语法: @include(模板文件名)	文件名不含后缀,语法类似view方法参数**

	@include('home.test.parent')

**显示效果**

	这是头
	这是文章内容
	这是尾

## 外部静态文件引入方式(了解) ##

在写页面肯定会引入相关的外部文件(js,css,image),则会涉及到路径的问题.以下面的app.css为例:

	<!--在上面的test5.blade.php文件测试-->
	<!--以往的引入方式-->
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<!--在laravel中系统封装了一个方法asset-->
	<link rel="stylesheet" type="text/css" href="{{asset('css')}}/app.css">

显示效果:

	<!--可以看出laravel中定义的这个标签使用有点多余,在本站访问没有必要写全域名,没有以往的引入方式好用,可以忽略只作了解-->
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	
	<link rel="stylesheet" type="text/css" href="http://www.laravel123.com/css/app.css">


**asset方法中的参数可以是多级目录也可以是单级目录**

# CSRF攻击 #

## 什么是CSRF攻击 ##

CSRF是跨站请求伪造(Cross-site request forgery)的英文缩写,Laravel框架中避免CSRF攻击很简单,Laravel自动为每个用户Session生成了一个CSRF Token,该Token可用于验证登录用户和发起请求者是否同一个,如果不是则请求失败,[**该原理和验证码的原理是一致**]

Laravel提供了一个全局帮助函数csrf_token来获取Token值,因此只需要视图提交表单中添加如下HTML代码即可在请求中带上Token:

	<!--php原生写法-->
	<input type="hidden" name="_token" value="<?php echo csrf_token();?>" />

## Laravel中如何避免CSRF攻击 ##

案例:通过案例实现csrf的机制验证

创建两个路由,一个用于展示表单(get),另外处理请求(post)

		//验证CSRF
		Route::get('home/test/test6','TestController@test6');
		Route::post('home/test/test7','TestController@test7')->name('test7');

使用默认的表单页面提交
	
		<form action="{{route('test7')}}" method="post">
		    <input type="text" name=""/>
		    <input type="submit" name=""/>
		</form>
	
页面会报异常无法提交成功
	
![](http://120.77.237.175:9080/photos/laravel/06.png)

**结论:可以看出在Laravel中csrf验证机制默认是开启的**

觖决报错问题(如何通过csrf验证)

觖决思路:带上csrf需要token值,随着请求传递给后续的方法

	<form action="{{route('test7')}}" method="post">
	    <input type="text" name=""/>
	    <!--添加CSRF验证-->
	    <input type="hidden" name="_token" value="{{csrf_token()}}">
	    <input type="submit" name=""/>
	</form>

针对csrf\_token方法的简化: **{{csrf_field()}}**

通过查看源码可以发现两者的显示方式是一样的

	<form action="http://www.laravel123.com/home/test/test7" method="post">
	    <input type="text" name=""/>
	    <!--添加CSRF验证-->
	    <!--csrf_token()-->
	   <!--<input type="hidden" name="_token" value="bqZwvMCW8NrB8t9EHlUEWpBIq3qPomneCXn5i6zs"> -->
	   <!--csrf_field()-->
	  <input type="hidden" name="_token" value="bqZwvMCW8NrB8t9EHlUEWpBIq3qPomneCXn5i6zs">
	    <input type="submit" name=""/>
	</form>

两者的区别:
- csrf\_token只是输出token的值
- csrf\_field输出了一个整个的Input隐藏域

在后期使用的时候怎么选择:在部分情况下可以自己根据情况选择.但是有一个情况下开发者是没有选择权限的,必须需要使用csrf_token的,这个情况就是使用**异步提交**表单的方式

## 从CSRF验证中排除例外路由 ##

并不是所有请求都需要避免CSRF攻击，比如去第三方API获取数据的请求。
可以通过在VerifyCsrfToken（app/Http/Middleware/VerifyCsrfToken.php）中间件中将要排除的请求URL添加到$except属性数组中：

	 //多个元素之前通过","分割,遵循数组写法
    protected $except = [
        //该处写需排除csrf验证的路由
        //'home/test/test7',
        //'*',    //表示全部的路由都不需要进行csrf验证
    ];

# 模型操作（AR模式）【理解】 #

Laravel 自带的 Eloquent ORM 提供了一个美观、简单的与数据库打交道的 **ActiveRecord** 实现，**每张数据表都对应一个与该表进行交互的“Model模型”**，模型允许你在表中进行数据查询，以及插入、更新、删除等操作。

**AR模式三个核心（映射）：**

- **每个数据表				与数据表进行交互的Model模型映射（实例化模型）**
- **记录中的字段			与模型类的属性映射（给属性赋值）**
- **表中的每个记录			与一个完整的请求实例映射（具体的CURD操作）**

## 定义模型 ##

1. 定义位置

	定义模型的位置，默认是在app目录下面，但是为了管理方便，建议分目录进行创建
2. 命名规则

	本身laravel对模型的命名没有严格的要求，一般采用  **表名(首字母大写).php**

	比如：Member.php  User.php   Goods.php
3. 创建模型

		php artisan make:model Home/Member

	创建好的初始代码：
	
		<?php
		
		namespace App\Home;
		
		use Illuminate\Database\Eloquent\Model;
		
		class Member extends Model
		{
			//
		}
4. **定义模型注意事项（重点）**

	1. （**必做**）定义一个$table属性，值是不要前缀的表名，**如果不指定则使用类名的复数形式作为表名**。如果模型为Member模型在不指定table属性的情况下，其默认会去找members表。修饰词：protected
	2. （可选）定义$primaryKey属性，值是主键名称，如果需要使AR模式的find方法，则可能需要指定主键（Model::find(n)），在主键字段不是id的时候则需要指定主键。修饰词：protected
	3. （可选）定义$timestamps属性，值是false,如果不设置为false，则默认会操作表中的created_at和updated_at字段,我们表中一般没有这两个字段，所以设置为false,表示不要操作这两个字段。**修饰词：public**
	4. （可选）定义$fillable属性，表示使用模型插入数据时，允许插入到数据库的字段信息。修饰词：protected

			class Member extends Model
			{
			    //定义模型关联的数据表(一个模型只操作一个表)
			    protected $table = 'member';
			    //定义主键(可选)
			    protected $primaryKey = 'id';
			    //定义禁止操作时间
			    public $timestamps = false;
			    //设置允许写入的数据字段
			    protected $fillable = ['id','name','age','email'];
			}

	注意：**使用模型中create插入数据时，要设置$fillable允许入库的字段**，使用$guarded是设置排除入库的字段。

## 模型控制器中调用 ##

引入Member模型类；

	use App\Home\Member;

**模型的使用：模型在控制器中的使用方式有2种**

1. 直接像使用DB门面一样的操作方式：以调用静态方法为主的形式，该形式下模型不需要实例化，例如：Member::get() 等价于 DB::table(‘member’) -> get()；
2. 实例化模型然后再去使用模型类（普通）
	
	例如:$model = new Member();$model -> get();
3. 定义测试路由

		//模型操作
		Route::group(['prefix'=>'home/test'],function(){
		    Route::get('/modeladd','TestController@modeladd');
		    Route::get('/modeldel','TestController@modeldel');
		    Route::get('/modelupdate','TestController@modelupdate');
		    Route::get('/modelselect','TestController@modelselect');
		});

4. 基本操作
	1. **添加数据**

		在laravel里面完成数据的添加可以使用两种方式：

		**方式一（AR模式）：使用AR模式必须要实例化模型**

		注意：在laravel里面添加数据的时候，需要先实例化模型，然后为模型设置属性，最后调用save方法即可。

			$member = new Member();	//映射关系1：将表映射到模型
			$member-> name = value;	//映射关系2：将字段映射到属性，属性名和字段名一致
			$member -> age = value;
			…
			$member -> save();		//映射关系3：将记录映射到实例

		如果模型中不去关联数据表，则会报以下的错误：
		![](http://120.77.237.175:9080/photos/laravel/07.png)
		
			  //模型添加操作
		    public function modeladd()
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
		    }

		上面的这种方法可以完成数据的插入，但是不建议使用。我们可以使用laravel提供的更高级的操作

		**方法二**

		建立简易表单，表单中有姓名、年龄、邮箱的字段，要求能够提交

		**test8.blade.php**

			 <form action="/home/test/modeladd" method="post">
		        <p>姓名：<input type="text" name="name" value=""></p>
		        <p>年龄：<input type="text" name="age" value=""></p>
		        <p>邮箱：<input type="email" name="email" value=""></p>
		        {{csrf_field()}}
		        <input type="submit" value="提交">
		    </form>

		**首先，在控制器文件引入Request这个类**
	
			use Illuminate\Http\Request;

		Request类的使用：
	
		1. 对象传递
		2. request语法（与input门面有点类似，方法名一致，但是input调用的是静态方法，而当前的不是）

				$request->all()
				$request->input('name');
				$request->only([‘name1’,’name2’…])
				$request->except([‘name1’,’name2’…])
				$request->has(‘name’)
				$request->get(‘name’)

		**定义操作方法**

		    public function modeladd(Request $request)
		    {
		        //实例化模型,将表和类映射起来
		       $model =  new Member();
		        //添加操作
		       $result = $model->create($request->all());
		        dd($result);
		    }

		添加操作代码语法如下；

			Member::create($request->all())	//返回值是一个对象

		**注意：如果使用create方法，则需要在模型中定义fillable属性，允许写入字段的定义，如果没有时间相关字段也需要禁用时间自动更新功能**

	2. **查询操作**

		**获取指定主键的一条数据**

			$info = Member::find(4); // 静态方法调用，获取主键为4的数据

		**模型查询操作**

		    public function modelselect()
		    {
		        //查询指定主键的记录
		        $data = Member::find(1);
				//其结果集默认是一个对象。
		        dd($data->name);
		    }
				
		如果需要在laravel中对象的结果集转化成数组，则需要在最终添加方法的调用：

 			-> get() -> toArray();

		如需要数组结果，则可以写成：

			 $data = Member::find(1)->toArray();

		**获取符合指定条件的第一条记录**

			  //查询符合指定条件的第1条记录
		        $data = Member::where('age','>','20')->first()->toArray();
		        dd($data);

		**查询多行并且指定字段**

			Member::all()    
			Member::all([字段1,字段2])     //与get方法的区别，all不支持连接其他的辅助查询方法
			//相当于get方法
			Member::get()    
			Member::get([字段1,字段2])
			按条件查询指定多个字段
			Member::where('id','>',2)->get([' 列 1',' 列 2']);	//数组选列
			Member::where('id','>',2)->select('列1','列2')->get(); //字符串选列
			Member::where('id','>',2)->select( [' 列 1',' 列 2'] )->get(); //字符串选列

		案例：测试在all方法之前，写一些辅助方法实现连贯操作

		![](http://120.77.237.175:9080/photos/laravel/08.png)

	3. **修改数据**

		**注意：在laravel里面如果需要更新数据（ORM模型方式），需要先调用模型的find方法获取对应的记录，返回一个模型对象，然后为该模型对象设置要更新的数据（对象的属性），最后调用save方法即可。**

		例如：

			$user = User::find($id); 
			$user->title = $_POST['title']; 
			$user->content= $_POST['content'];
			return $user->save() ? 'OK' : 'fail';

		案例：实现ORM形式模型的修改操作。修改为10的用户的名字为"陈二"

			 //模型更新操作
		    public function modelupdate()
		    {
		        //AR模型的修改操作
		        $model = Member::find(10);
		        //赋值属性(需要修改的字段进行赋值)
		        $model->name = "陈二";
		        //具体操作:实例映射到记录
		        $result = $model->save();
		        dd($result);	//true
		    }

		问题：能不能用模型去update呢？

		答：可以使用update方法进行更新，也可以使用AR模式的方式进行更新。

			  $result =  Member::where('id','10')->update([
		            'age'   =>  40,
		        ]);
		       dd($result);			//返回1

	4. 删除数据

		**注意：在laravel里面如果要删除数据，如果需要使用AR模式删除数据必须先根据主键id查询对应的记录，返回一个模型对象，然后调用模型对象的delete方法即可。**

		例如代码：

			$user = User::find($id);
			return $user->delete() ? 'ok' : 'fail';

		案例：使用AR模式删除id为10的记录

			  //模型删除操作
		    public function modeldel()
		    {
		       $result = Member::find(10)->delete();
		        dd($result);	//true
		    }

		问题：DB里面的删除方式能否在模型中使用？【可以】

# 自动验证 #

一般一个框架都会提供自动验证的机制，在TP里面的验证的规则是写在模型里面进行验证的，但是自laravel里面的思想有些不一样，**它的验证规则可以在控制器里面，也可以单独的写一个专门的验证文件**。并且laravel里面的验证不通过情况下的**提示信息**和**表单数据**是保存在**session里面的**，并且验证不通过的情况下会跳到上一个页面。

在前端页面中可以通过JavaScript验证表单的数据有效性，但是如果用户的浏览器过低或者直接禁用js，则前端验证则可能会失效，这样就不能保证数据的有效性。所以后端也需做相应的验证操作，这个操作在laravel中称之为自动验证（在ThinkPHP中也有自动验证）。


## 准备工作 ##

创建需要的路由、方法

	//自动验证
	Route::any('home/test/auto_valid','TestController@autoValidation');

## 验证方式一（控制器方式验证：推荐）**建议去查看手册** ##

### 基本语法 ###

		使用控制器中的validate方法来完成，$this->validate($request,[验证规则]);
		如果验证失败，laravel会自动将用户重定向回上一个位置，并将验证错误信息一次性存放到session中。
		请求验证：

		![](http://120.77.237.175:9080/photos/laravel/09.png)

		扩展补充：如何得知一个请求类型？

			语法：Input::method()			//返回GET或者POST

			//自动验证
		    public function autoValidation()
		    {
		        //判断请球类型
		        $method = Input::method();
		        if($method =="POST")
		        {
		            //自动验证
		        } else {
		            //展示视图
		            return view('home.test.test9');
		        }
		    }
### 基本验证规则 ###

- required: 不能为空
- max:255最长255个字符，
- min:1最少1个字符
- email:验证邮箱是否合法
- confirmed:验证两个字段是否相同，如果验证的字段是password,则必须输入一个与之匹配的password_confirmation字段
- integer:验证字段必须是整型
- ip:验证字段必须是IP地址
- numeric 验证字段必须是数值
- max:value 验证字段必须小于等于最大值，和字符串，数值，文件字段的size规则一起使用。
- min:value 验证字段的最小值，对字符串、数值、文件字段而言，和size规则使用方式一致。
- size:value 验证字段必须有和给定值value想匹配的尺寸，对字符串而言，value是相应的字符数目，对数值而言，value是给定整型值；对文件而言，value是相应的文件字节数。
- string 验证字段必须是字符串
- unique:表名，字段，需要排除的ID

**注意：多个验证规则可以通过 "|" 字符进行隔开**

	语法：$this -> validate(数据对象,[数组形式的验证规则]);

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
                'age'   =>  'required|integer',
                'email' =>  'required|email',
            ]);
        } else {
            //展示视图
            return view('home.test.test9');
        }
    }

### 输出错误信息 ###

	![](http://120.77.237.175:9080/photos/laravel/10.png)

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

	效果:

	![](http://120.77.237.175:9080/photos/laravel/11.png)

### 把输出效果转换成中文 ###

由于中文和英文都是属于语言范畴，如果要切换提示文字，则需要有中文语言包的支持。目前框架只有en语言包，则需要其他语言包需要去下载。

网址：https://packagist.org    composer主要的代码托管网站

在官网搜索laravel-lang

1. 需要寻找下载命令

	![](http://120.77.237.175:9080/photos/laravel/12.png)

	安装命令：# composer require caouecs/laravel-lang:~4.0

2. 使用composer进行安装,在项目根目录下运行上述的命令
	![](http://120.77.237.175:9080/photos/laravel/14.png)

3. 使用方法

	![](http://120.77.237.175:9080/photos/laravel/13.png)

	**语言包文件在vendor/caoue/laravel-lang中；将你需要的语言目录复制到resources/lang目录下即可。**

	根据提示

	![](http://120.77.237.175:9080/photos/laravel/15.png)

	在文件（config/app.php）中修改locale的值，改成你需要使用的语言简称。

	**简称其实就是语言包的文件夹名称**。
	
		 'locale' => 'zh-CN',
	**效果**:

	![](http://120.77.237.175:9080/photos/laravel/16.png)

	注意：并不是所有的字段都有对应的翻译（或者有的翻译可能不是很准确），如果想自己定义翻译，则需要去修改语言包文件代码。

	**resources/lang/zh-CN/validation.php**

	修改后续的值，或者新增需要的元素

# 文件上传 #

在laravel里面实现文件的上传是很简单的，压根不用引入第三方的类库，作者把上传作为一个简单的http请求看待的。使用时可以参考手册。

1. 修改表结构，添加一个字段

		ALTER TABLE `member` ADD COLUMN `avatar`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `email`;

2. 创建添加数据的表单和路由

	**路由**

		//文件上传
		Route::any('home/test/uploadfile','TestController@uploadFile');

	**View**

		  <form action="" method="post" enctype="multipart/form-data">
	        <p>姓名：<input type="text" name="name" value="" placeholder="请输入姓名"/></p>
	        <p>年龄：<input type="text" name="age" value="" placeholder="请输入年龄"/></p>
	        <p>邮箱：<input type="text" name="email" value="" placeholder="请输入邮箱"/></p>
	        <p>头像：<input type="file" name="avatar"/></p>
	        {{csrf_field()}}
	        <p><input type="submit" value="提交"/></p>
	    </form>

	**Controller**

	    //文件上传
	    public function uploadFile(Request $request)
	    {
	        //判断请求类型
	        $method = Input::method();
	        if($method == "POST")
	        {
	            //上传
	        } else {
	            //展示示图
	             return view('home.test.test10');
	        }
	
	    }

3. **在控制器中，添加上传业务处理逻**辑(此处操作建议查看手册)

	![](http://120.77.237.175:9080/photos/laravel/17.png)

	**关于上传错误状态码error的取值：0-7，但是没有5，0表示成功。**

	**问题：请你说出文件上传的本质（核心思想）？文件的移动，move_upload_file**

	![](http://120.77.237.175:9080/photos/laravel/18.png)

	更多的方法请访问：http://api.symfony.com/3.0/Symfony/Component/HttpFoundation/File/UploadedFile.html

	思路：
	- a. 先去判断文件是否正常和存在
	- b. 获取相关的信息（可选）
	- c. 保存文件（其实就是移动文件到新的目录）

	获取文件的方式：**既可以通过file方法来获取也可以通过动态属性来获取，二选一。**

4. 创建上传文件的保存路径

	![](http://120.77.237.175:9080/photos/laravel/19.png)

	上传路径:public/uploads

	关于项目中使用路径的说明：

	**如果路径是给php代码使用的，则路径建议使用“./”形式；如果路径是给浏览器使用的则建议使用“/”形式。**

	为了保存的文件不被覆盖，建议在保存文件的同时对文件名进行尽量唯一的重命名：

	
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
	              $request->file('avatar')->move('./uploads',md5(time()). rand(10000,99999).".".$request->file('avatar')->guessClientExtension());
	
	             }
	
	        } else {
	            //展示示图
	             return view('home.test.test10');
	        }
	
	    }

5. 注意：如果使用的是create方法添加数据到数据表中，则这里还要修改一下模型里面的一个fillable属性，代表允许插入到数据库的字段

		class Member extends Model
		{
		    //定义模型关联的数据表(一个模型只操作一个表)
		    protected $table = 'member';
		    //定义主键(可选)
		    protected $primaryKey = 'id';
		    //定义禁止操作时间
		    public $timestamps = false;
		    //设置允许写入的数据字段
		    protected $fillable = ['id','name','age','email','avatar'];
		}

	将数据写入数据表:

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
	                dd($result);
	             }
	
	        } else {
	            //展示示图
	             return view('home.test.test10');
	        }
	
	    }

	如果上传出现了错误，一定要使用获取错误信息的方法：

	![](http://120.77.237.175:9080/photos/laravel/20.png)

		$request -> file(‘avatar’) -> getErrorMessage();

# 数据分页 #

在laravel里面要完成分页是很简单的，它的思想之前的框架有些不一样，之前框架使用的是分页类完成分页，laravel是直接调用模型的分页方法，返回对应的数据和分页的字符串。

分页类的在框架中的位置（了解）:

	\vendor\laravel\framework\src\Illuminate\Pagination\Paginator.php

案例：使用分页功能实现当前member数据表的分页效果。由于数据量较少，可以考虑每页显示1个记录，重点是分页的效果

分页效果的实现大致需要哪几个步骤才能实现？

	- 查询符合分页条件的总的记录数
	- 计算总的页数（总记录数/每页记录数，并且向上取整）
	- 拼凑分页的链接
	- （核心）使用limit语法来限制分页的记录数
	- 展示分页的页码和分页数据
	- 如果可以，建议去考虑下分页的样式显示问题


1. 创建路由，并且展示简易列表页面（table标签布局）

	//数据分页
	Route::any('home/test/paging','TestController@paging');
2. 编写控制器中的方法代码，实现没有分页的效果（先不考虑分页效果）

    //数据分页
    public function paging()
    {
        //查询全部数据
       $data = Member::all();
       //展示视图并且传递数据
        return view('home.test.test11',compact('data'));
    }

3. 展示数据

	    <table style="border: 1px solid #000">
	        <thead>
	            <tr>
	                <th>id</th>
	                <th>名字</th>
	                <th>年龄</th>
	                <th>邮箱</th>
	                <th>头像</th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($data as $val)
	            <tr>
	                <td>{{$val->id}}</td>
	                <td>{{$val->name}}</td>
	                <td>{{$val->age}}</td>
	                <td>{{$val->email}}</td>
	                <td><img src="{{ltrim($val->avatar,'.')}}"></td>
	            </tr>
	            @endforeach
	
	        </tbody>
	    </table>

4. 在laravel中分页有2个提供者：**DB查询构建器，另外可以使用模型来实现**。用法基本一致

	以模型为例：
	
	![](http://120.77.237.175:9080/photos/laravel/23.png)

	分页的基本语法：

	**Model::paginate(每页显示的记录数)**	同样，paginate和get一样，支持使用where以及orderBy等辅助查询的方法。
	
		 //数据分页
	    public function paging()
	    {
	        //查询全部数据
	       $data = Member::paginate(1);
	       //展示视图并且传递数据
	        return view('home.test.test11',compact('data'));
	    }
	
	在页面中展示分页链接：
	
	**语法：{{$保存数据的对象 -> links()}}生成的链接**
	
	    <table style="border: 1px solid #000">
	        <thead>
	            <tr>
	                <th>id</th>
	                <th>名字</th>
	                <th>年龄</th>
	                <th>邮箱</th>
	                <th>头像</th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($data as $val)
	            <tr>
	                <td>{{$val->id}}</td>
	                <td>{{$val->name}}</td>
	                <td>{{$val->age}}</td>
	                <td>{{$val->email}}</td>
	                <td><img src="{{ltrim($val->avatar,'.')}}"></td>
	            </tr>
	            @endforeach
	
	        </tbody>
	
	    </table>
			{{$data->links()}}

5. 【可选】将页面的提示“>>”和“<<”改成上一页和下一页提示文字,直接改源码文件：

		vendor/laravel/framework/src/Illuminate/Pagination/resources/views/default.blade.php

注意：可以使用simplePaginate()表示简单分页，只有上一页和下一页，没有分页字符串。

例如：$info = Member::orderby('age','desc')->simplePaginate(2);

附：分页数据对象的其他实用方法如下

	分页数据对象->count()        			//当前页数据条数
	分页数据对象->currentPage()  		//当前页码
	分页数据对象->firstItem()    			//当前页第一条数据的序号
	分页数据对象->hasMorePages() 		//是否有后续页码
	分页数据对象->lastItem()     			//当前页最后一条数据的序号
	分页数据对象->lastPage() 				//最后页序号
	分页数据对象->nextPageUrl()  		//下一页的链接地址
	分页数据对象->perPage()      			//每页显示数据条数
	分页数据对象->previousPageUrl()  	//上一页的链接地址
	分页数据对象->total() 					//记录总条数
	分页数据对象->url(5)         			//制作指定页码的链接地址


# 验证码 #

## 验证码依赖安装 ##

1. 去packagist网站搜索验证码的代码依赖：关键词：captcha,用:mews/captcha
2. composer require mews/captcha
3. 修改配置文件：config/app.php，配置：配置provider信息，添加一行信息：

		'providers' => [
	        // ...
	        Mews\Captcha\CaptchaServiceProvider::class,
	    ]
4. 配置别名aliases键，添加一个别名记录

		'aliases' => [
	        // ...
	        'Captcha' => Mews\Captcha\Facades\Captcha::class,
	    ]
5. 如果（可选）需要定义自己的配置，则需要生成配置文件：
		
		php artisan vendor:publish

	发布之后会在config目录下找到对应的配置文件：captcha.php

## 案例 ##

案例：在之前test9的基础之上，实现验证码的显示

1. 需要在页面上显示出来,captcha_src();

	 	<p>验证码:<input type="text" name="captcha" /><img src="{{captcha_src()}}"></p>

	**如果需要自定义配置（如长度、宽高等），可以修改配置文件config/captcha.php文件**。

2. 验证码验证操作

 		 //自动验证
        //具体的规则
        //字段=>验证规则1|验证规则2|验证规则3
        $this -> validate($request,[
            'name'  =>  'required|min:2|max:20',
            'age'   =>  'required|integer|min:1|max:100',
            'email' =>  'required|email',
            'captcha'=> 'required|captcha',
        ]);

	**注意：验证码有效性验证规则，手册里是没有的，如果使用mews验证码包的话，其验证码验证规则就是captcha**

	显示效果:
	- captcha不能为空
	- validation.captcha(系统需要validation数组中的captcha元素,但有没有,所以提示英文)

	在**resources/lang/zh-CN/validation.php**语言文件中添加翻译
	![](http://120.77.237.175:9080/photos/laravel/21.png)

	**注意:validation.captcha这里提示的是validation文件下的首级captcha的配置,所以按上图配置可以正常显示出语言包**

# 数据表的迁移与填充 #

- 迁移：创建数据表的操作+删除数据表的操作
- 填充：往数据表里填充写入测试的数据（数据的插入操作）

## 数据的迁移操作 ##

在迁移过程中，操作可以分为两个部分：**创建与编写迁移文件、执行迁移文件**。

### 迁移文件的创建与编写 ###

迁移文件默认的位置: database/migrations

**注意:已经存在的2个文件，如果不打算使用系统自带的认证模块的话需要删除掉。**

1. 创建迁移文件

	案例：需要创建试卷的数据表，假设数据表的名字叫做paper。迁移文件名：**create_paper_table**
	
	创建的时候可以通过自动代码生成工具artisan命令来执行迁移文件的生成。
	
		#php artisan make:migration 迁移文件名      Create a new migration file
	
	迁移文件不需要分目录进行管理，可以直接书写名称即可。
	
	初始代码:
	
		class CreatePaperTable extends Migration
		{
		    /**
		     * Run the migrations.
		     *
		     * @return void (创建数据表)
		     */
		    public function up()
		    {
		        Schema::create('paper', function (Blueprint $table) {
		            $table->bigIncrements('id');
		            $table->timestamps();
		        });
		    }
		
		    /**
		     * Reverse the migrations.
		     *
		     * @return void (删除数据表,创建数据表的撤销操作)
		     */
		    public function down()
		    {
		        Schema::dropIfExists('paper');
		    }
		}
	
	- Up方法表示创建数据表的方法
	- Down方法表示删除数据表的方法

2. 编写迁移文件代码，让其能够实现数据表的**创建（up方法）与删除（down方法）**

	在写之前，可以参考项目初始化提供的user迁移文件：

	    public function up()
	    {
	        Schema::create('users', function (Blueprint $table) {
	            $table->bigIncrements('id');
	            $table->string('name');
	            $table->string('email')->unique();
	            $table->timestamp('email_verified_at')->nullable();
	            $table->string('password');
	            $table->rememberToken();
	            $table->timestamps();
	        });
	    }

		  public function down()
	    {
	        Schema::dropIfExists('users');
	    }

	Schema门面（类）是用于操作数据表的门面，调用其具体的方法之后就可以实现创建数据表与删除数据表，语法如上。照搬上述语法实现试卷表paper的创建：
	
	试卷表的字段分析：
	
		Id				表的主键，自增
		Paper_name		试卷名称，唯一，varchar(100)，不为空
		Total_score		试卷总分，整型数字，tinyint，默认为100
		Start_time		试卷开始考试时间，时间戳类型（整型int）
		Duration			考试时间长度，单位分钟，整型tinyint
		Status			试卷是否启用的状态，1表示启用，2表示禁用，默认为1，tinyint类型
	
	在创建数据表的列的时候遵循语法：
	
		$table 表示整个表的实例
		语法：$table -> 列类型方法(字段名,[长度/值范围]) -> 列修饰方法([修饰的值]);
		
		列类型方法的作用：指定列的名称并且设置列的类型长度或者其值范围（仅针对枚举类型）
		修饰方法：主要是补充列的一些特征，例如有些列不能为空，或者有默认值等等
	
	常见的修饰方法有：

	![](http://120.77.237.175:9080/photos/laravel/24.png)

	常用的列类型：

	![](http://120.77.237.175:9080/photos/laravel/25.png)

	创建数据表的迁移代码：

		 public function up()
	    {
	        Schema::create('paper', function (Blueprint $table) {
	            //每个列的定义代码
	            //$table -> 列类型方法(字段名,[长度/值范围]) -> 列修饰方法([修饰的值]);
	            //自增的主键ID
	            $table->increments('id');
	            //试卷名称,唯一,varchar(100),不为空
	            $table->string('paper_name','100')->notNull()->unique();
	            //试卷总分,整型数字,tinyint,默认为100
	            $table->tinyInteger('total_score')->default('100');
	            //试卷开始考试时间,时间戳类型(类型int)
	            $table->integer('start_time')->nullable();
	            //考试时间长度,单位分钟,整型tinyint
	            $table->tinyInteger('duration');
	            //试卷是否启用的状态,1表示启用,2表示禁用,默认为1,tinyint类型
	            $table->enum('status',['1','2'])->default(1);
	        });
	    }

	删除数据表的迁移代码：

		 public function down()
	    {
	        Schema::dropIfExists('paper');
	    }


### 执行迁移文件 ###

执行分为up执行和down执行

Up方法的执行:

如果在当前的项目中**第一次执行迁移文件**的话，则需要先去执行：

	#php artisan migrate:install

在执行过上述的命令之后，在数据表中会多出一个数据表，migrations

![](http://120.77.237.175:9080/photos/laravel/26.png)

作用：**用于创建记录迁移文件的记录数据表**。

需要执行up方法，则需要执行命令：（注意：**需要删除系统自带的迁移文件，只保留自己的**）

	#php artisan migrate				【执行迁移文件的：创建数据表】

![](http://120.77.237.175:9080/photos/laravel/27.png)

Down方法执行：（回滚操作，删除数据表）

	#php artisan migrate:rollback	【回滚最后一次的迁移操作，回滚操作不删除迁移文件】

回滚操作只删除迁移表中的记录和对应的数据表，其他操作不执行。

**注意：删除（回滚）之后会删除上一个批次的迁移记录，并且同批次建立的数据表也会删除，但是迁移文件依旧存在，方便后期继续迁移（创建数据表**

**注意:批次号：同一次被执行的多个迁移文件其批次号相同。**

针对迁移文件名的提示：如果迁移文件已经创建好并且执行了，就不要去修改迁移文件的名称，容易出错的。

## 数据表填充器 ##

填充操作就是往数据表中写测试数据的操作（增加操作）

### 填充器（种子文件）的创建与编写 ###

1. 填充器默认的所在目录

		database/seeds/DatabaseSeeder.php

2. 创建填充器

		#php artisan make:seeder 填充器名称	【约定俗成的写法：大写表名+TableSeeder】

	例如：以paper表为例，则名称应该为PaperTableSeeder

		#php artisan make:seeder PaperTableSeeder

	创建好的种子文件：

	![](http://120.77.237.175:9080/photos/laravel/28.png)

3. 【重点】编写填充器的代码，**实现往数据表中写入数据**

	注意：**在填充器文件中可以使用DB门面去新增数据，但是需要注意，DB门面在使用的时候不需要用户自己引入，一旦引入则报错，可以直接使用。**建议使用DB门面方法写入新的数据

		class PaperTableSeeder extends Seeder
		{
		    /**
		     * Run the database seeds.
		     *
		     * @return void
		     */
		    public function run()
		    {
		        $data = [
		            [
		                'paper_name'  =>  'test1',
		                'start_time'  => time(),
		                'duration'    => 100,
		            ],
		              [
		                'paper_name'  =>  'test2',
		                'start_time'  => time(),
		                'duration'    => 100,
		            ],
		              [
		                'paper_name'  =>  'test3',
		                'start_time'  => time(),
		                'duration'    => 100,
		            ],
		        ];
		        DB:table('paper')->insert($data);
		    }
		}

### 执行填充器文件 ###


	#php artisan db:seed --class=需要执行的种子文件名（不带.php）

种子文件不像迁移文件，迁移操作有单独的对应关系表去记录，由于种子文件的执行没有任何的记录，所以在执行种子文件的时候需要指定需要执行的种子文件。

	#php artisan db:seed --class=PaperTableSeeder

**填充器的执行操作没有回滚一说，没有删除。如果需要回滚，则可以手动清空对应的数据表。**

![](http://120.77.237.175:9080/photos/laravel/29.png)


# 项目初始化（使用laravel 做项目） #

1. 创建laravel项目

	通过composer进行创建：

		#composer create-project laravel/laravel=5.4.* --prefer-dist ./

2. 建立数据库

	修改.env文件，配置数据库的连接操作：

	![](http://120.77.237.175:9080/photos/laravel/30.png)

3. 设置网站本地化为中文

	修改语言包的配置：下载语言包：
	
		#composer require caouecs/laravel-lang:~3.0

	参考现文档里的自动验证里的输出转换成中文
4. 设置项目使用的时区

	修改系统默认的时区，修改配置文件：config/app.php配置项：timezone

	配置项的值：Aisa/shanghai	  Aisa/chongqing 	PRC（People`s Republic of China）

		'timezone' => 'UTC',

5. 清理项目（删除不需要的文件）

	- 删除app/Http/Controllers/Auth目录，因为需要自定义登录逻辑
	- **删除database/migrations/2014_10_12_000000_create_users_table.php**
	- **database/migrations/2014_10_12_100000_create_password_resets_table.php**
	- 同时也可以删除seeds目录下的初始文件：
	- 删除resources/views/welcome.blade.php欢迎页面
	- 在Public目录下的js、css文件夹也可以进行删除：

6. 关闭Mysql的严格模式

	编辑config/database.php将strict由true修改为false

		
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

	严格模式的功能说明
	- 不支持对not null字段插入null值
	- 不支持对自增长字段插入”值
	- 不支持text字段有默认值
7. 安装debugbar工具条（可选）

	安装命令(此版本必须Laravel5.5+)：

		composer require barryvdh/laravel-debugbar --dev

	最后修改config/app.php文件进行配置provider和aliases数组

		![](http://120.77.237.175:9080/photos/laravel/31.png)

# 响应处理 #

## json响应 ##

在laravel中框架如果需要响应json数据，则写成语法：

	return response() -> json(需要json输出的数据);

例

	//json
    public function json()
    {
        //查询数据
        $data = Member::all();
        //json格式响应
        return response()->json($data);
    }

## 跳转响应（重定向） ##

在有一些页面，例如同步添加操作，完成操作之后不能停留在当前页面，最好做一个跳转操作，也就是需要一个跳转的响应。

以之前的“上传操作代码”为例：后续比较理想的情况应该是在处理完成之后需要一个跳转提示，告知用户是否成功，成功则应该返回上一页，失败则应该输出错误提示。

两个跳转方式任选一个：

	Return redirect(路由);			该参数的路由可以是完整的请求路由，也可以是通过route方法+别名获取的路由
	Return redirect() -> to(路由);

# 会话控制 #

常见应用- **增删改查**

ession默认存到文件中

session文件的目录：

	storage\framework\sessions

## 使用Session门面 ##

控制器头部引用
	
	 use Illuminate\Support\Facades\Session;

由于session门面在app.php中已经定义好别名，所以在控制器中引入的时候可以直接

	use Session

常用方法

	ession::put('key', 'value');			Session中存储一个变量
	$value = Session::get('key');			Session中获取一个变量
	$value = Session::get('key', 'default');	Session中获取一个变量或返回一个默认值（如果变量不存在）
	$value = Session::get('key', function() { return 'default'; });
	Session::all();						Session中获取所有变量
	Session::has('users')				检查一个变量是否在Session中存在
	Session::forget('key');				Session中删除一个变量
	Session::flush();					Session中删除所有变量
	补充：session方法也可以在视图中使用，如：{{ Session::get('code')}}；

实例:

    //Session
    public function session()
    {
        //Session中存储一个变量
        Session::put("name","张三");
        //Session中获取一个变量
        echo Session::get("name");      //张三
        //Session中获取一个变量或近回一个默认值(如果变量不存在)
        echo Session::get("value",function(){return "123";});	//123
        //Session中获取所有变量
        dd(Session::all());
        //检查一个变量是否在Session中存在
        dd(Session::has("age"));	//false
        //Session中删除一个变量
        Session::forget("name");
        //Session中删除所有变量
        Session:flush();
    }

## 缓存操作 ##

Laravel 为不同的缓存系统提供了统一的 API。缓存配置位于 config/cache.php。在该文件中你可以指定在应用中默认使用哪个缓存驱动。Laravel 目前支持主流的缓存后端如 Memcached 和 Redis 等。

主要方法： 

	Cache::put()  
	Cache::get()  
	Cache::add() 
	Cache::pull() 
	Cache::forever() 
	Cache::forget()
	Cache::has()

系统默认是使用文件缓存，其缓存文件存储的位置位于（storage/framework/cache/data）：

	
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

## 设置缓存 ##

	语法：Cache::put('key', 'value', $minutes);
注意：**如果该键已经存在，则直接覆盖原来的值**，有效期必须设置，单位是分钟

	语法：Cache::add('key', 'value', $minutes);
add **方法只会在缓存项不存在的情况下添加数据到缓存**，如果数据被成功添加到缓存返回 true，否则，返回false：

永久存储数据

forever 方法用于持久化存储数据到缓存，这些值必须通过 forget 方法手动从缓存中移除：

**Cache::forever('key', 'value');		永久存储并不是真的永久，只不过其截至的时间是比较大的值（到2286年）**

## 获取缓存数据 ##

Cache 门面的 get 方法用于从缓存中获取缓存项，如果缓存项不存在，返回 null。如果需要的话你可以传递第二个参数到 get 方法指定缓存项不存在时返回的自定义默认值：

	$value = Cache::get('key');			获取指定的key值
	$value = Cache::get('key', 'default');	获取指定的key值，如果不存在，则使用默认值

可以传递一个匿名函数作为默认值，如果缓存项不存在的话闭包的结果将会被返回。传递匿名函数允许你可以从数据库或其它外部服务获取默认值：

	$value = Cache::get('key', function() {
	    return DB::table(...)->get();
	});

检查缓存项是否存在

has 方法用于判断缓存项是否存在：

	if (Cache::has('key')) {
	    //
	}

## 删除缓存数据 ##

语法：

	$value = Cache::pull('key'); 从缓存中获取缓存项然后删除，如果缓存项不存在的话返回null，一般设置一次性的存储的数据
	Cache::forget('key'); 使用forget 方法从缓存中移除缓存项数据
	Cache::flush();使用 flush 方法清除所有缓存：并且删除对应的目录

## 缓存数值增加/减少 ##

increment 和 decrement 方法可用于调整缓存中的整型数值。这两个方法都可以接收第二个参数来指明缓存项数值增加和减少的数目：**一般会用作计数器**。

	Cache::increment('key');
	Cache::increment('key', $amount);
	Cache::decrement('key');
	Cache::decrement('key', $amount);

## 获取并存储 ##

有时候你可能想要获取缓存项，但如果请求的缓存项不存在时给它**存储**一个默认值。例如，你可能想要从缓存中获取所有用户，或者如果它们不存在的话，**从数据库获取它们并将其添加到缓存中，你可以通过使用 Cache::remember 方法实现**：

	$value = Cache::remember('users', $minutes, function() {
	    return DB::table('users')->get();
	});

如果缓存项不存在，传递给 remember 方法的闭包被执行并且将结果存放到缓存中。

如果获取users值是不存在，则可以通过后续的回调代码去执行对应的操作获取其值，并返回，同时会设置一个指定有效期的缓存，方便下次直接使用。比较典型的操作就是在获取微信的accesstoken的时候可以使用。原因是accesstoken本身一天只有2000次的配额，而其有7200s的有效期，在有效期内可以不用去刷新请求。

还可以联合 remember 和 forever 方法：

	$value = Cache::rememberForever('users', function() {
	    return DB::table('users')->get();
	});


实例:

**路由**

	//缓存操作
	Route::get('home/test/cache','TestController@cache');

如果需要使用cache提供的方法，则需要先引入

	 'Cache' => Illuminate\Support\Facades\Cache::class,

**Controller**
	
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

经常使用的：**add/put、get、has、forget、flush、remember**。

# 联表查询 #

	文章表（article）：
			Id					主键
			Article_name			文章名称
			Author_id			作者（作者id）
	
	作者表（author）：
			Id					主键
			Author_name			作者名称

1. 创建迁移文件

		#php artisan make:migration create_article_table
		#php artisan make:migration create_author_table
2. 迁移代码

		class CreateAuthorTable extends Migration
		{
		    /**
		     * Run the migrations.
		     *
		     * @return void
		     */
		    public function up()
		    {
		        Schema::create('author', function (Blueprint $table) {
		            $table->increments('id');
		            $table->string('author_name',20)->notNull();
		        });
		    }
		
		    /**
		     * Reverse the migrations.
		     *
		     * @return void
		     */
		    public function down()
		    {
		        Schema::dropIfExists('author');
		    }
		}

		class CreateArticleTable extends Migration
		{
		    /**
		     * Run the migrations.
		     *
		     * @return void
		     */
		    public function up()
		    {
		        Schema::create('article', function (Blueprint $table) {
		            $table->increments('id');
		            $table->timestamps();
		        });
		    }
		
		    /**
		     * Reverse the migrations.
		     *
		     * @return void
		     */
		    public function down()
		    {
		        Schema::dropIfExists('article');
		    }
		}

3. 执行生成数据表的迁移文件

		php artisan migrate

4. 创建拟数据(通过填充器来实现)

	1. 创建填充器文件（可以将多个数据表的写入操作写在一起）
	
			php artisan make:seeder ArticleAndAuthorTableSeeder

	2. 编写数据模拟的代码

			class ArticleAndAuthorTableSeeder extends Seeder
			{
			    /**
			     * Run the database seeds.
			     *
			     * @return void
			     */
			    public function run()
			    {
			        DB::table('article')->insert([
			            [
			                'article_name'  =>  'test1',
			                'author_id'     =>  rand(1,3),
			            ],
			             [
			                'article_name'  =>  'test2',
			                'author_id'     =>  rand(1,3),
			            ],
			             [
			                'article_name'  =>  'test3',
			                'author_id'     =>  rand(1,3),
			            ],
			        ]);
			        DB::table('author')->insert([
			            [
			                'author_name'   =>  '张三',
			            ],
			            [
			                'author_name'   =>  '李四',
			            ],
			            [
			                'author_name'   =>  '王五',
			            ],
			        ]);
			    }
			}

	3. 需要执行填充器文件

			#php artisan db:seed --class=ArticleAndAuthorTableSeeder

分析

	sql语句：select  t1.id,t1.article_name,t2.author_name from article as t1 left join author as t2 on t1.author_id = t2.id;

将上述的sql语句改成链式操作：

**语法：DB门面/模型 -> join联表方式名称(关联的表名,表1的字段,运算符,表2的字段)**

![](http://120.77.237.175:9080/photos/laravel/32.png)

**Controller**

	   public function jointable()
	    {
	        //select  t1.id,t1.article_name,t2.author_name from article as t1 left join author as t2 on t1.author_id = t2.id;
	        $data = DB::table('article as t1')->select('t1.id','t1.article_name','t2.author_name')
	                            ->leftJoin('author as t2','t1.author_id','=','t2.id')
	                            ->get();
	        dd($data);
	    }

# 关联模型 (重点)#

关联模型就是绑定模型（表）的关系（关联表），后续需要使用联表的时候就可以直接使用关联模型。注意：**关联模型必须要创建模型。**

## 一对一关系 ##

1. 创建模型

		#php artisan make:model Home/Article
		#php artisan make:model Home/Author

2. 定义代码

		class Article extends Model
		{
		     //定义关联的数据表
		    protected $table = 'article';
		
		    //禁用时间字段
		    public $timestamps = false;
		}

		class Author extends Model
		{
		    //定义关联的数据表
		    protected $table = 'author';
		
		    //禁用时间字段
		    public $timestamps = false;
		}

3. 关联模型的关联方法

注意：在写关联模型的时候要分析出是谁关联谁，谁做主动关联的模型？当前的案例是**文章**关联作者，**需要关联代码写在主模型中**。

语法：

	public function 被关联的模型名小写(){
			return $this -> hasOne(‘需要关联模型的命名空间’,’被关联模型的关系字段,’本模型中的关系字段’);
	} 

**Article**

	class Article extends Model
	{
	     //定义关联的数据表
	    protected $table = 'article';
	
	    //禁用时间字段
	    public $timestamps = false;
	
	    //模型的关联操作:关联作者模型(一对一)
	    public function author()
	    {
	        return $this->hasOne('App\Home\Author','id','author_id');
	    }
	}

**关联关系的使用方法：使用动态属性进行调用**

![](http://120.77.237.175:9080/photos/laravel/34.png)

案例:

1. 定义路由

		//关联模型
		//一对一
		Route::get('home/test/joinmodeloneforone','TestController@joinModelOneForOne');
2. Controller

	![](http://120.77.237.175:9080/photos/laravel/33.png)

	- author就是关联方法
	- author_name是被关联模型表中的字段名称

使用一对一关联关系之后，其可以替代之前写join联表操作。

## 一对多关系 ##

1. 迁移文件的创建

		#php artisan make:migration create_comment_table

2. 编写迁移文件代码

		class CreateCommentTable extends Migration
		{
		    /**
		     * Run the migrations.
		     *
		     * @return void
		     */
		    public function up()
		    {
		        Schema::create('comment', function (Blueprint $table) {
		            //字段定义
		           $table->increments('id');
		           $table->string('comment')->notNull();
		           $table->tinyInteger('article_id');
		        });
		    }
		
		    /**
		     * Reverse the migrations.
		     *
		     * @return void
		     */
		    public function down()
		    {
		        Schema::dropIfExists('comment');
		    }
		}

3. 执行迁移文件生成数据表

		php artisan migrate

4. 添加测试的评论内容

	1. 创建填充器文件
	
			php artisan make:seeder CommentTableSeeder

	2. 编写填充器文件的代码

			class CommentTableSeeder extends Seeder
			{
			    /**
			     * Run the database seeds.
			     *
			     * @return void
			     */
			    public function run()
			    {
			        DB::table('comment')->insert([
			            [
			                'comment'   =>  111,
			                'article_id'=>  rand(1,3),
			            ],
			              [
			                'comment'   =>  222,
			                'article_id'=>  rand(1,3),
			            ],
			              [
			                'comment'   =>  333,
			                'article_id'=>  rand(1,3),
			            ],
			              [
			                'comment'   =>  444,
			                'article_id'=>  rand(1,3),
			            ],
			              [
			                'comment'   =>  555,
			                'article_id'=>  rand(1,3),
			            ],
			        ]);
			    }
			}

	3. 执行填充器文件

			php artisan db:seed --class=CommentTableSeeder

	4. 创建评论模型创建

			#php artisan make:model Home/Comment

		定义基本属性

			class Comment extends Model
			{
			    //定义关联的数据表
			    protected $table    = 'comment';
			
			    //禁用时间字段
			    public $timestamps = false;
			}

案例：查询出每个文章（主）下所有的评论（从）。

关联关系的编写：

		public function 被关联的模型名小写(){
				return $this -> hasMany(‘需要关联模型的命名空间’,’被关联模型的关系字段,’本模型中的关系字段’);
		} 

与hasOne方法相比，其只是把方法名称做了变化，其他与之前一致。

	 public function comment()
    {
        return $this->hasMany('App\Home\Comment','article_id','id');
    }

**Controller**

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

## 多对多关系 ##

**多对多的关系经过拆分之后其实就是两个一对多的关系**。由于是双向一对多的关系，因此光靠2张表是无法建立的关系的，需要依靠第三张表建立关系（xx与xx的关系表）。

1. 创建需要迁移文件

		#php artisan make:migration create_keyword_table
		#php artisan make:migration create_relation_table

2. 编写迁移文件的代码

		class CreateKeywordTable extends Migration
		{
		    /**
		     * Run the migrations.
		     *
		     * @return void
		     */
		    public function up()
		    {
		        Schema::create('keyword', function (Blueprint $table) {
		            $table->increments('id');
		            $table->string('keyword',10)->notNull();
		        });
		    }
		
		    /**
		     * Reverse the migrations.
		     *
		     * @return void
		     */
		    public function down()
		    {
		        Schema::dropIfExists('keyword');
		    }
		}


		class CreateRelationTable extends Migration
		{
		    /**
		     * Run the migrations.
		     *
		     * @return void
		     */
		    public function up()
		    {
		        Schema::create('relation', function (Blueprint $table) {
		            $table->increments('id');
		            $table->tinyInteger('article_id');
		            $table->tinyInteger('key_id');
		        });
		    }
		
		    /**
		     * Reverse the migrations.
		     *
		     * @return void
		     */
		    public function down()
		    {
		        Schema::dropIfExists('relation');
		    }
		}

3. 执行迁移文件生成数据表

		#php artisan migrate

4. 生成测试的数据

		#php artisan make:seeder KeywordAndRelationTableSeeder

	代码

		class KeywordAndRelationTableSeeder extends Seeder
		{
		    /**
		     * Run the database seeds.
		     *
		     * @return void
		     */
		    public function run()
		    {
		        DB::table('keyword')->insert([
		            [
		                'keyword'   =>  'keyword1',
		            ],
		              [
		                'keyword'   =>  'keyword2',
		            ],
		              [
		                'keyword'   =>  'keyword3',
		            ],
		              [
		                'keyword'   =>  'keyword4',
		            ],
		        ]);
		
		        DB::table('relation')->insert([
		            [
		                'article_id'    =>  rand(1,3),
		                'key_id'        =>  rand(1,4)
		            ],
		            [
		                'article_id'    =>  rand(1,3),
		                'key_id'        =>  rand(1,4)
		            ],
		            [
		                'article_id'    =>  rand(1,3),
		                'key_id'        =>  rand(1,4)
		            ],
		            [
		                'article_id'    =>  rand(1,3),
		                'key_id'        =>  rand(1,4)
		            ],
		        ]);
		    }
		}

	执行填充器文件：

		#php artisan db:seed --class=KeywordAndRelationTableSeeder

5. 创建需要的模型

**注意：根据手册中记录的语法要求，不需要给关系表单独的创建模型。**

该处只需要单独给keyword创建模型即可

	#php artisan make:model Home/Keyword

定义模型的基本内部结构

	class Keyword extends Model
	{
	    //定义关联的数据表
	    protected $table =  'keyword';
	
	    //禁用时间字段
	    public $timestamps = false;
	}

**案例：查询出每个文章下全部的关键词**

![](http://120.77.237.175:9080/photos/laravel/35.png)

**语法：return $this -> belongsToMany(被关联模型的元素空间路径,多对多模型的关系表名,当前模型中的关系键,被关联模型的关系键);**

**Model**

 	//模型的关联操作:关联关键词模型（多对多）
    public function keyword()
    {
        return $this->belongsToMany('App\Home\Keyword','relation','article_id','key_id');
    }

**Controller**

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