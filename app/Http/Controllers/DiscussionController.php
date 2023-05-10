<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Discussion;
use App\Models\Reply;
use Session;
use Auth;

class DiscussionController extends Controller
{
    public function create()
    {
        $title = 'Create Discussion';

        return view('discussion')->with(compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'channel_id' => 'required',
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'channel_id' => $request->channel_id,
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        Session::flash('success', 'Discussion Created Successfuly!');
        return redirect()->route('discussion.show', ['slug' => $discussion->slug]);
    }

    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        $title = $discussion->title;

        return view('discussions.show')->with(compact('title','discussion'));
    }

    public function reply($id, Request $request) {
        $this->validate($request, [
            'reply' => 'required'
        ]);

        $discussion = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => $request->reply
        ]);

        Session::flash('success', 'Your reply send Successfuly!');
        return redirect()->back();
    }
}
