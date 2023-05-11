<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watch;
use Session;
use Auth;


class WatchController extends Controller
{
    public function watch($id) {
        Watch::create([
            'discussion_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'Your watch set for this thred');
        return redirect()->back();
    }

    public function unwatch($id) {
        $watch = Watch::where(['discussion_id'=> $id, 'user_id'=> Auth::id()]);
        $watch->delete();

        Session::flash('success', 'Your watch unset for this thred');
        return redirect()->back();
    }
}
