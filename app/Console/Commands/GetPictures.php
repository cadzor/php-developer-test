<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Picture;

class GetPictures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetPictures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get pictures from the NASA API for the last 30 days and save to DB.';

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
     * @return int
     */
    public function handle()
    {

        // Get today and a month ago
        $today = Carbon::today()->format('Y-m-d');
        $monthAgo = Carbon::today()->subMonth()->format('Y-m-d');

        // GET request to NASA APOD API via Guzzle
        $client = new Client();
        $res = $client->request('GET', 'https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY&thumbs=true&start_date='.$monthAgo.'&end_date='.$today);
        $resBody = json_decode($res->getBody());
    

        // Loop through different objects returned from API, create if new, otherwise ignore/update
        foreach ($resBody as $picture) {
            Picture::updateOrCreate([
                'title' => $picture->title ?? '',
                'date' => $picture->date ?? '',
                'url' => $picture->url ?? '',
                'hdurl' => $picture->hdurl ?? '',
                'thumbs' => $picture->thumbnail_url ?? '',
                'media_type' => $picture->media_type ?? '',
                'explanation' => $picture->explanation ?? '',
                'copyright' => $picture->copyright ?? ''
            ]);
        }
    }

}
