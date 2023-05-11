<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','channel_id','title','slug','content'
    ];

    public function channel() {
        return $this->belongsTo('App\Models\Channel');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany('App\Models\Reply');
    }

    public function watches() {
        return $this->hasMany('App\Models\Watch');
    }

    public function is_being_watch_by_auth_user() {
        $id = Auth::id();

        $watcher_ids = array();

        foreach ($this->watches as $watch) {
            array_push($watcher_ids, $watch->user_id);
        }

        if (in_array($id, $watcher_ids)) {
            return true;
        }else{
            return false;
        }
    }

    public function hasBestanswer() {
        $result = false;

        foreach ($this->replies as $reply) {
            if ($reply->best_answer) {
                $result = true;
                break;
            }
        }
        return $result;
    }
}
