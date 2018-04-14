<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Faker\Factory;

class ProduceComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:ProduceComment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Produce random Comment';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = DB::table("users")->where("is_admin", 0)->orderBy(DB::raw("RAND()"))->take(5)->lists("id");
        $posts = DB::table("posts")->orderBy(DB::raw("RAND()"))->take(5)->lists("id");
        foreach ($posts as $key => $postId) {
            $faker = Factory::create("fa_IR");
            DB::table("post_comments")->insert(
                ["post_id" => $postId, "body" => $faker->realText(),
                    "sender_id" => $users[$key]]
            );
        }
        DB::table("posts")->whereIn('id', $posts)->update(['comment_count' => DB::raw("comment_count+1")]);
    }
}