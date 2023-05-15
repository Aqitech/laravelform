<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Discussion;
use App\Models\Reply;
use App\Models\User;
use Notification;
use Session;
use Auth;

class DiscussionController extends Controller
{
    public function create() {
        $title = 'Create Discussion';

        return view('discussions.add')->with(compact('title'));
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

    public function edit($slug) {
        $title = 'Edit Discussion';
        $discussion = Discussion::where('slug', $slug)->first();

        return view('discussions.edit')->with(compact('title', 'discussion'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $discussion = Discussion::find($id);

        $discussion->content = $request->content;
        $discussion->save();

        Session::flash('success', 'Discussion Updated Successfuly!');
        return redirect()->route('discussion.show', ['slug' => $discussion->slug]);
    }

    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        $best_answer = $discussion->replies()->where('best_answer',1)->first();
        $title = $discussion->title;

        return view('discussions.show')->with(compact('title','discussion','best_answer'));
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

        $watchers = array();

        foreach ($discussion->watches as $watcher) {
            array_push($watchers, User::find($watcher->user_id));
        }

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($discussion));

        Session::flash('success', 'Your reply send Successfuly!');
        return redirect()->back();
    }
}
