
- <a href="https://laravel.com/">官网</a>：https://laravel.com/
- <a href="http://www.golaravel.com/">中文官网</a>：http://www.golaravel.com/
- <a href="https://laravel-china.org/">中文社区</a>：https://laravel-china.org/

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