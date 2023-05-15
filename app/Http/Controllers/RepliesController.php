<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Models\Reply;
use App\Models\User;
use App\Models\Like;
use Notification;
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

    public function best_answer($id) {
        $reply = Reply::find($id);

        $reply->best_answer = 1;
        $reply->save();

        $reply->user->points += 1;
        $reply->user->save();

        Session::flash('success', 'Reply mark as best answer successfully!');
        return redirect()->back();
    }

    public function edit($id) {
        $title = 'Edit Reply';
        $reply = Reply::find($id);

        return view('replies.edit')->with(compact('title', 'reply'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'reply' => 'required'
        ]);

        $reply = Reply::find($id);
        $reply->content = $request->reply;
        $reply->save();

        $discussion = Discussion::where('id', $reply->discussion_id)->first();
        
        $watchers = array();

        foreach ($discussion->watches as $watcher) {
            array_push($watchers, User::find($watcher->user_id));
        }

        Notification::send($watchers, new \App\Notifications\AReplyUpdated($discussion));

        Session::flash('success', 'Your reply Updated Successfuly!');
        return redirect()->route('discussion.show', ['slug' => $discussion->slug]);
    }
}
