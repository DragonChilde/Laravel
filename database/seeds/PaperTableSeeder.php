<?php

use Illuminate\Database\Seeder;

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
        DB::table('paper')->insert($data);
    }
}
