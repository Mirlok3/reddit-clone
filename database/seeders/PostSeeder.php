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

        DB::table('posts')->insert([
            'user_id' => '1',
            'title' => 'BIG POST WITH WEBM | Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellente',
            'slug' => 'big-post-with-video-lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit-aenean-commodo-ligula-eget-dolor-aenean-massa-cum-sociis-natoque-penatibus-et-magnis-dis-parturient-montes-nascetur-ridiculus-mus-donec-quam-felis-ultricies-nec-pellente',
            'description' => '
                One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.
                The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. Whats happened to me  he thought . It wasnt a dream.
                His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an
                illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then t',
            'post_file' => '/post_files/webm-test.webm',
            'subreddit_id' => '3',
            'url' => 'https://vuejs.org/guide/introduction.html',
            'created_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => '1',
            'title' => 'JPG TEST',
            'slug' => 'jpg-test',
            'description' => 'jpg test',
            'post_file' => '/post_files/jpg-test.jpg',
            'subreddit_id' => '3',
            'created_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => '1',
            'title' => 'png TEST',
            'slug' => 'png-test',
            'description' => 'png test',
            'post_file' => '/post_files/png-test.png',
            'subreddit_id' => '3',
            'created_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => '1',
            'title' => 'mp4 TEST 1920x1080',
            'slug' => 'mp4-test-1920x1080',
            'description' => 'mp4 test',
            'post_file' => '/post_files/mp4-test.mp4',
            'subreddit_id' => '3',
            'created_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => '1',
            'title' => 'ogg TEST',
            'slug' => 'ogg-test',
            'description' => 'ogg test',
            'post_file' => '/post_files/ogg-test.ogg',
            'subreddit_id' => '3',
            'created_at' => now(),
        ]);
    }
}
