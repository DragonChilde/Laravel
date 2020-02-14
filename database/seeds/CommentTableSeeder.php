<?php

use Illuminate\Database\Seeder;

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
