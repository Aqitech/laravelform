<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Session;
use Auth;


class RepliesController extends Controller
{
    public function dislike($id) {
        $like = Like::where(['user_id' => Auth::id(), 'reply_id' => $id])->first();
        $like->delete();

        Session::flash('error', 'You successfully dislike this reply!');
        return redirect()->back();
    }

    public function like($id) {
        $like = Like::create([
            'user_id' => Auth::id(),
            'reply_id' => $id
        ]);

        Session::flash('success', 'You successfully like this reply!');
        return redirect()->back();
    }
}
