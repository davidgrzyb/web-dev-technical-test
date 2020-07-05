<?php

namespace App\Console\Commands;

use App\Photo;
use App\Gallery;
use Carbon\Carbon;
use App\Photographer;
use Illuminate\Console\Command;

class ImportDataFromJsonFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:json:import {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Takes the location of the landscapes.json file and uses the data to seed the database.';

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
        // Getting JSON file.
        $file = @file_get_contents(base_path() . '/' . $this->argument('file'));

        // If file not found return an error message.
        if(! $file) {
            return $this->error('File not found!');
        }

        // Decoding the JSON.
        $data = json_decode($file, true);

        // If JSON is not formatted correctly return an error message.
        if(! is_array($data)){
            return $this->error('File format is not valid!');
        }

        $photographer = Photographer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'bio' => $data['bio'],
            'profile_picture' => $data['profile_picture'],
        ]);

        $gallery = Gallery::create([
            'photographer_id' => $photographer->id,
        ]);

        // Loop over album items and save them as photos.
        foreach ($data['album'] as $photo) {
            Photo::create([
                'title' => $photo['title'],
                'description' => $photo['description'],
                'img' => $photo['img'],
                'featured' => $photo['featured'],
                'taken_at' => Carbon::parse($photo['date']),
                'gallery_id' => $gallery->id,
            ]);
        }

        return $this->info('Data imported successfully!');
    }
}
