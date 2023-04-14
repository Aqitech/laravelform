<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;

class FormsController extends Controller
{
    public function index()
    {
        $title = 'Forms';
        $discussions = Discussion::orderBy('created_at','desc')->paginate(3);

        return view('form')->with(compact('title','discussions'));
    }
}
