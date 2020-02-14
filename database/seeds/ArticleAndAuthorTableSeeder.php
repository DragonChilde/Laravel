<?php

use Illuminate\Database\Seeder;

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
