<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Factory;
use DB;

class ProducePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:ProducePost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Produce random post';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $result = DB::table("users")->where("is_admin", 1)->orderBy(DB::raw("RAND()"))->take(5)->lists("id");
        foreach ($result as $senderId) {
            $faker = Factory::create("fa_IR");
            DB::table("posts")->insert(
                ["title" => substr($faker->realText(), 0, 100), "content" => $faker->realText(), "sender_id" => $senderId]
            );
        }
    }
}
