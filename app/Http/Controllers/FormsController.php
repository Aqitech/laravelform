<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use App\Models\Discussion;
use App\Models\Channel;
use Auth;

class FormsController extends Controller
{
    public function index() {
        $title = 'Forms';
        switch (request('filter')) {
            case 'me':
                $discussions = Discussion::where('user_id', Auth::id())->paginate(5);
            break;

            case 'solved':
                $answered = array();

                foreach (Discussion::all() as $discussion) {
                    if ($discussion->hasBestanswer()) {
                        array_push($answered, $discussion);
                    }
                }

                $discussions = new paginator($answered, 5);
            break;

            case 'unsolved':
                $unanswered = array();

                foreach (Discussion::all() as $discussion) {
                    if (!$discussion->hasBestanswer()) {
                        array_push($unanswered, $discussion);
                    }
                }

                $discussions = new paginator($unanswered, 5);
            break;
            
            default:
                $discussions = Discussion::orderBy('created_at','desc')->paginate(5);
            break;
        }

        return view('form')->with(compact('title','discussions'));
    }

    public function channel($slug) {
        $title = ucfirst($slug);
        $channel = Channel::where('slug',$slug)->first();
        $discussions = $channel->discussions()->paginate(5);

        return view('channel')->with(compact('title','discussions'));
    }
}
