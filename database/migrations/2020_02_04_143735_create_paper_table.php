<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
