<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function discussions()
    {
        return $this->hasMany('App\Model\Discussion');
    }
}
