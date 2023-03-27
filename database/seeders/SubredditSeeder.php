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
            'color' => '#ffa500', // orange
            'created_at' => now(),
        ]);

        DB::table('subreddits')->insert([
            'user_id' => '2',
            'name' => 'VueJS',
            'description' => 'An approachable, performant and versatile framework for building web user interfaces.',
            'slug' => 'VueJS',
            'color' => '#378805', // green
            'created_at' => now(),
        ]);

        DB::table('subreddits')->insert([
            'user_id' => '1',
            'name' => 'Test Sub',
            'description' => 'Testing posts',
            'slug' => 'test-sub',
            'color' => '#ffffff', // white
            'subreddit_image' => '/post_files/gif-test.gif',
            'created_at' => now(),
        ]);

        DB::table('subreddits')->insert([
            'user_id' => '3',
            'name' => 'Black from User',
            'description' => 'Normal user is the moderator',
            'slug' => 'black-from-user',
            'color' => '#000000', //black
            'subreddit_image' => '/post_files/jpg-test.jpg',
            'created_at' => now(),
        ]);

        DB::table('subreddits')->insert([
            'user_id' => '2',
            'name' => 'Normal',
            'description' => 'Normal',
            'slug' => 'normal',
            'created_at' => now(),
        ]);
    }
}
