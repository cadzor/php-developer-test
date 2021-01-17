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
    protected $signature = 'getpictures';

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
        $today = Carbon::today()->format('Y-m-d');
        $monthAgo = Carbon::today()->subDays(30)->format('Y-m-d');

        $client = new Client();
        $res = $client->request('GET', 'https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY&start_date='.$monthAgo.'&end_date='.$today);
        $resBody = json_decode($res->getBody());
    
        foreach ($resBody as $picture) {
            Picture::updateOrCreate([
                'title' => (!empty($picture->title)) ? $picture->title : 'No title',
                'date' => $picture->date,
                'url' => $picture->url,
                'hdurl' => (!empty($picture->hdurl)) ? $picture->hdurl : $picture->url,
                'media_type' => $picture->media_type,
                'explanation' => (!empty($picture->explanation)) ? $picture->explanation : '',
                'copyright' => (!empty($picture->copyright)) ? $picture->copyright : ''
            ]);
        }
    }

}
