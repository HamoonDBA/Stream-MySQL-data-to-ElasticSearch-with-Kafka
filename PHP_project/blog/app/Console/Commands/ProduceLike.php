<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ProduceLike extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:ProduceLike';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Produce random like';

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
            DB::table("post_likes")->insert(
                ["post_id" => $postId,
                    "user_id" => $users[$key]]
            );
        }
        DB::table("posts")->whereIn('id', $posts)->update(['like_count' => DB::raw("like_count+1")]);
    }
}