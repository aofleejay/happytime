<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HappytimeController extends Controller
{
    public function store(Request $request)
    {
        return $request->all();
    }
}
