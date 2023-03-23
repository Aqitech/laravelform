<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $channel1 = ['title' => 'Laravel'];
        $channel2 = ['title' => 'PHP'];
        $channel3 = ['title' => 'VueJS'];
        $channel4 = ['title' => 'Javascript'];
        $channel5 = ['title' => 'Wordpress'];
        $channel6 = ['title' => 'HTML'];
        $channel7 = ['title' => 'CSS'];
        $channel8 = ['title' => 'Bootstrap'];

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
