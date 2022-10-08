<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubredditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subreddits')->insert([
            'user_id' => '1',
            'name' => 'Laravel',
            'description' => 'Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.',
            'slug' => 'Laravel',
            'subreddit_image' => '/subreddit_images/raddit-1521490-1288232.png',
            'created_at' => now(),
        ]);

        DB::table('subreddits')->insert([
            'user_id' => '2',
            'name' => 'VueJS',
            'description' => 'An approachable, performant and versatile framework for building web user interfaces.',
            'subreddit_image' => '/subreddit_images/raddit-1521490-1288232.png',
            'slug' => 'VueJS',
            'created_at' => now(),
        ]);
    }
}
