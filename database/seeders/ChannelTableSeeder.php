<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Channel;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Laravel', 'slug' => Str::slug('laravel')];
        $channel2 = ['title' => 'PHP', 'slug' => Str::slug('PHP')];
        $channel3 = ['title' => 'VueJS', 'slug' => Str::slug('VueJS')];
        $channel4 = ['title' => 'Javascript', 'slug' => Str::slug('Javascript')];
        $channel5 = ['title' => 'Wordpress', 'slug' => Str::slug('Wordpress')];
        $channel6 = ['title' => 'HTML', 'slug' => Str::slug('HTML')];
        $channel7 = ['title' => 'CSS', 'slug' => Str::slug('CSS')];
        $channel8 = ['title' => 'Bootstrap', 'slug' => Str::slug('Bootstrap')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);
        Channel::create($channel8);
    }
}
