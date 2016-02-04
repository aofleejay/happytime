<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HappytimeController extends Controller
{
    public function store(Request $request)
    {
        return view('store')
                ->with('text', $request->input('text'))
                ->with('user_name', $request->input('user_name'));
    }
}
