<?php

use Illuminate\Database\Seeder;

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
