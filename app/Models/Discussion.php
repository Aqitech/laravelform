<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','channel_id','title','slug','content'
    ];

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }
}
