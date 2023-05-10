<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Models\Channel;

class FormsController extends Controller
{
    public function index() {
        $title = 'Forms';
        $discussions = Discussion::orderBy('created_at','desc')->paginate(5);

        return view('form')->with(compact('title','discussions'));
    }

    public function channel($slug) {
        $title = ucfirst($slug);
        $channel = Channel::where('slug',$slug)->first();
        $discussions = $channel->discussions()->paginate(5);

        return view('channel')->with(compact('title','discussions'));
    }
}
