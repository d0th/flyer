<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Fasades\DB;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\frontend\HomeController;
use App\Network;

class dailyNight extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will clear db table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        // $network_face = Network::where('category_id', 2)->get();
        // $token = 'EAAQ1nZCCIJZBABAFuxZC6d2OhelOVLiznW6LbqucPwJFPMbhgHdwi11MoSc3Gzd5wRxpry8ZALLSNMbJDFBrNcy4bQLUJE5CZCGeWz7Y2EDk3E5vZAeRyOq9IuG6ov874oGwBLDPIx0bb47jiW5DuI1wDX56K6QdPMZBQmrrgsxMgZDZD';
        //     $me = curl_init();
        //     curl_setopt($me, CURLOPT_URL, "https://graph.facebook.com/v5.0/103590011045949/posts?fields=full_picture,message,likes,comments&access_token=" . $token);
        //     curl_setopt($me, CURLOPT_RETURNTRANSFER, 1);
        //     curl_setopt($me, CURLOPT_TIMEOUT, 15 );

        //     $media = json_decode(curl_exec($me));
            
        //     curl_close($me);

            // foreach ($media->data as $key => $value) {
            //     $nenwork = new Network;
            //     $nenwork->post_id = $value->id;
            //     $nenwork->data = serialize($value);
            //     $nenwork->category_id = 2;
            //     $nenwork->save();
            // }

            // return $media;
        // echo $network_face[0]->post_id;
        // HomeController::facebook();
    }
}
