<?php

use Illuminate\Database\Seeder;
use App\PlatformType;
use Carbon\Carbon;

class PlatformTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Windows 10',
                'image' => 'https://tumbao.elcaribe.club/wp-content/uploads/2020/05/download.png',
                'path' => 'windows10.png',
            ],
            [
                'name' => 'Mac OS',
                'image' => 'https://miro.medium.com/max/1146/1*POlwgD8liUYUqiEU6IU1Pw.png',
                'path' => 'mac.png',
            ],
            [
                'name' => 'Android',
                'image' => 'http://algorithm.wiki/en/app/assets/images/button/button_download_android.png',
                'path' => 'android.png',
            ],
        ];
        $now = Carbon::now();

        foreach($data as $d) {
            Image::make($d['image'])->save(storage_path('platformImage/' . $d['path']));
            PlatformType::create([ 
                'plt_name' => $d['name'],
                'plt_dlImagePath' => $d['path'],
                'plt_createdAt' => $now,
                'plt_updatedAt' => $now,
            ]);
        }
    }
}
