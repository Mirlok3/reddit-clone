<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => '1',
            'title' => 'Documentation',
            'slug' => 'documentation',
            'description' => 'Click link bellow',
            'subreddit_id' => '1',
            'url' => 'https://laravel.com/docs/9.x',
            'created_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => '2',
            'title' => 'Documentation',
            'slug' => 'documentation-2',
            'description' => 'Click link bellow',
            'subreddit_id' => '2',
            'url' => 'https://vuejs.org/guide/introduction.html',
            'created_at' => now(),
        ]);
    }
}
